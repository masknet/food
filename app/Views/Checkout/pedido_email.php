<h5>Pedido <?php echo esc($pedido->codigo) ?> realizado som sucesso!</h5>

<p>Olá <strong><?php echo esc($pedido->usuario->nome); ?></strong>, recebemos o seu pedido <?php echo esc($pedido->codigo); ?></strong></p>

<p>Estamos acelerando do lado de cá para que o seu pedido fique pronto rapidinho. Logo logo ele sairá para entrega.</p>
<p>Não se preocupe, quando isso acontecer, avisaremos você por e-mail, beleza?</p>


<p>
    Enquanto isso, <a href="<?php echo site_url('conta'); ?>">clique aqui para ver os seus pedidos</a>
</p>