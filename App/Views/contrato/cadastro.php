<!--begin::Portlet-->
<div class="container">
    <br>
    <center><h3>Cadastro de Contrato</h3></center>
    <?php if ($Sessao::retornaErro()) { ?>
        <div class="alert alert-warning" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
                <?php echo $mensagem; ?> <br>
            <?php } ?>
        </div>
    <?php } ?>
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/pedido/salvar" method="post" id="form_cadastro" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao" value="<?php echo $_SESSION['idInstituicao']; ?>" required>
        <div class="kt-portlet__body">
            <input type="hidden" class="form-control" name="dataCadastro" id="dataCadastro" value="<?php echo $dataAtual; ?>" required>
            <input type="hidden" class="form-control" name="idCliente" id="idCliente" required>
            <div class="kt-portlet__body">
            
                <div class="form-group">
                    <label  class="">CADASTRO DO CLIENTE</label>                    
                    <a href="http://<?php echo APP_HOST; ?>/cliente/cadastro" id="cadastroCliente"  name="cadastroCliente" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-plus"></i>Novo Cliente</a>
                      <div>    
                      <?php $cliente = $viewVar['listaClientes'] ?>
                        <input type="text" name="clienteAutocomplete" id="cliente-autocomplete" class="form-control" required placeholder="Cliente - autocomplete">
                      </div>
                      <span class="form-text text-muted">Por favor insira o cliente do Contrato</span>
            </div>
            <div class="kt-portlet__body">
            
                <div class="form-group">
                    <label  class="">CADASTRO DO CLIENTE</label>                    
                    <a href="http://<?php echo APP_HOST; ?>/cliente/cadastro" id="clienteCad"  name="clienteCad" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-plus"></i>Novo Cliente</a>
                      <div>    
                      <?php $cliente = $viewVar['listaClientes'] ?>
                        <input type="text" name="clientePesquisa" id="clientePesquisa" class="form-control" required placeholder="Cliente - autocomplete">
                      </div>
                      <input type="text" class="form-control" name="andreteste" id="andreteste" value="" required>
                      <span class="form-text text-muted">Por favor insira o cliente do Contrato</span>
            </div>
            <div class="form-group row">
                    <div class="col-lg-3">
                            <label for="codTipoCliente">Tipo do Cliente</label>
                                <select class="form-control" name="codTipoCliente" required>
                                    <option value="">Selecione o Tipo</option>
                                        <option value="Estadual" >Estadual</option>
                                        <option value="Federal" >Federal</option>
                                        <option value="Privado" >Privado</option>
                                        <option value="Municipal" >Municipal</option>
                                </select>
                                <span class="form-text text-muted">Por favor insira o Tipo do Cliente</span>
                            
                    </div>
                    <div class="col-lg-3">
                        <label>Numero da Licitacao:</label>
                        <input type="text" class="form-control" placeholder="Digite numero da licitacao" id="numeroPregao" name="numeroPregao" value="<?php echo $Sessao::retornaValorFormulario('numeroPregao'); ?>" required>
                        <span class="form-text text-muted">Digite o numero da licitacao</span>
                    </div>
                    <div class="col-lg-3">
                        
                                <label for="codStatusContrato">Status do Contrato</label>
                                <select class="form-control" name="codStatusContrato" required>
                                    <option value="">Selecione o Status</option>
                                        <option value="Pendente" >Pendente</option>
                                        <option value="Lancado" >Lancado</option>
                                        <option value="Vencido" >Vencido</option>
                                </select>
                                <span class="form-text text-muted">Por favor insira o Status do Contrato</span>
                            
                        </div>
                        <div class="col-lg-3">
                        <label class="">Numero do Contrato:</label>
                        <input type="text" class="form-control" placeholder="Digite o numero do Contrato" id="numeroAf" name="numeroAf" value="<?php echo $Sessao::retornaValorFormulario('numeroAf'); ?>" required>
                        <span class="form-text text-muted">Digite o numero do Contrato</span>
                    </div>
                </div>
                <div class="form-group row"> 
                    <div class="col-lg-3">
                        <label class="">Vigencia do Contrato:</label>
                        <input type="text" class="form-control" placeholder="Digite a Vigencia do Contrato" id="vigenciaContrato" name="vigenciaContrato" value="<?php echo $Sessao::retornaValorFormulario('numeroAf'); ?>" required>
                        <span class="form-text text-muted">Digite a Vigencia do Contrato</span>
                    </div>
                    <div class="col-lg-3">
                        <label class="">Valor do Contrato:</label>
                        <input type="text" class="form-control" placeholder="Digite o valor do Contrato" id="valorContrato" name="valorContrato" value="<?php echo $Sessao::retornaValorFormulario('valorContrato'); ?>" required>
                        <span class="form-text text-muted">Digite o valor do Contrato</span>
                    </div>
                    <div class="col-lg-3">
                        <label class="">Prazo de Entrega:</label>
                        <input type="text" class="form-control" placeholder="Digite o Prazo de Entrega" id="PrazoEntrega" name="PrazoEntrega" value="<?php echo $Sessao::retornaValorFormulario('valorContrato'); ?>" required>
                        <span class="form-text text-muted">Digite o Prazo de Entrega</span>
                    </div>
                    <div class="col-lg-3">
                        <label class="">Prazo de Pagamento:</label>
                        <input type="text" class="form-control" placeholder="Digite o Prazo de Pagamento" id="PrazoPagamento" name="PrazoPagamento" value="<?php echo $Sessao::retornaValorFormulario('valorPedido'); ?>" required>
                        <span class="form-text text-muted">Digite o Prazo de Pagamento</span>
                    </div>                    
                </div>                
                <div class="form-group row">
                    <div class="col-lg-8">
                        <label class="">Observacao do Contrato:</label>
                        <textarea class="form-control" rows="3" placeholder="Digite Observacao do Contrato" id="observacao" name="observacao" value="<?php echo $Sessao::retornaValorFormulario('observacao'); ?>" required></textarea>
                        <span class="form-text text-muted">Digite Observacao do Contrato</span>
                    </div>
                    <div class="col-lg-4">
                        <label class="">Anexo:</label>
                        <input type="file" name="anexo" id="anexo" value="<?php echo $Sessao::retornaValorFormulario('anexo'); ?>">
                        <span class="form-text text-muted">Selecione o arquivo</span>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-8">
                            <button type="submit" class="btn btn-primary btn-elevate btn-pill btn-elevate-air">Salvar</button>
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