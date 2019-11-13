<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet">
        <div class="kt-portlet__head"></div>
        <div class="col-md-6">
        <center>
            <h3>Excluir Notificacao</h3>
            </center>
            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/notificacao/excluir" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="codigo" id="codigo" value="<?php echo $viewVar['notificacao']->getNtf_cod(); ?>">

                <div class="panel panel-danger">
                    <div class="alert alert-warning" role="alert">
                    <h4><i class="flaticon-warning"></i> Deseja realmente excluir a notificacao: <?php echo $viewVar['notificacao']->getNtf_numero() ." Cliente ". $viewVar['notificacao']->getClienteLicitacao()->getRazaoSocial(); ?> </h4>
                    </div>
                    <div class="panel-footer"> 
                        <button type="submit" class="btn btn-danger btn-elevate btn-pill btn-elevate-air">Excluir</button>
                        <a href="http://<?php echo APP_HOST; ?>/notificacao" class="btn btn-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="kt-portlet__head"></div>
    </div>
</div>
</div>
