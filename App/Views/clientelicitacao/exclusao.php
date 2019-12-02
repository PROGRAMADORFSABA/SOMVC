<div class="container">
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet">
            <div class="kt-portlet__head"></div>          
            <center><h3>Excluir Cliente</h3> </center>
                <?php if($Sessao::retornaErro()){ ?>
                    <div class="alert alert-warning" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                            <?php echo $mensagem; ?> <br>
                        <?php } ?>
                    </div>
                <?php } ?>
                <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/clienteLicitacao/excluir" method="post" id="form_cadastro">
                    <input type="hidden" class="form-control" name="codCliente" id="codCliente" value="<?php echo $viewVar['clienteLicitacao']->getCodCliente(); ?>">
                    <div class="kt-portlet__body">
                        <div class="alert alert-warning" role="alert">
                        <h4><i class="flaticon-warning"></i> Deseja realmente excluir a Cliente: <?php echo $viewVar['clienteLicitacao']->getRazaoSocial(); ?> ?</h4>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-8">
                                        <button type="submit" class="btn btn-danger btn-elevate btn-pill btn-elevate-air">Excluir</button>
                                        <a href="http://<?php echo APP_HOST; ?>/ClienteLicitacao" class="btn btn-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                                    </div>
                                </div>
                            </div>
                        </div>                                          
                    </div>
                </form>
        </div>
    </div>
</div>
</div>

