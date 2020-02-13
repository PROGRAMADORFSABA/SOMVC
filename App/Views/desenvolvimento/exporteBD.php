<!--begin::Portlet-->
<div class="container">
    
    <center>
    <h1>Exportar/ Importar base de dados</h1>
    </center>
    <?php if ($Sessao::retornaMensagem()) { ?>
    <div class="alert alert-warning" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $Sessao::retornaMensagem(); ?>
    </div>
    <?php } ?>
    <!--begin::Form-->
    <form method="POST" action="http://<?php echo APP_HOST; ?>/desenvolvimento/conexaoBD" enctype="multipart/form-data">
        
        <div class="col-lg-3">
                        <label for="servidor">Servidor:</label>
                        <input type="text" class="form-control" placeholder="Digite servidor"
                            id="servidor" name="servidor"
                            value="<?php echo  DB_HOST  ?>" required>
                        <span class="form-text text-muted">Digite o servidor</span>
        </div>
        <div class="col-lg-3">
                        <label for="usuario">Usuario:</label>
                        <input type="text" class="form-control" placeholder="Digite usuario"
                            id="usuario" name="usuario"
                            value="<?php echo  DB_USER  ?>" required>
                        <span class="form-text text-muted">Digite o usuario</span>
        </div>
        <div class="col-lg-3">
                        <label for="senha">senha:</label>
                        <input type="password" class="form-control" placeholder="Digite senha"
                            id="senha" name="senha"
                            value="<?php echo  DB_PASSWORD  ?>" required>
                        <span class="form-text text-muted">Digite o senha</span>
        </div>
        <div class="col-lg-3">
                        <label for="dbname">Banco de Dados:</label>
                        <input type="text" class="form-control" placeholder="Digite banco de dados"
                            id="dbname" name="dbname"
                            value="<?php echo  DB_NAME  ?>" required>
                        <span class="form-text text-muted">Digite o banco de dados</span>
        </div>
            
        <label>Backup: </label>
        <input title="Selecione o arquivo para importação do banco de dados" type="file" name="arquivo"><br><br>

        <input class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air" type="submit" value="Cofirmar">

    </form>
    <br>
    <!--end::Form-->
</div>

<!--end::Portlet-->

<!-- footer -->

</div>