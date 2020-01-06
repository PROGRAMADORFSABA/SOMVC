<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <div class="kt-portlet kt-portlet--mobile">
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/contrato/" method="post" id="form_cadastro" enctype="multipart/form-data">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                        <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                    <h3 class="kt-portlet__head-title">
                    Pesquisa de contratos cadastrados 
                    </h3>                   
            </div>
        </div>
            <div class="kt-portlet__body">  
                <div class="form-group row">
                    <div class="col-lg-9">
                        <label for="clienteId">Cliente</label>
                        <select class="form-control" name="clienteId">
                            <option value="">Selecione o cliente</option>
                            <?php foreach ($viewVar['listaClientes'] as $cliente) : ?>
                            <option value="<?php echo $cliente->getClienteLicitacao()->getCodCliente(); ?>" <?php echo ($Sessao::retornaValorFormulario('clienteId') == $cliente->getClienteLicitacao()->getCodCliente()) ? "selected" : ""; ?>>
                            <?php echo $cliente->getClienteLicitacao()->getRazaoSocial(); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="form-text text-muted">Por favor insira o cliente</span>
                    </div>
                    <div class="col-lg-3">
                        <label for="codRepresentante">Representante</label>
                        <select class="form-control" id="codRepresentante" name="codRepresentante" >
                            <option value="">Selecione o Representante</option>
                            <?php foreach ($viewVar['listarRepresentantes'] as $representante) : ?>
                            <option value="<?php echo $representante->getRepresentante()->getCodRepresentante(); ?>" <?php echo ($Sessao::retornaValorFormulario('codRepresentante') == $representante->getRepresentante()->getCodRepresentante()) ? "selected" : ""; ?>>
                            <?php echo $representante->getRepresentante()->getNomeRepresentante(); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="form-text text-muted">Por favor insira o Representante</span>
                    </div>   
                </div>       
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="codigo">Codigo:</label>
                        <input type="text" class="form-control" title="Digite o codido" placeholder="codigo" id="codigo" name="codigo" value="<?php echo $Sessao::retornaValorFormulario('codigo'); ?>">
                    </div>
                    <div class="col-lg-2">
                        <label for="numero">Contrato:</label>
                        <input type="text" class="form-control" title="Digite o numero da Contrato" placeholder="Contrato" id="contrato" name="contrato" value="<?php echo $Sessao::retornaValorFormulario('contrato'); ?>">
                    </div>
                    <div class="col-lg-2">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                                <option value="">Selecione o Status</option>
                                <?php foreach ($viewVar['listarContratoStatus'] as $contratoStatus) : ?>
                                    <option value="<?php echo $contratoStatus->getStCtrId(); ?>" <?php echo ($Sessao::retornaValorFormulario('status') == $contratoStatus->getStCtrId()) ? "selected" : ""; ?>>
                                        <?php echo $contratoStatus->getStCtrNome(); ?></option>
                                <?php endforeach; ?>
                            </select>
                        <span class="form-text text-muted">Por favor insira o Status</span>
                    </div>    

                    <div class="col-lg-3">
                        <div class="form-group"><label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">Selecione o Status</option>
                            <option value="Pendente">Pendente</option>
                                <option value="Lancado">Lancado</option>
                                <option value="Vencido">Vencido</option>
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
                        <a href="http://<?php echo APP_HOST; ?>/contrato/cadastro" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
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
                    <th>CLIENTE</th>
                    <th>TIPO</th>
                    <th>NUMERO</th>
                    <th>STATUS</th>
                    <th>VENCIMENTO</th>
                    <th>VALOR</th>
                    <th>USUARIO</th>
                        <th>ENTREGA</th>
                        <th>PAGTO</th>
                        <th>DATA</th>
                        <th>ACOES</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>CÓDIGO</th>
                        <th>CLIENTE</th>
                        <th>TIPO</th>
                        <th>NUMERO</th>
                        <th>STATUS</th>
                        <th>VENCIMENTO</th>
                        <th>VALOR</th>
                        <th>USUARIO</th>
                        <th>ENTREGA</th>
                        <th>PAGTO</th>
                        <th>DATA</th>
                        <th>ACOES</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $dados = $viewVar['listaContratos'];
                   
                    if (!empty($dados)) {            
                        foreach ($dados as $contrato) {
                            ?>
                            <tr>
                                <td><?php echo $contrato->getCtrId(); ?></td>
                                <td><?php echo $contrato->getClienteLicitacao()->getRazaoSocial(); ?></td>
                                <td><?php echo $contrato->getClienteLicitacao()->getTipoCliente(); ?></td>
                                <td><?php echo $contrato->getCtrNumero(); ?></td>
                                <td><?php echo $contrato->getContratoStatus()->getStCtrNome(); ?></td>
                                <td><?php echo $contrato->getCtrDataVencimento()->format('d/m/Y'); ?></td>
                                <td><?php echo $contrato->getCtrValor(); ?></td>
                                <td><?php echo $contrato->getUsuario()->getNome(); ?></td>
                                <td><?php echo $contrato->getCtrPrazoEntrega(); ?></td>
                                <td><?php echo $contrato->getCtrPrazoPagamento(); ?></td>
                                <td><?php echo $contrato->getCtrDataCadastro()->format('d/m/Y'); ?></td>
                                <td>
                                    <span class="dropdown">
                                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true"><i class="la la-ellipsis-h"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/contrato/edicao/<?php echo $contrato->getCtrId(); ?>" title="Editar" class="btn btn-info btn-sm"><i class="la la-edit"></i> Editar</a>
                                            <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/contrato/exclusao/<?php echo $contrato->getCtrId(); ?>" title="Excluir" class="btn btn-info btn-sm"><i class="la la-trash"></i> Excluir</a>
                                            <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/contrato/edicao/<?php echo $contrato->getCtrId(); ?>" title="Status" class="btn btn-info btn-sm"><i class="la la-leaf"></i> Status</a>
                                            <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $contrato->getCtrAnexo(); ?>" target="_blank" title="Visualizar Anexo" class="btn btn-info btn-sm"><i class="la la-chain"></i> Anexo</a>
                                            <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/contrato/edicao/<?php echo $contrato->getCtrId(); ?>" title="Relatorios" class="btn btn-info btn-sm"><i class="la la-print"></i> Relatorio</a>
                                        </div>
                                    </span>
                                    <a href="http://<?php echo APP_HOST; ?>/contrato/edicao/<?php echo $contrato->getCtrId(); ?>" title="Editar" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-edit"></i></a>
                                    <a href="http://<?php echo APP_HOST; ?>/contrato/exclusao/<?php echo $contrato->getCtrId(); ?>" title="Excluir" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-trash"></i></a>
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