<?php

namespace App\Entities;

use CodeIgniter\Entity;

class Medida extends Entity {

    protected $dates = [
        'criado_em',
        'atualizado_em',
        'deletado_em',
    ];

}
