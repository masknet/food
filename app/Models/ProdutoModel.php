<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model {

    protected $table = 'produtos';
    protected $returnType = 'App\Entities\Produto';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'categoria_id',
        'nome',
        'slug',
        'ingredientes',
        'ativo',
        'imagem',
    ];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'criado_em';
    protected $updatedField = 'atualizado_em';
    protected $deletedField = 'deletado_em';
    // Validation
    protected $validationRules = [
        'nome' => 'required|min_length[2]|max_length[120]|is_unique[produtos.nome,id,{id}]',
        'categoria_id' => 'required|integer',
        'ingredientes' => 'required|min_length[10]|max_length[1000]',
    ];
    protected $validationMessages = [
        'nome' => [
            'required' => 'O campo Nome é obrigatório.',
            'is_unique' => 'Esse produto já existe.',
        ],
        'categoria_id' => [
            'required' => 'O campo Categoria é obrigatório.',
        ],
    ];
    //Eventos callback
    protected $beforeInsert = ['criaSlug'];
    protected $beforeUpdate = ['criaSlug'];

    protected function criaSlug(array $data) {

        if (isset($data['data']['nome'])) {

            $data['data']['slug'] = mb_url_title($data['data']['nome'], '-', TRUE);
        }

        return $data;
    }

    /**
     * @uso Controller usuarios no método procurar com o autocomplete
     * @param string $term
     * @return array categorias
     */
    public function procurar($term) {

        if ($term === null) {

            return [];
        }


        return $this->select('id, nome')
                        ->like('nome', $term)
                        ->withDeleted(true)
                        ->get()
                        ->getResult();
    }

    public function desfazerExclusao(int $id) {

        return $this->protect(false)
                        ->where('id', $id)
                        ->set('deletado_em', null)
                        ->update();
    }

    public function buscaProdutosWebHome() {

        return $this->select([
                            'produtos.id',
                            'produtos.nome',
                            'produtos.slug',
                            'produtos.ingredientes',
                            'produtos.imagem',
                            'categorias.id AS categoria_id',
                            'categorias.nome AS categoria',
                            'categorias.slug AS categoria_slug',
                        ])
                        ->selectMin('produtos_especificacoes.preco')
                        ->join('categorias', 'categorias.id = produtos.categoria_id')
                        ->join('produtos_especificacoes', 'produtos_especificacoes.produto_id = produtos.id')
                        ->where('produtos.ativo', true)
                        ->groupBy('produtos.nome')
                        ->orderBy('categorias.nome', 'ASC')
                        ->findAll();
    }

    /**
     * @uso no controller Produto/customizar
     * @param int $categoria_id
     * @return array de objetos
     */
    public function exibeOpcoesProdutosParaCustomizar(int $categoria_id) {

        return $this->select(['produtos.id', 'produtos.nome'])
                        ->join('produtos_especificacoes', 'produtos_especificacoes.produto_id = produtos.id')
                        ->where('produtos.categoria_id', $categoria_id)
                        ->where('produtos.ativo', true)
                        ->where('produtos_especificacoes.customizavel', true)
                        ->groupBy('produtos.nome')
                        ->findAll();
    }

    public function exibeProdutosParaCustomizarSegundaMetade(int $produto_id, int $categoria_id) {

        return $this->select(['produtos.id', 'produtos.nome'])
                        ->join('categorias', 'categorias.id = produtos.categoria_id')
                        ->join('produtos_especificacoes', 'produtos_especificacoes.produto_id = produtos.id')
                        ->where('produtos.id !=', $produto_id)
                        ->where('produtos.categoria_id', $categoria_id)
                        ->where('produtos.ativo', true)
                        ->where('produtos_especificacoes.customizavel', true)
                        ->groupBy('produtos.nome')
                        ->findAll();
    }

}
