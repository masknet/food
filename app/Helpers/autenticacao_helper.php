<?php

if (!function_exists('usuario_logado')) {

    function usuario_logado() {

        $autenticacao = service('autenticacao');

        return $autenticacao->pegaUsuarioLogado();
    }

}

