<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                
                <?php
                    if($Sessao::retornaErro()){ ?>
                    <div class="col-lg-12">
                        <div class="alert alert-danger" role="alert">
                            <?php $Sessao =null;
                                foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                                <?php echo $mensagem; ?> <br>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
			<div class=" col-lg-4 col-md-9 col-sm-12">
				
				</div>
			</div>
		<!--begin::Modal-->
		<div class="modal fade" id="kt_select2_modal" role="dialog" aria-labelledby="" aria-hidden="true">
				
				</div>
        <!--end::Modal-->
               <form class="form-horizontal" id="form_cadastro_produto" method="POST" action="http://<?php echo APP_HOST; ?>/pedidofalta/salvar">
                    <div class="col-lg-8">
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                Cadastro de Falta
                            </header>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Proposta</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input right">
                                            <input type="text" name="proposta" class="form-control" placeholder="Proposta"
                                                   required value= <?php
                                                echo $viewVar['pedidofalta']->getProposta(); ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">AFM</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input right">
                                            <input type="text" name="afm" class="form-control" placeholder="Proposta"
                                                   required value= <?php
                                                echo $viewVar['pedidofalta']->getProposta(); ?>>
                                        </div>
                                    </div>
                                </div>
                                <!--div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Data Cadastro</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input right">
                                            <input type="text" name="proposta" class="form-control" placeholder="Data Cadastro"
                                                   required value= >
                                                   
                                        </div>
                                    </div>
                                </div-->
                                <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Cliente</label>
                                    <div class="col-lg-9">
                                        <div>
                                            <input type="text" name="autocompleteCliente" id="clienteLicitacao-autocomplete" class="form-control" required placeholder="Cliente - autocomplete"
                                                   value=<?php echo $viewVar['pedidofalta']->getFkCliente()->getNomeFantasia();?> >

                                            <input type="hidden" id="cliente" name="cliente"
                                                   value=<?php echo $viewVar['pedidofalta']->getFkCLiente()->getCodCliente()?> >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Observação</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input right">
                                            <textarea maxlength="350" class="form-control spinner" placeholder="Observacao da Vaga" rows="5" name="observacao"><?php echo $viewVar['pedidofalta']->getObservacao()?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-12">
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                Produtos
                            </header>
                            <div class="panel-body">
                                <div id="produto-selecionados">
                                    <div class="form-group">
                                        <label  class="col-lg-3 col-sm-3 control-label">Adicionar</label>
                                        <div class="col-lg-9">
                                            <div class="iconic-input right">
                                                <input type="text" id="autocomplete-produto" class="form-control " placeholder="Produto">
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped">
                                        <thead>
                                        <th>Produto</th>
                                        <th>Remover</th>
                                        </thead>
                                        <tbody id="editar-tabela-produtos">
                                        <?php
                                            if($viewVar['pedidofalta']->getFkProduto()) {
                                                foreach ($viewVar['pedidofalta']->getFkProduto() as $produto) {
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
                        </section>
                    </div>
                    <div class="col-md-12">
                        <div align="right">
                            <a class="btn btn-success" href="http://<?php echo APP_HOST; ?>/pedidofalta/index">Voltar</a>
                            <button class="btn btn-info">Cadastrar</button>
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </section>
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