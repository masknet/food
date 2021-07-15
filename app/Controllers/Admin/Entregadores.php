<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Entregador;

class Entregadores extends BaseController {

    private $entregadorModel;

    public function __construct() {

        $this->entregadorModel = new \App\Models\EntregadorModel();
    }

    public function index() {

        $data = [
            'titulo' => 'Listando os entregadores',
            'entregadores' => $this->entregadorModel->withDeleted(true)->paginate(10),
            'pager' => $this->entregadorModel->pager,
        ];

        return view('Admin/Entregadores/index', $data);
    }

    public function procurar() {

        if (!$this->request->isAJAX()) {

            exit('Página não encontrada');
        }


        $entregadores = $this->entregadorModel->procurar($this->request->getGet('term'));

        $retorno = [];


        foreach ($entregadores as $entregador) {

            $data['id'] = $entregador->id;
            $data['value'] = $entregador->nome;

            $retorno[] = $data;
        }

        return $this->response->setJSON($retorno);
    }

    public function criar() {

        $entregador = new Entregador();


        $data = [
            'titulo' => "Castrando entregador",
            'entregador' => $entregador,
        ];

        return view('Admin/Entregadores/criar', $data);
    }

    public function cadastrar() {

        if ($this->request->getMethod() === 'post') {

            $entregador = new Entregador($this->request->getPost());

            if ($this->entregadorModel->save($entregador)) {

                return redirect()->to(site_url("admin/entregadores/show/" . $this->entregadorModel->getInsertID()))
                                ->with('sucesso', "Entregador $entregador->nome cadastrado com sucesso");
            } else {

                return redirect()->back()
                                ->with('errors_model', $this->entregadorModel->errors())
                                ->with('atencao', 'Por favor verifique os erros abaixo')
                                ->withInput();
            }
        } else {

            return redirect()->back();
        }
    }

    public function show($id = null) {

        $entregador = $this->buscaEntregadorOu404($id);


        $data = [
            'titulo' => "Detalhando o entregador $entregador->nome",
            'entregador' => $entregador,
        ];

        return view('Admin/Entregadores/show', $data);
    }

    public function editar($id = null) {

        $entregador = $this->buscaEntregadorOu404($id);


        $data = [
            'titulo' => "Editandi o entregador $entregador->nome",
            'entregador' => $entregador,
        ];

        return view('Admin/Entregadores/editar', $data);
    }

    public function atualizar($id = null) {

        if ($this->request->getMethod() === 'post') {


            $entregador = $this->buscaEntregadorOu404($id);

            $entregador->fill($this->request->getPost());

            if (!$entregador->hasChanged()) {

                return redirect()->back()->with('info', 'Não há dados para atualizar');
            }

            if ($this->entregadorModel->save($entregador)) {

                return redirect()->to(site_url("admin/entregadores/show/$entregador->id"))
                                ->with('sucesso', "Entregador $entregador->nome atualizado com sucesso");
            } else {

                return redirect()->back()
                                ->with('errors_model', $this->entregadorModel->errors())
                                ->with('atencao', 'Por favor verifique os erros abaixo')
                                ->withInput();
            }
        } else {

            return redirect()->back();
        }
    }

    public function editarImagem($id = null) {


        $entregador = $this->buscaEntregadorOu404($id);

        if ($entregador->deletado_em != null) {

            return redirect()->back()->with('info', 'Não é possível editar a imagem de um entregador excluído');
        }


        $data = [
            'titulo' => "Editando a imagem do entregador $entregador->nome",
            'entregador' => $entregador,
        ];

        return view('Admin/Entregadores/editar_imagem', $data);
    }

    public function upload($id = null) {


        $entregador = $this->buscaEntregadorOu404($id);


        $imagem = $this->request->getFile('foto_entregador');


        if (!$imagem->isValid()) {


            $codigoErro = $imagem->getError();

            if ($codigoErro == UPLOAD_ERR_NO_FILE) {

                return redirect()->back()->with('atencao', 'Nenhum arquivo foi selecionado');
            }
        }


        $tamanhoImagem = $imagem->getSizeByUnit('mb');


        if ($tamanhoImagem > 2) {

            return redirect()->back()->with('atencao', 'O arquivo selecionado é muito grande. Máximo permitido é: 2MB');
        }


        $tipoImagem = $imagem->getMimeType();

        $tipoImagemLimpo = explode('/', $tipoImagem);

        $tiposPermitidos = [
            'jpeg', 'png', 'webp',
        ];

        if (!in_array($tipoImagemLimpo[1], $tiposPermitidos)) {

            return redirect()->back()->with('atencao', 'O arquivo não tem o formato permitido. Apenas: ' . implode(', ', $tiposPermitidos));
        }



        list($largura, $altura) = getimagesize($imagem->getPathName());


        if ($largura < "400" || $altura < "400") {


            return redirect()->back()->with('atencao', 'A imagem não pode ser menor do que 400 x 400 pixels');
        }


//-------------------- A partir desse ponto fazemos o store da imagem -----------------------//

        /* Fazendo o store da imagem e recuperando o caminho da mesma */
        $imagemCaminho = $imagem->store('entregadores');


        $imagemCaminho = WRITEPATH . 'uploads/' . $imagemCaminho;


        /* Fazendo o resize da mesma imagem */
        service('image')
                ->withFile($imagemCaminho)
                ->fit(400, 400, 'center')
                ->save($imagemCaminho);


        /* Recuperando a imagem antiga para excluí-la */
        $imagemAntiga = $entregador->imagem;


        /* Atribuindo a nova imagem */
        $entregador->imagem = $imagem->getName();


        /* Atualizando a imagem do produto */
        $this->entregadorModel->save($entregador);

        /* Definindo o caminho da imagem antiga */
        $caminhoImagem = WRITEPATH . 'uploads/entregadores/' . $imagemAntiga;


        if (is_file($caminhoImagem)) {

            unlink($caminhoImagem);
        }

        return redirect()->to(site_url("admin/entregadores/show/$entregador->id"))->with('sucesso', 'Imagem alterada com sucesso');
    }

    public function imagem(string $imagem = null) {

        if ($imagem) {

            $caminhoImagem = WRITEPATH . 'uploads/entregadores/' . $imagem;


            $infoImagem = new \finfo(FILEINFO_MIME);

            $tipoImagem = $infoImagem->file($caminhoImagem);

            header("Content-Type: $tipoImagem");

            header("Content-Length: " . filesize($caminhoImagem));

            readfile($caminhoImagem);


            exit;
        }
    }

    public function excluir($id = null) {

        $entregador = $this->buscaEntregadorOu404($id);


        if ($this->request->getMethod() === 'post') {

            $this->entregadorModel->delete($id);


            if ($entregador->imagem) {

                $caminhoImagem = WRITEPATH . 'uploads/entregadores/' . $entregador->imagem;

                if (is_file($caminhoImagem)) {


                    unlink($caminhoImagem);
                }
            }


            $entregador->imagem = null;


            $this->entregadorModel->save($entregador);


            return redirect()->to(site_url("admin/entregadores"))->with('sucesso', 'Entregador excluído com sucesso');
        }




        $data = [
            'titulo' => "Excluindo o entregador $entregador->nome",
            'entregador' => $entregador,
        ];


        return view('Admin/Entregadores/excluir', $data);
    }

    public function desfazerExclusao($id = null) {

        $entregador = $this->buscaEntregadorOu404($id);

        if ($entregador->deletado_em == null) {

            return redirect()->back()->with('info', 'Apenas entregadores excluídos podem ser recuperados');
        }


        if ($this->entregadorModel->desfazerExclusao($id)) {

            return redirect()->back()->with('sucesso', 'Exclusão desfeita com sucesso!');
        } else {

            return redirect()->back()
                            ->with('errors_model', $this->entregadorModel->errors())
                            ->with('atencao', 'Por favor verifique os erros abaixo')
                            ->withInput();
        }
    }

    /**
     * 
     * @param int $id
     * @return objeto entregador
     */
    private function buscaEntregadorOu404(int $id = null) {

        if (!$id || !$entregador = $this->entregadorModel->withDeleted(true)->where('id', $id)->first()) {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o entregador $id");
        }

        return $entregador;
    }

}
