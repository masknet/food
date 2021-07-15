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
                    <input id="query" name="query" placeholder="Pesquise por um código de pedido" class="form-control bg-light mb-5">
                </div>


                <?php if (empty($pedidos)): ?>

                    <p>Não há dados para exibir</p>

                <?php else: ?>


                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Código do pedido</th>
                                    <th>Data do pedido</th>
                                    <th>Cliente</th>
                                    <th>Valor</th>
                                    <th>Situação</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($pedidos as $pedido): ?>

                                    <tr>
                                        <td>
                                            <a href="<?php echo site_url("admin/pedidos/show/$pedido->codigo"); ?>"><?php echo $pedido->codigo; ?></a>
                                        </td>
                                        <td><?php echo $pedido->criado_em->humanize(); ?></td>
                                        <td><?php echo $pedido->cliente; ?></td>

                                        <td>R$&nbsp;<?php echo esc(number_format($pedido->valor_pedido, 2)); ?></td>


                                        <td><?php $pedido->exibeSituacaoDoPedido(); ?></td>

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

                    url: "<?php echo site_url('admin/pedidos/procurar'); ?>",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function (data) {

                        if (data.length < 1) {

                            var data = [
                                {
                                    label: 'Pedido não encontrado',
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

                    window.location.href = '<?php echo site_url('admin/pedidos/show/'); ?>' + ui.item.value;
                }

            }

        }); // fim autocomplete


    });


</script>

<?php echo $this->endSection(); ?>