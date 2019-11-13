<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
							<div class="alert alert-light alert-elevate" role="alert">
								<div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
								<div class="alert-text">
									The grouping indicator is added by the drawCallback function, which will parse through the rows which are displayed, and enter a grouping TR element where a new group is found.
									See official documentation <a class="kt-link kt-font-bold" href="https://datatables.net/examples/advanced_init/row_grouping.html" target="_blank">here</a>.
								</div>
							</div>
							<div class="kt-portlet kt-portlet--mobile">
								<div class="kt-portlet__head kt-portlet__head--lg">
									<div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
										<h3 class="kt-portlet__head-title">
											Row Grouping
										</h3>
									</div>
									<div class="kt-portlet__head-toolbar">
										<div class="kt-portlet__head-wrapper">
											<div class="kt-portlet__head-actions">
												<div class="dropdown dropdown-inline">
													<button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<i class="la la-download"></i> Export
													</button>
													<div class="dropdown-menu dropdown-menu-right">
														<ul class="kt-nav">
															<li class="kt-nav__section kt-nav__section--first">
																<span class="kt-nav__section-text">Choose an option</span>
															</li>
															<li class="kt-nav__item">
																<a href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-print"></i>
																	<span class="kt-nav__link-text">Print</span>
																</a>
															</li>
															<li class="kt-nav__item">
																<a href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-copy"></i>
																	<span class="kt-nav__link-text">Copy</span>
																</a>
															</li>
															<li class="kt-nav__item">
																<a href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-file-excel-o"></i>
																	<span class="kt-nav__link-text">Excel</span>
																</a>
															</li>
															<li class="kt-nav__item">
																<a href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-file-text-o"></i>
																	<span class="kt-nav__link-text">CSV</span>
																</a>
															</li>
															<li class="kt-nav__item">
																<a href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon la la-file-pdf-o"></i>
																	<span class="kt-nav__link-text">PDF</span>
																</a>
															</li>
														</ul>
													</div>
												</div>
												&nbsp;
												<a href="#" class="btn btn-brand btn-elevate btn-icon-sm">
													<i class="la la-plus"></i>
													New Record
												</a>
											</div>
										</div>
									</div>
								</div>
								<div class="kt-portlet__body">

									<!--begin: Datatable -->
									<table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1" id="report">
										<thead>
											<tr>
												<th>FALTA ID</th>
												<th>PRODUTO</th>
												<th>CLIENTE</th>
												<th>MARCA</th>
												<th>OBSERVACAO</th>
												<th>AFM</th>
												<th>STATUS</th>
												<th>DATA</th>
												<th>Status</th>
												<th>Type</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
                                        <?php foreach($viewVar['pedidofalta'] as $pedidoFalta) { ?>
											<tr>
												<td><?php echo $pedidoFalta->getFaltaClienteCod();?></td>
												<td><?php echo $pedidoFalta->getFkProduto()->getProNome();?></td>
												<td><?php echo $pedidoFalta->getFkCliente()->getNomeFantasia();?></td>
												<td><?php echo $pedidoFalta->getFkMarca()->getForNomeFantasia();?></td>
												<td><?php echo $pedidoFalta->getObservacao();?></td>
												<td><?php echo $pedidoFalta->getAfm();?></td>
												<td><?php echo $pedidoFalta->getFkStatus()->getNomeStatus();?></td>
												<td>9/16/2016</td>
												<td>6</td>
												<td>2</td>
												<td nowrap></td>
                                            </tr>
                                             <?php
                                        }
                                        ?>
										</tbody>
									</table>

									<!--end: Datatable -->
								</div>
							</div>
						</div>

						<!-- end:: Content -->
					</div>