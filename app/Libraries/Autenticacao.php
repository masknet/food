<?php

namespace App\Libraries;

/*
 * @descrição essa biblioteca / classe cuidará da parte de autenticação na nossa aplicação
 */

class Autenticacao {

    private $usuario;

    /**
     * 
     * @param string $email
     * @param string $password
     * @return boolean
     */
    public function login(string $email, string $password) {

        $usuarioModel = new \App\Models\UsuarioModel();

        $usuario = $usuarioModel->buscaUsuarioPorEmail($email);

        /* Se não encontrar o usuário por e-mail, retorna false */
        if ($usuario === null) {

            return false;
        }

        /* Se a senha combinar com o password_hash, retorna false */
        if (!$usuario->verificaPassword($password)) {
            return false;
        }


        /*  Só permitiremos o login de usuários ativos */
        if (!$usuario->ativo) {
            return false;
        }

        /* Nesse ponto está tudo certo e podemos logar o usuário na aplicação invocando o método abaixo */
        $this->logaUsuario($usuario);

        /*  Retornamos true.... tudo certo */
        return true;
    }

    public function logout() {

        session()->destroy();
    }

    public function pegaUsuarioLogado() {

        /**
         * Não esquecer de compartilhar a instância com services
         */
        if ($this->usuario === null) {

            $this->usuario = $this->pegaUsuarioDaSessao();
        }

        /* Retornamos o usuario que foi definido no início da classe */
        return $this->usuario;
    }

    /**
     * @descrição: O método só permite ficar logado na aplicação aquele que ainda existir na base e que esteja ativo.
     *             Do contrário, será feito o logout do mesmo, caso haja uma mudança na sua conta durante a sua sessão
     * 
     * @uso: No filtro LoginFilter
     * 
     * @return retorna true se o método pegaUsuarioLogado() não for null. Ou seja, se o usuário estiver logado
     */
    public function estaLogado() {

        return $this->pegaUsuarioLogado() !== null;
    }

    private function pegaUsuarioDaSessao() {


        if (!session()->has('usuario_id')) {

            return null;
        }

        /* Instanciamos o Model Usuário */
        $usuarioModel = new \App\Models\UsuarioModel();

        /* Recupero o usuário de acordo com a chave da sessão 'usuario_id'  */
        $usuario = $usuarioModel->find(session()->get('usuario_id'));


        /* Só retorno o obejto $usuario se o mesmo for encontro e estiver ativo */
        if ($usuario && $usuario->ativo) {

            return $usuario;
        }
    }

    /**
     * 
     * Credenciais validadas. Regeneramos a session_id e inserimos o 'usuario_id' na sessão
     * 
     * @param object $usuario
     * 
     * @Importante: Antes de inserirmos os dados do usuário na sessão, devemos renegerar o ID da sessão.
     * Pois quando carregamos a view login pela primeira vez, o valor da variável 'ci_session' do debug toolbar é um,
     * Quando é relizado o login, o valor muda.
     * Ao fazermos isso, estamos previnindo session fixation attack 
     */
    private function logaUsuario(object $usuario) {

        $session = session();
        $session->regenerate();
        $session->set('usuario_id', $usuario->id);
    }

}
