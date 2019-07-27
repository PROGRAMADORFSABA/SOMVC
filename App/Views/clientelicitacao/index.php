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
                        <a href="#" class="btn btn-brand btn-elevate btn-icon-sm">
                            <i class="la la-plus"></i>
                            Novo Cliente
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        
                        <th>Código ID</th>
                        <th>Nome</th>
                        <th>Sobre Nome</th>
                        <th>Tipo</th>
                        <th>Data Cadastro</th>
                        <th>Company Name</th>
                        <th>Teste</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($viewVar['listaClienteLicitacao2'] as $clienteLicitacao) {
                        ?>
                        <tr>
                            <td><?php echo $clienteLicitacao->getIdCliente(); ?></td>
                            <td><?php echo $clienteLicitacao->getNome(); ?></td>
                            <td><?php echo $clienteLicitacao->getNomeFantasia(); ?></td>
                            <td><?php echo $clienteLicitacao->getTipoCliente()->getNomeTipo(); ?></td>
                            <td><?php echo $clienteLicitacao->getDataCadastro()->format('d/m/y'); ?></td>
                            <td>2/12/2018</td>
                            <td>3</td>
                            <td>3</td>
                            <td nowrap></td>
                        <?php
                        }
                        ?>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Código ID</th>
                        <th>Nome</th>
                        <th>Sobre Nome</th>
                        <th>tipo</th>
                        <th>Data Cadastro</th>
                        <th>Company Name</th>
                        <th>Status</th>
                        <th>Tipo</th>
                        <th>Ações</th>
                    </tr>
                </tfoot>
            </table>

            <!--end: Datatable -->
        </div>
    </div>
</div>

<!-- end:: Content -->
</div>