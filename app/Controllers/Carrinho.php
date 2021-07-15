<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Carrinho extends BaseController {

    private $validacao;
    private $produtoEspecificacaoModel;
    private $extraModel;
    private $produtoModel;
    private $medidaModel;
    private $bairroModel;
    private $acao;
    private $horaAtual;
    private $expedienteHoje;

    public function __construct() {


        $this->validacao = service('validation');

        $this->produtoEspecificacaoModel = new \App\Models\ProdutoEspecificacaoModel();
        $this->extraModel = new \App\Models\ExtraModel();
        $this->produtoModel = new \App\Models\ProdutoModel();
        $this->medidaModel = new \App\Models\MedidaModel();
        $this->bairroModel = new \App\Models\BairroModel();


        $this->horaAtual = date('H:i');

        $this->acao = service('router')->methodName();
    }

    public function index() {

        $data = [
            'titulo' => 'Meu carrinho de compras'
        ];


        if (session()->has('carrinho') && count(session()->get('carrinho')) > 0) {

            $data['carrinho'] = json_decode(json_encode(session()->get('carrinho')), false);
        }

        return view('Carrinho/index', $data);
    }

    public function adicionar() {


        if ($this->request->getMethod() === 'post') {


            $this->expedienteHoje = expedienteHoje();

            if ($this->expedienteHoje->situacao == false) {

                return redirect()->back()->with('expediente', 'Hoje estamos fechados para dar uma geral na casa.');
            }

            if ($this->horaAtual > $this->expedienteHoje->fechamento || $this->horaAtual < $this->expedienteHoje->abertura) {

                return redirect()->back()->with('expediente', "Nosso horário de atendimento para a " . $this->expedienteHoje->dia_descricao . " é das " . $this->expedienteHoje->abertura . " às " . $this->expedienteHoje->fechamento);
            }


            $produtoPost = $this->request->getPost('produto');


            $this->validacao->setRules([
                'produto.slug' => ['label' => 'Produto', 'rules' => 'required|string'],
                'produto.especificacao_id' => ['label' => 'Valor do produto', 'rules' => 'required|greater_than[0]'],
                'produto.preco' => ['label' => 'Valor do produto', 'rules' => 'required|greater_than[0]'],
                'produto.quantidade' => ['label' => 'Quantidade', 'rules' => 'required|greater_than[0]'],
            ]);


            if (!$this->validacao->withRequest($this->request)->run()) {

                return redirect()->back()
                                ->with('errors_model', $this->validacao->getErrors())
                                ->with('atencao', 'Por favor verifique os erros abaixo e tente novamente')
                                ->withInput();
            }



            /* Validamos a existência da especificacao_id */
            $especificacaoProduto = $this->produtoEspecificacaoModel
                    ->join('medidas', 'medidas.id = produtos_especificacoes.medida_id')
                    ->where('produtos_especificacoes.id', $produtoPost['especificacao_id'])
                    ->first();


            if ($especificacaoProduto == null) {

                return redirect()->back()
                                ->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor, entre em contato com a nossa equipe e informe o código de erro <strong>ERRO-ADD-PROD-1001<strong>');  // FRAUDE NO FORM                                                     
            }


            /* Caso o extra_id venha no post, validamos a existência do mesmo */
            if ($produtoPost['extra_id'] && $produtoPost['extra_id'] != "") {


                $extra = $this->extraModel->where('id', $produtoPost['extra_id'])->first();


                if ($extra == null) {

                    return redirect()->back()
                                    ->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor, entre em contato com a nossa equipe e informe o código de erro <strong>ERRO-ADD-PROD-2002<strong>');  // FRAUDE NO FORM ...  chave $produtoPost['extra_id']                                                    
                }
            }


            /* Buscamos o produto como objeto */
            $produto = $this->produtoModel->select(['id', 'nome', 'slug', 'ativo'])->where('slug', $produtoPost['slug'])->first();


            /* Validamos a existência do produto e se o mesmo está ativo */
            if ($produto == null || $produto->ativo == false) {

                return redirect()->back()
                                ->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor, entre em contato com a nossa equipe e informe o código de erro <strong>ERRO-ADD-PROD-3003<strong>');  // FRAUDE NO FORM na chave $produtoPost['slug']                                                 
            }

            /* Converto o objeto para array */
            $produto = $produto->toArray();


            /* Criamos o slug composto para identificarmos a existência ou não do item no carrinho na hora de adicionar */
            $produto['slug'] = mb_url_title($produto['slug'] . '-' . $especificacaoProduto->nome . '-' . (isset($extra) ? 'com extra-' . $extra->nome : ''), '-', true);


            /* Criamos o nome do produto a partir da especificação e (ou) do extra */
            $produto['nome'] = $produto['nome'] . ' ' . $especificacaoProduto->nome . ' ' . (isset($extra) ? 'Com extra ' . $extra->nome : '');

            /* Defimos o preco, quantidade e tamanho do produto */
            $preco = $especificacaoProduto->preco + (isset($extra) ? $extra->preco : 0);

            $produto['preco'] = number_format($preco, 2);
            $produto['quantidade'] = (int) $produtoPost['quantidade'];
            $produto['tamanho'] = $especificacaoProduto->nome;

            /* Removemos os atributos sem utilidade */
            unset($produto['ativo']);



            /* Iniciamos a inserção do produto no carrinho */

            if (session()->has('carrinho')) {

                /* Existe um carrinho de compras.... damos sequência.... */


                /* Recupero os produtos do carrinho */
                $produtos = session()->get('carrinho');

                /* Recuperamos apenas os slugs dos produtos do carrinho */
                $produtosSlugs = array_column($produtos, 'slug');


                if (in_array($produto['slug'], $produtosSlugs)) {

                    /* Já existe o produto no carrinho..... incrementamos a quantidade */


                    /* Chamamos a função que incrementa a quantidade do produto caso o mesmo exista no carrinho */
                    $produtos = $this->atualizaProduto($this->acao, $produto['slug'], $produto['quantidade'], $produtos);

                    /* Sobreescrevemos a sessão carrinho com o array $produtos qu foi incrementado (alterado) */
                    session()->set('carrinho', $produtos);
                } else {

                    /* Não existe no carrinho..... pode adicionar.... */


                    /**
                     * Adicionamos no carrinho existente o $produto. 
                     * Notem que o push adiciona na sessão 'carrinho' um array [ $produto ]
                     */
                    session()->push('carrinho', [$produto]);
                }
            } else {

                /* Não existe ainda um carrinho de compras na sessão */


                $produtos[] = $produto;

                session()->set('carrinho', $produtos);
            }

            return redirect()->to(site_url('carrinho'))->with('sucesso', 'Produto adicionado com sucesso!');
        } else {

            return redirect()->back();
        }
    }

    public function especial() {


        if ($this->request->getMethod() === 'post') {


            $this->expedienteHoje = expedienteHoje();

            if ($this->expedienteHoje->situacao == false) {

                return redirect()->back()->with('expediente', 'Hoje estamos fechados para dar uma geral na casa.');
            }

            if ($this->horaAtual > $this->expedienteHoje->fechamento || $this->horaAtual < $this->expedienteHoje->abertura) {

                return redirect()->back()->with('expediente', "Nosso horário de atendimento para a " . $this->expedienteHoje->dia_descricao . " é das " . $this->expedienteHoje->abertura . " às " . $this->expedienteHoje->fechamento);
            }


            $produtoPost = $this->request->getPost();

            $this->validacao->setRules([
                'primeira_metade' => ['label' => 'Primeiro produto', 'rules' => 'required|greater_than[0]'],
                'segunda_metade' => ['label' => 'Segundo produto', 'rules' => 'required|greater_than[0]'],
                'tamanho' => ['label' => 'Tamanho do produto', 'rules' => 'required|greater_than[0]'],
            ]);


            if (!$this->validacao->withRequest($this->request)->run()) {

                return redirect()->back()
                                ->with('errors_model', $this->validacao->getErrors())
                                ->with('atencao', 'Por favor verifique os erros abaixo e tente novamente')
                                ->withInput();
            }




            $primeiroProduto = $this->produtoModel->select(['id', 'nome', 'slug'])
                    ->where('id', $produtoPost['primeira_metade'])
                    ->first();

            if ($primeiroProduto == null) {

                return redirect()->back()
                                ->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor, entre em contato com a nossa equipe e informe o código de erro <strong>ERRO-ADD-CUSTOM-1001<strong>');  // FRAUDE NO FORM       $produtoPost['primeira_metade']                                                
            }

            $segundoProduto = $this->produtoModel->select(['id', 'nome', 'slug'])
                    ->where('id', $produtoPost['segunda_metade'])
                    ->first();

            if ($segundoProduto == null) {

                return redirect()->back()
                                ->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor, entre em contato com a nossa equipe e informe o código de erro <strong>ERRO-ADD-CUSTOM-2002<strong>');  // FRAUDE NO FORM  $produtoPost['segunda_metade']                                                     
            }

            /* Convertendo os objetos para array */
            $primeiroProduto = $primeiroProduto->toArray();
            $segundoProduto = $segundoProduto->toArray();



            /* Caso o extra_id venha no post, validamos a existência do mesmo */
            if ($produtoPost['extra_id'] && $produtoPost['extra_id'] != "") {


                $extra = $this->extraModel->where('id', $produtoPost['extra_id'])->first();


                if ($extra == null) {

                    return redirect()->back()
                                    ->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor, entre em contato com a nossa equipe e informe o código de erro <strong>ERRO-ADD-CUSTOM-3003<strong>');  // FRAUDE NO FORM ...  chave $produtoPost['extra_id']                                                    
                }
            }

            /* Recuperamos o valor do produto de acordo com o tamanho escolhido */
            $medida = $this->medidaModel->exibeValor($produtoPost['tamanho']);

            if ($medida->preco == null) {

                return redirect()->back()
                                ->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor, entre em contato com a nossa equipe e informe o código de erro <strong>ERRO-ADD-CUSTOM-4004<strong>');  // FRAUDE NO FORM ...  chave $produtoPost['tamnho']                                                    
            }


            /* Criamos o slug composto para identificarmos a existência ou não do item no carrinho na hora de adicionar */
            $produto['slug'] = mb_url_title($medida->nome . '-metade-' . $primeiroProduto['slug'] . '-metade-' . $segundoProduto['slug'] . '-' . (isset($extra) ? 'com extra-' . $extra->nome : ''), '-', true);


            /* Criamos o nome do produto a partir da especificação e (ou) do extra */
            $produto['nome'] = $medida->nome . ' metade ' . $primeiroProduto['nome'] . ' metade ' . $segundoProduto['slug'] . ' ' . (isset($extra) ? 'Com extra ' . $extra->nome : '');


            /* Defimos o preco, quantidade e tamanho do produto */
            $preco = $medida->preco + (isset($extra) ? $extra->preco : 0);

            $produto['preco'] = number_format($preco, 2);
            $produto['quantidade'] = 1; //Sempre será um
            $produto['tamanho'] = $medida->nome;


            /* Iniciamos a inserção do produto no carrinho */

            if (session()->has('carrinho')) {

                /* Existe um carrinho de compras.... damos sequência.... */


                /* Recupero os produtos do carrinho */
                $produtos = session()->get('carrinho');

                /* Recuperamos apenas os slugs dos produtos do carrinho */
                $produtosSlugs = array_column($produtos, 'slug');


                if (in_array($produto['slug'], $produtosSlugs)) {

                    /* Já existe o produto no carrinho..... incrementamos a quantidade */


                    /* Chamamos a função que incrementa a quantidade do produto caso o mesmo exista no carrinho */
                    $produtos = $this->atualizaProduto($this->acao, $produto['slug'], $produto['quantidade'], $produtos);

                    /* Sobreescrevemos a sessão carrinho com o array $produtos qu foi incrementado (alterado) */
                    session()->set('carrinho', $produtos);
                } else {

                    /* Não existe no carrinho..... pode adicionar.... */


                    /**
                     * Adicionamos no carrinho existente o $produto. 
                     * Notem que o push adiciona na sessão 'carrinho' um array [ $produto ]
                     */
                    session()->push('carrinho', [$produto]);
                }
            } else {

                /* Não existe ainda um carrinho de compras na sessão */


                $produtos[] = $produto;

                session()->set('carrinho', $produtos);
            }

            return redirect()->to(site_url('carrinho'))->with('sucesso', 'Produto adicionado com sucesso!');
        } else {

            return redirect()->back();
        }
    }

    public function atualizar() {

        if ($this->request->getMethod() === 'post') {

            $produtoPost = $this->request->getPost('produto');


            $this->validacao->setRules([
                'produto.slug' => ['label' => 'Produto', 'rules' => 'required|string'],
                'produto.quantidade' => ['label' => 'Quantidade', 'rules' => 'required|greater_than[0]'],
            ]);


            if (!$this->validacao->withRequest($this->request)->run()) {

                return redirect()->back()
                                ->with('errors_model', $this->validacao->getErrors())
                                ->with('atencao', 'Por favor verifique os erros abaixo e tente novamente')
                                ->withInput();
            }


            /* Recupero os produtos do carrinho */
            $produtos = session()->get('carrinho');

            /* Recuperamos apenas os slugs dos produtos do carrinho */
            $produtosSlugs = array_column($produtos, 'slug');


            if (!in_array($produtoPost['slug'], $produtosSlugs)) {

                return redirect()->back()
                                ->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor, entre em contato com a nossa equipe e informe o código de erro <strong>ERRO-ATUA-PROD-7007<strong>');  // FRAUDE NO FORM na chave $produtoPost['slug']
            } else {


                /* Produto validado.... atualizamos a quantidade do mesmo no carrinho */

                /* Chamamos a função que incrementa a quantidade do produto caso o mesmo exista no carrinho */
                $produtos = $this->atualizaProduto($this->acao, $produtoPost['slug'], $produtoPost['quantidade'], $produtos);

                /* Sobreescrevemos a sessão carrinho com o array $produtos que foi incrementado ou decrementado (alterado) */
                session()->set('carrinho', $produtos);


                return redirect()->back()->with('sucesso', 'Quantidade atualizada com sucesso');
            }
        } else {

            return redirect()->back();
        }
    }

    public function remover() {

        if ($this->request->getMethod() === 'post') {

            $produtoPost = $this->request->getPost('produto');


            $this->validacao->setRules([
                'produto.slug' => ['label' => 'Produto', 'rules' => 'required|string'],
            ]);


            if (!$this->validacao->withRequest($this->request)->run()) {

                return redirect()->back()
                                ->with('errors_model', $this->validacao->getErrors())
                                ->with('atencao', 'Por favor verifique os erros abaixo e tente novamente')
                                ->withInput();
            }


            /* Recupero os produtos do carrinho */
            $produtos = session()->get('carrinho');

            /* Recuperamos apenas os slugs dos produtos do carrinho */
            $produtosSlugs = array_column($produtos, 'slug');


            if (!in_array($produtoPost['slug'], $produtosSlugs)) {

                return redirect()->back()
                                ->with('fraude', 'Não conseguimos processar a sua solicitação. Por favor, entre em contato com a nossa equipe e informe o código de erro <strong>ERRO-ATUA-PROD-7007<strong>');  // FRAUDE NO FORM na chave $produtoPost['slug']
            } else {


                $produtos = $this->removeProduto($produtos, $produtoPost['slug']);

                /* Atualizamos o carrinho na sessão com o array $produtos sem o item que foi removido */
                session()->set('carrinho', $produtos);

                return redirect()->back()->with('sucesso', 'Produto removido do seu carrinho de compras');
            }
        } else {

            return redirect()->back();
        }
    }

    public function limpar() {

        session()->remove('carrinho');

        return redirect()->to(site_url('carrinho'));
    }

    public function consultaCep() {

        if (!$this->request->isAJAX()) {

            return redirect()->back();
        }


        $this->validacao->setRule('cep', 'CEP', 'required|exact_length[9]');


        if (!$this->validacao->withRequest($this->request)->run()) {

            $retorno['erro'] = '<span class="text-danger small">' . $this->validacao->getError() . '</span>';

            return $this->response->setJSON($retorno);
        }


        $cep = str_replace("-", "", $this->request->getGet('cep'));

        /* Carregamos o helper */
        helper('consulta_cep');


        $consulta = consultaCep($cep);


        if (isset($consulta->erro) && !isset($consulta->cep)) {

            $retorno['erro'] = '<span class="text-danger small">Informe um CEP válido</span>';

            return $this->response->setJSON($retorno);
        }






        $bairroRetornoSlug = mb_url_title($consulta->bairro, '-', true);


        $bairro = $this->bairroModel->select('nome, valor_entrega')->where('slug', $bairroRetornoSlug)->where('ativo', true)->first();



        /**
         * @descrição Em algumas situações o cliente poderá informar um CEP válido (ex.: 83430-000) que é um CEP para um munício todo.
         *            Ou seja, ele não é por rua. E se não é por rua, o Bairro será retornado como null no response do ajax request que fazemos
         *            para o webservice Via Cep 
         * 
         *            Portanto, alterem a verificação abaixo:
         * 
         *            Antes era:
         * 
         *              if ($bairro == null) {....
         * 
         *            Depois de alterado, ficará:
         * 
         *              if ($consulta->bairro == null || $bairro == null) {....
         */
        if ($consulta->bairro == null || $bairro == null) {

            $retorno['erro'] = '<span class="text-danger small">Não atendemos o Bairro: '
                    . esc($consulta->bairro)
                    . ' - ' . esc($consulta->localidade)
                    . ' - CEP ' . esc($consulta->cep)
                    . ' - ' . esc($consulta->uf)
                    . '</span>';

            return $this->response->setJSON($retorno);
        }


        $retorno['valor_entrega'] = 'R$ ' . esc(number_format($bairro->valor_entrega, 2));


        $retorno['bairro'] = '<span class="small">Valor de entrega para o Bairro: '
                . esc($consulta->bairro)
                . ' - ' . esc($consulta->localidade)
                . ' - CEP ' . esc($consulta->cep)
                . ' - ' . esc($consulta->uf)
                . ' - R$ ' . esc(number_format($bairro->valor_entrega, 2))
                . '</span>';


        $carrinho = session()->get('carrinho');

        $total = 0;

        foreach ($carrinho as $produto) {

            $total += $produto['preco'] * $produto['quantidade'];
        }


        $total += esc(number_format($bairro->valor_entrega, 2));

        $retorno['total'] = 'R$ ' . esc(number_format($total, 2));

        return $this->response->setJSON($retorno);
    }

    /**
     * 
     * @param string $acao
     * @param string $slug
     * @param int $quantidade
     * @param array $produtos
     * @return array
     */
    private function atualizaProduto(string $acao, string $slug, int $quantidade, array $produtos) {


        $produtos = array_map(function ($linha) use($acao, $slug, $quantidade) {

            if ($linha['slug'] == $slug) {


                if ($acao === 'adicionar') {

                    $linha['quantidade'] += $quantidade;
                }


                if ($acao === 'especial') {

                    $linha['quantidade'] += $quantidade;
                }



                if ($acao === 'atualizar') {


                    $linha['quantidade'] = $quantidade;
                }
            }

            return $linha;
        }, $produtos);

        return $produtos;
    }

    private function removeProduto(array $produtos, string $slug) {

        return array_filter($produtos, function ($linha) use($slug) {

            return $linha['slug'] != $slug;
        });
    }

}
