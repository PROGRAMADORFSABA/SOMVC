<!--begin::Portlet-->
<div class="container">
    <br>
    <center>
        <h1>Cadastro</h1>
    </center>
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
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" action="http://<?php echo APP_HOST; ?>/desenvolvimento/logisticateste" method="post" id="form_cadastro"
        enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="fk_instituicao" id="fk_instituicao"
            value="<?php echo $_SESSION['inst_id']; ?>" required>
        <div class="kt-portlet__body">
            <div class="kt-portlet__body">
                <div class="form-group">
                    <label for="cadastroCliente" class="">Razao Social</label>
                    <a href="#" id="cadastroCliente" name="cadastroCliente"
                        class="btn btn-brand btn-elevate btn-pill btn-elevate-air">
                        <i class="la la-plus"></i>Novo Cliente</a>
                    <div>
                        <input type="text" name="cliente-Autocomplete" id="cliente-Autocomplete" class="form-control"
                            required placeholder="Cliente - autocomplete" value="<?php  ?>">
                        <input type="text" id="cliente" name="cliente" value=<?php   ?>>
                    </div>
                    <span class="form-text text-muted">Por favor insira o cliente do Contrato</span>
                </div>
                <div class="form-group row">
                    <div class="col-lg-8">
                        <label for="transportadora">Transportadora:</label>
                        <input type="text" class="form-control" placeholder="Informe a transportadora"
                            id="transportadora" name="transportadora"
                            value="<?php $Sessao::retornaValorFormulario('transportadora');?>" required>
                        <span class="form-text text-muted">Informe a Transportadora</span>
                    </div>
                    <div class="col-lg-4">
                        <label for="cnpj">CNPJ:</label>
                        <input type="text" class="form-control" placeholder="Informe a cnpj" id="cnpj" name="cnpj"
                            value="<?php $Sessao::retornaValorFormulario('cnpj');?>" required>
                        <span class="form-text text-muted">Informe a Transportadora</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status"
                            value="<?php echo $Sessao::retornaValorFormulario('status'); ?>" required>
                            <option value="">Selecione o Status</option>
                            <option value="COLETADO">COLETADO</option>
                            <option value="EM TRANSITO">EM TRANSITO</option>
                            <option value="OCORRENCIA">OCORRENCIA</option>
                            <option value="ENTREGUE">ENTREGUE</option>
                            <option value="DEVOLVIDO">DEVOLVIDO</option>
                        </select>
                        <span class="form-text text-muted">Por favor insira o Status</span>
                    </div>
                    <div class="col-lg-3">
                        <label for="dataRecebimento" class="">Data de Coleta:</label>
                        <input type="date" class="form-control" placeholder="Informe a Data Coleta" id="dataColeta"
                            name="dataColeta" value="<?php echo $Sessao::retornaValorFormulario('dataColeta'); ?>"
                            required>
                        <span class="form-text text-muted">Informe a Data Coleta</span>
                    </div>
                    <div class="col-lg-5">
                    
                        <label for="anexo" class="">Anexo:</label>
                        <input type="file" name="anexo" id="anexo"
                            value="<?php echo $Sessao::retornaValorFormulario('anexo'); ?>">
                        <span class="form-text text-muted">Selecione o arquivo</span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-7">
                        <label for="observacao" class="">Observacao da Entrega:</label>
                        <textarea class="form-control" rows="3" placeholder="Informe Observacao da Entrega"
                            id="observacao" name="observacao"
                            value="<?php echo $Sessao::retornaValorFormulario('observacao'); ?>"></textarea>
                        <span class="form-text text-muted">Informe a Observacao da Entrega</span>
                    </div>
                   
                </div>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label for="numeroPedido">Numero do Pedido</label>
                        <input type="text" class="form-control" placeholder="Informe o numero do pedido"
                            id="numeroPedido" name="numeroPedido"
                            value="<?php $Sessao::retornaValorFormulario('numeroPedido');?>" >
                        <span class="form-text text-muted">Informe numero do pedido</span>
                    </div>
                    <div class="col-lg-3">
                        <label for="numeroNota">Numero da Nota fiscal</label>
                        <input type="text" class="form-control" placeholder="Informe o numero da Nota fiscal"
                            id="numeroNota" name="numeroNota"
                            value="<?php $Sessao::retornaValorFormulario('numeroNota');?>" >
                        <span class="form-text text-muted">Informe numero da Nota fiscal</span>
                    </div>
                    <div class="col-lg-3">
                        <label for="valor" class="">Valor:</label>
                        <input type="text" class="form-control" placeholder="Informe o valor" id="valor" name="valor"
                        value="<?php echo $Sessao::retornaValorFormulario('valor'); ?>">
                        <span class="form-text text-muted">Informe o valor</span>
                    </div>
                    <div class="col-lg-2">
                            <label for="btnAdicionarPedido" class="">Adicionar Pedidos:</label>
                        <a class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air form-control"
                            id="btnAdicionarPedido">Adicionar</a>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_3">
                    <thead>
                        <tr>
                            <th>PEDIDO</th>
                            <th>NOTA FISCAL</th>
                            <th>VALOR</th>
                            <th>Acoes</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>PEDIDO</th>
                            <th>NOTA FISCAL</th>
                            <th>VALOR</th>
                            <th>Acoes</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <tr>
                            <td>123456</td>
                            <td>25900</td>
                            <td>R$9.900,00</td>
                            <td>
                                <a href="#" title="Editar" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                        class="la la-edit"></i></a>
                                <a href="" title="Excluir" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                        class="la la-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>123457</td>
                            <td>25901</td>
                            <td>R$25.900,00</td>
                            <td>
                                <a href="#" title="Editar" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                        class="la la-edit"></i></a>
                                <a href="#" title="Excluir" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i
                                        class="la la-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>123458</td>
                            <td>25902</td>
                            <td>R$900,00</td>
                            <td>
                                <a href="#" title="Editar" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-edit"></i></a>
                                <a href="" title="Excluir" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="hidden" value="" name="pedidos[]"></td>                            
                        </tr>
                    </tbody>
                </table>
                <!--end: Datatable -->
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-8">
                            <button type="submit"
                                class="btn btn-success btn-elevate btn-pill btn-elevate-air">Gravar</button>
                            <a href="#" class="btn btn-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
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