<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                
                <?php if($Sessao::retornaErro()){ ?>
                    <div class="col-lg-12">
                        <div class="alert alert-danger" role="alert">
                            <?php foreach($sessao::retornaErro() as $key => $mensagem){ ?>
                                <?php echo $mensagem; ?> <br>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>

                <form class="form-horizontal" id="form_cadastro_vaga" method="POST" action="http://<?php echo APP_HOST; ?>/vaga/salvar">
                    <div class="col-lg-12">
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                Cadastro de Falta
                            </header>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Proposta</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input right">
                                            <input type="text" name="proposta" class="form-control" placeholder="Proposta"
                                                   required value= <?php echo $viewVar['pedidofalta']->getProsposta(); ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Cliente</label>
                                    <div class="col-lg-9">
                                        <div>
                                            <input type="text" name="autocompleteEmpresa" id="autocomplete-cliente" class="form-control" required placeholder="Cliente - autocomplete"
                                                   value=<?php echo $viewVar[''] ?>>

                                            <input type="hidden" id="cliente" name="cliente"
                                                   value= >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class="col-lg-3 col-sm-3 control-label">Descrição</label>
                                    <div class="col-lg-9">
                                        <div class="iconic-input right">
                                            <textarea maxlength="350" class="form-control spinner" placeholder="Descrição da Vaga" rows="5" name="descricao" > </textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </section>
                    </div>

                    <div class="col-md-12">
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                Tecnologias
                            </header>
                            <div class="panel-body">
                                <div id="tecnologias-selecionadas">
                                    <div class="form-group">
                                        <label  class="col-lg-3 col-sm-3 control-label">Adicionar</label>
                                        <div class="col-lg-9">
                                            <div class="iconic-input right">
                                                <input type="text" id="autocomplete-tecnologia" class="form-control " placeholder="Tecnologias">
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table table-striped">
                                        <thead>
                                        <th>Tecnologia</th>
                                        <th>Remover</th>
                                        </thead>
                                        <tbody id="editar-tabela-tecnologias">
                                        <?php
                                            if($viewVar['pedidofalta']->getProposta()) {
                                                foreach ($viewVar['pedidofalta']->getTecnologias() as $tecnologia) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <!-- ?php echo $tecnologia->getTecnologia(); ? -->
                                                            <input type="hidden" name="tecnologias[]" value= >
                                                        </td>
                                                        <td><button class="btn btn-danger btn-sm" type="button" onClick="app.removeTecnologia(this,<?php echo $tecnologia->getIdTecnologia(); ?>)">remover</button></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        ?>
                                        </tbody>
                                    </table>

                                </div>
                        </section>
                    </div>

                    <div class="col-md-12">
                        <div align="right">
                            <a class="btn btn-success" href="http://<?php echo APP_HOST; ?>/vaga/listar">Voltar</a>
                            <button class="btn btn-info">Cadastrar</button>
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </section>

    <div id="modal-tecnologias" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ATENÇÃO</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-block alert-danger fade in" id="div-modal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>



</div>