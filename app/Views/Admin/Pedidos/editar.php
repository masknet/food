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


                <?php if (session()->has('errors_model')): ?>


                    <ul>

                        <?php foreach (session('errors_model') as $error): ?>

                            <li class="text-danger"><?php echo $error; ?></li>

                        <?php endforeach; ?>

                    </ul>


                <?php endif; ?>



                <?php echo form_open("admin/pedidos/atualizar/$pedido->codigo"); ?>





                <div class="form-check form-check-flat form-check-primary mb-4">

                    <label for="saiu_entrega" class="form-check-label">

                        <input id="saiu_entrega" type="radio" class="form-check-input situacao" name="situacao" value="1" <?php echo ($pedido->situacao == 1 ? 'checked' : ''); ?>>
                        Saiu para entrega
                    </label>
                </div>


                <div id="box_entregador" class="form-group d-none">

                    <select name="entregador_id" class="form-control text-dark">

                        <option value="">Escolha o entregador...</option>

                        <?php foreach ($entregadores as $entregador): ?>

                            <option value="<?php echo $entregador->id ?>" <?php echo ($entregador->id == $pedido->entregador_id ? 'selected' : '') ?>> <?php echo esc($entregador->nome); ?></option>

                        <?php endforeach; ?>

                    </select>

                </div>



                <div class="form-check form-check-flat form-check-primary mb-4">


                    <label class="form-check-label">

                        <input type="radio" class="form-check-input situacao" name="situacao" value="2" <?php echo ($pedido->situacao == 2 ? 'checked' : ''); ?>>
                        Pedido entregue
                    </label>
                </div>

                <div class="form-check form-check-flat form-check-primary mb-4">


                    <label class="form-check-label">

                        <input type="radio" class="form-check-input situacao" name="situacao" value="3" <?php echo ($pedido->situacao == 3 ? 'checked' : ''); ?>>
                        Pedido cancelado
                    </label>
                </div>


                <input id="btn-editar-pedido" type="submit" class="btn btn-success" value="Editar pedido">

                <a href="<?php echo site_url("admin/pedidos/show/$pedido->codigo"); ?>" class="btn btn-light text-dark btn-sm">
                    <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
                    Voltar
                </a>


                <?php echo form_close(); ?>



            </div>


        </div>
    </div>


</div>





<?php echo $this->endSection(); ?>


<?php echo $this->section('scripts'); ?>

<script src="<?php echo site_url('admin/vendors/mask/jquery.mask.min.js'); ?>"></script>
<script src="<?php echo site_url('admin/vendors/mask/app.js'); ?>"></script>



<script>


    $(document).ready(function () {

        var entregador_id = $("#saiu_entrega").prop('checked');


        if (entregador_id) {

            $("#box_entregador").removeClass('d-none');
        }


        $(".situacao").on('click', function () {

            var valor = $(this).val();

            if (valor == 1) {

                $("#box_entregador").removeClass('d-none');

            } else {

                $("#box_entregador").addClass('d-none');
            }

        });


        $("form").submit(function () {

            $(this).find(":submit").attr('disabled', 'disabled');

            $("#btn-editar-pedido").val('Editando o pedido...');

        });



    });



</script>


<?php echo $this->endSection(); ?>