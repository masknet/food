<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Esse Seeder será usado quando hospedarmos o projeto
 */
class ExpedienteSeeder extends Seeder {

    public function run() {


        $expedienteModel = new \App\Models\ExpedienteModel();



        $expedientes = [
            [
                'dia' => '0',
                'dia_descricao' => 'Domingo',
                'abertura' => '18:00:00',
                'fechamento' => '23:00:00',
                'situacao' => true,
            ],
            [
                'dia' => '1',
                'dia_descricao' => 'Segunda',
                'abertura' => '18:00:00',
                'fechamento' => '23:00:00',
                'situacao' => true,
            ],
            [
                'dia' => '2',
                'dia_descricao' => 'Terça',
                'abertura' => '18:00:00',
                'fechamento' => '23:00:00',
                'situacao' => true,
            ],
            [
                'dia' => '3',
                'dia_descricao' => 'Quarta',
                'abertura' => '18:00:00',
                'fechamento' => '23:00:00',
                'situacao' => true,
            ],
            [
                'dia' => '4',
                'dia_descricao' => 'Quinta',
                'abertura' => '18:00:00',
                'fechamento' => '23:00:00',
                'situacao' => true,
            ],
            [
                'dia' => '5',
                'dia_descricao' => 'Sexta',
                'abertura' => '18:00:00',
                'fechamento' => '23:00:00',
                'situacao' => true,
            ],
            [
                'dia' => '6',
                'dia_descricao' => 'Sábado',
                'abertura' => '18:00:00',
                'fechamento' => '23:00:00',
                'situacao' => true,
            ],
        ];


        foreach ($expedientes as $expediente) {

            $expedienteModel->skipValidation(true)->protect(false)->insert($expediente);
        }
    }

}
