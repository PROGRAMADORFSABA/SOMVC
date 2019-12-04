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
                        
                        Check out each collumn for more details
                    </span>
                    <div class="chart-container">
                        <canvas id="line-chartcanvas"></canvas>
                        <?php
                        $clienteLicitacao = $viewVar['listar'];   
                                                            
                      // echo $clienteLicitacao->getCodCliente()[0]; 
                        // echo $clienteLicitacao->getRazaoSocial()[0]; 
                        
                         ?>
                    </div>

                </div><div class="kt-widget14__content">
                <div class="kt-widget14__chart" style="height:120px;">
                        <canvas id="kt_chart_profit_share"></canvas>

                        <div class="kt-widget14__legends">
                                    <div class="kt-widget14__legend">
                                        <span class="kt-widget14__bullet kt-bg-success"></span>                                       
                                        <span class="kt-widget14__stats"> <?php echo $clienteLicitacao->getCodCliente(); ?></span>
                                    </div>
                                    <div class="kt-widget14__legend">
                                        <span class="kt-widget14__bullet kt-bg-warning"></span>
                                        <span class="kt-widget14__stats">47% Business Events</span>
                                    </div>
                                    <div class="kt-widget14__legend">
                                        <span class="kt-widget14__bullet kt-bg-brand"></span>
                                        <span class="kt-widget14__stats">19% Others</span>
                                    </div>
                                </div>
                </div>
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
                        <a href="http://<?php echo APP_HOST; ?>/clienteLicitacao/cadastro" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
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
                        <th>TIPO</th>
                        <th>TROCA DE MARCA</th>
                        <th>Acoes</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $clienteLicitacao1 = $viewVar['listar'];
                    if ($clienteLicitacao1 > 0) {
                        foreach ($clienteLicitacao1 as $clienteLicitacao) {
                            ?>
                    <tr>
                        <td><?php echo $clienteLicitacao->getCodCliente(); ?></td>
                        <td><?php echo $clienteLicitacao->getRazaoSocial(); ?></td>
                        <td><?php echo $clienteLicitacao->getNomeFantasia(); ?></td>
                        <td><?php echo $clienteLicitacao->getCnpj(); ?></td>
                        <td><?php echo $clienteLicitacao->getTipoCliente(); ?></td>
                        <td><?php echo $clienteLicitacao->getTrocaMarca(); ?></td>
                        <td>
                            <span class="dropdown">
                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" title="Click para ver acoes desejadas" aria-expanded="true"><i class="la la-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/clienteLicitacao/edicao/<?php echo $clienteLicitacao->getCodcliente(); ?>" title="Editar" class="btn btn-info btn-sm"><i class="la la-edit"></i> Editar</a>
                                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/clienteLicitacao/exclusao/<?php echo $clienteLicitacao->getCodcliente(); ?>" title="Excluir" class="btn btn-info btn-sm"><i class="la la-trash"></i> Excluir</a>
                                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/clienteLicitacao/edicao/<?php echo $clienteLicitacao->getCodcliente(); ?>" title="Status" class="btn btn-info btn-sm"><i class="la la-leaf"></i> Status</a>
                                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/clienteLicitacao/edicao/<?php echo $clienteLicitacao->getCodcliente(); ?>" title="Relatorios" class="btn btn-info btn-sm"><i class="la la-print"></i> Relatorio</a>
                                </div>
                            </span>
                            <a href="http://<?php echo APP_HOST; ?>/clienteLicitacao/edicao/<?php echo $clienteLicitacao->getCodcliente(); ?>" title="Editar" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-edit"></i></a>
                            <a href="http://<?php echo APP_HOST; ?>/clienteLicitacao/exclusao/<?php echo $clienteLicitacao->getCodcliente(); ?>" title="Excluir" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-trash"></i></a>
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
                        <th>TIPO</th>
                        <th>TROCA DE MARCA</th>
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
   