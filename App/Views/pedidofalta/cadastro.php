<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                
                <?php
                    if($Sessao::retornaErro()){ ?>
                    <div class="col-lg-12">
                        <div class="alert alert-danger" role="alert">
                            <?php $sessao =null;
                                foreach($sessao::retornaErro() as $key => $mensagem){ ?>
                                <?php echo $mensagem; ?> <br>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
			<div class=" col-lg-4 col-md-9 col-sm-12">
					<a href="" class="btn btn-success btn-pill" data-toggle="modal" data-target="#kt_select2_modal">cadastro de faltas</a>
				</div>
			</div>
		<!--begin::Modal-->
		<div class="modal fade" id="kt_select2_modal" role="dialog" aria-labelledby="" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
										  <h5 class="modal-title" id="">Cadastrar falta</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true" class="la la-remove"></span>
											</button>
										</div>
										<form class="kt-form kt-form--fit kt-form--label-right">
											<div class="modal-body">
												<div class="form-group row kt-margin-t-20">
													<label class="col-form-label col-lg-3 col-sm-12">Cliente:</label>
													<div class="col-lg-9 col-md-9 col-sm-12">
                                                        <select class="form-control m-select2" id="kt_select2_1_modal" name="param">
                                                            <option value="<?php echo $viewVar['pedidofalta']->getFaltaClienteCod()?>" 
                                                            ></option>
															
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-form-label col-lg-3 col-sm-12">Proposta:</label>
													<div class="col-lg-9 col-md-9 col-sm-12">
														<input class="form-control m-select2" id="" name="param">
															
													</div>
                                                </div>
												<div class="form-group row">
													<label class="col-form-label col-lg-3 col-sm-12">Produto:</label>
													<div class="col-lg-9 col-md-9 col-sm-12">
														<select class="form-control m-select2" id="kt_select2_3_modal" name="param" multiple="multiple">
															<optgroup label="Alaskan/Hawaiian Time Zone">
																<option value="AK" selected>Alaska</option>
																<option value="HI">Hawaii</option>
															</optgroup>
															<optgroup label="Pacific Time Zone">
																<option value="CA">California</option>
																<option value="NV" selected>Nevada</option>
																<option value="OR">Oregon</option>
																<option value="WA">Washington</option>
															</optgroup>
															<optgroup label="Mountain Time Zone">
																<option value="AZ">Arizona</option>
																<option value="CO">Colorado</option>
																<option value="ID">Idaho</option>
																<option value="MT" selected>Montana</option>
																<option value="NE">Nebraska</option>
																<option value="NM">New Mexico</option>
																<option value="ND">North Dakota</option>
																<option value="UT">Utah</option>
																<option value="WY">Wyoming</option>
															</optgroup>
															<optgroup label="Central Time Zone">
																<option value="AL">Alabama</option>
																<option value="AR">Arkansas</option>
																<option value="IL">Illinois</option>
																<option value="IA">Iowa</option>
																<option value="KS">Kansas</option>
																<option value="KY">Kentucky</option>
																<option value="LA">Louisiana</option>
																<option value="MN">Minnesota</option>
																<option value="MS">Mississippi</option>
																<option value="MO">Missouri</option>
																<option value="OK">Oklahoma</option>
																<option value="SD">South Dakota</option>
																<option value="TX">Texas</option>
																<option value="TN">Tennessee</option>
																<option value="WI">Wisconsin</option>
															</optgroup>
															<optgroup label="Eastern Time Zone">
																<option value="CT">Connecticut</option>
																<option value="DE">Delaware</option>
																<option value="FL">Florida</option>
																<option value="GA">Georgia</option>
																<option value="IN">Indiana</option>
																<option value="ME">Maine</option>
																<option value="MD">Maryland</option>
																<option value="MA">Massachusetts</option>
																<option value="MI">Michigan</option>
																<option value="NH">New Hampshire</option>
																<option value="NJ">New Jersey</option>
																<option value="NY">New York</option>
																<option value="NC">North Carolina</option>
																<option value="OH">Ohio</option>
																<option value="PA">Pennsylvania</option>
																<option value="RI">Rhode Island</option>
																<option value="SC">South Carolina</option>
																<option value="VT">Vermont</option>
																<option value="VA">Virginia</option>
																<option value="WV">West Virginia</option>
															</optgroup>
														</select>
													</div>
												</div>
												<div class="form-group row kt-margin-b-20">
													<label class="col-form-label col-lg-3 col-sm-12">AFM:</label>
													<div class="col-lg-9 col-md-9 col-sm-12">
														<input class="form-control m-select2" id="" name="param">
													</div>
												</div>
											</div>
										  <div class="modal-footer">
									   <button type="button" class="btn btn-brand" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-secondary">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
        <!--end::Modal-->
               <form class="form-horizontal" id="form_cadastro_vaga" method="POST" action="http://<?php echo APP_HOST; ?>/pedidofalta/cadastro">
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
                                            <input type="text" name="proposta" class="form-control" placeholder="Proposta"
                                                   required value= <?php
                                                echo $viewVar['pedidofalta']->getProposta(); ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Data Cadastro</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input right">
                                            <input type="text" name="proposta" class="form-control" placeholder="Data Cadastro"
                                                   required value= <?php
                                                echo $viewVar['pedidofalta']->getProposta(); ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Cliente</label>
                                    <div class="col-lg-9">
                                        <div>
                                            <input type="text" name="autocompleteEmpresa" id="autocomplete-cliente" class="form-control" required placeholder="Cliente - autocomplete"
                                                   value=<?php echo $viewVar[''] ?>>

                                            <input type="hidden" id="cliente" name="cliente"
                                                   value= >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Observação</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input right">
                                            <textarea maxlength="350" class="form-control spinner" placeholder="Descrição da Vaga" rows="5" name="descricao" > </textarea>
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
                                <div id="produto-selecionadas">
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
                                                            <?php echo $produto->getProduto(); ?>
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
    <div id="modal-tecnologias" class="modal fade" role="dialog">
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
</div>