<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h1 class="kt-portlet__head-title">
                    TRANSPORTADORA
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
                        <a class="nav-link" data-toggle="tab" href="#kt_builder_endereco" role="tab">
                            Endereco
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_builder_contato" role="tab">
                            Contato
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
        <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/transportadora/salvar"
            method="post" id="form_cadastro" enctype="multipart/form-data">
            <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION['id']; ?>"
                class="form-control">
            <input type="hidden" id="codigo" name="codigo" value="<?php echo $viewVar['transportadora']->getTraId(); ?>"
                class="form-control">
            <input type="hidden" id="acao" name="acao" value="" class="form-control">
            <input type="hidden" id="instituicao" name="instituicao" value="<?php echo $_SESSION['inst_id']; ?>"
                class="form-control">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <div class="kt-form__actions">
                        <div class="col-lg-3"></div>
                        <button type="submit" name="builder_submit" data-demo="demo1"
                            class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-eye"></i>
                            Visualizar
                        </button>&nbsp;
                        <button type="submit" id="builder_export" data-demo="demo1"
                            class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-download"></i>
                            Export
                        </button>&nbsp;
                        <button type="submit" name="builder_reset" data-demo="demo1"
                            class="btn btn-outline-secondary btn-elevate btn-pill btn-elevate-air">
                            <i class="la la-recycle"></i>
                            Atualizar
                        </button>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane  active" id="kt_builder_principal">
                        <div class="kt-portlet__body">
                            <div class="form-group">
                                <label for="cadastroCliente" class="">CADASTRO DO CLIENTE</label>
                                <a href="http://<?php echo APP_HOST; ?>/cliente/cadastro" id="cadastroCliente"
                                    name="cadastroCliente" class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                                    <i class="la la-plus"></i>Novo Cliente</a>
                                <div>
                                    <input type="text" name="clienteLicitacaoAutocomplete"
                                        id="clienteLicitacao-autocomplete" class="form-control" required
                                        placeholder="Cliente - autocomplete" value="<?php  ?>">

                                    <input type="text" id="cliente" name="cliente" value="<?php  ?>">
                                </div>
                                <span class="form-text text-muted">Por favor insira o cliente do Pedido</span>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-8">
                                    <label for="razaosocial">Razão Social:</label>
                                    <input type="text" id="razaosocial" name="razaosocial" disabled class="form-control"
                                        value="<?php echo $viewVar['transportadora']->getTraRazaoSocial(); ?>"
                                        placeholder="Entre com Razão Social">
                                    <span class="form-text text-muted">Favor informar Razão Social</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="nomefantasia">Nome Fantasia:</label>
                                    <input type="text" id="nomefantasia" name="nomefantasia" disabled
                                        class="form-control"
                                        value="<?php echo $viewVar['transportadora']->getTraNomeFantasia(); ?>"
                                        placeholder="Entre com Nome Fantasia">
                                    <span class="form-text text-muted">Favor informar Nome Fantasia</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="" for="cnpj">CNPJ:</label>
                                    <input type="text" id="cnpj" name="cnpj" class="form-control" disabled
                                        value="<?php echo $viewVar['transportadora']->getTraCnpj(); ?>"
                                        placeholder="Entre com CNPJ">
                                    <span class="form-text text-muted">Favor informar CNPJ</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="inscricaoestadual">Insc. Estadual:</label>
                                    <input type="text" id="inscricaoestadual" name="inscricaoestadual" disabled
                                        value="<?php echo $viewVar['transportadora']->getTraIE(); ?>"
                                        class="form-control" placeholder="Insc. Estadual">
                                    <span class="form-text text-muted">Favor informar Insc. Estadual</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="" for="email">Email:</label>
                                    <input type="email" id="email" name="email" class="form-control" disabled
                                        value="<?php echo $viewVar['transportadora']->getTraEmail(); ?>"
                                        placeholder="Entre com email">
                                    <span class="form-text text-muted">Favor informar email</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="contato">Contato:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="la la-user"></i></span></div>
                                        <input type="text" id="contato" name="contato" class="form-control" disabled
                                            value="<?php echo $viewVar['transportadora']->getTraContato(); ?>"
                                            placeholder="Entre com contato">
                                    </div>
                                    <span class="form-text text-muted">Favor informar contato</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="" for="telefone">Telefone:</label>
                                    <input type="text" id="telefone" name="telefone" class="form-control" disabled
                                        value="<?php echo $viewVar['transportadora']->getTraTelefone(); ?>"
                                        placeholder="Entre com telefone">
                                    <span class="form-text text-muted">Favor informar telefone</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="" for="celular">Celular:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="celular" name="celular" class="form-control" disabled
                                            value="<?php echo $viewVar['transportadora']->getTraCelular(); ?>"
                                            placeholder="Entre com celular">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-info-circle"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar celular</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="kt_builder_endereco">
                        <input type="hidden" id="pessoa" name="pessoa"
                            value="<?php echo $viewVar['transportadora']->getTraPessoa(); ?>" class="form-control">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-8">
                                    <label for="longradouro">Longradouro:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="longradouro" name="longradouro" class="form-control"
                                            disabled
                                            value="<?php echo $viewVar['transportadora']->getEndLongradouro(); ?>"
                                            placeholder="Entre com longradouro">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-map-marker"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar longradouro</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="numero">Numero:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="number" id="numero" name="numero" class="form-control" disabled
                                            value="<?php echo $viewVar['transportadora']->getEndNumero(); ?>"
                                            placeholder="Entre com numero">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar numero</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="bairro" class="">Bairro:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="bairro" name="bairro" class="form-control" disabled
                                            value="<?php echo $viewVar['transportadora']->getEndBairro(); ?>"
                                            placeholder="Entre com bairro">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-bookmark-o"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar bairro</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="cidade" class="">Cidade:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <select class="form-control" ID="cidade" name="cidade">
                                            <option disabled value="">Selecione o Cidade</option>
                                            <?php foreach ($viewVar['listarCidades'] as $cidade) : ?>
                                            <option value="<?php echo $cidade->getCidId(); ?>"
                                                <?php echo ($viewVar['transportadora']->getEndCidade()->getCidId() == $cidade->getCidId()) ? "selected" :"";?>>
                                                <?php echo $cidade->getCidNome(); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-bookmark-o"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar cidade</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Status:</label>
                                    <div class="kt-radio-inline">
                                        <label for="status" class="kt-radio kt-radio--solid">
                                            <input type="radio" id="status" name="status" checked value="Ativo"> Ativo
                                            <span></span>
                                        </label>
                                        <label class="kt-radio kt-radio--solid">
                                            <input type="radio" id="status" name="status" value="Inativo"> Inativo
                                            <span></span>
                                        </label>
                                    </div>
                                    <span class="form-text text-muted">Favor informar status</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="complemento" class="">Complemento:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="complemento" name="complemento" class="form-control"
                                            disabled
                                            value="<?php echo $viewVar['transportadora']->getEndComplemento(); ?>"
                                            placeholder="Entre com complemento">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-bookmark-o"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar complemento</span>
                                </div>
                                <div class="col-lg-8">
                                    <label for="pontoreferencia" class="">Ponto Referencia:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="pontoreferencia" name="pontoreferencia" disabled
                                            value="<?php echo $viewVar['transportadora']->getEndPontoReferencia(); ?>"
                                            class="form-control" placeholder="Entre com pontoreferencia">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-bookmark-o"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar referencia</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="kt_builder_contato">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="contato1">Contato:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="la la-user"></i></span></div>
                                        <input type="text" id="contato1" name="contato1" class="form-control"
                                            placeholder="Entre com contato">
                                    </div>
                                    <span class="form-text text-muted">Favor informar contato</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="" for="telefone1">Telefone:</label>
                                    <input type="text" id="telefone1" name="telefone1" class="form-control"
                                        placeholder="Entre com telefone">
                                    <span class="form-text text-muted">Favor informar telefone</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="" for="celular1">Celular:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="celular1" name="celular1" class="form-control"
                                            placeholder="Entre com celular">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-info-circle"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar celular</span>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <!--begin: Datatable -->
                            <table class="table table-striped- table-bordered table-hover table-checkable"
                                id="kt_table_3">
                                <thead>
                                    <tr>
                                        <th>CONTATO</th>
                                        <th>EMAIL</th>
                                        <th>TELEFONE</th>
                                        <th>CELULAR</th>
                                        <th>ACOES</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>CONTATO</th>
                                        <th>EMAIL</th>
                                        <th>TELEFONE</th>
                                        <th>CELULAR</th>
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
                                        <td>fulano de tal</td>
                                        <td>email@email.com.br</td>
                                        <td>75 3333-4444</td>
                                        <td>75 9999-9999</td>
                                        <td>
                                            <a id="" name="" href='#' title="Editar"
                                                class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                                    class="la la-edit"></i></a>
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
                    <div class="tab-pane" id="kt_builder_observacao">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="observacao">Observacao:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"></div>
                                        <textarea type="text" id="observacao" rows="5" name="observacao"
                                            class="form-control"
                                            placeholder="Entre com observacao"><?php echo $viewVar['transportadora']->getTraObservacao(); ?></textarea>
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