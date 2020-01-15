<!--begin::Portlet-->
<div class="container">
    <?php if ($Sessao::retornaErro()) { ?>
    <div class="alert alert-warning" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
        <?php echo $mensagem; ?> 
        <?php } ?>
    </div>
    <?php } ?>
    <!--begin::Form-->
                <h2 class="display-4 text-center" ">Contato</h2>
                <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/xxxx/xxxx" method="post" id="form_cadastro" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nome</label>
                            <input type="text" class="form-control" placeholder="Nome completo">
                        </div>
                        <div class="form-group col-md-6">
                            <label>E-mail</label>
                            <input type="email" class="form-control" placeholder="Seu Melhor E-mail">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Assunto</label>
                        <input type="text" class="form-control" placeholder="Assunto da mensagem">
                    </div>
                    <div class="form-group">
                        <label>Mensagem</label>
                        <textarea class="form-control" rows="6"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Enviar</button>
                </form>
    <!--end::Form-->
</div>
<!--end::Portlet-->

<!-- footer -->
</div>