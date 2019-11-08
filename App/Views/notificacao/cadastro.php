<!--begin::Portlet-->
<div class="container">
    <br>
    <center><h3>Cadastro de Notificacoes</h3></center>
    <?php if ($Sessao::retornaErro()) { ?>
        <div class="alert alert-warning" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
                <?php echo $mensagem; ?> <br>
            <?php } ?>
        </div>
    <?php } ?>
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/notificacao/salvar" method="post" id="form_cadastro" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="instituicao" id="instituicao" value="<?php echo $_SESSION['inst_id']; ?>" required>
        <input type="hidden" class="form-control" name="usuario" id="usuario" value="<?php echo $_SESSION['id']; ?>" required>
        <input type="hidden" class="form-control" name="dataCadastro" id="dataCadastro" value="<?php echo $dataAtual; ?>" required>
        <div class="kt-portlet__body">            
            <div class="kt-portlet__body">
            
                <div class="form-group">
                    <label for="cadastroCliente" class="">CADASTRO DO CLIENTE</label>                    
                    <a href="http://<?php echo APP_HOST; ?>/edital/cadastro" id="cadastroCliente"  name="cadastroCliente" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-plus"></i>Novo Edital</a>
                      <div>    
                            <input type="text" name="editalCliente-Autocomplete" id="editalCliente-Autocomplete" class="form-control" required placeholder="Cliente - autocomplete"
                            value="<?php echo $viewVar['notificacao']->getNtf_clientelicitacao()->getRazaoSocial(); ?>" > 
                            <input type="text" id="cliente" name="cliente" 
                            value=<?php echo $viewVar['notificacao']->getNtf_clientelicitacao()->getCodCliente(); ?>>  
                        </div>
                        <span class="form-text text-muted">Por favor insira o cliente do Contrato</span>                       
                </div>
            <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="numeroNotificacao" >Numero da Notificacao:</label>
                        <input type="text" class="form-control" placeholder="Digite numero da Notificacao" id="numeroNotificacao" name="numeroNotificacao" value="<?php $Sessao::retornaValorFormulario('numeroNotificacao');?>" required>
                        <span class="form-text text-muted">Digite o numero da Notificacao</span>
                    </div>
                    <div class="col-lg-3">
                        <label for="numeroPedido" >Numero do Pedido</label>
                        <input type="text" class="form-control" placeholder="Digite o numero do pedido" id="numeroPedido" name="numeroPedido" value="<?php $Sessao::retornaValorFormulario('numeroPedido');?>" required>
                        <span class="form-text text-muted">Digite numero do pedido</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="garantia">Garantia</label>
                        <select class="form-control" name="garantia" id="garantia" required>
                            <option value="">Selecione o garantia</option>
                                <option value="Todas">Todas</option>
                                <option value="Parcial">Parcial</option>
                                <option value="Nenhuma">Nenhuma</option>
                        </select>
                        <span class="form-text text-muted">Por favor insira a garantia</span>
                    </div>
                    <div class="col-lg-3">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="">Selecione o Status</option>
                                <option value="Pendente">Pendente</option>
                                <option value="Deferido">Deferido</option>
                                <option value="Atendido">Atendido</option>
                        </select>
                        <span class="form-text text-muted">Por favor insira o Status</span>
                    </div>
                    <div class="col-lg-2">
                    <label for="prazoDefesa" class="">Prazo Defesa:</label>
                            <input type="text" class="form-control" placeholder="Digite o Prazo de Defesa" id="prazoDefesa" name="prazoDefesa" value="<?php echo $Sessao::retornaValorFormulario('prazoDefesa'); ?>" required>
                            <span class="form-text text-muted">Digite o Prazo de Defesa</span>
                    </div>   
            </div>
                <div class="form-group row">
                <div class="col-lg-3">
                        <label for="trocaMarca">Troca de Marca</label>
                        <select class="form-control" name="trocaMarca" id="trocaMarca" required>
                            <option value="">Selecione o trocaMarca</option>
                                <option value="Nao">Nao</option>
                                <option value="Com Carta">Com Carta</option>
                                <option value="Sem Carta">Sem Carta</option>
                        </select>
                        <span class="form-text text-muted">Por favor insira a troca de Marca</span>
                    </div>
                    <div class="col-lg-3">
                        <label for="valor" class="">Valor:</label>
                        <input type="text" class="form-control" placeholder="Digite o valor" id="valor" name="valor" value="<?php echo $Sessao::retornaValorFormulario('valor'); ?>" >
                        <span class="form-text text-muted">Digite o valor</span>
                    </div>
                <div class="col-lg-2">
                        <label for="editalLicitacao-AutoComplete" >Numero da Licitacao:</label>
                        <input type="text" title="pesquisa o edital para o cliente selecionado" class="form-control" disabled placeholder="Digite numero da licitacao" id="editalLicitacao-AutoComplete" name="editalLicitacao-AutoComplete" value="<?php echo $Sessao::retornaValorFormulario('numeroLicitacao'); ?>" required>
                        <input type="hidden" id="numeroLicitacao" name="numeroLicitacao" required>
                        <span class="form-text text-muted">Digite o numero da licitacao</span>
                    </div>
                                        
                    <div class="col-lg-4">
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
                            <a href="http://<?php echo APP_HOST; ?>/notificacao" class="btn btn-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
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