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
                    <span class="font-weight-bold">Nome:</span>
                    <?php echo esc($categoria->nome); ?>
                </p>
                <p class="card-text">
                    <span class="font-weight-bold">Slug:</span>
                    <?php echo esc($categoria->slug); ?>
                </p>
                <p class="card-text">
                    <span class="font-weight-bold">Ativo:</span>
                    <?php echo ($categoria->ativo ? 'Sim' : 'Não'); ?>
                </p>

                <p class="card-text">
                    <span class="font-weight-bold">Criado:</span>
                    <?php echo $categoria->criado_em->humanize(); ?>
                </p>

                <?php if ($categoria->deletado_em == null): ?>

                    <p class="card-text">
                        <span class="font-weight-bold">Atualizado:</span>
                        <?php echo $categoria->atualizado_em->humanize(); ?>
                    </p>

                <?php else: ?>

                    <p class="card-text">
                        <span class="font-weight-bold text-danger">Excluído:</span>
                        <?php echo $categoria->deletado_em->humanize(); ?>
                    </p>

                <?php endif; ?>

                <div class="mt-4">


                    <?php if ($categoria->deletado_em == null): ?>


                        <a href="<?php echo site_url("admin/categorias/editar/$categoria->id"); ?>" class="btn btn-dark btn-sm mr-2">
                            <i class="mdi mdi-pencil btn-icon-prepend"></i>
                            Editar
                        </a>

                        <a href="<?php echo site_url("admin/categorias/excluir/$categoria->id"); ?>" class="btn btn-danger btn-sm mr-2">
                            <i class="mdi mdi-trash-can btn-icon-prepend"></i>
                            Excluir
                        </a>

                        <a href="<?php echo site_url("admin/categorias"); ?>" class="btn btn-light text-dark btn-sm">
                            <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
                            Voltar
                        </a>


                    <?php else: ?>

                        <a title="Desfazer exclusão" href="<?php echo site_url("admin/categorias/desfazerexclusao/$categoria->id"); ?>" class="btn btn-dark btn-sm">
                            <i class="mdi mdi-undo btn-icon-prepend"></i>
                            Desfazer
                        </a>

                        <a href="<?php echo site_url("admin/categorias"); ?>" class="btn btn-light text-dark btn-sm">
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