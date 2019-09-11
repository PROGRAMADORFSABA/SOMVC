						<!-- begin:: Content -->
						<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

							<!--begin::Portlet-->
							<div class="kt-portlet">
								<div class="kt-portlet__head">
									<div class="kt-portlet__head-label">
										<h3 class="kt-portlet__head-title">
											Bootstrap Switch Examples
										</h3>
									</div>
								</div>

								<!--begin::Form-->
								<form class="kt-form kt-form--label-right">
									<div class="kt-portlet__body">
										<div class="form-group row">
											<label class="col-form-label col-lg-3 col-sm-12">Basic Example</label>
											<div class="col-lg-9 col-md-9 col-sm-12">
												<input data-switch="true" type="checkbox" checked="checked" id="kt_switch_1">
												<input data-switch="true" type="checkbox" id="kt_switch_1">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-3 col-sm-12">State Colors</label>
											<div class="col-lg-9 col-md-9 col-sm-12">
												<input data-switch="true" type="checkbox" checked="checked" data-on-color="success" data-off-color="warning">
												<input data-switch="true" type="checkbox" checked="checked" data-on-color="brand">
												<input data-switch="true" type="checkbox" checked="checked" data-on-color="danger">
												<input data-switch="true" type="checkbox" checked="checked" data-on-color="info">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-3 col-sm-12">Custom Label</label>
											<div class="col-lg-9 col-md-9 col-sm-12">
												<input data-switch="true" type="checkbox" checked="checked" data-on-text="True" data-handle-width="50" data-off-text="False" data-on-color="success">
												<input data-switch="true" type="checkbox" checked="checked" data-on-text="1" data-handle-width="30" data-off-text="0" data-on-color="info">
												<input data-switch="true" type="checkbox" checked="checked" data-on-text="Enabled" data-handle-width="70" data-off-text="Disabled" data-on-color="brand">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-3 col-sm-12">Disabled State</label>
											<div class="col-lg-9 col-md-9 col-sm-12">
												<input data-switch="true" type="checkbox" checked="checked" disabled>
												<input data-switch="true" type="checkbox" disabled>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-3 col-sm-12">Sizing</label>
											<div class="col-lg-9 col-md-9 col-sm-12">
												<input data-switch="true" data-size="small" type="checkbox" checked="checked">
												<input data-switch="true" type="checkbox" checked="checked">
												<input data-switch="true" data-size="large" type="checkbox" checked="checked">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-lg-3 col-sm-12">Modal Demos</label>
											<div class="col-lg-9 col-md-9 col-sm-12">
												<a href="" class="btn btn-outline-danger success btn-pill" data-toggle="modal" data-target="#kt_switch_modal">Launch switches on modal</a>
											</div>
										</div>
									</div>
									<div class="kt-portlet__foot">
										<div class="kt-form__actions">
											<div class="row">
												<div class="col-lg-9 ml-lg-auto">
													<button type="reset" class="btn btn-brand">Submit</button>
													<button type="reset" class="btn btn-secondary">Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</form>

								<!--end::Form-->
							</div>

							<!--end::Portlet-->

							<!--begin::Modal-->
							<div class="modal fade" id="kt_switch_modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="">Bootstrap Switch Examples</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true" class="la la-remove"></span>
											</button>
										</div>
										<form class="kt-form kt-form--fit kt-form--label-right">
											<div class="modal-body">
												<div class="form-group row kt-margin-t-20">
													<label class="col-form-label col-lg-3 col-sm-12">Basic Example</label>
													<div class="col-lg-9 col-md-9 col-sm-12">
														<input data-switch="true" type="checkbox" checked="checked" id="kt_switch_1">
														<input data-switch="true" type="checkbox" id="kt_switch_1">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-form-label col-lg-3 col-sm-12">State Colors</label>
													<div class="col-lg-9 col-md-9 col-sm-12">
														<input data-switch="true" type="checkbox" checked="checked" data-on-color="success" data-off-color="warning">
														<input data-switch="true" type="checkbox" checked="checked" data-on-color="brand">
														<input data-switch="true" type="checkbox" checked="checked" data-on-color="danger">
														<input data-switch="true" type="checkbox" checked="checked" data-on-color="info">
													</div>
												</div>
												<div class="form-group row">
													<label class="col-form-label col-lg-3 col-sm-12">Custom Label</label>
													<div class="col-lg-9 col-md-9 col-sm-12">
														<input data-switch="true" type="checkbox" checked="checked" data-on-text="True" data-off-text="False" data-on-color="success">
														<input data-switch="true" type="checkbox" checked="checked" data-on-text="1" data-off-text="0" data-on-color="info">
														<input data-switch="true" type="checkbox" checked="checked" data-on-text="Enabled" data-off-text="Disabled" data-on-color="brand">
													</div>
												</div>
												<div class="form-group row kt-margin-b-20">
													<label class="col-form-label col-lg-3 col-sm-12">Disabled State</label>
													<div class="col-lg-9 col-md-9 col-sm-12">
														<input data-switch="true" type="checkbox" checked="checked" disabled>
														<input data-switch="true" type="checkbox" disabled>
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




<!-- begin:: Content -->

<div class="container">
    <div class="row">
        <br>
        <div class="col-md-12">
            <a href="http://<?php echo APP_HOST; ?>/produto/cadastro" class="btn btn-success btn-sm">Adicionar</a>
            <hr>
        </div>
        <div class="col-md-12">
            <?php if ($Sessao::retornaMensagem()) { ?>
                <div  class="alert alert-success" role="alert">
				<i class="flaticon-warning"></i>
                    <?php echo $Sessao::retornaMensagem(); ?><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
            <?php } ?>

            <?php
            if (!count($viewVar['listaProdutos'])) {
                ?>
                <div class="alert alert-info" role="alert">Nenhum produto encontrado</div>
            <?php
        } else {
            ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <td class="info">Nome</td>
                            <td class="info">Preço</td>
                            <td class="info">Quantidade</td>
                            <td class="info">Data Cadastro</td>
                            <td class="info"></td>
                        </tr>
                        <?php
                        foreach ($viewVar['listaProdutos'] as $produto) {
                            ?>
                            <tr>
                                <td><?php echo $produto->getProNome(); ?></td>
                                <td><?php echo $produto->getProNomeComercial(); ?></td>                                
                                <td><?php echo $produto->getProDataCadastro()->format('d/m/Y'); ?></td>
                                <td><?php echo $produto->getProDataCadastroAlteracao()->format('d/m/Y'); ?></td>
                                <td>
                                    <a href="http://<?php echo APP_HOST; ?>/produto/edicao/<?php echo $produto->getProCod(); ?>" class="btn btn-info btn-sm">Editar</a>
                                    <a href="http://<?php echo APP_HOST; ?>/produto/exclusao/<?php echo $produto->getProCod(); ?>" class="btn btn-danger btn-sm">Excluir</a>
                                </td>
                            </tr>
                        <?php
                    }
                    ?>
                    </table>
                </div>
            <?php
        }
        ?>
        </div>
    </div>
</div>

<!-- end:: Content -->
</div>