<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Medida;

class Medidas extends BaseController {

    private $medidaModel;

    public function __construct() {

        $this->medidaModel = new \App\Models\MedidaModel();
    }

    public function index() {

        $data = [
            'titulo' => 'Listando as medidas de produtos',
            'medidas' => $this->medidaModel->withDeleted(true)->paginate(10),
            'pager' => $this->medidaModel->pager,
        ];


        return view('Admin/Medidas/index', $data);
    }

    public function procurar() {

        if (!$this->request->isAJAX()) {

            exit('Página não encontrada');
        }


        $medidas = $this->medidaModel->procurar($this->request->getGet('term'));

        $retorno = [];


        foreach ($medidas as $medida) {

            $data['id'] = $medida->id;
            $data['value'] = $medida->nome;

            $retorno[] = $data;
        }

        return $this->response->setJSON($retorno);
    }

    public function criar() {

        $medida = new Medida();

        $data = [
            'titulo' => "Criando nova medida",
            'medida' => $medida,
        ];

        return view('Admin/Medidas/criar', $data);
    }

    public function cadastrar() {

        if ($this->request->getMethod() === 'post') {

            $medida = new Medida($this->request->getPost());


            if ($this->medidaModel->save($medida)) {

                return redirect()->to(site_url("admin/medidas/show/" . $this->medidaModel->getInsertID()))
                                ->with('sucesso', "Medida $medida->nome cadastrada com sucesso");
            } else {

                return redirect()->back()
                                ->with('errors_model', $this->medidaModel->errors())
                                ->with('atencao', 'Por favor verifique os erros abaixo')
                                ->withInput();
            }
        } else {

            /* Não é post */
            return redirect()->back();
        }
    }

    public function show($id = null) {

        $medida = $this->buscaMedidaOu404($id);

        $data = [
            'titulo' => "Detalhando a $medida->nome",
            'medida' => $medida,
        ];

        return view('Admin/Medidas/show', $data);
    }

    public function editar($id = null) {

        $medida = $this->buscaMedidaOu404($id);

        $data = [
            'titulo' => "Editando a $medida->nome",
            'medida' => $medida,
        ];

        return view('Admin/Medidas/editar', $data);
    }

    public function atualizar($id = null) {

        if ($this->request->getMethod() === 'post') {

            $medida = $this->buscaMedidaOu404($id);


            if ($medida->deletado_em != null) {

                return redirect()->back()->with('info', "A medida $medida->nome encontra-se excluída. Portanto, não é possível editá-la.");
            }


            $medida->fill($this->request->getPost());


            if (!$medida->hasChanged()) {

                return redirect()->back()->with('info', 'Não dados para atualizar');
            }


            if ($this->medidaModel->save($medida)) {

                return redirect()->to(site_url("admin/medidas/show/$medida->id"))
                                ->with('sucesso', "Medida $medida->nome atualizada com sucesso");
            } else {

                return redirect()->back()
                                ->with('errors_model', $this->medidaModel->errors())
                                ->with('atencao', 'Por favor verifique os erros abaixo')
                                ->withInput();
            }
        } else {

            /* Não é post */
            return redirect()->back();
        }
    }

    public function excluir($id = null) {

        $medida = $this->buscaMedidaOu404($id);


        if ($medida->deletado_em != null) {

            return redirect()->back()->with('info', "A medida $medida->nome já encontra-se excluída");
        }

        if ($this->request->getMethod() === 'post') {

            $this->medidaModel->delete($id);
            return redirect()->to(site_url('admin/medidas'))->with('sucesso', "Medida $medida->nome excluída com sucesso!");
        }


        $data = [
            'titulo' => "Excluindo a medida $medida->nome",
            'medida' => $medida,
        ];

        return view('Admin/Medidas/excluir', $data);
    }

    public function desfazerExclusao($id = null) {

        $medida = $this->buscaMedidaOu404($id);

        if ($medida->deletado_em == null) {

            return redirect()->back()->with('info', 'Apenas medidas excluídas podem ser recuperadas');
        }


        if ($this->medidaModel->desfazerExclusao($id)) {

            return redirect()->back()->with('sucesso', 'Exclusão desfeita com sucesso!');
        } else {

            return redirect()->back()
                            ->with('errors_model', $this->medidaModel->errors())
                            ->with('atencao', 'Por favor verifique os erros abaixo')
                            ->withInput();
        }
    }

    /**
     * 
     * @param int $id
     * @return objeto medida
     */
    private function buscaMedidaOu404(int $id = null) {

        if (!$id || !$medida = $this->medidaModel->withDeleted(true)->where('id', $id)->first()) {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos a medida $id");
        }

        return $medida;
    }

}
