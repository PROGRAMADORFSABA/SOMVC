<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <div class="kt-portlet kt-portlet--mobile">
        <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/sugestoes/" method="post"
            id="form_cadastro" enctype="multipart/form-data">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        Pesquisa de sugestoes registrados
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="codigo">Codigo:</label>
                        <input type="text" class="form-control" title="Digite o codido" placeholder="codigo" id="codigo"
                            name="codigo" value="<?php echo $Sessao::retornaValorFormulario('codigo'); ?>">
                        <span class="form-text text-muted">Por favor insira o codigo</span>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group"><label for="status">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="">Selecione o Status</option>
                                <option value="EM ANALISE">EM ANALISE</option>
                                <option value="EM TRATAMENTO">EM TRATAMENTO</option>
                                <option value="CONCLUIDO">CONCLUIDO</option>
                                <option value="CANCELADO">CANCELADO</option>
                            </select>
                            <span class="form-text text-muted">Por favor insira o Status</span>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group"><label for="tipo">Tipo</label>
                            <select class="form-control" name="tipo" id="tipo">
                                <option value="">Selecione o tipo</option>
                                <option value="CORRECAO">CORRECAO</option>
                                <option value="DESENVOLVIMENTO">DESENVOLVIMENTO</option>
                                <option value="OUTROS">OUTROS</option>
                            </select>
                            <span class="form-text text-muted">Por favor insira o tipo</span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label for="usuario">Usuario</label>
                        <select class="form-control" id="usuario" name="usuario">
                            <option value="">Selecione o Usuario</option>
                            <?php foreach ($viewVar['listarUsuarios'] as $usuario) : ?>
                            <option value="<?php echo $usuario->getId(); ?>"
                                <?php echo ($Sessao::retornaValorFormulario('idusuario') == $usuario->getId()) ? "selected" : ""; ?>>
                                <?php echo $usuario->getNome(); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="form-text text-muted">Por favor insira o usuario</span>
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
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <a href="http://<?php echo APP_HOST; ?>/sugestoes/cadastro"
                            class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
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
                        <th>ASSUNTO</th>
                        <th>TIPO</th>
                        <th>STATUS</th>
                        <th>USUARIO</th>
                        <th>DATA</th>
                        <th>ACOES</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>CÓDIGO</th>
                        <th>ASSUNTO</th>
                        <th>TIPO</th>
                        <th>STATUS</th>
                        <th>USUARIO</th>
                        <th>DATA</th>
                        <th>ACOES</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $dados = $viewVar['listarSugestoes'];
                    if (!empty($dados)) {  
                        foreach ($dados as $sugestoes) {
                            ?>
                    <tr>
                        <td><?php echo $sugestoes->getSugId(); ?></td>
                        <td><?php echo $sugestoes->getSugAssunto(); ?></td>
                        <td><?php echo $sugestoes->getSugTipo(); ?></td>
                        <td><?php echo $sugestoes->getSugStatus(); ?></td>
                        <td><?php echo $sugestoes->getUsuario()->getNome(); ?></td>
                        <td><?php echo $sugestoes->getSugDataCadastro()->format('d/m/Y H:m'); ?></td>
                        <td>
                            <span class="dropdown">
                                <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown"
                                    aria-expanded="true"><i class="la la-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item"
                                        href="http://<?php echo APP_HOST; ?>/sugestoes/edicao/<?php echo $sugestoes->getSugId(); ?>"
                                        title="Editar" class="btn btn-info btn-sm"><i class="la la-edit"></i> Editar</a>
                                    <a class="dropdown-item"
                                        href="http://<?php echo APP_HOST; ?>/sugestoes/exclusao/<?php echo $sugestoes->getSugId(); ?>"
                                        title="Excluir" class="btn btn-info btn-sm"><i class="la la-trash"></i>
                                        Excluir</a>
                                    <a class="dropdown-item"
                                        href="http://<?php echo APP_HOST; ?>/sugestoes/edicao/<?php echo $sugestoes->getSugId(); ?>"
                                        title="Status" class="btn btn-info btn-sm"><i class="la la-leaf"></i> Status</a>
                                    <a class="dropdown-item"
                                        href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $sugestoes->getSugAnexo(); ?>"
                                        target="_blank" title="Visualizar Anexo" class="btn btn-info btn-sm"><i
                                            class="la la-chain"></i> Anexo</a>
                                    <a class="dropdown-item"
                                        href="http://<?php echo APP_HOST; ?>/sugestoes/edicao/<?php echo $sugestoes->getSugId(); ?>"
                                        title="Relatorios" class="btn btn-info btn-sm"><i class="la la-print"></i>
                                        Relatorio</a>
                                </div>
                            </span>
                            <a href="http://<?php echo APP_HOST; ?>/sugestoes/edicao/<?php echo $sugestoes->getSugId(); ?>"
                                title="Editar" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                    class="la la-edit"></i></a>
                            <a href="http://<?php echo APP_HOST; ?>/sugestoes/exclusao/<?php echo $sugestoes->getSugId(); ?>"
                                title="Excluir" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                    class="la la-trash"></i></a>
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