<!--begin::Portlet-->
<div class="kt-portlet kt-portlet--tabs">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">

            <h1 class="kt-portlet__head-title">
                TESTE FORMULARIO COM ABAS
            </h1>
        </div>
    </div>
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-toolbar">
            <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-left nav-tabs-line-primary"
                role="tablist">
                <li class="nav-item">
                    <a class="nav-link  active" data-toggle="tab" href="#kt_builder_skins" role="tab">
                        Skins
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#kt_builder_teste" role="tab">
                        teste
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#kt_builder_page" role="tab">
                        Page
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#kt_builder_header" role="tab">
                        Header
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#kt_builder_topbar" role="tab">
                        Topbar
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#kt_builder_subheader" role="tab">
                        Subheader
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#kt_builder_content" role="tab">
                        Content
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#kt_builder_aside" role="tab">
                        Aside
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#kt_builder_footer" role="tab">
                        Footer
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <!--begin::Form-->
    <form class="kt-form kt-form--label-right" action="" method="POST">
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
                <div class="tab-pane  active" id="kt_builder_skins">
                    <div class="kt-section kt-margin-t-30">
                        <div class="kt-section__body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Header Skin:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control" name="builder[layout][header][self][skin]">
                                        <option value="light" selected>Light(default)</option>
                                        <option value="dark">Dark</option>
                                    </select>
                                    <div class="form-text text-muted">Select header skin</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Header Menu Skin:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control"
                                        name="builder[layout][header][menu][desktop][submenu][skin]">
                                        <option value="light" selected>Light(default)</option>
                                        <option value="dark">Dark</option>
                                    </select>
                                    <div class="form-text text-muted">Select header skin</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Logo Bar Skin:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control" name="builder[layout][brand][self][skin]">
                                        <option value="dark" selected>Dark(default)</option>
                                        <option value="light">Light</option>
                                    </select>
                                    <div class="form-text text-muted">Select logo bar skin</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Aside Skin:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control" name="builder[layout][aside][self][skin]">
                                        <option value="dark" selected>Dark(default)</option>
                                        <option value="light">Light</option>
                                    </select>
                                    <div class="form-text text-muted">Select left aside skin</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane " id="kt_builder_teste">
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
                                <input type="text" id="inscricaoestadual" name="inscricaoestadual" class="form-control"
                                    placeholder="Insc. Estadual">
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
                <div class="tab-pane " id="kt_builder_page">
                    <div class="kt-section kt-margin-t-30">
                        <div class="kt-section__body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Page Loader:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control" name="builder[layout][loader][type]">
                                        <option value="" selected>Disabled</option>
                                        <option value="default">Spinner</option>
                                        <option value="spinner-message">Spinner & Message</option>
                                        <option value="spinner-logo">Spinner & Logo</option>
                                    </select>
                                    <div class="form-text text-muted">Select page loading indicator</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Display Page Toolbar:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="hidden" name="builder[layout][toolbar][display]" value="false">
                                    <span class="kt-switch kt-switch--icon-check">
                                        <label>
                                            <input type="checkbox" name="builder[layout][toolbar][display]" value="true"
                                                checked />
                                            <span></span>
                                        </label>
                                    </span>
                                    <div class="form-text text-muted">Display or hide the page's right center
                                        toolbar(demos switcher, documentation and page builder links)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane " id="kt_builder_header">
                    <div class="kt-section kt-margin-t-30">
                        <div class="kt-section__body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Desktop Fixed Header:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="hidden" name="builder[layout][header][self][fixed][desktop]"
                                        value="false">
                                    <span class="kt-switch kt-switch--icon-check">
                                        <label>
                                            <input type="checkbox" name="builder[layout][header][self][fixed][desktop]"
                                                value="true" checked />
                                            <span></span>
                                        </label>
                                    </span>
                                    <div class="form-text text-muted">Enable fixed header for desktop mode</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Mobile Fixed Header:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="hidden" name="builder[layout][header][self][fixed][mobile]"
                                        value="false">
                                    <span class="kt-switch kt-switch--icon-check">
                                        <label>
                                            <input type="checkbox" name="builder[layout][header][self][fixed][mobile]"
                                                value="true" checked />
                                            <span></span>
                                        </label>
                                    </span>
                                    <div class="form-text text-muted">Enable fixed header for mobile mode</div>
                                </div>
                            </div>

                            <div class="kt-separator kt-separator--space-lg kt-separator--border-dashed"></div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Display Header Menu:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="hidden" name="builder[layout][header][menu][self][display]"
                                        value="false">
                                    <span class="kt-switch kt-switch--icon-check">
                                        <label>
                                            <input type="checkbox" name="builder[layout][header][menu][self][display]"
                                                value="true" checked />
                                            <span></span>
                                        </label>
                                    </span>
                                    <div class="form-text text-muted">Display header menu</div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Header Menu Layout:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control" name="builder[layout][header][menu][self][layout]">
                                        <option value="default" selected>Default</option>
                                        <option value="tab">Tab</option>
                                    </select>
                                    <div class="form-text text-muted">Select header menu layout style</div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Header Menu Arrows:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="hidden" name="builder[layout][header][menu][self][root-arrow]"
                                        value="false">
                                    <span class="kt-switch kt-switch--icon-check">
                                        <label>
                                            <input type="checkbox"
                                                name="builder[layout][header][menu][self][root-arrow]" value="true" />
                                            <span></span>
                                        </label>
                                    </span>
                                    <div class="form-text text-muted">Enable header menu root link arrows</div>
                                </div>
                            </div>

                            <div class="kt-separator kt-separator--space-lg kt-separator--border-dashed"></div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Header Search Layout:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control" name="builder[layout][header][topbar][search][layout]">
                                        <option value="offcanvas">Offcanvas</option>
                                        <option value="dropdown" selected>Dropdown</option>
                                    </select>
                                    <div class="form-text text-muted">Select header menu layout style</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane " id="kt_builder_subheader">
                    <div class="kt-section kt-margin-t-30">
                        <div class="kt-section__body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Display Subheader:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="hidden" name="builder[layout][subheader][display]" value="false">
                                    <span class="kt-switch kt-switch--icon-check">
                                        <label>
                                            <input type="checkbox" name="builder[layout][subheader][display]"
                                                value="true" checked />
                                            <span></span>
                                        </label>
                                    </span>
                                    <div class="form-text text-muted">Display subheader</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Fixed Subheader:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <span class="kt-switch kt-switch--icon-check">
                                        <label>
                                            <input type="hidden" name="builder[layout][subheader][fixed]" value="false">
                                            <input type="checkbox" name="builder[layout][subheader][fixed]" value="true"
                                                checked />
                                            <span></span>
                                        </label>
                                    </span>
                                    <div class="form-text text-muted">Enable fixed(sticky) subheader. Requires
                                        <code>Solid</code> subheader style.</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Width:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control" name="builder[layout][subheader][width]">
                                        <option value="fluid" selected>Fluid</option>
                                        <option value="fixed">Fixed</option>
                                    </select>
                                    <div class="form-text text-muted">Select layout width type.</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Subheader Style:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control" name="builder[layout][subheader][style]">
                                        <option value="transparent">Transparent</option>
                                        <option value="solid" selected>Solid</option>
                                    </select>
                                    <div class="form-text text-muted">Select subheader style</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Subheader Layout:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control" name="builder[layout][subheader][layout]">
                                        <option value="subheader-v1" selected>Subheader v1</option>
                                        <option value="subheader-v2">Subheader v2</option>
                                        <option value="subheader-v3">Subheader v3</option>
                                        <option value="subheader-v4">Subheader v4</option>
                                    </select>
                                    <div class="form-text text-muted">Select subheader layout</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane " id="kt_builder_content">
                    <div class="kt-section kt-margin-t-30">
                        <div class="kt-section__body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Width:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control" name="builder[layout][content][width]">
                                        <option value="fluid" selected>Fluid</option>
                                        <option value="fixed">Fixed</option>
                                    </select>
                                    <div class="form-text text-muted">Select layout width type.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane " id="kt_builder_topbar">
                    <div class="kt-section kt-margin-t-30">
                        <div class="kt-section__body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Icons Style:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control" name="builder[layout][header][topbar][icon-style]">
                                        <option value="default">Default</option>
                                        <option value="duotone" selected>Duo-tone</option>
                                    </select>
                                    <div class="form-text text-muted">Select topbar icons style</div>
                                </div>
                            </div>

                            <div class="kt-separator kt-separator--space-lg kt-separator--border-dashed"></div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Display Search:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="hidden" name="builder[layout][header][topbar][search][display]"
                                        value="false">
                                    <span class="kt-switch kt-switch--icon-check">
                                        <label>
                                            <input type="checkbox"
                                                name="builder[layout][header][topbar][search][display]" value="true"
                                                checked />
                                            <span></span>
                                        </label>
                                    </span>
                                    <div class="form-text text-muted">Display topbar search</div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Search Layout:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control" name="builder[layout][header][topbar][search][layout]">
                                        <option value="offcanvas">Offcanvas</option>
                                        <option value="dropdown" selected>Dropdown</option>
                                    </select>
                                    <div class="form-text text-muted">Select topbar search layout style</div>
                                </div>
                            </div>

                            <div class="kt-separator kt-separator--space-lg kt-separator--border-dashed"></div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Display Notifications:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="hidden" name="builder[layout][header][topbar][notifications][display]"
                                        value="false">
                                    <span class="kt-switch kt-switch--icon-check">
                                        <label>
                                            <input type="checkbox"
                                                name="builder[layout][header][topbar][notifications][display]"
                                                value="true" checked />
                                            <span></span>
                                        </label>
                                    </span>
                                    <div class="form-text text-muted">Display topbar notifications</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Notifications Layout:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control"
                                        name="builder[layout][header][topbar][notifications][layout]">
                                        <option value="offcanvas">Offcanvas</option>
                                        <option value="dropdown" selected>Dropdown</option>
                                    </select>
                                    <div class="form-text text-muted">Select topbar notifications layout style</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Notifications Dropdown Style:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control"
                                        name="builder[layout][header][topbar][notifications][dropdown][style]">
                                        <option value="light">Light</option>
                                        <option value="dark" selected>Dark</option>
                                    </select>
                                    <div class="form-text text-muted">Select topbar notifications dropdown layout style
                                    </div>
                                </div>
                            </div>

                            <div class="kt-separator kt-separator--space-lg kt-separator--border-dashed"></div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Display Quick Actions:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="hidden" name="builder[layout][header][topbar][quick-actions][display]"
                                        value="false">
                                    <span class="kt-switch kt-switch--icon-check">
                                        <label>
                                            <input type="checkbox"
                                                name="builder[layout][header][topbar][quick-actions][display]"
                                                value="true" checked />
                                            <span></span>
                                        </label>
                                    </span>
                                    <div class="form-text text-muted">Display topbar quick actions</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Quick Actions Layout:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control"
                                        name="builder[layout][header][topbar][quick-actions][layout]">
                                        <option value="offcanvas">Offcanvas</option>
                                        <option value="dropdown" selected>Dropdown</option>
                                    </select>
                                    <div class="form-text text-muted">Select topbar quick actions layout style</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Quick Actions Dropdown Style:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control"
                                        name="builder[layout][header][topbar][quick-actions][dropdown][style]">
                                        <option value="light">Light</option>
                                        <option value="dark" selected>Dark</option>
                                    </select>
                                    <div class="form-text text-muted">Select topbar quick actions dropdown layout style
                                    </div>
                                </div>
                            </div>

                            <div class="kt-separator kt-separator--space-lg kt-separator--border-dashed"></div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Display User Panel:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="hidden" name="builder[layout][header][topbar][user][display]"
                                        value="false">
                                    <span class="kt-switch kt-switch--icon-check">
                                        <label>
                                            <input type="checkbox" name="builder[layout][header][topbar][user][display]"
                                                value="true" checked />
                                            <span></span>
                                        </label>
                                    </span>
                                    <div class="form-text text-muted">Display topbar user panel</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Topbar User Layout:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control" name="builder[layout][header][topbar][user][layout]">
                                        <option value="offcanvas">Offcanvas</option>
                                        <option value="dropdown" selected>Dropdown</option>
                                    </select>
                                    <div class="form-text text-muted">Select topbar user layout style</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">User Dropdown Style:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control"
                                        name="builder[layout][header][topbar][user][dropdown][style]">
                                        <option value="light">Light</option>
                                        <option value="dark" selected>Dark</option>
                                    </select>
                                    <div class="form-text text-muted">Select topbar user dropdown layout style</div>
                                </div>
                            </div>

                            <div class="kt-separator kt-separator--space-lg kt-separator--border-dashed"></div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Display Languages:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="hidden" name="builder[layout][header][topbar][languages][display]"
                                        value="false">
                                    <span class="kt-switch kt-switch--icon-check">
                                        <label>
                                            <input type="checkbox"
                                                name="builder[layout][header][topbar][languages][display]" value="true"
                                                checked />
                                            <span></span>
                                        </label>
                                    </span>
                                    <div class="form-text text-muted">Display topbar languages</div>
                                </div>
                            </div>

                            <div class="kt-separator kt-separator--space-lg kt-separator--border-dashed"></div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Display Quick Panel:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="hidden" name="builder[layout][header][topbar][quick-panel][display]"
                                        value="false">
                                    <span class="kt-switch kt-switch--icon-check">
                                        <label>
                                            <input type="checkbox"
                                                name="builder[layout][header][topbar][quick-panel][display]"
                                                value="true" checked />
                                            <span></span>
                                        </label>
                                    </span>
                                    <div class="form-text text-muted">Display topbar quick panel</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane " id="kt_builder_aside">
                    <div class="kt-section kt-margin-t-30">
                        <div class="kt-section__body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Display:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <span class="kt-switch kt-switch--icon-check">
                                        <input type="hidden" name="builder[layout][aside][self][display]" value="false">
                                        <label>
                                            <input type="checkbox" name="builder[layout][aside][self][display]"
                                                value="true" checked />
                                            <span></span>
                                        </label>
                                    </span>
                                    <div class="form-text text-muted">Display aside</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Fixed:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="hidden" name="builder[layout][aside][self][fixed]" value="false">
                                    <span class="kt-switch kt-switch--icon-check">
                                        <label>
                                            <input type="checkbox" name="builder[layout][aside][self][fixed]"
                                                value="true" checked />
                                            <span></span>
                                        </label>
                                    </span>
                                    <div class="form-text text-muted">Set fixed aside layout</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Enable Minimize:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="hidden" name="builder[layout][aside][self][minimize][toggle]"
                                        value="false">
                                    <span class="kt-switch kt-switch--icon-check">
                                        <label>
                                            <input type="checkbox" name="builder[layout][aside][self][minimize][toggle]"
                                                value="true" checked />
                                            <span></span>
                                        </label>
                                    </span>
                                    <div class="form-text text-muted">Allow aside minimizing</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Default Minimize:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="hidden" name="builder[layout][aside][self][minimize][default]"
                                        value="false">
                                    <span class="kt-switch kt-switch--icon-check">
                                        <label>
                                            <input type="checkbox"
                                                name="builder[layout][aside][self][minimize][default]" value="true" />
                                            <span></span>
                                        </label>
                                    </span>
                                    <div class="form-text text-muted">Set aside minimized by default</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Menu Icon Style:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control" name="builder[layout][aside][menu][icon-style]">
                                        <option value="line">Line</option>
                                        <option value="bold">Bold</option>
                                        <option value="solid">Solid</option>
                                        <option value="duotone" selected>Duo-tone</option>
                                    </select>
                                    <div class="form-text text-muted">Select aside menu icon style</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Submenu Toggle:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control" name="builder[layout][aside][menu][dropdown]">
                                        <option value="true">Dropdown</option>
                                        <option value="false" selected>Accordion</option>
                                    </select>
                                    <div class="form-text text-muted">Select submenu toggle mode(works only when
                                        <code>Fixed Mode</code> is disabled)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane " id="kt_builder_footer">
                    <div class="kt-section kt-margin-t-30">
                        <div class="kt-section__body">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Fixed Footer:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <span class="kt-switch kt-switch--icon-check">
                                        <input type="hidden" name="builder[layout][footer][self][fixed]" value="false">
                                        <label>
                                            <input type="checkbox" name="builder[layout][footer][self][fixed]"
                                                value="true" />
                                            <span></span>
                                        </label>
                                    </span>
                                    <div class="form-text text-muted">Set fixed footer</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Width:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-control" name="builder[layout][footer][self][width]">
                                        <option value="fluid" selected>Fluid</option>
                                        <option value="fixed">Fixed</option>
                                    </select>
                                    <div class="form-text text-muted">Select layout width type.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-9">
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
        </div>
    </form>
    <!--end::Form-->
</div>
<!--end::Portlet-->