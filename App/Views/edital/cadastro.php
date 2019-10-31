<!--begin::Portlet-->
<div class="container">
    <br>
    <center><h3>Cadastro de Edital</h3></center>
    <?php if ($Sessao::retornaErro()) { ?>
        <div class="alert alert-warning" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
                <?php echo $mensagem; ?> <br>
            <?php } ?>
        </div>
    <?php } ?>
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/edital/salvar" method="post" id="form_cadastro" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao" value="<?php echo $_SESSION['inst_id']; ?>" required>
        <input type="hidden" class="form-control" name="edtUsuario" id="edtUsuario" value="<?php echo $_SESSION['id']; ?>" required>
            <input type="hidden" class="form-control" name="dataCadastro" id="dataCadastro" value="<?php echo $dataAtual; ?>" required>
        <div class="kt-portlet__body">
            <input type="hidden" class="form-control" name="idCliente" id="idCliente" required>
            <div class="kt-portlet__body">
            
                <div class="form-group">
                    <label for="cadastroCliente" class="">CADASTRO DO CLIENTE</label>                    
                    <a href="http://<?php echo APP_HOST; ?>/cliente/cadastro" id="cadastroCliente"  name="cadastroCliente" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-plus"></i>Novo Cliente</a>
                      <div>    
                        <input type="text" name="clienteLicitacaoAutocomplete" id="clienteLicitacao-autocomplete" class="form-control" required placeholder="Cliente - autocomplete"
                        value="<?php echo $viewVar['edital']->getClienteLicitacao()->getRazaoSocial(); ?>" > 
                        
                        <input type="hidden" id="cliente" name="cliente" 
                        value="<?php echo $viewVar['edital']->getClienteLicitacao()->getCodCliente(); ?>">  
                    </div>
                      <span class="form-text text-muted">Por favor insira o cliente do Contrato</span>

                       
            </div>
            
            <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="modalidade">Modalidade</label>
                            <select class="form-control" name="modalidade" id="modalidade" required>
                                <option value="">Selecione a Modalidade</option>
                                <option value="Eletronico">Eletronico</option>
                                <option value="Presencial">Presencial</option>
                                <option value="Concorrencia">Concorrencia</option>
                                <option value="Convite">Convite</option>
                            </select>
                            <span class="form-text text-muted">Por favor insira o Modalidade</span>
                    </div>
                    <div class="col-lg-3">
                        <label for="numeroLicitacao" >Numero da Licitacao:</label>
                        <input type="text" class="form-control" placeholder="Digite numero da licitacao"  id="numeroLicitacao" name="numeroLicitacao" value="<?php echo $Sessao::retornaValorFormulario('numeroLicitacao'); ?>" required>
                        <span class="form-text text-muted">Digite o numero da licitacao</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="garantia">Garantia</label>
                        <select class="form-control" name="garantia" required>
                            <option value="">Selecione Garantia</option>
                                <option value="Sim">SIM</option>
                                <option value="Nao">NÃO</option>
                        </select>
                        <span class="form-text text-muted">Por favor Garantia</span>
                    </div>  
                    <div class="col-lg-2">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="">Selecione o Status</option>
                            <option value="Em Analise">Em Analise</option>
                                <option value="Ganha">Ganha</option>
                                <option value="Concorrendo">Concorrendo</option>
                                <option value="Em Montagem">Em Montagem</option>
                                <option value="Perdida">Perdida</option>
                        </select>
                        <span class="form-text text-muted">Por favor insira o Status</span>
                    </div>
                    <div class="col-lg-3">
                        <label for="codRepresentante">Representante</label>
                        <select class="form-control" id="codRepresentante" name="codRepresentante" required>
                                <option value="">Selecione o Representante</option>
                                <?php foreach ($viewVar['listarRepresentantes'] as $representante) : ?>
                                    <option value="<?php echo $representante->getCodRepresentante(); ?>" <?php echo ($Sessao::retornaValorFormulario('codRepresentante') == $representante->getCodRepresentante()) ? "selected" : ""; ?>>
                                        <?php echo $representante->getNomeRepresentante(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        <span class="form-text text-muted">Por favor insira o Representante</span>
                    </div>   
                </div>
                <div class="form-group row"> 
                    <div class="col-lg-2">
                            <label for="dataAbertura" class="">Data de Abertura:</label>
                            <input type="date" class="form-control" placeholder="Digite a Data de Abertura" id="dataAbertura" name="dataAbertura" value="<?php echo $Sessao::retornaValorFormulario('dataAbertura'); ?>" required>
                            <span class="form-text text-muted">Digite a Hora</span>
                    </div>
                    <div class="col-lg-2">
                            <label for="hora" class="">Hora:</label>
                            <input type="time" class="form-control" placeholder="Digite a Hora de Abertura" id="hora" name="hora" value="<?php echo $Sessao::retornaValorFormulario('hora'); ?>" required>
                            <span class="form-text text-muted">Digite a Hora de Abertura</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="valor" class="">Valor da Proposta:</label>
                        <input type="text" class="form-control" placeholder="Digite o valor da Proposta" id="valor" name="valor" value="<?php echo $Sessao::retornaValorFormulario('valor'); ?>" >
                        <span class="form-text text-muted">Digite o valor da Proposta</span>
                    </div>
                    <div class="col-lg-2">
                            <label for="dataResultado" class="">Data de Resultado:</label>
                            <input type="date" class="form-control" placeholder="Digite a Data de Resultado" id="dataResultado" name="dataResultado" value="<?php echo $Sessao::retornaValorFormulario('dataResultado'); ?>" >
                            <span class="form-text text-muted">Digite Resultado</span>
                    </div>
                    <div class="col-lg-2">
                                <label for="tipo">Tipo</label>
                                <select class="form-control" name="tipo" required>
                                    <option value="">Selecione o Tipo</option>
                                        <option value="Por Item" >Por Item</option>
                                        <option value="Por Lote" >Por Lote</option>>
                                </select>
                                <span class="form-text text-muted">Por favor insira o Tipo</span>
                    </div>
                    <div class="col-lg-2">
                        <label for="proposta" class="">Proposta:</label>
                        <input type="text" class="form-control" placeholder="Digite a Proposta" id="proposta" name="proposta" value="<?php echo $Sessao::retornaValorFormulario('proposta'); ?>" >
                        <span class="form-text text-muted">Digite o numero da Proposta</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="anexo" class="">Anexo:</label>
                        <input type="file" name="anexo" id="anexo" value="<?php echo $Sessao::retornaValorFormulario('anexo'); ?>">
                        <span class="form-text text-muted">Selecione o arquivo</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="observacao" class="">Observacao do Edital:</label>
                        <textarea class="form-control" rows="3" placeholder="Digite Observacao do Edital" id="observacao" name="observacao" value="<?php echo $Sessao::retornaValorFormulario('observacao'); ?>" ></textarea>
                        <span class="form-text text-muted">Digite Observacao do Edital</span>
                    </div>
                    <div class="col-lg-6">
                        <label for="analise" class="">Analise do Edital:</label>
                        <textarea class="form-control" rows="3" placeholder="Digite Analise do Edital" id="analise" name="analise" value="<?php echo $Sessao::retornaValorFormulario('analise'); ?>" ></textarea>
                        <span class="form-text text-muted">Digite Analise do Edital</span>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-8">
                            <button type="submit" class="btn btn-primary btn-elevate btn-pill btn-elevate-air">Salvar</button>
                            <a href="http://<?php echo APP_HOST; ?>/edital" class="btn btn-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
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