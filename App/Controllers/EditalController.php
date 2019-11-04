<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\Entidades\Edital;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\ClienteLicitacao;
use App\Models\Entidades\Contrato;
use App\Models\Entidades\Representante;
use App\Models\Validacao\EditalValidador;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Estado;
use App\Services\EditalService;
use App\Services\RepresentanteService;
use App\Services\ClienteLicitacaoService;
use App\Services\ContratoService;
use App\Services\UsuarioService;
use App\Services\InstituicaoService;


class EditalController extends Controller
{
    public function index($params)
    {
        $editalId = $params[0];
        $editalService = new EditalService();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $representanteService = new RepresentanteService();
        $edital = new Edital();

        self::setViewParam('listaClientes', $editalService->listar($editalId));
        
        //self::setViewParam('listaClientes', $clienteLicitacaoService->listar());
        self::setViewParam('listarRepresentantes', $editalService->listarRepresentanteEdital());
        
       if($_POST){
           $edital->setEdtCliente($_POST['codCliente']);           
           $edital->setEdtId($_POST['codigo']);        
           $edital->setEdtProposta($_POST['proposta']);        
           $edital->setEdtNumero($_POST['numeroLicitacao']);              
           $edital->setEdtModalidade($_POST['modalidade']);        
           $edital->setEdtStatus($_POST['status']);        
           $edital->setEdtTipo($_POST['tipo']);  
           $edital->setEdtRepresentante($_POST['codRepresentante']); 
        }
        
        self::setViewParam('listaEditais', $editalService->listarDinamico($edital));
        $this->render('/edital/index');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
    }

    public function autoComplete($params)
    {
        $edital = new Edital();
        $edital->CidNome($params[0]);        
        $editalService = new EditalService();
        $busca = $editalService->autoComplete($edital);
        
        echo $busca;
    }

    public function cadastro()
    {
        
        $representanteService = new RepresentanteService();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $edital = new Edital();

        if(Sessao::existeFormulario()) { 
     
        $clienteId = Sessao::retornaValorFormulario('cliente');
        $clienteLicitacao = $clienteLicitacaoService->listar($clienteId)[0];
        $edital->setClienteLicitacao($clienteLicitacao);
       
        $representanteId = Sessao::retornaValorFormulario('representante');
        $representante = $representanteService->listar($representanteId)[0];
        $edital->setRepresentante($representante);
        }else{    
        self::setViewParam('listarRepresentantes', $representanteService->listar());                 
            $edital->setClienteLicitacao(new ClienteLicitacao());
            $edital->setRepresentante(new Representante());
        }
        $this->setViewParam('edital',$edital);        
        $this->render('/edital/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $clienteLicitacaoService  = new ClienteLicitacaoService();        
        $usuarioService = new UsuarioService();        
        $representanteService = new RepresentanteService();        
        $instituicaoService = new InstituicaoService();        
        $clienteLicitacao         = $clienteLicitacaoService->listar($_POST['cliente']);
        $usuario        = $usuarioService->listar($_POST['edtUsuario']);
        $instituicao     =   $instituicaoService->listar($_POST['fk_instituicao']);
        $representante    = $representanteService->listar($_POST['representante'])[0];

        $edital = new Edital();
        $edital->setEdtProposta($_POST['proposta']);        
        $edital->setEdtNumero($_POST['numeroLicitacao']);        
        $edital->setEdtValor(str_replace(',','.', str_replace(".", "", $_POST['valor'])));      
        $edital->setEdtModalidade($_POST['modalidade']);        
        $edital->setEdtStatus($_POST['status']);        
        $edital->setEdtTipo($_POST['tipo']);        
        $edital->setEdtHora($_POST['hora']);        
        $edital->setEdtDataAlteracao($_POST['dataAbertura']);        
        $edital->setEdtDataCadastro($_POST['dataCadastro']);        
        $edital->setEdtDataAlteracao($_POST['dataAlteracao']);        
        $edital->setEdtDataResultado($_POST['dataResultado']);        
        $edital->setEdtGarantia($_POST['garantia']);        
        $edital->setEdtAnalise($_POST['analise']);        
        $edital->setEdtAnexo($_POST['anexo']);        
        $edital->setEdtObservacao($_POST['observacao']);        
        $edital->setClienteLicitacao($clienteLicitacao);
        $edital->setInstituicao($instituicao);
        $edital->setRepresentante($representante);
        $edital->setUsuario($usuario);

        Sessao::gravaFormulario($_POST);

        $editalValidador    = new EditalValidador();
        $resultadoValidacao = $editalValidador->validar($edital);

        if ($resultadoValidacao->getErros()) {
           $this->redirect('/edital/cadastro');
        }

        $editalService = new EditalService();
    
       if($editalService->salvar($edital)){
            $this->redirect('/edital');
        }else{
            $this->redirect('/edital/cadastro');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function edicao($params)
    {
        $editalId = $params[0];
        $representanteService = new RepresentanteService();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $edital = new Edital();
        
        if(Sessao::existeFormulario()) { 
            $clienteId = Sessao::retornaValorFormulario('cliente');
            $clienteLicitacao = $clienteLicitacaoService->listar($clienteId)[0];
            $edital->setClienteLicitacao($clienteLicitacao);
            
            $representanteId = Sessao::retornaValorFormulario('codRepresentante');
            $representante = $representanteService->listar($representanteId)[0];
            $edital->setRepresentante($representante);
            
        }else{                       
            self::setViewParam('listarRepresentantes', $representanteService->listar());            
            $editalService = new EditalService();
            $edital = $editalService->listar($editalId)[0]; 
        }        
        if (!$edital) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/edital');
        }
            
       $this->setViewParam('edital', $edital);
       
        $this->render('/edital/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar()
    {       
        $edital = new Edital();

        $clienteLicitacaoService  = new ClienteLicitacaoService();        
        $usuarioService = new UsuarioService();        
        $representanteService = new RepresentanteService();        
        $instituicaoService = new InstituicaoService();        
        $clienteLicitacao         = $clienteLicitacaoService->listar($_POST['cliente']);
        $usuario        = $usuarioService->listar($_POST['edtUsuario']);
        $instituicao     =   $instituicaoService->listar($_POST['fk_instituicao']);
        $representante    = $representanteService->listar($_POST['representante'])[0];

        $edital = new Edital();
        $edital->setEdtId($_POST['codigo']);        
        $edital->setEdtProposta($_POST['proposta']);        
        $edital->setEdtNumero($_POST['numeroLicitacao']);        
        $edital->setEdtValor(str_replace(',','.', str_replace(".", "", $_POST['valor'])));      
        $edital->setEdtModalidade($_POST['modalidade']);        
        $edital->setEdtStatus($_POST['status']);        
        $edital->setEdtTipo($_POST['tipo']);        
        $edital->setEdtHora($_POST['hora']);        
        $edital->setEdtDataAlteracao($_POST['dataAbertura']);        
        $edital->setEdtDataCadastro($_POST['dataCadastro']);        
        $edital->setEdtDataAlteracao($_POST['dataAlteracao']);        
        $edital->setEdtDataResultado($_POST['dataResultado']);        
        $edital->setEdtGarantia($_POST['garantia']);        
        $edital->setEdtAnalise($_POST['analise']); 
        $anexo =  $_POST['anexo'];
        if($anexo == ""){
            $edital->setEdtAnexo($_POST['anexoAlt']);                    
        } else{
            $edital->setEdtAnexo($_POST['anexo']);        
        }
        $edital->setEdtObservacao($_POST['observacao']);        
        $edital->setClienteLicitacao($clienteLicitacao);
        $edital->setInstituicao($instituicao);
        $edital->setRepresentante($representante);
        $edital->setUsuario($usuario);

        Sessao::gravaFormulario($_POST);

        $editalService = new EditalService();
    
        $editalValidador = new EditalValidador();
        $resultadoValidacao = $editalValidador->validar($edital);
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            Sessao::gravaMensagem("erro na atualizacao");
            Sessao::gravaFormulario($_POST);
           $this->redirect('/edital/edicao/' . $_POST['codigo']);
        }
        
         if ($editalService->Editar($edital)) {
            $this->redirect('/edital');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
           
        }else{
            Sessao::gravaFormulario($_POST);            
            Sessao::gravaMensagem("erro na atualizacao");
          $this->redirect('/edital/edicao/' . $_POST['codigo']);
        }

    }
    
    public function exclusao($params)
    {
        $editalId = $params[0];

        $editalService = new EditalService();
        $contratoService = new ContratoService();

        $edital = $editalService->listar($editalId)[0];
        $contrato = $contratoService->listarPorEdital($editalId)[0];

        if (!$edital) {
        Sessao::gravaMensagem("Edital inexistente");
            $this->redirect('/edital');
        }
        if($contrato){
            $contrato = $contrato->getCtrNumero();
            self::setViewParam('contrato', $contrato);               
        }else{
            $contrato = "";               
            self::setViewParam('contrato', $contrato);               
        }
        self::setViewParam('edital', $edital);           

       $this->render('/edital/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $edital = new Edital();
        $edital->setEdtId($_POST['codigo']);

        $editalService = new EditalService();        

        if (!$editalService->excluir($edital)) {
            Sessao::gravaMensagem("Edital inexistente");
            $this->redirect('/edital/exclusao'.$edital->getEdtId());
        }

        Sessao::gravaMensagem("Edital excluido com sucesso!");

        $this->redirect('/edital');
    }

}
