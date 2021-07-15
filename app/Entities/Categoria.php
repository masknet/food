<?php

namespace App\Entities;

use CodeIgniter\Entity;

class Categoria extends Entity {

    protected $dates = [
        'criado_em',
        'atualizado_em',
        'deletado_em',
    ];

}
