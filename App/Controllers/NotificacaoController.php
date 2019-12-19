<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\Validacao\NotificacaoValidador;
use App\Models\Entidades\Contrato;
use App\Models\Entidades\Notificacao;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Edital;
use App\Models\Entidades\Representante;
use App\Models\Entidades\ClienteLicitacao;
use App\Services\ContratoService;
use App\Services\NotificacaoService;
use App\Services\UsuarioService;
use App\Services\EditalService;
use App\Services\EmailService;
use App\Services\InstituicaoService;
use App\Services\ClienteLicitacaoService;
use App\Services\RepresentanteService;

class NotificacaoController extends Controller
{
    public function listarPorEdital($params)
    {
        $notificacaoService = new NotificacaoService();
        $notificacao = new Notificacao();
        $editalId = $params[0];
        if($editalId)
        {
            $notificacao->setEdital(new Edital());
            $notificacao->getEdital()->setEdtId($editalId);
           
            self::setViewParam('listaNotificacoes', $notificacaoService->listarDinamico($notificacao));
            $this->render('/notificacao/index');
        }
    }
    public function index($params)
    {
        $notificacaoId = $params[0];
        $contratoService = new ContratoService();
        $notificacaoService = new NotificacaoService();
        $editalService = new EditalService();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $representanteService = new RepresentanteService();
        $contrato = new Contrato();
        $notificacao = new Notificacao();
       // self::setViewParam('listaClientes', $contratoService->listarClienteContrato($contratoId));
        //self::setViewParam('listaClientes', $clienteLicitacaoService->listar());
        //self::setViewParam('listarRepresentantes', $contratoService->listarRepresentanteContrato());                
       
        if($_POST){
           $notificacao->setNtf_valor($_POST['codRepresentante']);
           $notificacao->setNtf_cod($_POST['codigo']);
           $notificacao->setClienteLicitacao($_POST['clienteId']);
           $notificacao->setNtf_Numero($_POST['notificacao']); 
           $notificacao->setNtf_Status($_POST['status']);
           $notificacao->setNtf_pedido($_POST['modalidade']);       
           $notificacao->setNtf_numero($_POST['numeroLicitacao']); 
        }
      
        //self::setViewParam('listaNotificacoes', $notificacaoService->listar($notificacao));
        self::setViewParam('listaNotificacoes', $notificacaoService->listarDinamico($notificacao));
       $this->render('/notificacao/index');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();

    }
/*
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
*/
    public function cadastro()
    {
        $representanteService = new RepresentanteService();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $editalService = new EditalService(); 
        $contrato = new Contrato();
        $notificacao = new Notificacao();
        
        if(Sessao::existeFormulario()) { 
            
            $clienteId = Sessao::retornaValorFormulario('cliente');
            $clienteLicitacao = $clienteLicitacaoService->listar($clienteId);
            $notificacao->setClienteLicitacao($clienteLicitacao);
            
            $editalId = Sessao::retornaValorFormulario('numeroLicitacao');
            $edital = $editalService->listar($editalId)[0];
            $notificacao->setEdital($edital);
            
            $representanteId = Sessao::retornaValorFormulario('representante');
            $representante = $representanteService->listar($representanteId)[0];
            $notificacao->setNtf_representante($representante);

            $notificacao->setNtf_garantia( Sessao::retornaValorFormulario('garantia'));
            $notificacao->setNtf_status( Sessao::retornaValorFormulario('status'));
            $notificacao->setNtf_pedido( Sessao::retornaValorFormulario('numeroPedido'));
            $notificacao->setNtf_prazodefesa( Sessao::retornaValorFormulario('prazoDefesa'));
            $notificacao->setNtf_trocamarca( Sessao::retornaValorFormulario('trocaMarca'));
            $notificacao->setNtf_valor( Sessao::retornaValorFormulario('valor'));
            $notificacao->setNtf_observacao( Sessao::retornaValorFormulario('observacao'));
            $notificacao->setNtf_anexo( Sessao::retornaValorFormulario('anexo'));
            $notificacao->setNtf_numero( Sessao::retornaValorFormulario('numeroNotificacao'));
        }else{
            $notificacao->setclientelicitacao(new ClienteLicitacao());
            $notificacao->setNtf_representante(new Representante());
        }
        
        self::setViewParam('listarRepresentantes', $representanteService->listar());                 
        $this->setViewParam('notificacao',$notificacao);        
        $this->render('/notificacao/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    { 
        $notificacaoService         = new NotificacaoService();
        $clienteLicitacaoService    = new ClienteLicitacaoService();        
        $usuarioService             = new UsuarioService();        
        $representanteService       = new RepresentanteService();        
        $instituicaoService         = new InstituicaoService();        
        $editalService              = new EditalService();        
        
        $edital             = $editalService->listar($_POST['numeroLicitacao'])[0];
        $clienteLicitacao   = $clienteLicitacaoService->listar($_POST['cliente']);
        $usuario            = $usuarioService->listar($_POST['usuario']);
        $instituicao        = $instituicaoService->listar($_POST['instituicao']);
        $representante      = $representanteService->listar($_POST['representante'])[0];
        
        $notificacao = new Notificacao();
        $notificacao->setClienteLicitacao($clienteLicitacao);
        $notificacao->setNtf_numero($_POST['numeroNotificacao']);        
        $notificacao->setNtf_pedido($_POST['numeroPedido']);        
        $notificacao->setNtf_garantia($_POST['garantia']);        
        $notificacao->setNtf_status($_POST['status']);        
        $notificacao->setNtf_prazodefesa($_POST['prazoDefesa']);        
        $notificacao->setNtf_trocamarca($_POST['trocaMarca']);        
        $notificacao->setNtf_valor(str_replace(',','.', str_replace(".", "", $_POST['valor'])));
        $notificacao->setEdital($edital);
        $notificacao->setNtf_usuario($usuario);
        $notificacao->setNtf_representante($representante);
        $notificacao->setNtf_datacadastro($_POST['dataCadastro']);        
        $notificacao->setNtf_datarecebimento($_POST['dataRecebimento']);
        $notificacao->setNtf_dataalteracao($_POST['dataCadastro']);
        $notificacao->setNtf_observacao($_POST['observacao']);
        $notificacao->setNtf_anexo($_POST['anexo']);
        $notificacao->setNtf_instituicao($instituicao);
        Sessao::gravaFormulario($_POST);
                
        $notificacaoValidador   = new NotificacaoValidador();
        $resultadoValidacao     = $notificacaoValidador->validar($notificacao);
        
        if ($resultadoValidacao->getErros()) {
            $this->redirect('/notificacao/cadastro');
        }
        
        if (!$notificacao) {           
            $this->redirect('/notificacao/cadastro');
            Sessao::gravaMensagem("sem dados informados");
         }
 
       if($codNotificacao = $notificacaoService->salvar($notificacao)){
           $notificacao->setNtf_cod($codNotificacao);
           $notificacao = $notificacaoService->listar($notificacao)[0];
           var_dump($notificacao);
            $emailService = new EmailService();
            $subject = 1;        
            $emailService->emailNotificacao($notificacao,$subject);

            $this->redirect('/notificacao');       
        }else{                      
           $this->redirect('/notificacao/cadastro');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function edicao($params)
    {       
        $notificacao = new Notificacao();
        $notificacao->setNtf_cod($params[0]);       
        $notificacaoService = new NotificacaoService();
        $editalService = new EditalService();
        $representanteService = new RepresentanteService();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        if(Sessao::existeFormulario()) { 
            $clienteId = Sessao::retornaValorFormulario('cliente');            
            $clienteLicitacao = $clienteLicitacaoService->listar($clienteId);
            $notificacao->setClienteLicitacao($clienteLicitacao);            
            $notificacao->setNtf_garantia( Sessao::retornaValorFormulario('garantia'));
            $notificacao->setNtf_status( Sessao::retornaValorFormulario('status'));
            $notificacao->setNtf_pedido( Sessao::retornaValorFormulario('numeroPedido'));
            $notificacao->setNtf_prazodefesa( Sessao::retornaValorFormulario('prazoDefesa'));
            $notificacao->setNtf_trocamarca( Sessao::retornaValorFormulario('trocaMarca'));
            $notificacao->setNtf_valor( Sessao::retornaValorFormulario('valor'));
            $notificacao->setNtf_observacao( Sessao::retornaValorFormulario('observacao'));
            $notificacao->setNtf_anexo( Sessao::retornaValorFormulario('anexo'));
            $notificacao->setNtf_numero( Sessao::retornaValorFormulario('numeroNotificacao'));
            $representanteId = Sessao::retornaValorFormulario('representante');
            $representante = $representanteService->listar($representanteId)[0];
            $notificacao->setNtf_representante($representante);

            $editalId = Sessao::retornaValorFormulario('numeroLicitacao');
            $edital = $editalService->listar($editalId)[0];
            $notificacao->setEdital($edital);
            
        }else{                                   
            $notificacao = $notificacaoService->listarDinamico($notificacao)[0]; 
        }        
        self::setViewParam('listarRepresentantes', $representanteService->listar());            
        if (!$notificacao) {
            Sessao::gravaMensagem("Cadastro inexistente");
           $this->redirect('/notificacao');
        }
        $this->setViewParam('notificacao', $notificacao);
        $this->render('/notificacao/editar');
        
        Sessao::limpaMensagem();
    }

    public function atualizar()
    {             
        $notificacaoService         = new NotificacaoService();
        $clienteLicitacaoService    = new ClienteLicitacaoService();        
        $usuarioService             = new UsuarioService();        
        $representanteService       = new RepresentanteService();        
        $instituicaoService         = new InstituicaoService();        
        $editalService              = new EditalService();        
        
        $edital             = $editalService->listar($_POST['numeroLicitacao'])[0];             
        $clienteLicitacao   = $clienteLicitacaoService->listar($_POST['cliente']);  
        $usuario            = $usuarioService->listar($_POST['usuario']);
        $instituicao        = $instituicaoService->listar($_POST['instituicao']);
        $representante      = $representanteService->listar($_POST['representante'])[0];
        
        $notificacao = new Notificacao();
        $notificacao->setClienteLicitacao($clienteLicitacao);
        $notificacao->setNtf_cod($_POST['codigo']);        
        $notificacao->setNtf_numero($_POST['numeroNotificacao']);        
        $notificacao->setNtf_pedido($_POST['numeroPedido']);        
        $notificacao->setNtf_garantia($_POST['garantia']);        
        $notificacao->setNtf_status($_POST['status']);        
        $notificacao->setNtf_prazodefesa($_POST['prazoDefesa']);        
        $notificacao->setNtf_trocamarca($_POST['trocaMarca']);        
        $notificacao->setNtf_valor(str_replace(',','.', str_replace(".", "", $_POST['valor'])));
        $notificacao->setEdital($edital);
        $notificacao->setNtf_usuario($usuario);
        $notificacao->setNtf_representante($representante);
        $notificacao->setNtf_datarecebimento($_POST['dataRecebimento']);
        $notificacao->setNtf_dataalteracao($_POST['dataCadastro']);
        $notificacao->setNtf_observacao($_POST['observacao']);
        $notificacao->setNtf_instituicao($instituicao);
        $anexo =  $_POST['anexo'];
        if($anexo == ""){
            $notificacao->setNtf_anexo($_POST['anexoAlt']);                    
        } else{
            $notificacao->setNtf_anexo($_POST['anexo']);        
        }
        
        Sessao::gravaFormulario($_POST);

        $notificacaoValidador = new NotificacaoValidador();
        $resultadoValidacao = $notificacaoValidador->validar($notificacao);
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            Sessao::gravaFormulario($_POST);
            $this->redirect('/notificacao/edicao/' . $_POST['codigo']);
            Sessao::gravaMensagem("erro na atualizacao");
        }        
        if ($notificacaoService->Editar($notificacao)) {
            $emailService = new EmailService();
            $subject = 2;
            $emailService->emailNotificacao($notificacao, $subject);
            $this->redirect('/notificacao');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();           
        }else{
            Sessao::gravaFormulario($_POST);            
            $this->redirect('/notificacao/edicao/'.$_POST['codigo']);
            Sessao::gravaMensagem("erro na atualizacao");
        }
    }
    
    public function exclusao($params)
    {
        $notificacao = new Notificacao();
        $notificacao->setNtf_cod($params[0]); 

        $notificacaoService = new NotificacaoService();

        $notificacao = $notificacaoService->listarDinamico($notificacao)[0];

        if (!$notificacao) {
        Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/notificacao');
        }

        self::setViewParam('notificacao', $notificacao);

        $this->render('/notificacao/excluir');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $notificacao = new Notificacao();
        $notificacao->setNtf_cod($_POST['codigo']);
      
        $notificacaoService = new NotificacaoService();

        if (!$notificacaoService->excluir($notificacao)) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/notificacao/excluir'.$notificacao->getNtf_cod());
        }

        Sessao::gravaMensagem("Cadastro excluido com sucesso!");

        $this->redirect('/notificacao');
    }

}
