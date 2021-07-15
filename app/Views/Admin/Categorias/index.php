<?php echo $this->extend('Admin/layout/principal'); ?>


<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php echo $this->endSection(); ?>


<?php echo $this->section('estilos'); ?>

<!-- Aqui enviamos para o template principal os estilos -->

<link rel="stylesheet" href="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.css'); ?>"/>

<?php echo $this->endSection(); ?>



<?php echo $this->section('conteudo'); ?>


<div class="row">

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo $titulo; ?></h4>


                <div class="ui-widget">
                    <input id="query" name="query" placeholder="Pesquise por uma categoria" class="form-control bg-light mb-5">
                </div>


                <a href="<?php echo site_url("admin/categorias/criar"); ?>" class="btn btn-success float-right mb-5">
                    <i class="mdi mdi-plus btn-icon-prepend"></i>
                    Cadastrar
                </a>

                <?php if (empty($categorias)): ?>

                    <p> Não há dados para exibir</p>

                <?php else: ?>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Data de criação</th>
                                    <th>Ativo</th>
                                    <th>Situação</th>
                                </tr>
                            </thead>
                            <tbody>




                                <?php foreach ($categorias as $categoria): ?>

                                    <tr>
                                        <td>
                                            <a href="<?php echo site_url("admin/categorias/show/$categoria->id"); ?>"><?php echo $categoria->nome; ?></a>
                                        </td>
                                        <td><?php echo $categoria->criado_em->humanize(); ?></td>


                                        <td><?php echo ($categoria->ativo && $categoria->deletado_em == null ? '<label class="badge badge-primary">Sim</label>' : '<label class="badge badge-danger">Não</label>'); ?></td>

                                        <td>

                                            <?php echo ($categoria->deletado_em == null ? '<label class="badge badge-primary">Disponível</label>' : '<label class="badge badge-danger">Excluído</label>'); ?>

                                            <?php if ($categoria->deletado_em != null): ?>

                                                <a href="<?php echo site_url("admin/categorias/desfazerexclusao/$categoria->id"); ?>" class="badge badge-dark ml-2">
                                                    <i class="mdi mdi-undo btn-icon-prepend"></i>
                                                    Desfazer
                                                </a>

                                            <?php endif; ?>

                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                            </tbody>
                        </table>

                        <div class="mt-3">

                            <?php echo $pager->links() ?>

                        </div>
                    </div>

                <?php endif; ?>

            </div>
        </div>
    </div>


</div>





<?php echo $this->endSection(); ?>




<?php echo $this->section('scripts'); ?>

<!-- Aqui enviamos para o template principal os scripts -->


<script src="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.js'); ?>"></script>


<script>

    $(function () {

        $("#query").autocomplete({

            source: function (request, response) {

                $.ajax({

                    url: "<?php echo site_url('admin/categorias/procurar'); ?>",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function (data) {

                        if (data.length < 1) {

                            var data = [
                                {
                                    label: 'Categoria não encontrado',
                                    value: -1
                                }
                            ];

                        }
                        response(data); // Aqui temos valor no data

                    },

                }); // fim ajax

            },
            minLenght: 1,
            select: function (event, ui) {

                if (ui.item.value == -1) {

                    $(this).val("");
                    return false;

                } else {

                    window.location.href = '<?php echo site_url('admin/categorias/show/'); ?>' + ui.item.id;
                }

            }

        }); // fim autocomplete


    });


</script>

<?php echo $this->endSection(); ?>