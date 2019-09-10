<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <!--GRAFICO begin:: Widgets/Daily Sales (DASHBOARD.JS)-->
    <div class="col-xl-4">
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-widget14">
                <div class="kt-widget14__header kt-margin-b-30">
                    <h3 class="kt-widget14__title">
                        Daily Sales
                    </h3>
                    <span class="kt-widget14__desc">

                        <?php
                        $qtde = $viewVar['qtdeFornecedores'];
                        $qtde2 = $viewVar['qtdeFornecedores1'];

                        if (count($qtde2) > 0) {
                            $andre = 0; //teste
                            echo "<br> " . " codigo = " . $qtde2[$andre]['codFornecedor'] . "<br> ";
                            echo "<br> " . " nome = " . $qtde2[0]['razaoSocial'] . "<br> ";
                            echo "<br> " . " qtde = " . $qtde2[0]['qtdePedidos'] . "<br> ";
                            echo "<br> " . " codigo = " . $qtde2[1]['codFornecedor'] . "<br> ";
                            echo "<br> " . " nome = " . $qtde2[1]['razaoSocial'] . "<br> ";
                            echo "<br> " . " qtde = " . $qtde2[1]['qtdePedidos'] . "<br> ";
                            echo "<br> " . " qtde = " . $qtde2[2]['qtdePedidos'] . "<br> ";
                        } else {
                            echo "<br> " . " Sem resultados " . "<br> ";
                        }
                        echo "<br> " . " qtde = " . $qtde[0] . "<br> ";
                        ?>
                        <input type="hidden" value="<?php echo $qtde2[0]['qtdePedidos']; ?>" name="top1" id="top1">
                        <input type="hidden" value="<?php echo $qtde2[1]['qtdePedidos']; ?>" name="top2" id="top2">

                        <h3 id="andre1">qtde fornecedor = <?php print($qtde[0]); ?></h3>
                        <input type="hidden" value="<?php echo $qtde[0]; ?>" name="teste" id="teste">
                        Check out each collumn for more details
                    </span>
                </div>
                <div class="kt-widget14__chart" style="height:120px;">
                    <canvas id="kt_chart_daily_salesFornecedor"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- GRAFICOend:: Widgets/Daily Sales-->

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-line-chart"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Pesquisa de coluna individual
                </h3>
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
                        <a href="http://<?php echo APP_HOST; ?>/fornecedor/cadastro" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-plus"></i>
                            Novo Fornecedor

                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_2">
                <thead>
                    <tr>
                        <th>CÓDIGO ID</th>
                        <th>NOME FANTASIA</th>
                        <th>RAZAO SOCIAL</th>
                        <th>CNPJ</th>
                        <th>DATA CADASTRO</th>
                        <th>Company Name</th>
                        <th>Teste</th>
                        <th>Status</th>
                        <th>teste 2</th>
                        <th>Acoes</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $dados = $viewVar['listafornecedores'];
                    if ($dados > 0) {
                        foreach ($dados as $fornecedor) {
                            ?>
                    <tr>
                        <td><?php echo $fornecedor->getFornecedor_Cod(); ?></td>
                        <td><?php echo $fornecedor->getNomeFantasia(); ?></td>
                        <td><?php echo $fornecedor->getRazaoSocial(); ?></td>
                        <td><?php echo $fornecedor->getCnpj(); ?></td>
                        <td><?php echo $fornecedor->getDataCadastro()->format('d/m/Y'); ?></td>
                        <td>02/12/2018</td>
                        <td>3</td>
                        <td>3</td>
                        <td>3</td>

                        <td>
                            <span class="dropdown">
                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true"><i class="la la-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/fornecedor/edicao/<?php echo $fornecedor->getFornecedor_Cod(); ?>" title="Editar" class="btn btn-info btn-sm"><i class="la la-edit"></i> Editar</a>
                                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/fornecedor/exclusao/<?php echo $fornecedor->getFornecedor_Cod(); ?>" title="Excluir" class="btn btn-info btn-sm"><i class="la la-edit"></i> Excluir</a>
                                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/fornecedor/edicao/<?php echo $fornecedor->getFornecedor_Cod(); ?>" title="Status" class="btn btn-info btn-sm"><i class="la la-leaf"></i> Status</a>
                                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/fornecedor/edicao/<?php echo $fornecedor->getFornecedor_Cod(); ?>" title="Relatorios" class="btn btn-info btn-sm"><i class="la la-print"></i> Relatorio</a>
                                </div>
                            </span>
                            <a href="http://<?php echo APP_HOST; ?>/fornecedor/edicao/<?php echo $fornecedor->getFornecedor_Cod(); ?>" title="Editar" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-edit"></i></a>
                        </td>

                        <?php
                            }
                        } else {

                            echo "<h3 class='kt-portlet__head-title'><p class='text-danger'>Nenhum Dado Encontrado!</p></h3>";
                        }
                        ?>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>CÓDIGO ID</th>
                        <th>NOME FANTASIA</th>
                        <th>RAZAO SOCIAL</th>
                        <th>CNPJ</th>
                        <th>DATA CADASTRO</th>
                        <th>Company Name</th>
                        <th>Teste</th>
                        <th>Status</th>
                        <th>teste 2</th>

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