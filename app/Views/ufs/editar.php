<?=$header?>
<br>
<?php if (session('mensaje')) { ?>
    <div class="alert alert-danger" role="alert">
        <?php
            echo session('mensaje');
        ?>
    </div>
<?php
}
?>
<div class="container">
    <div class="card border-primary">
        <div class="card-body">
            <h4 class="card-title">Editar datos</h4>
            <p class="card-text">
            <form method="post" action="<?=site_url('/actualizar')?>" enctype="multipart/form-data">
            <input type="hidden" id="id" value="<?=$uf['id']?>" name="id">    
            <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input id="fecha" value="<?=$uf['fecha']?>" class="form-control" type="text" name="fecha">
                </div>
                <div class="form-group">
                    <label for="valor">Valor</label>
                    <input id="valor" value="<?=$uf['valor']?>" class="form-control" type="text" name="valor">
                </div>
                <button class="btn btn-success" type="submit">Actualizar</button>
                <a href="<?=base_url('listar');?>" class="btn btn-info">Cancelar</a>
            </form>
            </p>
        </div>
    </div>
</div>
<?=$footer?>