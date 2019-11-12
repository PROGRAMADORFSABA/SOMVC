<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet">
        <div class="kt-portlet__head"></div>
        <div class="col-md-6">
        <center>
            <h3>Excluir Edital</h3>
            </center>
            <?php if($Sessao::retornaErro()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php foreach($Sessao::retornaErro() as $key => $mensagem){ ?>
                        <?php echo $mensagem; ?> <br>
                    <?php } ?>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/edital/excluir" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="codigo" id="codigo" value="<?php echo $viewVar['edital']->getEdtId(); ?>">

                <div class="panel panel-danger">
                    <div class="alert alert-warning" role="alert">
                        <?php
                            $contrato = $viewVar['contrato'];
                            if ($contrato) {
                              $contrato = " - $contrato "." <a id='teste' target='blank' href=http://". APP_HOST."/contrato/listarPorEdital/".$viewVar['edital']->getEdtId()." title='Clique aqui pra detalhes' >Contratos</a>";
                            } else {
                                $contrato = "";
                            }
                            $notificacao = $viewVar['notificacao'];
                            if ($notificacao) {
                              $notificacao = " - $notificacao "." <a id='teste' target='blank' href=http://". APP_HOST."/notificacao/listarPorEdital/".$viewVar['edital']->getEdtId()." title='Clique aqui pra detalhes' >notificacoes</a>";
                                
                            } else {
                                $notificacao = "";
                            }
                        ?>
                    <h4><i class="flaticon-warning"></i> Deseja realmente excluir o edital: <?php echo $viewVar['edital']->getEdtNumero() ." Cliente ". $viewVar['edital']->getClienteLicitacao()->getRazaoSocial(). "  ".$contrato. " ".$notificacao; ?> </h4>
                    </div>                    
                    <div class="panel-footer"> 
                        <button type="submit" class="btn btn-danger btn-elevate btn-pill btn-elevate-air">Excluir</button>
                        <a href="http://<?php echo APP_HOST; ?>/edital" class="btn btn-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="kt-portlet__head"></div>
    </div>
</div>
</div>
