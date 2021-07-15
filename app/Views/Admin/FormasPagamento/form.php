
<div class="form-row">

    <div class="form-group col-md-12">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome" value="<?php echo old('nome', esc($forma->nome)); ?>">
    </div>

</div>


<div class="form-check form-check-flat form-check-primary mb-4">
    <label for="ativo" class="form-check-label">


        <input type="hidden" name="ativo" value="0">


        <input type="checkbox" class="form-check-input" id="ativo" name="ativo" value="1" <?php if (old('ativo', $forma->ativo)): ?> checked="" <?php endif; ?> >
        Ativo
    </label>
</div>






<button type="submit" class="btn btn-primary mr-2 btn-sm">
    <i class="mdi mdi-checkbox-marked-circle btn-icon-prepend"></i>
    Salvar
</button>

