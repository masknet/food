<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Produto extends BaseController {

    private $produtoModel;
    private $produtoEspecificacaoModel;
    private $produtoExtraModel;
    private $medidaModel;
    private $extraModel;

    public function __construct() {

        $this->produtoModel = new \App\Models\ProdutoModel();
        $this->produtoEspecificacaoModel = new \App\Models\ProdutoEspecificacaoModel();
        $this->produtoExtraModel = new \App\Models\ProdutoExtraModel();
        $this->medidaModel = new \App\Models\MedidaModel();
        $this->extraModel = new \App\Models\ExtraModel();
    }

    public function detalhes(string $produto_slug = null) {

        if (!$produto_slug || !$produto = $this->produtoModel->where('slug', $produto_slug)->where('ativo', true)->first()) {

            return redirect()->to(site_url('/'));
        }

        $data = [
            'titulo' => "Detalhando o produto $produto->nome",
            'produto' => $produto,
            'especificacoes' => $this->produtoEspecificacaoModel->buscaEspecificacoesDoProdutoDetalhes($produto->id),
        ];


        $extras = $this->produtoExtraModel->buscaExtrasDoProdutoDetalhes($produto->id);

//        dd($extras);

        if ($extras) {

            $data['extras'] = $extras;
        }


        return view('Produto/detalhes', $data);
    }

    public function customizar(string $produto_slug = null) {


        if (!$produto_slug || !$produto = $this->produtoModel->where('slug', $produto_slug)->where('ativo', true)->first()) {

            return redirect()->back();
        }


        if (!$this->produtoEspecificacaoModel->where('produto_id', $produto->id)->where('customizavel', true)->first()) {

            return redirect()->back()->with('info', "O produto <strong>$produto->nome</strong> não pode ser vendido meio a meio");
        }


        $data = [
            'titulo' => "Customizando o produto $produto->nome",
            'produto' => $produto,
            'especificacoes' => $this->produtoEspecificacaoModel->buscaEspecificacoesDoProdutoDetalhes($produto->id),
            'opcoes' => $this->produtoModel->exibeOpcoesProdutosParaCustomizar($produto->categoria_id),
        ];





        return view('Produto/customizar', $data);
    }

    public function procurar() {

        if (!$this->request->isAJAX()) {

            return redirect()->back();
        }


        $get = $this->request->getGet();


        $produto = $this->produtoModel->where('id', $get['primeira_metade'])->first();

        if ($produto == null) {

            return $this->response->setJSON([]);
        }


        $produtos = $this->produtoModel->exibeProdutosParaCustomizarSegundaMetade($get['primeira_metade'], $get['categoria_id']);


        if ($produtos == null) {

            return $this->response->setJSON([]);
        }


        $data['produtos'] = $produtos;
        $data['imagemPrimeiroProduto'] = $produto->imagem;


        return $this->response->setJSON($data);
    }

    public function exibeTamanhos() {

        if (!$this->request->isAJAX()) {

            return redirect()->back();
        }

        $get = $this->request->getGet();


        $primeiroProduto = $this->produtoModel->where('id', $get['primeiro_produto_id'])->first();

        if ($primeiroProduto == null) {

            return $this->response->setJSON([]);
        }


        $especificacoesPrimeiroProduto = $this->produtoEspecificacaoModel->where('produto_id', $primeiroProduto->id)->findAll();


        if ($especificacoesPrimeiroProduto == null) {

            return $this->response->setJSON([]);
        }


        $extrasPrimeiroProduto = $this->produtoExtraModel->buscaExtrasDoProdutoDetalhes($primeiroProduto->id);


//----------------------------------- Verificões do segundo produto-------------------------------------//


        $segundoProduto = $this->produtoModel->where('id', $get['segundo_produto_id'])->first();

        if ($segundoProduto == null) {

            return $this->response->setJSON([]);
        }


        $especificacoesSegundoProduto = $this->produtoEspecificacaoModel->where('produto_id', $segundoProduto->id)->findAll();


        if ($especificacoesSegundoProduto == null) {

            return $this->response->setJSON([]);
        }


        $extrasSegundoProduto = $this->produtoExtraModel->buscaExtrasDoProdutoDetalhes($segundoProduto->id);


        $extrasCombinados = $segundoProduto->combinaExtrasDosProdutos($extrasPrimeiroProduto, $extrasSegundoProduto);


        if ($extrasCombinados != null) {

            $data['extras'] = $extrasCombinados;
        }

        $medidasEmComun = $segundoProduto->recuperaMedidasEmComun($especificacoesPrimeiroProduto, $especificacoesSegundoProduto);

        $medidas = $this->medidaModel->select('id, nome')->whereIn('id', $medidasEmComun)->where('ativo', true)->findAll();


        $data['medidas'] = $medidas;


        $data['imagemSegundoProduto'] = $segundoProduto->imagem;


        return $this->response->setJSON($data);
    }

    public function exibeValor() {


        if (!$this->request->isAJAX()) {

            return redirect()->back();
        }

        $get = $this->request->getGet();


        $medida = $this->medidaModel->exibeValor($get['medida_id']);

        if ($medida->preco == null) {

            return $this->response->setJSON([]);
        }


        $extra = $this->extraModel->select('preco')->find($get['extra_id']);


        if ($extra != null) {

            $medida->preco = number_format($medida->preco + $extra->preco, 2);
        }


        return $this->response->setJSON($medida);
    }

    public function imagem(string $imagem = null) {

        if ($imagem) {

            $caminhoImagem = WRITEPATH . 'uploads/produtos/' . $imagem;


            $infoImagem = new \finfo(FILEINFO_MIME);

            $tipoImagem = $infoImagem->file($caminhoImagem);

            header("Content-Type: $tipoImagem");

            header("Content-Length: " . filesize($caminhoImagem));

            readfile($caminhoImagem);


            exit;
        }
    }

}
