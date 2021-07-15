<?php echo $this->extend('layout/principal_web'); ?>

<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php echo $this->endSection(); ?>


<?php echo $this->section('estilos'); ?>

<link rel="stylesheet" href="<?php echo site_url("web/src/assets/css/produto.css"); ?>"/>


<style>

    @media only screen and (max-width: 767px){


        #login{

            min-width: 100% !important;

        }
    }


</style>



<?php echo $this->endSection(); ?>





<?php echo $this->section('conteudo'); ?>


<div class="container section" id="menu" data-aos="fade-up" style="margin-top: 3em">

    <!-- product -->
    <div id="login" class="product-content product-wrap clearfix product-deatil center-block" style="max-width: 60%">
        <div class="row">

            <div class="col-md-12">


                <h2 style="margin-bottom: 1em"><?php echo $titulo; ?></h2>


                <?php if (session()->has('errors_model')): ?>


                    <ul style="margin-left: -1.6em !important;">

                        <?php foreach (session('errors_model') as $error): ?>

                            <li class="text-danger"><?php echo $error; ?></li>

                        <?php endforeach; ?>

                    </ul>


                <?php endif; ?>


                <?php echo form_open('login/criar'); ?>


                <div class="form-group">
                    <input type="email" name="email" value="<?php echo old('email'); ?>" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Digite o seu e-mail">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Digite a sua senha">
                </div>
                <div class="mt-3" style="margin-top: 2em">
                    <button type="submit" class="btn btn-block btn-food btn-lg font-weight-medium auth-form-btn">Entrar</button>
                </div>

                <div class="d-flex justify-content-between align-items-center" style="margin-top: 1em">
                    <a href="<?php echo site_url('password/esqueci'); ?>" class="auth-link text-black">Esqueci a minha senha</a>
                </div>

                <div class="text-center mt-4 font-weight-light">
                    Ainda não tem uma conta? <a href="<?php echo site_url('registrar'); ?>" class="text-primary">Criar conta</a>
                </div>
                <?php echo form_close(); ?>



            </div>

        </div>
    </div>
    <!-- end product -->


</div>



<?php echo $this->endSection(); ?>











