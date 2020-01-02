<!--begin::Portlet-->
<div class="container">
    <br>
    <center><h3>Alteracao de Edital</h3></center>
    <?php if ($Sessao::retornaErro()) { ?>
        <div class="alert alert-warning" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
                <?php echo $mensagem; ?> <br>
            <?php } ?>
        </div>
    <?php } ?>
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/edital/atualizar" method="post" id="form_cadastro" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao" value="<?php echo $_SESSION['inst_id']; ?>" required>
        <input type="hidden" class="form-control" id="codigo" name="codigo" value="<?php echo $viewVar['edital']->getEdtId(); ?>"  required>
        <input type="hidden" class="form-control" name="edtUsuario" id="edtUsuario" value="<?php echo $_SESSION['id']; ?>" required>
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
                        <input type="text" id="cliente" name="cliente" value=<?php echo $viewVar['edital']->getClienteLicitacao()->getCodCliente(); ?>>  

                      <span class="form-text text-muted">Por favor insira o cliente do Edital</span>  
                      </div>                    
                </div>            
            <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="modalidade">Modalidade</label>
                            <select class="form-control" name="modalidade" id="modalidade" required>
                                <option value="">Selecione a Modalidade</option>
                                <option value="<?php echo $viewVar['edital']->getEdtModalidade(); ?>" <?php echo ($viewVar['edital']->getEdtModalidade() == $viewVar['edital']->getEdtModalidade()) ? "selected" : ""; ?>>
                                    <?php echo $viewVar['edital']->getEdtModalidade(); ?> </option>
                                <option value="Eletronico">Eletronico</option>
                                <option value="Presencial">Presencial</option>
                                <option value="Concorrencia">Concorrencia</option>
                                <option value="Convite">Convite</option>
                            </select>
                            <span class="form-text text-muted">Por favor insira o Modalidade</span>
                    </div>
                    <div class="col-lg-3">
                        <label for="numeroLicitacao" >Numero da Licitacao:</label>
                        <input type="text" class="form-control" placeholder="Digite numero da licitacao" id="numeroLicitacao" name="numeroLicitacao" value="<?php echo $viewVar['edital']->getEdtNumero(); ?>" required>
                        <span class="form-text text-muted">Digite o numero da licitacao</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="garantia">Garantia</label>
                        <select class="form-control" name="garantia" required>
                            <option value="">Selecione Garantia</option>
                            <option value="<?php echo $viewVar['edital']->getEdtGarantia(); ?>" <?php echo ($viewVar['edital']->getEdtGarantia() == $viewVar['edital']->getEdtGarantia()) ? "selected" : ""; ?>>
                                    <?php echo $viewVar['edital']->getEdtGarantia(); ?> </option>
                                <option value="Sim">SIM</option>
                                <option value="Nao">NÃO</option>
                        </select>
                        <span class="form-text text-muted">Por favor Garantia</span>
                    </div>  
                   
                    <div class="col-lg-2">
                        <label for="status">status</label>
                        <select class="form-control" id="status" name="status" required>
                                <option value="">Selecione o status</option>
                                <?php foreach ($viewVar['listarEditalStatus'] as $editalStatus) : ?>
                                    <option value="<?php echo $editalStatus->getStEdtId(); ?>" <?php echo ($viewVar['edital']->getEditalStatus()->getStEdtId() == $editalStatus->getStEdtId()) ? "selected" : ""; ?>>
                                        <?php echo $editalStatus->getStEdtNome(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        <span class="form-text text-muted">Por favor insira o status</span>
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
                            <label for="dataAbertura" class="">Data de Abertura:</label>
                            <input type="date" class="form-control" placeholder="Digite a Data de Abertura" id="dataAbertura" name="dataAbertura" value="<?php echo $viewVar['edital']->getEdtDataAbertura()->format('Y-m-d'); ?>" required>
                            <span class="form-text text-muted">Digite a Hora</span>
                    </div>
                    <div class="col-lg-2">
                            <label for="hora" class="">Hora:</label>
                            <input type="time" class="form-control" placeholder="Digite a Hora de Abertura" id="hora" name="hora" value="<?php echo $viewVar['edital']->getEdtHora()->format('h:m:s'); ?>"  required>
                            <span class="form-text text-muted">Digite a Hora de Abertura</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="valor" class="">Valor da Proposta:</label>
                        <input type="text" class="form-control" placeholder="Digite o valor da Proposta" id="valor" name="valor" value="<?php echo $viewVar['edital']->getEdtValor(); ?>">
                        <span class="form-text text-muted">Digite o valor da Proposta</span>
                    </div>
                    <div class="col-lg-2">
                            <label for="dataResultado" class="">Data de Resultado:</label>
                            <input type="date" class="form-control" placeholder="Digite a Data de Resultado" id="dataResultado" name="dataResultado" value="<?php echo $viewVar['edital']->getEdtDataResultado()->format('Y-m-d'); ?>" >
                            <span class="form-text text-muted">Digite Resultado</span>
                    </div>
                    <div class="col-lg-2">
                                <label for="tipo">Tipo</label>
                                <select class="form-control" name="tipo" required>
                                    <option value="">Selecione o Tipo</option>
                                    <option value="<?php echo $viewVar['edital']->getEdtTipo(); ?>" <?php echo ($viewVar['edital']->getEdtTipo() == $viewVar['edital']->getEdtTipo()) ? "selected" : ""; ?>>
                                    <?php echo $viewVar['edital']->getEdtTipo(); ?> </option>
                                        <option value="Por Item" >Por Item</option>
                                        <option value="Por Lote" >Por Lote</option>>
                                </select>
                                <span class="form-text text-muted">Por favor insira o Tipo</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="proposta" class="">Proposta:</label>
                        <input type="text" class="form-control" placeholder="Digite a Proposta" id="proposta" name="proposta" value="<?php echo $viewVar['edital']->getEdtProposta(); ?>">
                        <span class="form-text text-muted">Digite o numero da Proposta</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="anexo" class="">Anexo:</label>
                        <input type="file" name="anexo" id="anexo" value="<?php echo $Sessao::retornaValorFormulario('anexo'); ?>">
                        <input type="hidden" name="anexoAlt" id="anexoAlt" value="<?php echo $viewVar['edital']->getEdtAnexo(); ?>">
                        <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $viewVar['edital']->getEdtAnexo(); ?>" 
                        target="_blank" title="Click para Visualizar Anexo" class="btn btn-info btn-sm"><i class="la la-chain"></i> Anexo</a>
                        <span class="form-text text-muted">Selecione o arquivo</span>
                    </div>
                </div>                
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="observacao" class="">Observacao do Edital:</label>
                        <textarea class="form-control" rows="3" placeholder="Digite Observacao do Edital" id="observacao" name="observacao" ><?php echo $viewVar['edital']->getEdtObservacao(); ?></textarea>
                        <span class="form-text text-muted">Digite Observacao do Edital</span>
                    </div>
                    <div class="col-lg-6">
                        <label for="analise" class="">Analise do Edital:</label>
                        <textarea class="form-control" rows="3" placeholder="Digite Analise do Edital" id="analise" name="analise"  ><?php echo $viewVar['edital']->getEdtAnalise(); ?></textarea>
                        <span class="form-text text-muted">Digite Analise do Edital</span>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12">
                    <input type="checkbox" id="enviarEmail" name="enviarEmail" value="1" checked>
                    <label>Deseja enviar Email?</label>
                    <input type="text" class="form-control" title="Digite o endereco de e-mail" placeholder="email separado por virgula" id="email" name="email" disabled value="<?php echo $Sessao::retornaValorFormulario('email'); ?>">
                </div>
            </div>           
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-8">
                            <button type="submit" class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">Salvar</button>
                            <a href="http://<?php echo APP_HOST; ?>/edital" class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                        </div>
                    </div>
                    <br>
                    <h5  class="" name="informacao" id="informacao" >
                        <p><strong><em>Cadastrado em: <?php echo $viewVar['edital']->getEdtDataCadastro()->format('d/m/Y H:m:s'); ?>
                         - Ultima Alteracao em: <?php echo $viewVar['edital']->getEdtDataAlteracao()->format('d/m/Y H:m:s')  ?>
                        Por: <?php echo $viewVar['edital']->getUsuario()->getNome() ; ?>
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