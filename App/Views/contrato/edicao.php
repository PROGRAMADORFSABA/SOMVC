<!--begin::Portlet-->
<div class="container">
    <br>
    <center><h3>Alteracao de Contrato</h3></center>
    <?php if ($Sessao::retornaErro()) { ?>
        <div class="alert alert-warning" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
                <?php echo $mensagem; ?> <br>
            <?php } ?>
        </div>
    <?php } ?>
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/contrato/atualizar" method="post" id="form_cadastro" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao" value="<?php echo $_SESSION['inst_id']; ?>" required>
        <input type="hidden" class="form-control" id="codigo" name="codigo" value="<?php echo $viewVar['contrato']->getCtrId(); ?>"  required>
        <input type="hidden" class="form-control" name="ctrUsuario" id="ctrUsuario" value="<?php echo $_SESSION['id']; ?>" required>
            <input type="hidden" class="form-control" name="dataCadastro" id="dataCadastro" value="<?php echo $dataAtual; ?>" required>
        <div class="kt-portlet__body">
            <input type="hidden" class="form-control" name="idCliente" id="idCliente" required>
            <div class="kt-portlet__body">
            
                <div class="form-group row">
                    <div class="col-lg-12">
                    <label  class="">CADASTRO DO CLIENTE</label>                    
                    <a href="http://<?php echo APP_HOST; ?>/cliente/cadastro" id="cadastroCliente"  name="cadastroCliente" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-plus"></i>Novo Cliente</a>                     
                        <input type="text" class="form-control" placeholder="Cliente - autocomplete" id="clienteLicitacao-autocomplete" name="clienteLicitacao-autocomplete" value="<?php echo $viewVar['edital']->getClienteLicitacao()->getRazaoSocial()  ." - ". $viewVar['edital']->getClienteLicitacao()->getNomeFantasia(); ?>" required>
                        <input type="hidden" id="cliente" name="cliente" value=<?php echo $viewVar['edital']->getClienteLicitacao()->getCodCliente(); ?>>  

                      <span class="form-text text-muted">Por favor insira o cliente do Edital</span>  
                      </div>                    
                </div>            
            <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="prazoEntrega">Prazo de Entrega</label>
                        <input type="text" class="form-control" placeholder="Digite o Prazo de Entrega" id="prazoEntrega" name="prazoEntrega" value="<?php echo $viewVar['contrato']->getCtrPrazoEntrega(); ?>" required>
                            </select>
                            <span class="form-text text-muted">Por favor insira o Prazo de Entrega</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="prazoPagamento">Prazo de Pagamento</label>
                        <input type="text" class="form-control" placeholder="Digite o Prazo de Pagamento" id="prazoPagamento" name="prazoPagamento" value="<?php echo $viewVar['contrato']->getCtrPrazoPagamento(); ?>" required>
                            </select>
                            <span class="form-text text-muted">Por favor insira o Prazo de Pagamento</span>
                    </div>
                    <div class="col-lg-3">
                        <label for="numeroContrato" >Numero da Contrato:</label>
                        <input type="text" class="form-control" placeholder="Digite numero da Contrato" id="numeroContrato" name="numeroContrato" value="<?php echo $viewVar['contrato']->getCtrPrazoEntrega(); ?>" required>
                        <span class="form-text text-muted">Digite o numero da Contrato</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="">Selecione o Status</option>
                            <option value="<?php echo $viewVar['contrato']->getCtrStatus(); ?>" <?php echo ($viewVar['contrato']->getCtrStatus() == $viewVar['contrato']->getCtrStatus()) ? "selected" : ""; ?>>
                                    <?php echo $viewVar['contrato']->getCtrStatus(); ?> </option>
                                    <option value="Pendente">Pendente</option>
                                <option value="Lancado">Lancado</option>
                                <option value="Vencido">Vencido</option>
                        </select>
                        <span class="form-text text-muted">Por favor insira o Status</span>
                    </div>
                    <div class="col-lg-3">
                        <label for="representante">Representante</label>
                        <select class="form-control" id="representante" name="representante" required>
                                <option value="">Selecione o Representante</option>
                                <?php foreach ($viewVar['listarRepresentantes'] as $representante) : ?>
                                    <option value="<?php echo $representante->getCodRepresentante(); ?>" <?php echo ($viewVar['edital']->getRepresentante()->getCodRepresentante() == $representante->getCodRepresentante()) ? "selected" : ""; ?>>
                                        <?php echo $representante->getNomeRepresentante(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        <span class="form-text text-muted">Por favor insira o Representante</span>
                    </div>                     
                </div>
                <div class="form-group row"> 
                    <div class="col-lg-2">
                            <label for="dataInicio" class="">Data de Inicio:</label>
                            <input type="date" class="form-control" placeholder="Digite a Data Inicial" id="dataInicio" name="dataInicio" value="<?php echo $viewVar['contrato']->getEdtDataInicio()->format('Y-m-d'); ?>" required>
                            <span class="form-text text-muted">Digite a Data Inicial</span>
                    </div>
                    <div class="col-lg-2">
                            <label for="dataVencimento" class="">Data de Vencimento:</label>
                            <input type="date" class="form-control" placeholder="Digite a Data Vencimento" id="dataVencimento" name="dataVencimento" value="<?php echo $viewVar['contrato']->getEdtDataVencimento()->format('Y-m-d'); ?>" required>
                            <span class="form-text text-muted">Digite a Data Vencimento</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="anexo" class="">Anexo:</label>
                        <input type="file" name="anexo" id="anexo" value="<?php echo $Sessao::retornaValorFormulario('anexo'); ?>">
                        <input type="hidden" name="anexoAlt" id="anexoAlt" value="<?php echo $viewVar['contrato']->getCtrAnexo(); ?>">
                        <span class="form-text text-muted">Selecione o arquivo</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="observacao" class="">Observacao do Contrato:</label>
                        <textarea class="form-control" rows="3" placeholder="Digite Observacao do Contrato" id="observacao" name="observacao" ><?php echo $viewVar['contrato']->getCtrObservacao(); ?></textarea>
                        <span class="form-text text-muted">Digite Observacao do Contrato</span>
                    </div>                    
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-8">
                            <button type="submit" class="btn btn-primary btn-elevate btn-pill btn-elevate-air">Salvar</button>
                            <a href="http://<?php echo APP_HOST; ?>/contrato" class="btn btn-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
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