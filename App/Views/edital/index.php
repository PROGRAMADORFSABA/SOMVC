<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <div class="kt-portlet kt-portlet--mobile">
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/edital/" method="post" id="form_cadastro" enctype="multipart/form-data">
            <h3 class="kt-portlet__head-title">
                Pesquisa de editais registrados
            </h3>
            <div class="form-group"><label for="codCliente">Cliente</label>
                <select class="form-control" name="codCliente">
                    <option value="">Selecione o cliente</option>
                    <?php foreach ($viewVar['listaClientes'] as $cliente) : ?>
                        <option value="<?php echo $cliente->getCodCliente(); ?>" <?php echo ($Sessao::retornaValorFormulario('cliente') == $cliente->getCodCliente()) ? "selected" : ""; ?>>
                            <?php echo $cliente->getRazaoSocial(); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-lg-3">
                        <label for="codRepresentante">Representante</label>
                        <select class="form-control" id="codRepresentante" name="codRepresentante" >
                                <option value="">Selecione o Representante</option>
                                <?php foreach ($viewVar['listarRepresentantes'] as $representante) : ?>
                                    <option value="<?php echo $representante->getCodRepresentante(); ?>" <?php echo ($Sessao::retornaValorFormulario('codRepresentante') == $representante->getCodRepresentante()) ? "selected" : ""; ?>>
                                        <?php echo $representante->getNomeRepresentante(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        <span class="form-text text-muted">Por favor insira o Representante</span>
                    </div>   
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <div class="col-lg-1">
                        <label for="codigo">Codigo:</label>
                        <input type="text" class="form-control" title="Digite o codido" placeholder="codigo" id="codigo" name="codigo" value="<?php echo $Sessao::retornaValorFormulario('codigo'); ?>">
                    </div>
                    <div class="col-lg-2">
                        <label for="prosposta">Prosposta:</label>
                        <input type="text" class="form-control" title="Digite o numero da Prosposta" placeholder="Prosposta" id="proposta" name="proposta" value="<?php echo $Sessao::retornaValorFormulario('proposta'); ?>">
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group"><label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">Selecione o Status</option>
                            <option value="Em Analise">Em Analise</option>
                                <option value="Ganha">Ganha</option>
                                <option value="Concorrendo">Concorrendo</option>
                                <option value="Em Montagem">Em Montagem</option>
                                <option value="Perdida">Perdida</option>
                        </select>
                            <span class="form-text text-muted">Por favor insira o Status</span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group"><label for="modalidade">modalidade</label>
                        <select class="form-control" name="modalidade" id="modalidade" >
                                <option value="">Selecione a Modalidade</option>
                                <option value="Eletronico">Eletronico</option>
                                <option value="Presencial">Presencial</option>
                                <option value="Concorrencia">Concorrencia</option>
                                <option value="Convite">Convite</option>
                            </select>
                            <span class="form-text text-muted">Por favor insira o Modalidade</span>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <label>Licitacao:</label>
                        <input type="text" class="form-control" title="Digite o numero da licitacao" placeholder="Nume. Licitacao" id="numeroLicitacao" name="numeroLicitacao" value="<?php echo $Sessao::retornaValorFormulario('numeroLicitacao'); ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-elevate btn-pill btn-elevate-air">Pesquisar</button>
            </div>
        </form>
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
                        <a href="http://<?php echo APP_HOST; ?>/edital/cadastro" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-plus"></i>
                            Novo Cadastro
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
                        <th>NUMERO</th>
                        <th>PROPOSTA</th>
                        <th>MODALIDADE</th>
                        <th>TIPO</th>
                        <th>GARANTIA</th>
                        <th>STATUS</th>
                        <th>CLIENTE</th>
                        <th>USUARIO</th>
                        <th>DATA</th>
                        <th>HORA</th>
                        <th>ACOES</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>CÓDIGO</th>
                        <th>NUMERO</th>
                        <th>PROPOSTA</th>
                        <th>MODALIDADE</th>
                        <th>TIPO</th>
                        <th>GARANTIA</th>
                        <th>STATUS</th>
                        <th>CLIENTE</th>
                        <th>USUARIO</th>
                        <th>DATA</th>
                        <th>HORA</th>
                        <th>ACOES</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $dados = $viewVar['listaEditais'];
                    if ($dados > 0) {
                        foreach ($dados as $edital) {
                            ?>
                            <tr>
                                <td><?php echo $edital->getEdtId(); ?></td>
                                <td><?php echo $edital->getEdtNumero(); ?></td>
                                <td><?php echo $edital->getEdtProposta(); ?></td>
                                <td><?php echo $edital->getEdtModalidade(); ?></td>
                                <td><?php echo $edital->getEdtTipo(); ?></td>
                                <td><?php echo $edital->getEdtGarantia(); ?></td>
                                <td><?php echo $edital->getEdtStatus(); ?></td>
                                <td><?php echo $edital->getClienteLicitacao()->getNomeFantasia(); ?></td>
                                <td><?php echo $edital->getUsuario()->getNome(); ?></td>
                                <td><?php echo $edital->getEdtDataCadastro()->format('d/m/Y'); ?></td>
                                <td><?php echo $edital->getEdtHora()->format('H:m:s'); ?></td>
                                <td>
                                    <span class="dropdown">
                                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true"><i class="la la-ellipsis-h"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/edital/edicao/<?php echo $edital->getEdtId(); ?>" title="Editar" class="btn btn-info btn-sm"><i class="la la-edit"></i> Editar</a>
                                            <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/edital/exclusao/<?php echo $edital->getEdtId(); ?>" title="Excluir" class="btn btn-info btn-sm"><i class="la la-trash"></i> Excluir</a>
                                            <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/edital/edicao/<?php echo $edital->getEdtId(); ?>" title="Status" class="btn btn-info btn-sm"><i class="la la-leaf"></i> Status</a>
                                            <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $edital->getEdtAnexo(); ?>" target="_blank" title="Visualizar Anexo" class="btn btn-info btn-sm"><i class="la la-chain"></i> Anexo</a>
                                            <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/edital/edicao/<?php echo $edital->getEdtId(); ?>" title="Relatorios" class="btn btn-info btn-sm"><i class="la la-print"></i> Relatorio</a>
                                        </div>
                                    </span>
                                    <a href="http://<?php echo APP_HOST; ?>/edital/edicao/<?php echo $edital->getEdtId(); ?>" title="Editar" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-edit"></i></a>
                                    <a href="http://<?php echo APP_HOST; ?>/edital/exclusao/<?php echo $edital->getEdtId(); ?>" title="Excluir" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-trash"></i></a>
                                </td>
                        <?php
                            }
                        } else {

                            echo "<h3 class='kt-portlet__head-title'><p class='text-danger'>Nenhum Dado Encontrado!</p></h3>";
                        }
                        ?>
                            </tr>
                </tbody>
               
            </table>

            <!--end: Datatable -->
        </div>
    </div>
</div>

<!-- end:: Content -->
</div>