<!--begin::Portlet-->
<div class="container">
    <br>
    <center><h1>Cadastro </h1></center>
    <br>    
    <!--begin::Portlet-->
<div class="kt-portlet">
    <?php if ($Sessao::retornaMensagem()) { ?>
    <div class="alert alert-warning" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $Sessao::retornaMensagem(); ?>
    </div>
    <?php } ?>
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/controller/tela" method="post"
        id="form_cadastro">
        <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao"
            value="<?php echo $_SESSION['idInstituicao']; ?>" required>
            <input type="text" class="form-control" name="dataCadastro" id="dataCadastro" value="<?php echo  date('Y-m-d H-m-s'); ?>" required>
        <div class="kt-portlet__body">
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label>Razao Social:</label>
                        <input type="text" class="form-control" placeholder="Digite a Razao Social" id="nome" name="nome"
                        value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>" required>
                        <span class="form-text text-muted">Digite a Razao Social</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label class="">Nome Fantasia:</label>
                        <input type="text" class="form-control" placeholder="Digite seu e-mail" name="nomeFantasia"
                            value="<?php echo $Sessao::retornaValorFormulario('nomeFantasia'); ?>" required>
                        <span class="form-text text-muted">Digite o Nome Fantasia</span>
                    </div>
                    <div class="col-lg-4">
                        <label class="">Email:</label>
                        <input type="email" class="form-control" placeholder="Digite seu e-mail" name="email"
                            value="<?php echo $Sessao::retornaValorFormulario('email'); ?>" required>
                        <span class="form-text text-muted">Digite seu e-mail</span>
                    </div>
                    <div class="col-lg-4">
                        <label class="">CNPJ:</label>
                        <input type="text" id="cnpj" name="cnpj" class="form-control" placeholder="Digite o CNPJ">
                        <span class="form-text text-muted">Por favor insira o CNPJ</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                    <label class="" for="contato">Contato:</label>
                        <input type="text" id="contato" name="contato" class="form-control" placeholder="Digite o contato">
                        <span class="form-text text-muted">Por favor insira o contato</span>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group"><label for="id_ep">Cidade</label>
                            <select class="form-control" name="id_dep" required>
                                <option value="">Selecione a Cidade</option>
                                <?php foreach ($viewVar['listaCidades'] as $cidade) : ?>
                                <option value="<?php echo $cidade->getId(); ?>"
                                    <?php echo ($Sessao::retornaValorFormulario('id') == $cidade->getId()) ? "selected" : ""; ?>>
                                    <?php echo $Cidade->getNome(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <span class="form-text text-muted">Por favor insira a Cidade</span>
                    </div>

                    <div class="col-lg-4">
                        <label class="">Status:</label>
                        <div class="kt-radio-inline">
                            <label class="kt-radio kt-radio--solid">
                                <input type="radio" name="status" value="1" readonly="readonly"> Ativo
                                <span></span>
                            </label>
                        </div>
                        <label class="kt-radio kt-radio--solid">
                            <input type="radio" name="status" checked value="2" readonly="readonly"> Desativado
                            <span></span>
                        </label>
                        <span class="form-text text-muted">Por favor, selecione o statuss</span>
                    </div>

                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label class="">Observacao:</label>
                        <textarea type="text" class="form-control" id="dica" name="Observacao"
                          rows="4"  placeholder="Digite a Observacao"></textarea
                        <span class="form-text text-muted">Por favor insira sua Observacao</span>
                    </div>

                </div>
            </div>
            
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-5"></div>
                        <div class="col-lg-4">
                            <button type="submit"
                                class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">Salvar</button>
                            <a href="http://<?php echo APP_HOST; ?>/classe"
                                class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
    </form>

    <!--end::Form-->
</div>

<!--end::Portlet-->



<!-- footer -->

</div>