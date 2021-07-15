<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Token;

class UsuarioModel extends Model {

    protected $table = 'usuarios';
    protected $returnType = 'App\Entities\Usuario';
    protected $allowedFields = ['nome', 'email', 'cpf', 'telefone', 'password', 'reset_hash', 'reset_expira_em', 'ativacao_hash'];
    //Datas
    protected $useTimestamps = true;
    protected $createdField = 'criado_em';
    protected $updatedField = 'atualizado_em';
    protected $dateFormat = 'datetime'; // Para uso com o $useSoftDelete
    protected $useSoftDeletes = true;
    protected $deletedField = 'deletado_em';
    //Validações
    protected $validationRules = [
        'nome' => 'required|min_length[4]|max_length[120]',
        'email' => 'required|valid_email|is_unique[usuarios.email]',
        'cpf' => 'required|exact_length[14]|validaCpf|is_unique[usuarios.cpf]',
        'telefone' => 'required',
        'password' => 'required|min_length[6]',
        'password_confirmation' => 'required_with[password]|matches[password]'
    ];
    protected $validationMessages = [
        'nome' => [
            'required' => 'O campo Nome é obrigatório.',
        ],
        'email' => [
            'required' => 'O campo E-mail é obrigatório.',
            'is_unique' => 'Desculpe. Esse email já existe.',
        ],
        'cpf' => [
            'required' => 'O campo CPF é obrigatório.',
            'is_unique' => 'Desculpe. Esse CPF já existe.',
        ],
    ];
    //Eventos callback
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data) {

        if (isset($data['data']['password'])) {

            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

            unset($data['data']['password']);
            unset($data['data']['password_confirmation']);
        }

        return $data;
    }

    /**
     * @uso Controller usuarios no método procurar com o autocomplete
     * @param string $term
     * @return array usuarios
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

    public function desabilitaValidacaoSenha() {

        unset($this->validationRules['password']);
        unset($this->validationRules['password_confirmation']);
    }

    public function desabilitaValidacaoTelefone() {

        unset($this->validationRules['telefone']);
    }

    public function desfazerExclusao(int $id) {

        return $this->protect(false)
                        ->where('id', $id)
                        ->set('deletado_em', null)
                        ->update();
    }

    /**
     * @uso Classe Autenticacao
     * @param string $email
     * @return objecto $usuario
     */
    public function buscaUsuarioPorEmail(string $email) {
        return $this->where('email', $email)->first();
    }

    public function buscaUsuarioParaResetarSenha(string $token) {


        $token = new Token($token);


        $tokenHash = $token->getHash();


        $usuario = $this->where('reset_hash', $tokenHash)->first();


        if ($usuario != null) {


            /**
             * Verificamos se o token não está expirado de acordo com a data e hora atuais
             */
            if ($usuario->reset_expira_em < date('Y-m-d H:i:s')) {

                /*
                 * Token está expirado, então setamos o $usuario = null;
                 */
                $usuario = null;
            }

            return $usuario;
        }
    }

    public function ativarContaPeloToken(string $token) {


        $token = new Token($token);


        $token_hash = $token->getHash();



        $usuario = $this->where('ativacao_hash', $token_hash)->first();


        if ($usuario != null) {


            $usuario->ativar();


            $this->protect(false)->save($usuario);
        }
    }

    public function recuperaTotalClientesAtivos() {

        return $this->where('is_admin', false)
                        ->where('ativo', true)
                        ->countAllResults(); // 
    }

}
