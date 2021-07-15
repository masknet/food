<?php echo $this->extend('layout/principal_web'); ?>

<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php echo $this->endSection(); ?>


<?php echo $this->section('estilos'); ?>

<link rel="stylesheet" href="<?php echo site_url("web/src/assets/css/produto.css"); ?>"/>

<?php echo $this->endSection(); ?>





<?php echo $this->section('conteudo'); ?>


<div class="container section" id="menu" data-aos="fade-up" style="margin-top: 3em">

    <div class="col-sm-12 col-md-12 col-lg-12">
        <!-- product -->
        <div class="product-content product-wrap clearfix product-deatil">
            <div class="row">

                <?php if (!isset($carrinho)): ?>

                    <div class="text-center">

                        <h2 class="text-center">Seu carrinho de compras está vazio</h2>

                        <a href="<?php echo site_url("/"); ?>" class="btn btn-lg" style="background-color: #990100; color: white; margin-top: 2em">Mais delícias</a>

                    </div>

                <?php else: ?>


                    <div class="table-responsive">

                        <p style="margin-bottom: 2em">Resumo do carrinho de compras</p>


                        <?php if (session()->has('errors_model')): ?>


                            <ul style="list-style: decimal">

                                <?php foreach (session('errors_model') as $error): ?>

                                    <li class="text-danger"><?php echo $error; ?></li>

                                <?php endforeach; ?>

                            </ul>

                        <?php endif; ?>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">Remover</th>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Tamanho</th>
                                    <th class="text-center" scope="col">Quantidade</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Sub total</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $total = 0; ?>

                                <?php foreach ($carrinho as $produto): ?>

                                    <tr>
                                        <th class="text-center" scope="row">


                                            <?php echo form_open("carrinho/remover", ['class' => 'form-inline']); ?>

                                            <div class="form-group">

                                                <input type="hidden" name="produto[slug]" value="<?php echo $produto->slug; ?>">

                                            </div>


                                            <button type="submit" class="btn btn-danger float-right">
                                                <i class="fa fa-trash"></i>                                              
                                            </button>


                                            <?php echo form_close(); ?>

                                        </th>
                                        <td><?php echo esc($produto->nome); ?></td>
                                        <td><?php echo esc($produto->tamanho); ?></td>
                                        <td class="text-center">


                                            <?php echo form_open("carrinho/atualizar", ['class' => 'form-inline']); ?>

                                            <div class="form-group">

                                                <input type="number" name="produto[quantidade]" class="form-control" value="<?php echo $produto->quantidade; ?>" min="1" max="10" step="1" required="">
                                                <input type="hidden" name="produto[slug]" value="<?php echo $produto->slug; ?>">

                                            </div>


                                            <button type="submit" class="btn btn-primary float-right">
                                                <i class="fa fa-refresh"></i>                                              
                                            </button>


                                            <?php echo form_close(); ?>



                                        </td>

                                        <td>R$&nbsp;<?php echo esc($produto->preco); ?></td>

                                        <?php
                                        $subTotal = $produto->preco * $produto->quantidade;

                                        $total += $subTotal;
                                        ?>

                                        <td>R$&nbsp;<?php echo number_format($subTotal, 2); ?></td>
                                    </tr>

                                <?php endforeach; ?>


                                <tr>
                                    <td class="text-right" colspan="5" style="font-weight: bold">Total produtos:</td>
                                    <td colspan="5">R$&nbsp;<?php echo number_format($total, 2); ?></td>
                                </tr>

                                <tr>
                                    <td class="text-right" colspan="5" style="font-weight: bold; border-top: none !important">Taxa entrega:</td>
                                    <td class="border-top-0" colspan="5" id="valor_entrega" style="border-top: none !important">Não calculado</td>
                                </tr>

                                <tr>
                                    <td class="text-right border-top-0" colspan="5" style="font-weight: bold; border-top: none !important">Total pedido:</td>
                                    <td class="border-top-0" colspan="5" id="total" style="border-top: none !important"><?php echo 'R$&nbsp;' . number_format($total, 2); ?></td>
                                </tr>



                            </tbody>
                        </table>



                        <div class="form-group col-md-5">

                            <label>Consulte a taxa de entrega</label>
                            <input type="text" name="cep" class="cep form-control" placeholder="Informe o seu CEP">
                            <div id="cep"></div>

                        </div>


                    </div>

                    <hr>

                    <div class="col-md-12">

                        <a href="<?php echo site_url("carrinho/limpar"); ?>" class="btn btn-default" style="font-family: 'Montserrat-Bold';">Limpar carrinho</a>

                        <a href="<?php echo site_url("/"); ?>" class="btn btn-primary" style="font-family: 'Montserrat-Bold';">Mais delícias</a>

                        <a href="<?php echo site_url("checkout"); ?>" class="btn pull-right" style="background-color: #990100; color: white; font-family: 'Montserrat-Bold';">Finalizar pedido</a>

                    </div>

                <?php endif; ?>







            </div>
        </div>
        <!-- end product -->
    </div>


</div>



<?php echo $this->endSection(); ?>


<?php echo $this->section('scripts'); ?>


<script src="<?php echo site_url('admin/vendors/mask/jquery.mask.min.js'); ?>"></script>
<script src="<?php echo site_url('admin/vendors/mask/app.js'); ?>"></script>


<script>


    $("[name=cep]").focusout(function () {

        var cep = $(this).val();

        if (cep.length === 9) {


            $.ajax({

                type: 'get',
                url: '<?php echo site_url('carrinho/consultacep'); ?>',
                dataType: 'json',
                data: {
                    cep: cep
                },
                beforeSend: function () {

                    $("#cep").html('Consultando...');


                    $("[name=cep]").val('');

                },

                success: function (response) {

                    if (!response.erro) {

                        /* CEP válido */


                        $("#cep").html('');


                        $("#valor_entrega").html(response.valor_entrega);



                        $("#total").html(response.total);



                        $("#cep").html(response.bairro);



                    } else {

                        /* Erros de validação etc... */

                        $("#cep").html(response.erro);

                    }

                },
                error: function () {

                    alert('Não foi possível consultar a taxa de entrega. Por favor entre em contato com a nossa equipe e inform o erro: CONSULTA-ERRO-TAXA-ENTREGA');

                }

            });

        }

    });




</script>



<?php echo $this->endSection(); ?>








