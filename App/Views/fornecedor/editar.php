<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <h3>Alteracao Fornecedor</h3>

            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/fornecedor/atualizar" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="codFornecedor" id="codFornecedor" value="<?php echo $viewVar['fornecedor']->getCodFornecedor(); ?>">
                <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao" value="<?php  echo $_SESSION['idInstituicao']; ?>" required>
                <div class="form-group">
                    <label for="nomeFantasia">Nome Fantasia</label>
                    <input type="text"  class="form-control" name="nomeFantasia" id="nomeFantasia" placeholder="" value="<?php echo $viewVar['fornecedor']->getNomeFantasia(); ?>" required>
                </div>

                <div class="form-group">
                    <label for="razaoSocial">Razao Social</label>
                    <input type="text"  class="form-control"  name="razaoSocial" id="razaoSocial" placeholder="" value="<?php echo $viewVar['fornecedor']->getRazaoSocial(); ?>" required>
                </div>

                <div class="form-group">
                    <label for="cnpj">CNPJ</label>
                    <input type="text"  class="form-control"  name="cnpj" id="cnpj" placeholder="" value="<?php echo $viewVar['fornecedor']->getCnpj(); ?>" required>
                </div>               

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/fornecedor" class="btn btn-info btn-sm">Voltar</a>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>
</div>
