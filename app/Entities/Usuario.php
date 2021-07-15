<?php

namespace App\Entities;

use CodeIgniter\Entity;
use App\Libraries\Token;

class Usuario extends Entity {

    protected $dates = [
        'criado_em',
        'atualizado_em',
        'deletado_em',
    ];

    public function verificaPassword(string $password) {

        return password_verify($password, $this->password_hash);
    }

    public function iniciaPasswordReset() {

        /* Instancio novo objeto da classe Token */
        $token = new Token();


        /**
         * @Descricao: Atribuímos ao objeto Entitie Usuario ($this) o atributo 'reset_token' que conterá o token gerado
         *             para que possamos acessá-lo na view 'Password/reset_email'
         */
        $this->reset_token = $token->getValue();




        /**
         * @Descricao: Atribuímos ao objeto Entitie Usuario ($this) o atributo 'reset_hash' que conterá o hash do token
         */
        $this->reset_hash = $token->getHash();


        /**
         * @Descrição: Atribuímos ao objeto Entitie Usuario ($this) o atributo 'reset_expira_em' que conterá a data de expiração do Token gerado 
         */
        $this->reset_expira_em = date('Y-m-d H:i:s', time() + 7200); //Expira em 2hs a partir da data e hora atuais
    }

    public function completaPasswordReset() {

        $this->reset_hash = null;
        $this->reset_expira_em = null;
    }

    public function iniciaAtivacao() {

        $token = new Token();

        $this->token = $token->getValue();

        $this->ativacao_hash = $token->getHash();
    }
    
    
    public function ativar() {
        
        $this->ativo = true;
        $this->ativacao_hash = null;
    }

}
