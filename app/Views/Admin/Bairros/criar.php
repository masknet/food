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



                <?php echo form_open("admin/bairros/cadastrar"); ?>


                <?php echo $this->include('Admin/Bairros/form'); ?>


                <a href="<?php echo site_url("admin/bairros"); ?>" class="btn btn-light text-dark btn-sm">
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


    $("#btn-salvar").prop('disabled', true);


    $('[name=cep]').focusout(function () {

        var cep = $(this).val();


        $.ajax({

            type: 'get',
            url: '<?php echo site_url('admin/bairros/consultacep'); ?>',
            dataType: 'json',
            data: {
                cep: cep
            },
            beforeSend: function () {

                $("#cep").html('Consultando...');

                $('[name=nome]').val('');
                $('[name=cidade]').val('');
                $('[name=estado]').val('');


                $("#btn-salvar").prop('disabled', true);

            },
            success: function (response) {


                if (!response.erro) {

                    /*  Sucesso ....*/

                    $('[name=nome]').val(response.endereco.bairro);
                    $('[name=cidade]').val(response.endereco.localidade);
                    $('[name=estado]').val(response.endereco.uf);


                    $("#btn-salvar").prop('disabled', false);
                    $("#cep").html('');


                } else {

                    /* Tem erros de validação, cep não encontrado, etc...  */

                    $("#cep").html(response.erro);

                }


            }, // fim success
            error: function () {

                alert('Não foi possível contultar o cep. Contacte o suporte técnico');
                $("#btn-salvar").prop('disabled', true);

            },

        });




    });





</script>





<?php echo $this->endSection(); ?>