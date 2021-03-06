<!--begin::Portlet-->
<div class="container">
    <br>
    <center>
        <h3>Cadastro de Permissoes</h3>
    </center>
    <br>
    <div class="kt-portlet">
        <?php if ($Sessao::retornaErro()) { ?>
        <div class="alert alert-warning" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php foreach ($Sessao::retornaErro() as $key => $mensagem) { ?>
            <?php echo $mensagem; ?> <br>
            <?php } ?>
        </div>
        <?php } ?>

        <form id="frmCadastro" class="was-validated" action="http://<?php echo APP_HOST; ?>/permissao/salvar"
            method="post">
            <table class="table table-bordered table-striped table-condensed cf">
                <thead class="cf">
                    <tr>
                        <th>TELAS</th>
                        <th>VISUALISAR</th>
                        <th>CADASTRAR</th>
                        <th>ALTERAR</th>
                        <th>ECLUIR</th>
                        <th>IMPRIMIR</th>
                        <th>RELATORIO</th>
                        <th>NENHUM</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Usuario</td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1000"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                    </tr>
                    <tr>
                        <td>Pedido</td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="<?php echo '20' ?>"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                    </tr>
                    <tr>
                        <td>Estado</td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                    </tr>
                    <tr>
                        <td>Cidade</td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                    </tr>
                    <tr>
                        <td>Grupo5</td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                    </tr>
                    <tr>
                        <td>Grupo6</td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                    </tr>
                    <tr>
                        <td>Grupo7</td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                        <td><input type="checkbox" id="tabela[]" name="tabela[]" value="1"></td>
                    </tr>
                    <tr>
                        <td>Grupo8</td>
                        <td>
                            <div class="kt-radio-inline">
                                <label class="kt-radio kt-radio--solid " >
                                    <input type="radio" name="status" value="1" readonly="readonly" class="background-red"> S
                                    <span class="checkmark"></span>
                                </label>
                                <label class="kt-radio kt-radio--solid">
                                    <input type="radio" name="status" checked value="2" readonly="readonly"> N
                                    <span></span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="kt-radio-inline">
                                <label class="kt-radio kt-radio--solid " >
                                    <input type="radio" name="status" value="1" readonly="readonly" class="background-red"> S
                                    <span class="checkmark"></span>
                                </label>
                                <label class="kt-radio kt-radio--solid">
                                    <input type="radio" name="status" checked value="2" readonly="readonly"> N
                                    <span></span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="kt-radio-inline">
                                <label class="kt-radio kt-radio--solid " >
                                    <input type="radio" name="status" value="1" readonly="readonly" class="background-red"> S
                                    <span class="checkmark"></span>
                                </label>
                                <label class="kt-radio kt-radio--solid">
                                    <input type="radio" name="status" checked value="2" readonly="readonly"> N
                                    <span></span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="kt-radio-inline">
                                <label class="kt-radio kt-radio--solid " >
                                    <input type="radio" name="status" value="1" readonly="readonly" class="background-red"> S
                                    <span class="checkmark"></span>
                                </label>
                                <label class="kt-radio kt-radio--solid">
                                    <input type="radio" name="status" checked value="2" readonly="readonly"> N
                                    <span></span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="kt-radio-inline">
                                <label class="kt-radio kt-radio--solid " >
                                    <input type="radio" name="status" value="1" readonly="readonly" class="background-red"> S
                                    <span class="checkmark"></span>
                                </label>
                                <label class="kt-radio kt-radio--solid">
                                    <input type="radio" name="status" checked value="2" readonly="readonly"> N
                                    <span></span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="kt-radio-inline">
                                <label class="kt-radio kt-radio--solid " >
                                    <input type="radio" name="status" value="1" readonly="readonly" class="background-red"> S
                                    <span class="checkmark"></span>
                                </label>
                                <label class="kt-radio kt-radio--solid">
                                    <input type="radio" name="status" checked value="2" readonly="readonly"> N
                                    <span></span>
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="kt-radio-inline">
                                <label class="kt-radio kt-radio--solid " >
                                    <input type="radio" name="status" value="1" readonly="readonly" class="background-red"> S
                                    <span class="checkmark"></span>
                                </label>
                                <label class="kt-radio kt-radio--solid">
                                    <input type="radio" name="status" checked value="2" readonly="readonly"> N
                                    <span></span>
                                </label>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <div class="row">
                        <div class="col-lg-5"></div>
                        <div class="col-lg-5">
                            <button type="submit" id="andre" name="andre"
                                class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air">Button</button>
                            <input type="submit" id="submit" name="submit"
                                class="btn btn-outline-success btn-elevate btn-pill btn-elevate-air" value="Salvar">
                            <a href="http://<?php echo APP_HOST; ?>/permissao"
                                class="btn btn-outline-info btn-elevate btn-pill btn-elevate-air">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
</div>