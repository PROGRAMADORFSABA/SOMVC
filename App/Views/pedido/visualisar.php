<!--begin::Portlet-->
<div class="container">
    <br>
    <center> <h1>Visualização de pedido</h1></center>
    <?php if ($Sessao::retornaMensagem()) { ?>
				<div class="alert alert-danger" role="alert">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<?php echo $Sessao::retornaMensagem(); ?>
				</div>
    <?php } ?>
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/email/emailPedido" method="post" id="form_cadastro" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="codControle" id="codControle" value="<?php echo $viewVar['pedido']->getCodControle(); ?>" required >
        <input type="hidden" class="form-control" name="dataCadastro" id="dataCadastro"  value="<?php echo $viewVar['pedido']->getDataCadastro()->format('d/m/Y H:m:s'); ?>" required >
        <input type="hidden" class="form-control" name="usuario" id="usuario" value="<?php echo $_SESSION['id']; ?>" required>
        <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao" value="<?php echo $_SESSION['inst_id']; ?>" required>
        <input type="hidden" class="form-control" name="dataAlteracao" id="dataAlteracao" readonly="readonly" value="<?php echo $dataAtual; ?>" required>
        <div class="kt-portlet__body">
            <div class="kt-portlet__body">
                <div class="form-group">
                        <label for="cadastroCliente" class="">Razao Social</label>                          
                            <input type="text" name="clienteLicitaca" id="clienteLicitacao" class="form-control" required placeholder="Cliente - autocomplete"
                            value="<?php echo $viewVar['pedido']->getClienteLicitacao()->getRazaoSocial(); ?>" readonly > 
                            
                            <input type="hidden" id="cliente" name="cliente" 
                            value="<?php echo $viewVar['pedido']->getClienteLicitacao()->getCodCliente(); ?>">                          
                        <span class="form-text text-muted">cliente do Pedido</span>                       
                </div> 
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label>Numero da Licitacao:</label>
                        <input type="text" class="form-control" placeholder="numero da licitacao" id="numeroPregao" name="numeroPregao" value="<?php echo $viewVar['pedido']->getNumeroLicitacao(); ?>" readonly>
                        <span class="form-text text-muted">numero da licitacao</span>
                    </div>
                    <div class="col-lg-4">
                        <label class="">Numero do Pedido:</label>
                        <input type="text" class="form-control" placeholder="numero do pedido" id="numeroAf" name="numeroAf" value="<?php echo $viewVar['pedido']->getNumeroAf(); ?>" readonly>
                        <span class="form-text text-muted">numero do pedido</span>
                    </div>
                    <div class="col-lg-4">
                        <label class="">Valor do pedido:</label>
                        <input type="text" class="form-control" placeholder="valor do pedido" id="valorPedido" name="valorPedido" value="<?php echo $viewVar['pedido']->getValorPedido(); ?>" readonly>
                        <span class="form-text text-muted">valor do pedido</span> 
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label for="representante">Representante</label>
                                    <input type="text"  name="representante" id="representante" class="form-control"  value=" <?php echo $viewVar['pedido']->getRepresentante()->getNomeRepresentante(); ?> " readonly >
                            <span class="form-text text-muted">Representante do Pedido</span>                        
                    </div>                    
                    <div class="col-lg-4">
                        <label for="status">Status</label>
                        <input type="text" name="status" id="status" class="form-control" required placeholder="Status"
                            value="<?php echo $viewVar['pedido']->getStatus()->getNome(); ?>" readonly > 
                            <span class="form-text text-muted">Status do Pedido</span>                        
                    </div>
                    <div class="col-lg-4">
                        <label class="">Anexo:</label>
                            <input type="hidden" class="form-control" id="anexo"  readonly="readonly" name="anexo" value="<?php echo $viewVar['pedido']->getAnexo(); ?>" readonly>
                            <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $viewVar['pedido']->getAnexo(); ?>" 
                            target="_blank" title="Click para Visualizar Anexo" class="btn btn-info btn-sm"><i class="la la-chain"></i> Anexo</a>
                            <span class="form-text text-muted">Selecione o arquivo</span>                       
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label class="">Observacao do Pedido:</label>
                        <textarea class="form-control" rows="4" placeholder="Observacao do Pedido" id="observacao" name="observacao" readonly><?php echo $viewVar['pedido']->getObservacao(); ?></textarea>
                        <span class="form-text text-muted">Observacao do Pedido</span>
                    </div>
                    <div class="col-lg-6">
                        <label class="">Mensagem do usuario:</label>
                        <textarea class="form-control" rows="4" placeholder="Mensagem do usuario" id="mensagem" name="mensagem" ></textarea>
                        <span class="form-text text-muted">Mensagem do usuario</span>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <input type="checkbox" id="enviarEmail" name="enviarEmail" value="1" checked>
                    <label>Deseja enviar Email?</label>
                    <input type="text" class="form-control" title="endereco de e-mail" placeholder="email separado por virgula" id="email" name="email" disabled value="vendas2@fabmed.com.br">
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-8">
                        <button type="submit" class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">Enviar Email</button>
                            <a href="http://<?php echo APP_HOST; ?>/pedido" class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                        </div>
                    </div>
                    <br>
                        <h5 class="" name="informacao" id="informacao" >
                        <p><strong><em>Cadastrado em: <?php echo $viewVar['pedido']->getDataCadastro()->format('d/m/Y H:m:s'); ?>
                         - Ultima Alteracao em: <?php echo $viewVar['pedido']->getDataAlteracao()->format('d/m/Y H:m:s')  ?>
                        Por: <?php echo $viewVar['pedido']->getUsuario()->getNome() ; ?>
                            </em></strong></p></h5>
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