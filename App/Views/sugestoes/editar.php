<!--begin::Portlet-->
<div class="container">
    <br>
    <center><h3>Alteracao de Sugestoes</h3></center>
    <?php if ($Sessao::retornaErro()) { ?>
        <div class="alert alert-warning" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
                <?php echo $mensagem; ?> <br>
            <?php } ?>
        </div>
    <?php } ?>
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/sugestoes/atualizar" method="post" id="form_cadastro" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="dataCadastro" id="dataCadastro" value="<?php echo $dataAtual; ?>" required>
        <input type="hidden" class="form-control" name="instituicao" id="instituicao" value="<?php echo $_SESSION['inst_id']; ?>" required>
        <input type="hidden" class="form-control" id="usuario" name="usuario" value="<?php echo $_SESSION['id']; ?>" required>
        <input type="hidden" class="form-control" id="codigo" name="codigo" value="<?php echo $viewVar['sugestoes']->getSugId(); ?>"  required>
        <div class="kt-portlet__body">
            <div class="kt-portlet__body">                                     
            <div class="form-group row">
                    <div class="col-lg-3">
                                <div class="form-group"><label for="status">Status</label>
                                <select class="form-control" name="status" id="status" >
                                    <option value="">Selecione o Status</option>
                                    <option value="<?php echo $viewVar['sugestoes']->getSugStatus(); ?>" <?php echo ($viewVar['sugestoes']->getSugStatus() == $viewVar['sugestoes']->getSugStatus()) ? "selected" : ""; ?>>
                                    <?php echo $viewVar['sugestoes']->getSugStatus(); ?> </option>
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
                                <select class="form-control" name="tipo" id="tipo" >
                                    <option value="">Selecione o Tipo</option>
                                    <option value="<?php echo $viewVar['sugestoes']->getSugTipo(); ?>" <?php echo ($viewVar['sugestoes']->getSugTipo() == $viewVar['sugestoes']->getSugTipo()) ? "selected" : ""; ?>>
                                    <?php echo $viewVar['sugestoes']->getSugTipo(); ?> </option>
                                    <option value="CORRECAO">CORRECAO</option>
                                    <option value="DESENVOLVIMENTO">DESENVOLVIMENTO</option>
                                    <option value="OUTROS">OUTROS</option>                               
                                </select>
                                    <span class="form-text text-muted">Por favor insira o Tipo</span>
                                </div>
                    </div>
                    <div class="col-lg-2">
                        <label for="anexo" class="">Anexo:</label>
                        <input type="file" name="anexo" id="anexo" value="<?php echo $Sessao::retornaValorFormulario('anexo'); ?>">
                        <input type="hidden" name="anexoAlt" id="anexoAlt" value="<?php echo $viewVar['sugestoes']->getSugAnexo(); ?>">
                        <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/public/assets/media/anexos/<?php echo $viewVar['sugestoes']->getSugAnexo(); ?>" 
                        target="_blank" title="Click para Visualizar Anexo" class="btn btn-info btn-sm"><i class="la la-chain"></i> Anexo</a>
                        <span class="form-text text-muted">Selecione o arquivo</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label for="descricao" class="">descricao do sugestoes:</label>
                        <textarea class="form-control" rows="4" placeholder="Digite descricao do sugestoes" id="descricao" name="descricao" ><?php echo $viewVar['sugestoes']->getSugDescricao(); ?></textarea>
                        <span class="form-text text-muted">Digite descricao do sugestoes</span>
                    </div>
                </div>            
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-8">
                            <button type="submit" class="btn btn-primary btn-elevate btn-pill btn-elevate-air">Salvar</button>
                            <a href="http://<?php echo APP_HOST; ?>/sugestoes" class="btn btn-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
    <!--end::Form-->
</div>

<!--end::Portlet-->

<!-- footer -->

</div>