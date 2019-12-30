<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\Entidades\Edital;
use App\Models\Entidades\EditalStatus;
use App\Models\Entidades\ClienteLicitacao;
use App\Models\Entidades\Representante;
use App\Models\Validacao\EditalValidador;
use App\Services\EditalService;
use App\Services\EditalStatusService;
use App\Services\RepresentanteService;
use App\Services\ClienteLicitacaoService;
use App\Services\ContratoService;
use App\Services\UsuarioService;
use App\Services\InstituicaoService;
use App\Services\NotificacaoService;

class EditalController extends Controller
{
    public function index($params)
    {
        $editalId                   = $params[0];
        $editalService              = new EditalService();
        $clienteLicitacaoService    = new ClienteLicitacaoService();
        $representanteService       = new RepresentanteService();
        $edital                     = new Edital();

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
        $editalStatusService     = new EditalStatusService();
        $editalStatus            = new EditalStatus();
        $representanteService    = new RepresentanteService();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $edital = new Edital();

        if(Sessao::existeFormulario()) {
     
        $editalStatusId = Sessao::retornaValorFormulario('cliente');
        $editalStatus = $editalStatusService->listar($editalStatusId)[0];
        $edital->setEditalStatus($editalStatus);
        
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
            $edital->setEditalStatus(new EditalStatus());
        }
        self::setViewParam('listarEditalStatus', $editalStatusService->listar($editalStatus)); 
        $this->setViewParam('edital',$edital);        
        $this->render('/edital/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $editalStatus           = new EditalStatus();
        $clienteLicitacaoService = new ClienteLicitacaoService();        
        $usuarioService          = new UsuarioService();        
        $editalStatusService     = new EditalStatusService();        
        $representanteService    = new RepresentanteService();        
        $instituicaoService      = new InstituicaoService();        
        $clienteLicitacao        = $clienteLicitacaoService->listar($_POST['cliente']);
        $usuario                 = $usuarioService->listar($_POST['edtUsuario']);
        $editalStatus->setStEdtId($_POST['status']);
        $status                  = $editalStatusService->listar($editalStatus)[0];
        $instituicao             = $instituicaoService->listar($_POST['fk_instituicao']);
        $representante           = $representanteService->listar($_POST['representante'])[0];

        $edital = new Edital();
        $edital->setEdtProposta($_POST['proposta']);        
        $edital->setEdtNumero($_POST['numeroLicitacao']);        
        $edital->setEdtValor(str_replace(',','.', str_replace(".", "", $_POST['valor'])));      
        $edital->setEdtModalidade($_POST['modalidade']);        
       // $edital->setEdtStatus($_POST['status']);        
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
        $edital->setEditalStatus($status);

        Sessao::gravaFormulario($_POST);

        $editalValidador    = new EditalValidador();
        $resultadoValidacao = $editalValidador->validar($edital);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
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
        $editalStatus            = new EditalStatus();
        $editalId                = $params[0];
        $representanteService    = new RepresentanteService();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $edital = new Edital();
        
        
        if(Sessao::existeFormulario()) { 
            $clienteId        = Sessao::retornaValorFormulario('cliente');
            $clienteLicitacao = $clienteLicitacaoService->listar($clienteId)[0];
            $edital->setClienteLicitacao($clienteLicitacao);
            
            $representanteId = Sessao::retornaValorFormulario('codRepresentante');
            $representante = $representanteService->listar($representanteId)[0];
            $edital->setRepresentante($representante);

            $editalStatus->setStEdtId($_POST['status']);
            $status    = $editalStatusService->listar($editalStatus)[0];
            
        }else{                       
            $editalService = new EditalService();
            $edital        = $editalService->listar($editalId)[0]; 
        }        
        self::setViewParam('listarRepresentantes', $representanteService->listar());            
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
        $editalStatus = new EditalStatus();
        $editalStatusService     = new EditalStatusService();    
        $clienteLicitacaoService  = new ClienteLicitacaoService();        
        $usuarioService          = new UsuarioService();        
        $representanteService    = new RepresentanteService();        
        $instituicaoService      = new InstituicaoService();        
        $clienteLicitacao        = $clienteLicitacaoService->listar($_POST['cliente']);
        $editalStatus->setStEdtId($_POST['status']);
        $status                  = $editalStatusService->listar($editalStatus)[0];
        $usuario                 = $usuarioService->listar($_POST['edtUsuario']);
        $instituicao             =   $instituicaoService->listar($_POST['fk_instituicao']);
        $representante           = $representanteService->listar($_POST['representante'])[0];
       
        $edital->setEdtId($_POST['codigo']);        
        $edital->setEdtProposta($_POST['proposta']);        
        $edital->setEdtNumero($_POST['numeroLicitacao']);        
        $edital->setEdtValor(str_replace(',','.', str_replace(".", "", $_POST['valor'])));      
        $edital->setEdtModalidade($_POST['modalidade']);        
       //$edital->setEdtStatus($_POST['status']);        
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
        $edital->setEditalStatus($status);

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
        $editalId           = $params[0];

        $editalService      = new EditalService();
        $contratoService    = new ContratoService();
        $notificacaoService = new NotificacaoService();

        $edital      = $editalService->listar($editalId)[0];
        $contrato    = $contratoService->qtdeContratoPorEdital($editalId);
        $notificacao = $notificacaoService->qtdeNotificacaoPorEdital($editalId);

        if (!$edital) {
        Sessao::gravaMensagem("Cadastro inexistente!");
            $this->redirect('/edital');
        }
        if($notificacao){
            $notificacao = $notificacao->getNtf_numero();
            self::setViewParam('notificacao', $notificacao);               
        }else{
            $notificacao = "";               
            self::setViewParam('notificacao', $notificacao);
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
