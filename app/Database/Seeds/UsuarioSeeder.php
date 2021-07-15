<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder {

    public function run() {

        $usuarioModel = new \App\Models\UsuarioModel;

        $usuario = [
            'nome' => 'Lucio Antonio de Souza',
            'email' => 'admin@admin.com',
            'password' => '123456',
            'cpf' => '349.957.910-35',
            'telefone' => '41 - 9999-9999',
            'is_admin' => true,
            'ativo' => true,
        ];

        $usuarioModel->skipValidation(true)->protect(false)->insert($usuario);
    }

}
