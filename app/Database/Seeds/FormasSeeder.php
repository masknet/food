<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FormasSeeder extends Seeder {

    public function run() {

        $formaModel = new \App\Models\FormaPagamentoModel();

        $forma = [
            'nome' => 'Dinheiro',
            'ativo' => true,
        ];

        $formaModel->skipValidation(true)->insert($forma);
    }

}
