<div class="container">
    <br>
    <center>
        <h3>Editar Cliente</h3>
    </center>

    <?php if ($Sessao::retornaErro()) { ?>
    <div class="alert alert-warning" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
        <?php echo $mensagem; ?> <br>
        <?php } ?>
    </div>
    <?php } ?>
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/clienteLicitacao/atualizar" method="post" id="form_cadastro" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="codCliente" id="codCliente" value="<?php echo $viewVar['clienteLicitacao']->getCodCliente(); ?>">
        <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao" value="<?php echo $_SESSION['idInstituicao']; ?>" required>
        <div class="kt-portlet__body">
            <div class="kt-portlet__body">
                <div class="form-group">
                    <label for="razaoSocial">Razao Social</label>
                    <input type="text" class="form-control" name="razaoSocial" id="razaoSocial" placeholder="Razao Social do cliente" value="<?php echo $viewVar['clienteLicitacao']->getRazaoSocial(); ?>" required>

                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label for="nomeFantasia">Nome Fantasia</label>
                            <input type="text" class="form-control" name="nomeFantasia" id="nomeFantasia" placeholder="Nome Fantasia do cliente" value="<?php echo $viewVar['clienteLicitacao']->getNomeFantasia(); ?>" required>
                        </div>

                        <div class="col-lg-3">
                            <label for="cnpj">CNPJ</label>
                            <input type="text" class="form-control" name="cnpj" id="Cnpj" placeholder="Cnpj" value="<?php echo $viewVar['clienteLicitacao']->getCnpj(); ?>" required>
                        </div>
                        <div class="col-lg-3">
                            <label for="trocaMarca">Aceita Troca Marca</label>
                            <div class="input-group">
                                <select class="form-control" name="trocaMarca" id="trocaMarca">
                                    <option value="">Selecione a opcao</option>
                                    <option value="<?php echo $viewVar['clienteLicitacao']->getTrocaMarca(); ?>" <?php echo ($viewVar['clienteLicitacao']->getTrocaMarca() == $viewVar['clienteLicitacao']->getTrocaMarca()) ? "selected" : ""; ?>>
                                        <?php echo $viewVar['clienteLicitacao']->getTrocaMarca(); ?> </option>
                                    <option value="NAO">0 - NAO</option>
                                    <option value="SIM">1 - SIM</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                             <label for="tipoCliente">Tipo cliente</label>
                            <div class="input-group">
                                <select class="form-control" name="tipoCliente" id="tipoCliente" value="<?php echo $viewVar['clienteLicitacao']->getTipoCliente(); ?>">
                                    <option value="<?php echo $viewVar['clienteLicitacao']->getTipoCliente(); ?>"><?php echo $viewVar['clienteLicitacao']->getTipoCliente(); ?></option>
                                    <option value="">Selecione o tipo do Cliente</option>
                                    <option value="Estadual">1 - Estadual</option>
                                    <option value="Federal">2 - Federal</option>
                                    <option value="Municipal">3 - Municipal</option>
                                    <option value="Particular">4 - Particular</option>
                                </select>
                            </div>
                        </div>                       
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <button type="submit" class="btn btn-success btn-elevate btn-pill btn-elevate-air">Salvar</button>
                        <a href="http://<?php echo APP_HOST; ?>/clienteLicitacao" class="btn btn-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>