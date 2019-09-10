<!--begin::Portlet-->
<div class="container">
    <br>
    <center>
        <h3>Cadastro de Produto</h3>
    </center>
    <?php if ($Sessao::retornaErro()) { ?>
    <div class="alert alert-warning" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
        <?php echo $mensagem; ?> <br>
        <?php } ?>
    </div>
    <?php } ?>
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/produto/salvar" method="post" id="form_cadastro" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao" value="<?php echo $_SESSION['idInstituicao']; ?>" required>
        <div class="kt-portlet__body">
            <input type="hidden" class="form-control" name="dataCadastro" id="dataCadastro" value="<?php echo $dataAtual; ?>" required>
            <input type="hidden" class="form-control" name="dataAlteracao" id="dataAlteracao" value="<?php echo $dataAtual; ?>" required>
            <input type="hidden" class="form-control" name="proUsuario" id="proUsuario" value="<?php echo $codUsuario; ?>" required>
            <div class="kt-portlet__body">
                <div class="form-group">
                    <label>Nome do Produto:</label>
                    <input type="text" class="form-control" placeholder="Digite Nome do Produto" id="proNome" name="proNome" value="<?php echo $Sessao::retornaValorFormulario('ProNome'); ?>" required>
                    <span class="form-text text-muted">Digite o Nome do Produto</span>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label class="">Nome Comercial:</label>
                        <input type="text" class="form-control" placeholder="Digite o Nome Comercial" id="proNomeComercial" name="proNomeComercial" value="<?php echo $Sessao::retornaValorFormulario('ProNomeComercial'); ?>" required>
                        <span class="form-text text-muted">Digite o Nome Comercial</span>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group"><label for="proMarca">Marca:</label>
                            <select class="form-control" name="proMarca" required>
                                <option value="">Selecione a Marca</option>
                                <?php foreach ($viewVar['listaMarcas'] as $marca) : ?>
                                <option value="<?php echo $marca->getProMarca(); ?>" <?php echo ($Sessao::retornaValorFormulario('ProMarca') == $representante->getProMarca()) ? "selected" : ""; ?>>
                                    <?php echo $parca->getNomeMarca(); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="form-text text-muted">Por favor insira a Marca</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
                        <div class="form-group"><label for="proFornecedor">Fornecedor:</label>
                            <select class="form-control" name="proFornecedor" required>
                                <option value="">Selecione o Fornecedor</option>
                                <?php foreach ($viewVar['listaFornecedores'] as $fornecedor) : ?>
                                <option value="<?php echo $fornecedor->getProFornecedor(); ?>" <?php echo ($Sessao::retornaValorFormulario('codRepresentante') == $fornecedor->getProFornecedor()) ? "selected" : ""; ?>>
                                    <?php echo $fornecedor->getNomeFornecedor(); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="form-text text-muted">Por favor insira o Fornecedor</span>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-8">
                            <button type="submit" class="btn btn-primary btn-elevate btn-pill btn-elevate-air">Enviar</button>
                            <a href="http://<?php echo APP_HOST; ?>/pedido" class="btn btn-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
    <!--end::Form-->
</div>

<!--end::Portlet-->

<!-- footer -->

</div>