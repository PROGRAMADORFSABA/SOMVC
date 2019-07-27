<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Fornecedor</h3>

            <?php if ($Sessao::retornaErro()) { ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/fornecedor/salvar" method="post" id="form_cadastro">                
                <div class="form-group">
                    <label for="nomeFantasia">Nome Fantasia</label>
                    <input type="text"  class="form-control" name="nomeFantasia" id="nomeFantasia" placeholder="Nome Fantasia">
                </div>

                <div class="form-group">
                    <label for="razaoSocial">Razao Social</label>
                    <input type="text"  class="form-control"  name="razaoSocial" id="razaoSocial" value="<?php echo $Sessao::retornaValorFormulario('razaoSocial'); ?>" placeholder="Razao Social" required>
                </div>

                <div class="form-group">
                    <label for="cnpj">CNPJ</label>
                    <input type="text"  class="form-control"  name="cnpj" id="cnpj" placeholder="CNPJ" value="<?php echo $Sessao::retornaValorFormulario('cnpj'); ?>" required>
                </div>     
                <button type="submit" class="btn btn-success btn-pill btn-elevate btn-elevate-air">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/fornecedor"  class="btn btn-brand btn-elevate btn-pill btn-elevate-air">Listar de Fornecedores</a>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>
</div>