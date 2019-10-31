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
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/contrato/salvar" method="post" id="form_cadastro" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao" value="<?php echo $_SESSION['inst_id']; ?>" required>
        <input type="hidden" class="form-control" name="ctrUsuario" id="ctrUsuario" value="<?php echo $_SESSION['id']; ?>" required>
            <input type="hidden" class="form-control" name="dataCadastro" id="dataCadastro" value="<?php echo $dataAtual; ?>" required>
        <div class="kt-portlet__body">
            <input type="hidden" class="form-control" name="idCliente" id="idCliente" required>
            <div class="kt-portlet__body">
            
                <div class="form-group">
                    <label for="cadastroCliente" class="">CADASTRO DO CLIENTE</label>                    
                    <a href="http://<?php echo APP_HOST; ?>/edital/cadastro" id="cadastroCliente"  name="cadastroCliente" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-plus"></i>Novo Edital</a>
                      <div>    
                        <input type="text" name="contratoCliente-Autocomplete" id="contratoCliente-Autocomplete" class="form-control" required placeholder="Cliente - autocomplete"
                        value="<?php echo $viewVar['contrato']->getClienteLicitacao()->getRazaoSocial(); ?>" > 
                        <input type="hidden" id="cliente" name="cliente" 
                        value=<?php echo $viewVar['contrato']->getClienteLicitacao()->getCodCliente(); ?>>  
                    </div>
                      <span class="form-text text-muted">Por favor insira o cliente do Contrato</span>                       
            </div>
            <div class="form-group row">
                    <div class="col-lg-3">
                        <label for="numeroContrato" >Numero da Contrato:</label>
                        <input type="text" class="form-control" placeholder="Digite numero da Contrato" id="numeroContrato" name="numeroContrato" value="<?php $Sessao::retornaValorFormulario('numeroContrato');?>" required>
                        <span class="form-text text-muted">Digite o numero da Contrato</span>
                    </div>
                    <div class="col-lg-3">
                        <label for="prazoEntrega" >Prazo de Entrega:</label>
                        <input type="text" class="form-control" placeholder="Digite o Prazo de Entrega" id="prazoEntrega" name="prazoEntrega" value="<?php $Sessao::retornaValorFormulario('prazoEntrega');?>" required>
                        <span class="form-text text-muted">Digite oPrazo de Entrega</span>
                    </div>
                    <div class="col-lg-3">
                        <label for="prazoPagamento" >Prazo de Pagamento:</label>
                        <input type="text" class="form-control" placeholder="Digite o Prazo de Pagamento" id="prazoPagamento" name="prazoPagamento" value="<?php $Sessao::retornaValorFormulario('prazoPagamento');?>" required>
                        <span class="form-text text-muted">Digite oPrazo de Pagamento</span>
                    </div>
                    <div class="col-lg-3">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="">Selecione o Status</option>
                                <option value="Pendente">Pendente</option>
                                <option value="Lancado">Lancado</option>
                                <option value="Vencido">Vencido</option>
                        </select>
                        <span class="form-text text-muted">Por favor insira o Status</span>
                    </div>
            </div>
                <div class="form-group row">
                <div class="col-lg-2">
                        <label for="numeroLicitacao-AutoComplete" >Numero da Licitacao:</label>
                        <input type="text" class="form-control" placeholder="Digite numero da licitacao" id="numeroLicitacao-AutoComplete" name="numeroLicitacao-AutoComplete" value="<?php echo $Sessao::retornaValorFormulario('numeroLicitacao-AutoComplete'); ?>" required>
                        <input type="text" id="numeroLicitacao" name="numeroLicitacao" required>
                        <span class="form-text text-muted">Digite o numero da licitacao</span>
                    </div>
                                        
                    <div class="col-lg-3">
                        <label for="representante">Representante</label>
                        <select class="form-control" id="representante" name="representante" required>
                                <option value="">Selecione o Representante</option>
                                <?php foreach ($viewVar['listarRepresentantes'] as $representante) : ?>
                                    <option value="<?php echo $representante->getCodRepresentante(); ?>" <?php echo ($Sessao::retornaValorFormulario('representante') == $representante->getCodRepresentante()) ? "selected" : ""; ?>>
                                        <?php echo $representante->getNomeRepresentante(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        <span class="form-text text-muted">Por favor insira o Representante</span>
                    </div>  
                    <div class="col-lg-2">
                    <label for="dataInicio" class="">Data de Inicio:</label>
                            <input type="date" class="form-control" placeholder="Digite a Data Inicial" id="dataInicio" name="dataInicio" value="<?php echo $Sessao::retornaValorFormulario('dataInicio'); ?>" required>
                            <span class="form-text text-muted">Digite a Data Inicial</span>
                    </div>
                    <div class="col-lg-2">
                    <label for="dataVencimento" class="">Data de Vencimento:</label>
                            <input type="date" class="form-control" placeholder="Digite a Data Vencimento" id="dataVencimento" name="dataVencimento" value="<?php echo $Sessao::retornaValorFormulario('dataVencimento'); ?>" required>
                            <span class="form-text text-muted">Digite a Data Vencimento</span>
                    </div>
                    <div class="col-lg-3">
                        <label for="valor" class="">Valor do Contrato:</label>
                        <input type="text" class="form-control" placeholder="Digite o valor do Contrato" id="valor" name="valor" value="<?php echo $Sessao::retornaValorFormulario('valor'); ?>" >
                        <span class="form-text text-muted">Digite o valor do Contrato</span>
                    </div>
                </div> 
                <div class="form-group row">
               
                    <div class="col-lg-7">
                        <label for="observacao" class="">Observacao do Contrato:</label>
                        <textarea class="form-control" rows="3" placeholder="Digite Observacao do Contrato" id="observacao" name="observacao" value="<?php echo $Sessao::retornaValorFormulario('observacao'); ?>" ></textarea>
                        <span class="form-text text-muted">Digite Observacao do Contrato</span>
                    </div>  
                    <div class="col-lg-3">
                        <label for="anexo" class="">Anexo:</label>
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