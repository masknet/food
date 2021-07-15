<?php

namespace Config;

use CodeIgniter\Config\BaseService;

/**
 * Classes Compartilhadas
 * Há ocasiões em que você precisa exigir que apenas uma única instância de um serviço seja criada. 
 * Isso é facilmente tratado com o método getSharedInstance () que é chamado de dentro do método de fábrica. 
 * Isso controla a verificação de se uma instância foi criada e salva na classe e, se não, cria uma nova. 
 * Todos os métodos de fábrica fornecem um valor $getShared = true como o último parâmetro.
 * 
 * @mais: https://codeigniter4.github.io/userguide/concepts/services.html
 */
class Services extends BaseService {

    public static function autenticacao($getShared = true) {
        if ($getShared) {
            return static::getSharedInstance('autenticacao');
        }

        return new \App\Libraries\Autenticacao;
    }

}
