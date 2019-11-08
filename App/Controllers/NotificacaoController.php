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
use App\Services\InstituicaoService;
use App\Services\ClienteLicitacaoService;
use App\Services\RepresentanteService;

class NotificacaoController extends Controller
{
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
       // self::setViewParam('listarRepresentantes', $contratoService->listarRepresentanteContrato());
        
       if($_POST){
           $notificacao->setNtf_valor($_POST['codRepresentante']);
           $notificacao->setNtf_cod($_POST['codigo']);
           $notificacao->setNtf_ClienteLicitacao($_POST['clienteId']);
           $notificacao->setNtf_Numero($_POST['no$notificacao']); 
           $notificacao->setNtf_Status($_POST['status']);
           $notificacao->setNtf_pedido($_POST['modalidade']);       
           $notificacao->setNtf_numero($_POST['numeroLicitacao']); 
        }
    
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
        $editalService = new NotificacaoService();   
        $contrato = new Contrato();
        $notificacao = new Notificacao();
        
        if(Sessao::existeFormulario()) { 
            
            $clienteId = Sessao::retornaValorFormulario('cliente');
            $clienteLicitacao = $clienteLicitacaoService->listar($clienteId);
            $notificacao->setNtf_ClienteLicitacao($clienteLicitacao);
            
            $editalId = Sessao::retornaValorFormulario('numeroLicitacao');
            $edital = $clienteLicitacaoService->listar($editalId)[0];
           // $notificacao->setEdital($edital);
            
            $representanteId = Sessao::retornaValorFormulario('representante');
            $representante = $representanteService->listar($representanteId)[0];
            $notificacao->setNtf_Representante($representante);
        }else{    
            self::setViewParam('listarRepresentantes', $representanteService->listar());                 
            $notificacao->setNtf_clientelicitacao(new ClienteLicitacao());
            $notificacao->setNtf_representante(new Representante());
        }
      
        $this->setViewParam('notificacao',$notificacao);        
        $this->render('/notificacao/cadastro');
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
        $usuario        = $usuarioService->listar($_POST['usuario']);
        $instituicao     =   $instituicaoService->listar($_POST['instituicao']);
        $representante    = $representanteService->listar($_POST['representante'])[0];
        $edital    = $editalService->listar($_POST['numeroLicitacao'])[0];
 /* 
ntf_numero, ntf_licitacao,     ntf_pedido,     ntf_status,     ntf_garantia,     ntf_trocamarca,
     ntf_valor,     ntf_anexo,     ntf_prazodefesa,     ntf_clientelicitacao,     ntf_usuario,
     ntf_representante,    ntf_dataalteracao,    ntf_datacadastro
 */ 
        $notificacao = new Notificacao();
        $notificacao->setNtf_Numero($_POST['numeroNotificacao']);        
        $notificacao->setNtf_pedido($_POST['numeroPedido']);        
        $notificacao->setNtf_Status($_POST['status']);        
        $notificacao->setNtf_garantia($_POST['garatia']);        
        $notificacao->setNtf_trocamarca($_POST['trocaMarca']);        
        $notificacao->setNtf_Valor(str_replace(',','.', str_replace(".", "", $_POST['valor'])));
        $notificacao->setNtf_Anexo($_POST['anexo']);        
        $notificacao->setNtf_prazodefesa($_POST['prazoDefesa']);        
        $notificacao->setNtf_ClienteLicitacao($clienteLicitacao);
        $notificacao->setNtf_Usuario($usuario);
        $notificacao->setNtf_Representante($representante);
        $notificacao->setNtf_datacadastro($_POST['dataCadastro']);        
        $notificacao->setNtf_dataalteracao($_POST['dataAlteracao']);        
        $notificacao->setNtf_Edital($edital);
        $notificacao->setNtf_Instituicao($instituicao);
        Sessao::gravaFormulario($_POST);

        $notificacaoValidador  = new NotificacaoValidador();
        $resultadoValidacao = $notificacaoValidador->validar($notificacao);

       if ($resultadoValidacao->getErros()) {
           $this->redirect('/notificacao/cadastro');
        }
        if (!$edital) {
            $this->redirect('/notificacao/cadastro');
            Sessao::gravaMensagem("nenhuma licitacao informada");
         }

        $notificacaoService = new NotificacaoService();
    
       if($notificacaoService->salvar($notificacao)){
            $this->redirect('/notificacao');
        }else{          
            $this->redirect('/notificacao/cadastro');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }
/*
    public function edicao($params)
    { 
       
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
            $this->redirect('/notificacao');
        }
        
        $this->setViewParam('contrato', $contrato);
        $this->render('/notificacao/edicao');
        
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
    
        $NotificacaoValidador = new NotificacaoValidador();
        $resultadoValidacao = $NotificacaoValidador->validar($contrato);
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            Sessao::gravaMensagem("erro na atualizacao");
            Sessao::gravaFormulario($_POST);
           $this->redirect('/notificacao/edicao/' . $_POST['codigo']);
        }        
        if ($contratoService->Editar($contrato)) {
            $this->redirect('/notificacao');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();           
        }else{
            Sessao::gravaFormulario($_POST);            
            Sessao::gravaMensagem("erro na atualizacao");
            //$this->redirect('/notificacao/edicao/'.$_POST['codigo']);
        }
    }
    
    public function exclusao($params)
    {
        $ctrId = $params[0];

        $contratoService = new ContratoService();

        $contrato = $contratoService->listar($ctrId)[0];

        if (!$contrato) {
        Sessao::gravaMensagem("Contrato inexistente");
            $this->redirect('/notificacao');
        }

        self::setViewParam('contrato', $contrato);

        $this->render('/notificacao/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $contrato = new Contrato();
        $contrato->setCtrId($_POST['codigo']);

        $contratoService= new ContratoService();

        if (!$contratoService->excluir($contrato)) {
            Sessao::gravaMensagem("Contrato inexistente");
            $this->redirect('/notificacao/exclusao'.$contrato->getCtrId());
        }

        Sessao::gravaMensagem("Contrato excluido com sucesso!");

        $this->redirect('/notificacao');
    }
*/
}
