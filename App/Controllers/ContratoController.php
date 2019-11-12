<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\Validacao\ContratoValidador;
use App\Models\Entidades\Contrato;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Edital;
use App\Models\Entidades\Representante;
use App\Models\Entidades\ClienteLicitacao;
use App\Services\ContratoService;
use App\Services\UsuarioService;
use App\Services\EditalService;
use App\Services\InstituicaoService;
use App\Services\ClienteLicitacaoService;
use App\Services\RepresentanteService;
use App\Services\NotificacaoService;

class ContratoController extends Controller
{
    public function listarPorEdital($params)
    {
        $contratoService = new ContratoService();
        $contrato = new Contrato();
        $editalId = $params[0];
        if($contrato)
        {
           // $contrato->setEdital(new Edital());
            $contrato->setCodEdital($editalId);
           
            self::setViewParam('listaContratos', $contratoService->listarDinamico($contrato));
            $this->render('/contrato/index');
        }
    }

    public function index($params)
    {
        $contratoId = $params[0];
        $contratoService = new ContratoService();
        $editalService = new EditalService();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $representanteService = new RepresentanteService();
        $contrato = new Contrato();

        self::setViewParam('listaClientes', $contratoService->listarClienteContrato($contratoId));
        //self::setViewParam('listaClientes', $clienteLicitacaoService->listar());
        self::setViewParam('listarRepresentantes', $contratoService->listarRepresentanteContrato());
        
       if($_POST){
           $contrato->setCtrRepresentante($_POST['codRepresentante']);
           $contrato->setCtrId($_POST['codigo']);
           $contrato->setCtrClienteLicitacao($_POST['clienteId']);
           $contrato->setCtrNumero($_POST['contrato']); 
           $contrato->setCtrStatus($_POST['status']);
           $contrato->setCtrModalidade($_POST['modalidade']);       
           $contrato->setCtrNumeroLicitacao($_POST['numeroLicitacao']); 
        }
    
        self::setViewParam('listaContratos', $contratoService->listarDinamico($contrato));
        $this->render('/contrato/index');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();

    }

    public function autoCompleteContratoClienteRazaoSocial($params)
    {       
        $clienteLicitacao = new ClienteLicitacao();
        $clienteLicitacao->setRazaoSocial($params[0]);        
        
        $contratoService = new ContratoService();
        $busca = $contratoService->autoCompleteContratoClienteRazaoSocial($clienteLicitacao);      
        echo $busca;
    }
    public function autoCompleteEditalClienteRazaoSocial($params)
    {       
        $clienteLicitacao = new ClienteLicitacao();
        $clienteLicitacao->setRazaoSocial($params[0]);        
        
        $contratoService = new ContratoService();
        $busca = $contratoService->autoCompleteEditalClienteRazaoSocial($clienteLicitacao);      
        echo $busca;
    }
    public function autoCompleteNumeroContratoCodCliente($params)
    {       
        $edital = new Edital();
        $edital->setEdtNumero($params[0]);        
        $clienteLicitacao = new ClienteLicitacao();
        $clienteLicitacao->setCodCliente($params[1]);
          
        $contratoService = new ContratoService();
        $busca = $contratoService->autoCompleteNumeroContratoCodCliente($edital, $clienteLicitacao);      
        echo $busca;
    }
    public function autoCompleteNumeroEditalCodCliente($params)
    {       
        $edital = new Edital();
        $edital->setEdtNumero($params[0]);        
        $clienteLicitacao = new ClienteLicitacao();
        $clienteLicitacao->setCodCliente($params[1]);
          
        $contratoService = new ContratoService();
        $busca = $contratoService->autoCompleteNumeroEditalCodCliente($edital, $clienteLicitacao);      
        echo $busca;
    }

    public function cadastro()
    {
        $representanteService = new RepresentanteService();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $editalService = new EditalService();   
        $contrato = new Contrato();
        
        if(Sessao::existeFormulario()) { 
            
            $clienteId = Sessao::retornaValorFormulario('cliente');
            $clienteLicitacao = $clienteLicitacaoService->listar($clienteId);
            $contrato->setClienteLicitacao($clienteLicitacao);
            
            $editalId = Sessao::retornaValorFormulario('numeroLicitacao');
            $edital = $clienteLicitacaoService->listar($editalId)[0];
            $contrato->setEdital($edital);
            
            $representanteId = Sessao::retornaValorFormulario('representante');
            $representante = $representanteService->listar($representanteId)[0];
            $contrato->setRepresentante($representante);
        }else{    
            self::setViewParam('listarRepresentantes', $representanteService->listar());                 
            $contrato->setClienteLicitacao(new ClienteLicitacao());
            $contrato->setRepresentante(new Representante());
        }
       if( $teste = Sessao::retornaValorFormulario('teste')){
           var_dump($teste);
           self::setViewParam('listarTestes', $clienteLicitacaoService->listar($teste)); 
        }
        $this->setViewParam('contrato',$contrato);        
        $this->render('/contrato/cadastro');
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
        $editalService = new EditalService();        
        $clienteLicitacao         = $clienteLicitacaoService->listar($_POST['cliente']);
        $usuario        = $usuarioService->listar($_POST['ctrUsuario']);
        $instituicao     =   $instituicaoService->listar($_POST['fk_instituicao']);
        $representante    = $representanteService->listar($_POST['representante'])[0];
        $edital    = $editalService->listar($_POST['numeroLicitacao'])[0];
 
        $contrato = new Contrato();
        $contrato->setCtrNumero($_POST['numeroContrato']);        
        $contrato->setCtrDataInicio($_POST['dataInicio']);        
        $contrato->setCtrDataVencimento($_POST['dataVencimento']);        
        $contrato->setCtrValor(str_replace(',','.', str_replace(".", "", $_POST['valor'])));
        $contrato->setCtrStatus($_POST['status']);        
        $contrato->setCtrObservacao($_POST['observacao']);
        $contrato->setCtrAnexo($_POST['anexo']);        
        $contrato->setEdital($edital);        
        $contrato->setCtrPrazoPagamento($_POST['prazoPagamento']);        
        $contrato->setCtrPrazoEntrega($_POST['prazoEntrega']);             
        $contrato->setCtrDataAlteracao($_POST['dataCadastro']);        
        $contrato->setCtrDataCadastro($_POST['dataCadastro']);        
        $contrato->setClienteLicitacao($clienteLicitacao);
        $contrato->setInstituicao($instituicao);
        $contrato->setRepresentante($representante);
        $contrato->setUsuario($usuario);
        Sessao::gravaFormulario($_POST);

        $contratoValidador  = new ContratoValidador();
        $resultadoValidacao = $contratoValidador->validar($contrato);

       if ($resultadoValidacao->getErros()) {
           $this->redirect('/contrato/cadastro');
        }
        if (!$edital) {
            $this->redirect('/contrato/cadastro');
            Sessao::gravaMensagem("nenhuma licitacao informada");
         }

        $contratoService = new ContratoService();
    
       if($contratoService->salvar($contrato)){
            $this->redirect('/contrato');
        }else{          
            $this->redirect('/contrato/cadastro');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function edicao($params)
    { 
        /*
        ctr_id, ctr_numero, ctr_datainicio,  ctr_datavencimento, ctr_valor, ctr_status, ctr_observacao, ctr_anexo, ctr_clientelicitacao, ctr_usuario, 
        ctr_prazoentrega, ctr_prazopagamento, ctr_instituicao, ctr_datacadastro, ctr_dataalteracao
        */
        $contratoId = $params[0];
        
        $contratoService = new ContratoService();
        $representanteService = new RepresentanteService();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $contrato = new Edital();
        if(Sessao::existeFormulario()) { 
            $clienteId = Sessao::retornaValorFormulario('cliente');
            $clienteLicitacao = $clienteLicitacaoService->listar($clienteId);
            $contrato->setClienteLicitacao($clienteLicitacao);
            
            $representanteId = Sessao::retornaValorFormulario('representante');
            $representante = $representanteService->listar($representanteId)[0];
            self::setViewParam('listarRepresentantes', $representanteService->listar()); 
            $contrato->setRepresentante($representante);
            $contrato = $contratoService->listar($contratoId)[0];           
        }else{                       
            self::setViewParam('listarRepresentantes', $representanteService->listar());            
           
            $contrato = $contratoService->listar($contratoId)[0]; 
        }        
        if (!$contrato) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/contrato');
        }
        
        $this->setViewParam('contrato', $contrato);
        $this->render('/contrato/edicao');
        
        Sessao::limpaMensagem();
    }

    public function atualizar()
    {             
        $clienteLicitacaoService  = new ClienteLicitacaoService();        
        $usuarioService = new UsuarioService();        
        $representanteService = new RepresentanteService();        
        $instituicaoService = new InstituicaoService();        
        $editalService = new EditalService();        
        $clienteLicitacao         = $clienteLicitacaoService->listar($_POST['cliente']);
        $usuario        = $usuarioService->listar($_POST['ctrUsuario']);
        $instituicao     =   $instituicaoService->listar($_POST['fk_instituicao']);
        $representante    = $representanteService->listar($_POST['representante'])[0];
        $edital    = $editalService->listar($_POST['numeroLicitacao'])[0];
 
        $contrato = new Contrato();
        $contrato->setCtrId($_POST['codigo']);        
        $contrato->setCtrNumero($_POST['numeroContrato']);        
        $contrato->setCtrDataInicio($_POST['dataInicio']);        
        $contrato->setCtrDataVencimento($_POST['dataVencimento']);        
        $contrato->setCtrValor(str_replace(',','.', str_replace(".", "", $_POST['valor'])));
        $contrato->setCtrStatus($_POST['status']);        
        $contrato->setCtrObservacao($_POST['observacao']);
        $contrato->setCtrAnexo($_POST['anexo']);        
        $contrato->setEdital($edital);        
        $contrato->setCtrPrazoPagamento($_POST['prazoPagamento']);        
        $contrato->setCtrPrazoEntrega($_POST['prazoEntrega']);             
        $contrato->setCtrDataAlteracao($_POST['dataCadastro']);        
       // $contrato->setCtrDataCadastro($_POST['dataCadastro']);        
        $contrato->setClienteLicitacao($clienteLicitacao);
        $contrato->setInstituicao($instituicao);
        $contrato->setRepresentante($representante);
        $contrato->setUsuario($usuario);
        $anexo =  $_POST['anexo'];
        if($anexo == ""){
            $contrato->setCtrAnexo($_POST['anexoAlt']);                    
        } else{
            $contrato->setCtrAnexo($_POST['anexo']);        
        }
        $contrato->setCtrObservacao($_POST['observacao']);        
        $contrato->setClienteLicitacao($clienteLicitacao);
        $contrato->setInstituicao($instituicao);
        $contrato->setRepresentante($representante);
        $contrato->setUsuario($usuario);

        Sessao::gravaFormulario($_POST);

        $contratoService = new ContratoService();
    
        $contratoValidador = new ContratoValidador();
        $resultadoValidacao = $contratoValidador->validar($contrato);
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            Sessao::gravaMensagem("erro na atualizacao");
            Sessao::gravaFormulario($_POST);
           $this->redirect('/contrato/edicao/' . $_POST['codigo']);
        }        
        if ($contratoService->Editar($contrato)) {
            $this->redirect('/contrato');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();           
        }else{
            Sessao::gravaFormulario($_POST);            
            Sessao::gravaMensagem("erro na atualizacao");
            //$this->redirect('/contrato/edicao/'.$_POST['codigo']);
        }
    }
    
    public function exclusao($params)
    {
        $ctrId = $params[0];

        $contratoService    = new ContratoService();
        $notificacaoService = new NotificacaoService();
        $contrato           = $contratoService->listar($ctrId)[0];
        $codEdital = $contrato->getEdital()->getEdtId();
        $notificacao        = $notificacaoService->qtdeNotificacaoPorEdital($codEdital);
        
        if (!$contrato) {
        Sessao::gravaMensagem("Contrato inexistente");
            $this->redirect('/contrato');
        }
        if($notificacao){
            $notificacao = $notificacao->getNtf_numero();
            self::setViewParam('notificacao', $notificacao);               
        }else{
            $notificacao = "";               
            self::setViewParam('notificacao', $notificacao);
        }
        self::setViewParam('contrato', $contrato);

        $this->render('/contrato/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $contrato = new Contrato();
        $contrato->setCtrId($_POST['codigo']);

        $contratoService= new ContratoService();

        if (!$contratoService->excluir($contrato)) {
            Sessao::gravaMensagem("Contrato inexistente");
            $this->redirect('/contrato/exclusao'.$contrato->getCtrId());
        }

        Sessao::gravaMensagem("Contrato excluido com sucesso!");

        $this->redirect('/contrato');
    }

}
