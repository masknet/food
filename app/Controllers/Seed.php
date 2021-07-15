<?php

namespace App\Controllers;

class Seed extends BaseController {

    public function index() {


        $seeder = \Config\Database::seeder();
        
        $seeder->call('UsuarioSeeder');
        $seeder->call('ExpedienteSeeder');
        $seeder->call('FormasSeeder');

        echo 'Semeado';
    }

}
