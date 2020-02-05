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
        <form class="kt-form kt-form--label-right">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <div class="kt-form__actions">
                        <div class="col-lg-3"></div>
                        <button type="submit" name="builder_submit" data-demo="demo1" class="btn btn-brand">
                            <i class="la la-eye"></i>
                            Preview
                        </button>&nbsp;
                        <button type="submit" id="builder_export" data-demo="demo1" class="btn btn-success">
                            <i class="la la-download"></i>
                            Export
                        </button>&nbsp;
                        <button type="submit" name="builder_reset" data-demo="demo1" class="btn btn-secondary">
                            <i class="la la-recycle"></i>
                            Reset
                        </button>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane  active" id="kt_builder_principal">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-8">
                                    <label for="razaosocial">Razão Social:</label>
                                    <input type="text" id="razaosocial" name="razaosocial" class="form-control"
                                        placeholder="Entre com Razão Social">
                                    <span class="form-text text-muted">Favor informar Razão Social</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="nomefantasia">Nome Fantasia:</label>
                                    <input type="text" id="nomefantasia" name="nomefantasia" class="form-control"
                                        placeholder="Entre com Nome Fantasia">
                                    <span class="form-text text-muted">Favor informar Nome Fantasia</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label class="" for="cnpj">CNPJ:</label>
                                    <input type="text" id="cnpj" name="cnpj" class="form-control"
                                        placeholder="Entre com CNPJ">
                                    <span class="form-text text-muted">Favor informar CNPJ</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="inscricaoestadual">Insc. Estadual:</label>
                                    <input type="text" id="inscricaoestadual" name="inscricaoestadual"
                                        class="form-control" placeholder="Insc. Estadual">
                                    <span class="form-text text-muted">Favor informar Insc. Estadual</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="" for="email">Email:</label>
                                    <input type="email" id="email" name="email" class="form-control"
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
                                        <input type="text" id="contato" name="contato" class="form-control"
                                            placeholder="Entre com contato">
                                    </div>
                                    <span class="form-text text-muted">Favor informar contato</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="" for="telefone">Telefone:</label>
                                    <input type="text" id="telefone" name="telefone" class="form-control"
                                        placeholder="Entre com telefone">
                                    <span class="form-text text-muted">Favor informar telefone</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="" for="celular">Celular:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="celular" name="celular" class="form-control"
                                            placeholder="Entre com celular">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-info-circle"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar celular</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-8">
                                    <label for="endereco">Endereco:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="endereco" name="endereco" class="form-control"
                                            placeholder="Entre com endereco">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-map-marker"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar endereco</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="numero">Numero:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="number" id="numero" name="numero" class="form-control"
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
                                        <input type="text" id="bairro" name="bairro" class="form-control"
                                            placeholder="Entre com bairro">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-bookmark-o"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar bairro</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="cidade" class="">Cidade:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="cidade" name="cidade" class="form-control"
                                            placeholder="Entre com cidade">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-bookmark-o"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar cidade</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Status:</label>
                                    <div class="kt-radio-inline">
                                        <label for="status" class="kt-radio kt-radio--solid">
                                            <input type="radio" name="status" checked value="2"> Ativo
                                            <span></span>
                                        </label>
                                        <label class="kt-radio kt-radio--solid">
                                            <input type="radio" name="status" value="2"> Inativo
                                            <span></span>
                                        </label>
                                    </div>
                                    <span class="form-text text-muted">Favor informar status</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="kt_builder_endereco">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-8">
                                    <label for="endereco">Endereco:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="endereco" name="endereco" class="form-control"
                                            placeholder="Entre com endereco">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-map-marker"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar endereco</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="numero">Numero:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="number" id="numero" name="numero" class="form-control"
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
                                        <input type="text" id="bairro" name="bairro" class="form-control"
                                            placeholder="Entre com bairro">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-bookmark-o"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar bairro</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for="cidade" class="">Cidade:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="cidade" name="cidade" class="form-control"
                                            placeholder="Entre com cidade">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-bookmark-o"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar cidade</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Status:</label>
                                    <div class="kt-radio-inline">
                                        <label for="status" class="kt-radio kt-radio--solid">
                                            <input type="radio" name="status" checked value="2"> Ativo
                                            <span></span>
                                        </label>
                                        <label class="kt-radio kt-radio--solid">
                                            <input type="radio" name="status" value="2"> Inativo
                                            <span></span>
                                        </label>
                                    </div>
                                    <span class="form-text text-muted">Favor informar status</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="kt_builder_contato">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label for="contato">Contato:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                    class="la la-user"></i></span></div>
                                        <input type="text" id="contato" name="contato" class="form-control"
                                            placeholder="Entre com contato">
                                    </div>
                                    <span class="form-text text-muted">Favor informar contato</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="" for="telefone">Telefone:</label>
                                    <input type="text" id="telefone" name="telefone" class="form-control"
                                        placeholder="Entre com telefone">
                                    <span class="form-text text-muted">Favor informar telefone</span>
                                </div>
                                <div class="col-lg-4">
                                    <label class="" for="celular">Celular:</label>
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text" id="celular" name="celular" class="form-control"
                                            placeholder="Entre com celular">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i
                                                    class="la la-info-circle"></i></span></span>
                                    </div>
                                    <span class="form-text text-muted">Favor informar celular</span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label class="">Status:</label>
                                <div class="kt-radio-inline">
                                    <label for="status" class="kt-radio kt-radio--solid">
                                        <input type="radio" name="status" checked value="2"> Ativo
                                        <span></span>
                                    </label>
                                    <label class="kt-radio kt-radio--solid">
                                        <input type="radio" name="status" value="2"> Inativo
                                        <span></span>
                                    </label>
                                </div>
                                <span class="form-text text-muted">Favor informar status</span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="kt_builder_observacao">
                        <div class="kt-portlet__body">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label for="observacao">Observacao:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"></div>
                                        <textarea type="text" id="observacao" rows="5" name="observacao" class="form-control"
                                            placeholder="Entre com observacao"></textarea>
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
                            <button type="reset" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Cancel</button>
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