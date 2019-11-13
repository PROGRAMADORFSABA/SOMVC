<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet">
        <div class="kt-portlet__head"></div>
        <div class="col-md-6">
        <center>
            <h3>Excluir Contrato</h3>
            </center>
            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/contrato/excluir" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="codigo" id="codigo" value="<?php echo $viewVar['contrato']->getCtrId(); ?>">

                <div class="panel panel-danger">
                    <div class="alert alert-warning" role="alert">
                    <?php
                            $notificacao = $viewVar['notificacao'];
                            if ($notificacao) {
                              $notificacao = " - $notificacao "." <a id='teste' target='blank' href=http://". APP_HOST."/notificacao/listarPorEdital/".$viewVar['contrato']->getEdital()->getEdtId()." title='Clique aqui pra detalhes' >notificacoes</a>";
                                
                            } else {
                                $notificacao = "";
                            }
                        ?>
                    <h4><i class="flaticon-warning"></i> Deseja realmente excluir o contrato: <?php echo $viewVar['contrato']->getCtrNumero() ." Cliente ". $viewVar['contrato']->getClienteLicitacao()->getRazaoSocial(). " ".$notificacao; ; ?> </h4>
                    </div>
                    <div class="panel-footer"> 
                        <button type="submit" class="btn btn-danger btn-elevate btn-pill btn-elevate-air">Excluir</button>
                        <a href="http://<?php echo APP_HOST; ?>/contrato" class="btn btn-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="kt-portlet__head"></div>
    </div>
</div>
</div>
