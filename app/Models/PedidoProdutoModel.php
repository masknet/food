<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoProdutoModel extends Model {

    protected $table = 'pedidos_produtos';
    protected $returnType = 'object';
    protected $allowedFields = [
        'pedido_id',
        'produto',
        'quantidade',
    ];

    public function recuperaProdutosMaisVendidos(int $quantidade) {

        return $this->select('produto, quantidade, SUM(quantidade) AS quantidade')
                        ->limit($quantidade)
                        ->groupBy('produto')
                        ->orderBy('quantidade', 'DESC')
                        ->find(); // o $limit só funciona com find()
    }

}
