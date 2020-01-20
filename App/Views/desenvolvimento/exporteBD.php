<h1>Exportar base de dados</h1>
<?php if ($Sessao::retornaErro()) { ?>
<div class="alert alert-warning" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
    <?php echo $mensagem; ?> <br>
    <?php } ?>
</div>
<?php } ?>
<?php if ($Sessao::retornaMensagem()) { ?>
<div class="alert alert-warning" role="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php echo $Sessao::retornaMensagem(); ?>
</div>
<?php } ?>
<form method="POST" action="http://<?php echo APP_HOST; ?>/desenvolvimento/conexaoBD" enctype="multipart/form-data">
    <label>Servidor: </label>
    <input type="text" name="servidor" placeholder="Nome do Servidor" value="<?php echo DB_HOST ?>"><br><br>

    <label>Usuário: </label>
    <input type="text" name="usuario" placeholder="Nome do usuário" value="<?php echo DB_USER ?>"><br><br>

    <label>Senha: </label>
    <input type="password" name="senha" placeholder="Senha da base de dados"><br><br>

    <label>Base de Dados: </label>
    <input type="text" name="dbname" placeholder="Nome da base de dados" value="<?php echo DB_NAME ?>"><br><br>

    <input type="submit" value="Exportar">

</form>
</body>
</div>
</div>
</div>