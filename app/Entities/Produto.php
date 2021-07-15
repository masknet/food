<?php

namespace App\Entities;

use CodeIgniter\Entity;

class Produto extends Entity {

    protected $dates = [
        'criado_em',
        'atualizado_em',
        'deletado_em',
    ];

    public function combinaExtrasDosProdutos(array $extrasPrimeiroProduto, array $extrasSegundoProduto) {


        $extrasUnicos = [];


        $extrasCombinados = array_merge($extrasPrimeiroProduto, $extrasSegundoProduto);


        foreach ($extrasCombinados as $extra) {


            $extraExiste = (bool) in_array($extra->id, array_column($extrasUnicos, 'id'));


            if ($extraExiste == false) {

                array_push($extrasUnicos, [
                    'id' => $extra->id,
                    'nome' => $extra->nome,
                    'preco' => $extra->preco,
                ]);
            }
        }

        return $extrasUnicos;
    }

    public function recuperaMedidasEmComun(array $especificacoesPrimeiroProduto, array $especificacoesSegundoProduto) {

        $primeiroArrayMedidas = [];

        foreach ($especificacoesPrimeiroProduto as $especificacao) {

            if ($especificacao->customizavel) {

                array_push($primeiroArrayMedidas, $especificacao->medida_id);
            }
        }


        $segundoArrayMedidas = [];

        foreach ($especificacoesSegundoProduto as $especificacao) {

            if ($especificacao->customizavel) {

                array_push($segundoArrayMedidas, $especificacao->medida_id);
            }
        }


        return array_intersect($primeiroArrayMedidas, $segundoArrayMedidas);
    }


}
