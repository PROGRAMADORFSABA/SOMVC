<!-- begin:: Content -->

<div class="kt-portlet">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                CADASTRO DE FALTA
            </h3>
        </div>
    </div>

    <!--begin::Form-->
    <form class="kt-form kt-form--label-right"  method="POST" action="http://<?php echo APP_HOST; ?>/pedidofalta/salvar" >
        <div class="kt-portlet__body">
            <section class="panel panel-default">
            <div class="form-group row form-group-marginless kt-margin-t-20">
                <label class="col-lg-1 col-form-label">Cliente:</label>
                <div class="col-lg-3">
                    <input type="text" name="autocompleteCliente" id="autocomplete-clientefalta" class="form-control" placeholder="Cliente" value=<?php echo $viewVar['pedidofalta']->getFkCliente()->getNomeFantasia();?>>
                    <input type="hidden" id="cliente" name="cliente" value=<?php echo $viewVar['pedidofalta']->getFkCLiente()->getCodCliente()?> >
                    <span class="form-text text-muted">Pro favor digite um nomde de Cliente</span>
                </div>
                <label class="col-lg-1 col-form-label">Proposta:</label>
                <div class="col-lg-3">
                    <input type="text" class="form-control" placeholder="Proposta" required value="<?php echo $Sessao::retornaValorFormulario('proposta'); ?>">
                    <span class="form-text text-muted">Por favor, digite o Nº da proposta</span>
                </div>
                <label class="col-lg-1 col-form-label">AFM:</label>
                <div class="col-lg-3">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="flaticon2-delivery-package"></i></span></div>
                        <input type="text" class="form-control" id="afm" name="afm" placeholder="AFM"  required value= "<?php echo $Sessao::retornaValorFormulario('afm'); ?>">
                    </div>
                    <span class="form-text text-muted">Por favor, digite a AFM</span>
                </div>
            </div>
            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
            <div class="form-group row form-group-marginless">
                <label class="col-lg-1 col-form-label">Status:</label>
                <div class="col-lg-3">
                    <select type="email" class="form-control" placeholder="Status"></select>
                    <span class="form-text text-muted">Por favor, escolha o status da falta.</span>
                </div>
                <label class="col-lg-1 col-form-label">Observação:</label>
                <div class="col-lg-3">
                    <div class="kt-input-icon">
                        <textarea maxlength="350" type="text" class="form-control spinner" placeholder="Observacao da falta" rows="5" name="observacao" value="<?php echo $Sessao::retornaValorFormulario('observacao'); ?>"></textarea>
                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-info-circle"></i></span>
                    </div>
                    <span class="form-text text-muted">Please enter fax</span>
                </div>
                <label class="col-lg-1 col-form-label">Address:</label>
                <div class="col-lg-3">
                    <div class="kt-input-icon">
                        <input type="text" class="form-control" placeholder="Enter your address">
                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-map-marker"></i></span></span>
                    </div>
                    <span class="form-text text-muted">Please enter your address</span>
                </div>
            </div>
            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
            <div class="form-group row">
                <label class="col-lg-1 col-form-label">Produto:</label>
                <div class="col-lg-3">
                    <div class="kt-input-icon">
                        <input type="text" id="autocomplete-produto" class="form-control" placeholder="Auto - complete Produto">
                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="fa fa-plus-circle"></i></span></span>
                    </div>
                    <span class="form-text text-muted">Por favor, digite o nome do produto.</span>
                    <table class="table table-striped">
                        <thead>
                        <th>Produto</th>
                        <th>Remover</th>
                        </thead>
                        <tbody id="editar-tabela-produtos">
                        <?php
                            if($viewVar['pedidofalta']->getFk_Produto()) {
                                foreach ($viewVar['pedidofalta']->getFk_Produto() as $produto) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $produto->getProNome(); ?>
                                            <input type="hidden" name="produtos[]" value=<?php echo $produto->getProCodigo(); ?> >
                                        </td>
                                        <td><button class="btn btn-danger btn-sm" type="button" onClick="app.removeProduto(this,<?php echo $produto->getProCodigo(); ?>)">remover</button></td>
                                    </tr>
                                    <?php
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
                <label class="col-lg-1 col-form-label">Tipo de Licitação:</label>
                <div class="col-lg-3">
                    <div class="kt-radio-inline">
                        <label class="kt-radio kt-radio--solid">
                            <input type="radio" name="example_2" checked value="2"> Presencial
                            <span></span>
                        </label>
                        <label class="kt-radio kt-radio--solid">
                            <input type="radio" name="example_2" value="2"> Eletronico
                            <span></span>
                        </label>
                    </div>
                    <span class="form-text text-muted">Por favor, selecione o tipo de pregão.</span>
                </div>
            </div>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-5"></div>
                    <div class="col-lg-7">
                        <button class="btn btn-brand">Enviar</button>
                        <a href="http://<?php echo APP_HOST; ?>/pedidofalta/index" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="modal-produtos" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">ATENÇÃO</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-block alert-danger fade in" id="div-modal">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </section>
    </section>

    <!--end::Form-->
</div>

<!--end::Portlet-->
</div>
</div>
</div>

<!-- end:: Content -->
</div>