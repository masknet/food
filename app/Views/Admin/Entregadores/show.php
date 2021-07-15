<?php echo $this->extend('Admin/layout/principal'); ?>


<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php echo $this->endSection(); ?>


<?php echo $this->section('estilos'); ?>



<?php echo $this->endSection(); ?>



<?php echo $this->section('conteudo'); ?>


<div class="row">

    <div class="col-lg-3 grid-margin stretch-card">
        <div class="card">

            <div class="card-header bg-primary pb-0 pt-4">


                <h4 class="card-title text-white"><?php echo esc($titulo); ?></h4>

            </div>
            <div class="card-body">


                <div class="text-center">


                    <?php if ($entregador->imagem && $entregador->deletado_em == null): ?>

                        <img class="card-img-top w-75" src="<?php echo site_url("admin/entregadores/imagem/$entregador->imagem"); ?>" alt="<?php echo esc($entregador->nome); ?>">

                    <?php else: ?>

                        <img class="card-img-top w-75" src="<?php echo site_url('admin/images/entregador-sem-imagem.jpg'); ?>" alt="Produto sem imagem por enquanto">

                    <?php endif; ?>


                </div>

                <?php if ($entregador->deletado_em == null): ?>

                    <hr>


                    <a href="<?php echo site_url("admin/entregadores/editarimagem/$entregador->id"); ?>" class="btn btn-outline-primary mt-2 mb-2 btn-sm">
                        <i class="mdi mdi-image btn-icon-prepend"></i>
                        Editar imagem
                    </a>

                    <hr>

                <?php endif; ?>


                <p class="card-text">
                    <span class="font-weight-bold">Nome:</span>
                    <?php echo esc($entregador->nome); ?>
                </p>
                <p class="card-text">
                    <span class="font-weight-bold">Telefone:</span>
                    <?php echo esc($entregador->telefone); ?>
                </p>
                <p class="card-text">
                    <span class="font-weight-bold">Veículo:</span>
                    <?php echo esc($entregador->veiculo); ?> | <?php echo esc($entregador->placa); ?>
                </p>
                <p class="card-text">
                    <span class="font-weight-bold">Ativo:</span>
                    <?php echo ($entregador->ativo ? 'Sim' : 'Não'); ?>
                </p>

                <p class="card-text">
                    <span class="font-weight-bold">Criado:</span>
                    <?php echo $entregador->criado_em->humanize(); ?>
                </p>

                <?php if ($entregador->deletado_em == null): ?>

                    <p class="card-text">
                        <span class="font-weight-bold">Atualizado:</span>
                        <?php echo $entregador->atualizado_em->humanize(); ?>
                    </p>

                <?php else: ?>

                    <p class="card-text">
                        <span class="font-weight-bold text-danger">Excluído:</span>
                        <?php echo $entregador->deletado_em->humanize(); ?>
                    </p>

                <?php endif; ?>

                <div class="mt-4">


                    <?php if ($entregador->deletado_em == null): ?>


                        <a href="<?php echo site_url("admin/entregadores/editar/$entregador->id"); ?>" class="btn btn-dark btn-sm mr-2">
                            <i class="mdi mdi-pencil btn-icon-prepend"></i>
                            Editar
                        </a>

                        <a href="<?php echo site_url("admin/entregadores/excluir/$entregador->id"); ?>" class="btn btn-danger btn-sm mr-2">
                            <i class="mdi mdi-trash-can btn-icon-prepend"></i>
                            Excluir
                        </a>

                        <a href="<?php echo site_url("admin/entregadores"); ?>" class="btn btn-light text-dark btn-sm">
                            <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
                            Voltar
                        </a>


                    <?php else: ?>

                        <a title="Desfazer exclusão" href="<?php echo site_url("admin/entregadores/desfazerexclusao/$entregador->id"); ?>" class="btn btn-dark btn-sm">
                            <i class="mdi mdi-undo btn-icon-prepend"></i>
                            Desfazer
                        </a>

                        <a href="<?php echo site_url("admin/entregadores"); ?>" class="btn btn-light text-dark btn-sm">
                            <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
                            Voltar
                        </a>


                    <?php endif; ?>



                </div>


            </div>


        </div>
    </div>


</div>





<?php echo $this->endSection(); ?>


<?php echo $this->section('scripts'); ?>


<?php echo $this->endSection(); ?>