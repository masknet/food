<?php echo $this->extend('Admin/layout/principal'); ?>


<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php echo $this->endSection(); ?>


<?php echo $this->section('estilos'); ?>



<?php echo $this->endSection(); ?>



<?php echo $this->section('conteudo'); ?>


<div class="row">

    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">

            <div class="card-header bg-primary pb-0 pt-4">


                <h4 class="card-title text-white"><?php echo esc($titulo); ?></h4>

            </div>
            <div class="card-body">

                <p class="card-text">
                    <span class="font-weight-bold">Situação:</span>
                    <?php $pedido->exibeSituacaoDoPedido(); ?>
                </p>

                <p class="card-text">
                    <span class="font-weight-bold">Criado:</span>
                    <?php echo $pedido->criado_em->humanize(); ?>
                </p>


                <p class="card-text">
                    <span class="font-weight-bold">Atualizado:</span>
                    <?php echo $pedido->atualizado_em->humanize(); ?>
                </p>


                <p class="card-text">
                    <span class="font-weight-bold">Forma de pagamento na entrega:</span>
                    <?php echo $pedido->forma_pagamento; ?>
                </p>

                <p class="card-text">
                    <span class="font-weight-bold">Valor dos produtos:</span>
                    R$&nbsp;<?php echo esc(number_format($pedido->valor_produtos, 2)); ?>
                </p>

                <p class="card-text">
                    <span class="font-weight-bold">Valor de entrega:</span>
                    R$&nbsp;<?php echo esc(number_format($pedido->valor_entrega, 2)); ?>
                </p>

                <p class="card-text">
                    <span class="font-weight-bold">Valor do pedido:</span>
                    R$&nbsp;<?php echo esc(number_format($pedido->valor_pedido, 2)); ?>
                </p>

                <p class="card-text">
                    <span class="font-weight-bold">Endereço de entrega:</span>
                    <?php echo esc($pedido->endereco_entrega); ?>
                </p>

                <p class="card-text">
                    <span class="font-weight-bold">Observações do pedido:</span>
                    <?php echo esc($pedido->observacoes); ?>
                </p>

                <?php if ($pedido->entregador_id != null): ?>

                    <p class="card-text">
                        <span class="font-weight-bold">Entregador:</span>
                        <?php echo esc($pedido->entregador); ?>
                    </p>

                <?php endif; ?>


                <?php $produtos = unserialize($pedido->produtos); ?>

                <ul class="list-group">

                    <?php foreach ($produtos as $produto): ?>

                        <li class="list-group-item">

                            <p><strong>Produto:</strong> <?php echo $produto['nome']; ?></p>
                            <p><strong>Quantidade:</strong> <?php echo $produto['quantidade']; ?></p>
                            <p><strong>Preço:&nbsp;</strong>R$&nbsp;<?php echo number_format($produto['preco'], 2); ?></p>

                        </li>

                    <?php endforeach; ?>

                </ul>


                <div class="mt-4">

                    <a href="<?php echo site_url("admin/pedidos/editar/$pedido->codigo"); ?>" class="btn btn-dark btn-sm mr-2">
                        <i class="mdi mdi-pencil btn-icon-prepend"></i>
                        Alterar situação
                    </a>

                    <a href="<?php echo site_url("admin/pedidos/excluir/$pedido->codigo"); ?>" class="btn btn-danger btn-sm mr-2">
                        <i class="mdi mdi-trash-can btn-icon-prepend"></i>
                        Excluir pedido
                    </a>

                    <a href="<?php echo site_url("admin/pedidos"); ?>" class="btn btn-light text-dark btn-sm">
                        <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
                        Voltar
                    </a>

                </div>


            </div>


        </div>
    </div>


</div>





<?php echo $this->endSection(); ?>


<?php echo $this->section('scripts'); ?>


<?php echo $this->endSection(); ?>