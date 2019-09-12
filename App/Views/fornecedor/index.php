<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Pesquisa de coluna individual
                </h3>
                <?php if ($Sessao::retornaMensagem()) { ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $Sessao::retornaMensagem(); ?>
                </div>
                <?php } ?>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i> Exportar
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text">Escolha uma opção</span>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-print"></i>
                                            <span class="kt-nav__link-text">Imprimir</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-copy"></i>
                                            <span class="kt-nav__link-text">copiar</span>
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
                        <a href="http://<?php echo APP_HOST; ?>/clientelicitacao/cadastro" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-plus"></i>
                            Novo Cliente

                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_3">
                <thead>
                    <tr>
                        <th>CÓDIGO</th>
                        <th>RAZAO SOCIAL</th>
                        <th>NOME FANTASIA</th>
                        <th>CNPJ</th>
                        <th>Acoes</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $fornecedor = $viewVar['listafornecedores'];
                    if ($fornecedor > 0){
                        foreach ($viewVar['listafornecedores'] as $fornecedor){

                        ?>
                    <tr>
                        <td><?php echo $fornecedor->getFornecedor_Cod(); ?></td>
                        <td><?php echo $fornecedor->getRazaoSocial(); ?></td>
                        <td><?php echo $fornecedor->getNomeFantasia(); ?></td>
                        <td><?php echo $fornecedor->getCNPJ(); ?></td>
                        <td>
                            <span class="dropdown">
                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true"><i class="la la-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/clientelicitacao/edicao/<?php echo $clienteLicitacao->getCodcliente(); ?>" title="Editar" class="btn btn-info btn-sm"><i class="la la-edit"></i> Editar</a>
                                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/clientelicitacao/exclusao/<?php echo $clienteLicitacao->getCodcliente(); ?>" title="Excluir" class="btn btn-info btn-sm"><i class="la la-trash"></i> Excluir</a>
                                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/clientelicitacao/edicao/<?php echo $clienteLicitacao->getCodcliente(); ?>" title="Status" class="btn btn-info btn-sm"><i class="la la-leaf"></i> Status</a>
                                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/clientelicitacao/edicao/<?php echo $clienteLicitacao->getCodcliente(); ?>" title="Relatorios" class="btn btn-info btn-sm"><i class="la la-print"></i> Relatorio</a>
                                </div>
                            </span>
                            <a href="http://<?php echo APP_HOST; ?>/clientelicitacao/edicao/<?php echo $clienteLicitacao->getCodcliente(); ?>" title="Editar" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-edit"></i></a>
                            <a href="http://<?php echo APP_HOST; ?>/clientelicitacao/exclusao/<?php echo $clienteLicitacao->getCodcliente(); ?>" title="Excluir" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-trash"></i></a>
                        </td>
                        <?php
                            }
                        }else {

                            echo "<h3 class='kt-portlet__head-title'><p class='text-danger'>Nenhum Dado Encontrado!</p></h3>";
                        }
                        ?>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>CÓDIGO</th>
                        <th>RAZAO SOCIAL</th>
                        <th>NOME FANTASIA</th>
                        <th>CNPJ</th>
                        <th>Acoes</th>
                    </tr>
                </tfoot>
            </table>

            <!--end: Datatable -->
        </div>
    </div>
</div>

<!-- end:: Content -->
</div>