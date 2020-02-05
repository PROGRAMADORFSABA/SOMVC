<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">

                <h1 class="kt-portlet__head-title">
                    GERENCIAMENTO DE GARANTIA
                </h1>
            </div>
            <?php if ($Sessao::retornaErro()) { ?>
            <div class="alert alert-warning" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
                <?php echo $mensagem; ?> <br>
                <?php } ?>
            </div>
            <?php } ?>
            <?php if ($Sessao::retornaMensagem()) { ?>
            <div class="alert alert-warning" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $Sessao::retornaMensagem(); ?>
            </div>
            <?php } ?>
        </div>
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-left nav-tabs-line-primary"
                    role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_builder_principal" role="tab">
                            Principal
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_builder_observacao" role="tab">
                            Observacao
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <!--begin::Form-->
        <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/garantia/salvar" method="post"
            id="form_cadastro" enctype="multipart/form-data">
            <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION['id']; ?>"
                class="form-control">
            <input type="hidden" id="instituicao" name="instituicao" value="<?php echo $_SESSION['inst_id']; ?>"
                class="form-control">
            <div class="kt-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane  active" id="kt_builder_principal">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="fornecedor" class="">Fornecedor:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <select class="form-control" ID="fornecedor" name="fornecedor">
                                            <option value=""></option>
                                            <option value=""> Fornecedor 1</option>
                                            <option value=""> Fornecedor 2</option>
                                            <option value=""> Fornecedor 3</option>
                                            <option value=""> Fornecedor 2</option>
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Favor informar</span>
                                </div>
                                <div class="col-lg-2">
                                    <label for="" class="">Status:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <select class="form-control" ID="" name="">
                                            <option value=""></option>
                                            <option value=""> Garantido</option>
                                            <option value=""> Nao Garantido</option>
                                            <option value=""> Recusado</option>
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Favor informar </span>
                                </div>
                                <div class="col-lg-2">
                                    <label for="" class="">Resultado:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <select class="form-control" ID="" name="">
                                            <option value=""></option>
                                            <option value=""> Ganho</option>
                                            <option value=""> Perdido</option>
                                            <option value=""> Outro</option>
                                        </select>
                                    </div>
                                    <span class="form-text text-muted">Favor informar </span>
                                </div>
                                <div class="col-lg-2">
                                    <label for="" class="">Data de Solicitacao:</label>
                                    <input type="date" class="form-control" placeholder="Digite a Data de Solicitacao"
                                        id="" name="" value="">
                                    <span class="form-text text-muted">Digite a Data</span>
                                </div>
                                <div class="col-lg-2">
                                    <label for="" class="">Data de Resultado:</label>
                                    <input type="date" class="form-control" placeholder="Digite a Data de Resultado"
                                        id="" name="" value=" ">
                                    <span class="form-text text-muted">Digite a Data</span>
                                </div>                               
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="anexo" class="">Anexo:</label>
                                    <input type="file" name="anexo" id="anexo"
                                        value="<?php echo $Sessao::retornaValorFormulario('anexo'); ?>">
                                    <span class="form-text text-muted">Selecione o arquivo</span>
                                </div>
                                <div class="col-lg-2">
                                    <label for="btnAdicionarGarantia" class="">Adicionar Garantia:</label>
                                    <a class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air form-control"
                                        id="btnAdicionarGarantia">Adicionar</a>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <!--begin: Datatable -->
                                <table class="table table-striped- table-bordered table-hover table-checkable"
                                    id="kt_table_3">
                                    <thead>
                                        <tr>
                                            <th>FORNECEDOR</th>
                                            <th>STATUS</th>
                                            <th>RESULTADO</th>
                                            <th>DATA SOLICITADO</th>
                                            <th>DATA RESULTADO</th>
                                            <th>ACOES</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>FORNECEDOR</th>
                                            <th>STATUS</th>
                                            <th>RESULTADO</th>
                                            <th>DATA SOLICITADO</th>
                                            <th>DATA RESULTADO</th>
                                            <th>ACOES</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                //$dados = $viewVar['listarContatos'];
                            //  if (!empty($dados)) {  
                                //  foreach ($dados as $transportadora) {
                                        ?>
                                        <tr>
                                            <td>FORNECEDOR 01</td>
                                            <td>STATUS 1</td>
                                            <td>RESULTADO 1</td>
                                            <td>01/01/2020</td>
                                            <td>05/01/2020</td>
                                            <td>
                                                <a id="" name="" href='#' title="Editar"
                                                    class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                                        class="la la-edit"></i></a>
                                                        <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/" target="_blank" title="Visualizar Anexo" class="btn btn-info btn-sm"><i class="la la-chain"></i></a>
                                                <a id="" name="" href='#' title="Excluir"
                                                    class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                                        class="la la-trash"></i></a>
                                            </td>
                                            <td>
                                        <tr>
                                            <td>FORNECEDOR 02</td>
                                            <td>STATUS 2</td>
                                            <td>RESULTADO 2</td>
                                            <td>02/02/2020</td>
                                            <td>05/02/2020</td>
                                            <td>
                                                <a id="" name="" href='#' title="Editar"
                                                    class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                                        class="la la-edit"></i></a>
                                                        <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/" target="_blank" title="Visualizar Anexo" class="btn btn-info btn-sm"><i class="la la-chain"></i></a>
                                                <a id="" name="" href='#' title="Excluir"
                                                    class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                                        class="la la-trash"></i></a>
                                            </td>
                                        <tR>

                                        <tr>
                                            <td>FORNECEDOR 03</td>
                                            <td>STATUS 3</td>
                                            <td>RESULTADO 3</td>
                                            <td>03/03/2020</td>
                                            <td>05/03/2020</td>
                                            <td>
                                                <a id="" name="" href='#' title="Editar"
                                                    class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                                        class="la la-edit"></i></a>
                                                        <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/" target="_blank" title="Visualizar Anexo" class="btn btn-info btn-sm"><i class="la la-chain"></i></a>
                                                <a id="" name="" href='#' title="Excluir"
                                                    class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                                        class="la la-trash"></i></a>
                                            </td>
                                            <?php
                                    //    }
                                // } else {

                                        echo "<h3 class='kt-portlet__head-title'><p class='text-danger'>Nenhum Dado Encontrado!</p></h3>";
                                //  }
                            ?>
                                        </tr>
                                    </tbody>

                                </table>

                                <!--end: Datatable -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="kt_builder_observacao">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="observacao">Observacao:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"></div>
                                        <textarea type="text" id="observacao" rows="5" name="observacao"
                                            class="form-control"
                                            placeholder="Entre com observacao"></textarea>
                                    </div>
                                    <span class="form-text text-muted">Favor informar observacao</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-8">
                            <a id="btnTraNovo"
                                class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Novo</a>
                            <button type="submit"
                                class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">Salvar</button>
                            <a type="button" id="btnVoltarTra" href='http://<?php echo APP_HOST; ?>/transportadora/'
                                class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                            <a id="btnTraAlterar"
                                class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Alterar</a>
                            <button type="submit" id="btnTraExcluir"
                                class="btn btn-outline-danger btn-elevate btn-pill btn-elevate-air">Excluir</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>
    <!--end::Portlet-->
</div>
</div>