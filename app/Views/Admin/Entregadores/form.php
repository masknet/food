
<div class="form-row">

    <div class="form-group col-md-5">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" value="<?php echo old('nome', esc($entregador->nome)); ?>">
    </div>

    <div class="form-group col-md-3">
        <label for="cpf">CPF</label>
        <input type="text" class="form-control cpf" name="cpf" id="cpf" value="<?php echo old('cpf', esc($entregador->cpf)); ?>">
    </div>

    <div class="form-group col-md-2">
        <label for="cnh">CNH</label>
        <input type="text" class="form-control cnh" name="cnh" id="cnh" value="<?php echo old('cnh', esc($entregador->cnh)); ?>">
    </div>

    <div class="form-group col-md-2">
        <label for="telefone">Telefone</label>
        <input type="text" class="form-control sp_celphones" name="telefone" id="telefone" value="<?php echo old('telefone', esc($entregador->telefone)); ?>">
    </div>

    <div class="form-group col-md-5">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" name="email" id="email" value="<?php echo old('email', esc($entregador->email)); ?>">
    </div>


    <div class="form-group col-md-4">
        <label for="veiculo">Veículo</label>
        <input type="text" class="form-control" name="veiculo" id="veiculo" value="<?php echo old('veiculo', esc($entregador->veiculo)); ?>">
    </div>
    
    <div class="form-group col-md-3">
        <label for="placa">Placa</label>
        <input type="text" class="form-control placa" name="placa" id="placa" value="<?php echo old('placa', esc($entregador->placa)); ?>">
    </div>
    
    
    <div class="form-group col-md-12">
        <label for="endereco">Endereço</label>
        <input type="text" class="form-control" name="endereco" id="endereco" value="<?php echo old('endereco', esc($entregador->endereco)); ?>">
    </div>


</div>


<div class="form-check form-check-flat form-check-primary mb-2">
    <label for="ativo" class="form-check-label">


        <input type="hidden" name="ativo" value="0">


        <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" <?php if (old('ativo', $entregador->ativo)): ?> checked="" <?php endif; ?> >
        Ativo
    </label>
</div>


<button type="submit" class="btn btn-primary mt-4 mr-2 btn-sm">
    <i class="mdi mdi-checkbox-marked-circle btn-icon-prepend"></i>
    Salvar
</button>

