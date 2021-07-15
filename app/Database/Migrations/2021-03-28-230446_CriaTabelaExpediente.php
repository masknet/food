<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriaTabelaExpediente extends Migration {

    public function up() {

        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'dia' => [// 0 (PARA DOMINGO) ATÉ 6 (SÁBADO)
                'type' => 'INT',
                'constraint' => 5,
            ],
            'dia_descricao' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'abertura' => [
                'type' => 'TIME',
                'null' => true,
                'default' => null,
            ],
            'fechamento' => [
                'type' => 'TIME',
                'null' => true,
                'default' => null,
            ],
            'situacao' => [// 0 (fechado) e 1 (aberto)
                'type' => 'BOOLEAN',
                'null' => false,
            ],
        ]);


        $this->forge->addPrimaryKey('id');


        $this->forge->createTable('expediente');
    }

    public function down() {

        $this->forge->dropTable('expediente');
    }

}
