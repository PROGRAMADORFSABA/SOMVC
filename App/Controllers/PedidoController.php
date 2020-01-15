<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\PedidoDAO;
use App\Models\DAO\StatusDAO;
use App\Models\DAO\RepresentanteDAO;
use App\Services\RepresentanteService;
use App\Services\ClienteLicitacaoService;
use App\Services\PedidoService;
use App\Services\InstituicaoService;
use App\Services\UsuarioService;
use App\Services\StatusService;
use App\Services\EmailService;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Representante;
use App\Models\Entidades\ClienteLicitacao;
use App\Models\Validacao\PedidoValidador;

class PedidoController extends Controller
{

    public function index()
    {
        $pedido = new Pedido();
        $clienteLicitacao = new ClienteLicitacao();
        if($_POST){
            $pedido->setCodControle($_POST['codigo']);
            $pedido->setCodRepresentante($_POST['representante']);
            $pedido->setCodCliente($_POST['cliente']);
            //$pedido->setCodUsuario($_POST['usuario']); 
            $pedido->setCodStatus($_POST['status']);
            $pedido->setNumeroAF($_POST['numeroAf']);       
            $pedido->setNumeroLicitacao($_POST['numeroLicitacao']);
           // $pedido->setTipoCliente($_POST['tipo']);
            $pedido->setTipoCliente(implode( "','", $_POST['tipo']));
         }

        $pedidoService = new PedidoService();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $representanteService = new RepresentanteService();
        $statusService = new StatusService();
        self::setViewParam('listaStatus', $statusService->listar());
        self::setViewParam('listarPedidos', $pedidoService->listar($pedido));
        self::setViewParam('listaClientesPedido', $clienteLicitacaoService->listaClientesPedido());
        self::setViewParam('listaTipoClientes', $clienteLicitacaoService->listaTipoCliente($clienteLicitacao));
        self::setViewParam('listarRepresentantes', $representanteService->listar());
        $pedidoDAO = new PedidoDAO();
        
       // self::setViewParam('listaPedido', $pedidoDAO->listar());
       // self::setViewParam('listaPedidos', $pedidoDAO->listarTeste());
        
        $this->render('/pedido/index');
        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
    }
    public function visualisar($params)
    {
            $codControle = $params[0];
            
            $pedido = new Pedido();
            $pedidoService           = new PedidoService();
            $usuarioService          = new UsuarioService();
            $statusService           = new StatusService();
            $instituicaoService      = new InstituicaoService();
            $clienteLicitacaoService = new ClienteLicitacaoService();        
            $representanteService    = new RepresentanteService();

            $pedido->setCodControle($codControle);
            $pedido = $pedidoService->listar($pedido)[0];
            self::setViewParam('listaStatus', $statusService->listar());
            self::setViewParam('listaRepresentantes', $representanteService->listar());
    
        if (!$pedido) {
            Sessao::gravaMensagem("Pedido inexistente");
            $this->redirect('/pedido');
        }
        self::setViewParam('pedido', $pedido);
        $this->render('/pedido/visualisar');
        Sessao::limpaMensagem();
    }

    public function teste()
    {        
        $this->render('/pedido/teste');

        Sessao::limpaMensagem();
    }
    public function pesquisa()
    {

        $statusDAO = new StatusDAO();
        self::setViewParam('listaStatus', $statusDAO->listar());
        $representanteDAO = new RepresentanteDAO();
        self::setViewParam('listaRepresentantes', $representanteDAO->listar());

        $pedido = new Pedido();
        $pedido->setCodStatus($_POST['codStatus']);
        $pedido->setNumeroAF($_POST['numeroAf']);
        $pedido->setNumeroLicitacao($_POST['numeroLicitacao']);
        $pedido->setCodControle($_POST['codControle']);
        $pedido->setCodCliente($_POST['codCliente']);

        $pedidoDAO = new PedidoDAO();

        self::setViewParam('listaPedido', $pedidoDAO->listarTeste1($pedido));
        if ($pedidoDAO->listarTeste1($pedido) == false) {
            Sessao::gravaMensagem("Nenhum Cadastro Localizado!");
        }
        $this->render('/pedido/teste');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
    }

    public function cadastro()
    {
        $pedido = new Pedido();
        $statusDAO = new StatusDAO();
        self::setViewParam('listaStatus', $statusDAO->listar());        
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $representanteService   = new RepresentanteService();        
        $usuadioService   = new UsuarioService();        
           
        if(Sessao::existeFormulario()) {
            $clienteId = Sessao::retornaValorFormulario('cliente');
            $clienteLicitacao = $clienteLicitacaoService->listar($clienteId);
            $pedido->setClienteLicitacao($clienteLicitacao);
            
            $representanteId = Sessao::retornaValorFormulario('representante');            
            $representante = $representanteService->listar($representanteId)[0];
            $pedido->setRepresentante($representante);     
            
            $usuarioId = Sessao::retornaValorFormulario('usuario');
            $usuario = $usuadioService->listar($usuarioId);
            $pedido->setUsuario($usuario);     
            
            $pedido->setDataCadastro(Sessao::retornaValorFormulario('dataCadastro'));            
            $pedido->setNumeroLicitacao(Sessao::retornaValorFormulario('numeroPregao'));
            $pedido->setNumeroAf(Sessao::retornaValorFormulario('numeroAf'));
            $pedido->setNumeroPedidoERP(Sessao::retornaValorFormulario('numeroPedidoERP'));
            $pedido->setValorPedido(Sessao::retornaValorFormulario('valorPedido'));
            $pedido->setCodStatus(Sessao::retornaValorFormulario('codStatus'));
            $pedido->setCodCliente(Sessao::retornaValorFormulario('codCliente'));
            $pedido->setAnexo(Sessao::retornaValorFormulario('anexo'));
            $pedido->setObservacao(Sessao::retornaValorFormulario('observacao'));
            //$pedido->setCodRepresentante(Sessao::retornaValorFormulario('representante'));
            $pedido->setFk_Instituicao(Sessao::retornaValorFormulario('fk_instituicao'));
            $pedido->setDataFechamento(Sessao::retornaValorFormulario('dataFechamento'));
            $pedido->setDataAlteracao(Sessao::retornaValorFormulario('dataAlteracao'));

        }else{
            self::setViewParam('listarRepresentantes', $representanteService->listar()); 
            $pedido->setClienteLicitacao(new ClienteLicitacao());
            $pedido->setRepresentante(new Representante());
        }
        $this->setViewParam('pedido',$pedido); 
        $this->render('/pedido/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }
    public function salvar()
    {
        $clienteLicitacaoService  = new ClienteLicitacaoService();        
        $usuarioService           = new UsuarioService();        
        $representanteService     = new RepresentanteService();        
        $instituicaoService       = new InstituicaoService();        
        $statusService            = new StatusService();   
        $clienteLicitacao         = $clienteLicitacaoService->listar($_POST['cliente']);
        $usuario                  = $usuarioService->listar($_POST['usuario']);
        $instituicao              = $instituicaoService->listar($_POST['fk_instituicao']);
        $representante            = $representanteService->listar($_POST['representante'])[0];
        $status                   = $statusService->listar($_POST['codStatus']);
        var_dump($status);
        $pedido = new Pedido();

        $pedido->setDataCadastro($_POST['dataCadastro']);
        //date_format($date, 'Y-m-d H:i:s');
        $pedido->setNumeroLicitacao($_POST['numeroPregao']);
        $pedido->setNumeroAf($_POST['numeroAf']);
        $pedido->setNumeroPedidoERP($_POST['numeroPedidoERP']);
        $pedido->setValorPedido($_POST['valorPedido']);
        $pedido->setStatus($status);
        $pedido->setAnexo($_POST['anexo']);
        $pedido->setObservacao($_POST['observacao']);
        $pedido->setDataFechamento($_POST['dataFechamento']);
        $pedido->setDataAlteracao($_POST['dataAlteracao']);
        $pedido->setInstituicao($instituicao);
        $pedido->setRepresentante($representante);
        $pedido->setUsuario($usuario);
        $pedido->setClienteLicitacao($clienteLicitacao);

        Sessao::gravaFormulario($_POST);

        $pedidoService = new PedidoService();
        if($status->getCodStatus() == 16 || $status->getCodStatus() == 17 AND $_POST['numeroPedidoERP'] == ""){
            Sessao::gravaMensagem(" Numero do Pedido é Obrigatorio");
            $this->redirect('/pedido/cadastro');                  
        } 
        if ( $codPedido  = $pedidoService->salvar($pedido)) {
            if(isset($_POST['enviarEmail'])){  
            $pedido->setCodControle($codPedido);
            $pedido = $pedidoService->listar($pedido)[0];
           
                $email = $_POST['email'];
                $emailService = new EmailService();
                $subject = 1;
                $emailService->email($pedido,$email, $subject);
            }
            
            $this->redirect('/pedido');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
        } else {
            Sessao::gravaMensagem("Erro ao gravar");
            $this->redirect('/pedido/cadastro');
        }
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }
    public function edicao($params)
    {
        $codControle = $params[0];
        
        $pedido = new Pedido();
        $pedido->setCodControle($codControle);
        $pedidoService           = new PedidoService();
        $usuarioService          = new UsuarioService();
        $statusService           = new StatusService();
        $instituicaoService      = new InstituicaoService();
        $clienteLicitacaoService = new ClienteLicitacaoService();        
        $representanteService    = new RepresentanteService();
        
        self::setViewParam('listaStatus', $statusService->listar());
        self::setViewParam('listaRepresentantes', $representanteService->listar());
        
        if(Sessao::existeFormulario()) {
            $clienteId = Sessao::retornaValorFormulario('cliente');
            $clienteLicitacao = $clienteLicitacaoService->listar($clienteId);
            $pedido->setClienteLicitacao($clienteLicitacao);
            
            $representanteId = Sessao::retornaValorFormulario('representante');
            $representante = $representanteService->listar($representanteId)[0];
            $pedido->setRepresentante($representante);     
            
            $usuarioId = Sessao::retornaValorFormulario('usuario');
            $usuario = $usuarioService->listar($usuarioId);
            $pedido->setUsuario($usuario);  
            
            $statusId = Sessao::retornaValorFormulario('status');
            $status = $statusService->listar($statusId);
            $pedido->setStatus($status);  
            
            $institutoId = Sessao::retornaValorFormulario('fk_instituicao');
            $instituicao = $instituicaoService->listar($institutoId);
            $pedido->setInstituicao($instituicao);  
            
            $pedido->setCodControle(Sessao::retornaValorFormulario('codControle'));          
          //  $pedido->setDataCadastro(Sessao::retornaValorFormulario('dataCadastro'));            
            $pedido->setNumeroLicitacao(Sessao::retornaValorFormulario('numeroPregao'));
            $pedido->setNumeroAf(Sessao::retornaValorFormulario('numeroAf'));
            $pedido->setNumeroPedidoERP(Sessao::retornaValorFormulario('numeroPedidoERP'));
            $pedido->setValorPedido(Sessao::retornaValorFormulario('valorPedido'));
            $pedido->setCodStatus(Sessao::retornaValorFormulario('codStatus'));
            $pedido->setCodCliente(Sessao::retornaValorFormulario('codCliente'));
            $pedido->setAnexo(Sessao::retornaValorFormulario('anexo'));
            $pedido->setObservacao(Sessao::retornaValorFormulario('observacao'));            
            $pedido->setDataFechamento(Sessao::retornaValorFormulario('dataFechamento'));
            $pedido->setDataAlteracao(Sessao::retornaValorFormulario('dataAlteracao'));
            
        }else{
            $pedido = $pedidoService->listar($pedido)[0];
        }
        if (!$pedido) {
            Sessao::gravaMensagem("Pedido inexistente");
            $this->redirect('/pedido');
        }
        self::setViewParam('pedido', $pedido);
        $this->render('/pedido/editar');
        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $pedido = new Pedido();
        
        $clienteLicitacaoService  = new ClienteLicitacaoService();        
        $usuarioService       = new UsuarioService();        
        $statusService        = new StatusService();        
        $representanteService = new RepresentanteService();        
        $instituicaoService   = new InstituicaoService();        
        $clienteLicitacao     = $clienteLicitacaoService->listar($_POST['cliente']);
        $usuario              = $usuarioService->listar($_POST['usuario']);
        $instituicao          = $instituicaoService->listar($_POST['fk_instituicao']);
        $representante        = $representanteService->listar($_POST['representante'])[0];
        $status               = $statusService->listar($_POST['status']);
      
        $pedido->setCodControle($_POST['codControle']);
        $pedido->setNumeroLicitacao($_POST['numeroPregao']);
        $pedido->setNumeroAf($_POST['numeroAf']);
        $pedido->setNumeroPedidoERP($_POST['numeroPedidoERP']);
        //$pedido->setValorPedido(number_format($_POST['valorPedido'], 2, ',', '.'));
        $pedido->setUsuario($usuario);
        $pedido->setStatus($status);
        $pedido->setValorPedido($_POST['valorPedido']);
        $pedido->setClienteLicitacao($clienteLicitacao);            
        $pedido->setObservacao($_POST['observacao']);
        $pedido->setRepresentante($representante);
        $pedido->setInstituicao($instituicao);
        $pedido->setDataFechamento($_POST['dataFechamento']);
        $pedido->setDataAlteracao($_POST['dataAlteracao']);
        $anexo =  $_POST['anexo'];
        if($anexo == ""){
            $pedido->setAnexo($_POST['anexoAlt']);                    
        } else{
            $pedido->setAnexo($_POST['anexo']);        
        }
        Sessao::gravaFormulario($_POST);
        $pedidoValidador = new PedidoValidador();
        $resultadoValidacao = $pedidoValidador->validar($pedido);
        
        if($status->getCodStatus() == 16 || $status->getCodStatus() == 17 AND $_POST['numeroPedidoERP'] == ""){
            Sessao::gravaMensagem(" Numero do Pedido é Obrigatorio");
            $this->redirect('/pedido/edicao/' . $_POST['codControle']);                  
        } 

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            
           $this->redirect('/pedido/edicao/' . $_POST['codControle']);
        }
        $pedidoService = new PedidoService();
        if ($pedidoService->Editar($pedido)) {  
            if(isset($_POST['enviarEmail'])){  
                $pedido->setCodControle($_POST['codControle']);
                $pedido = $pedidoService->listar($pedido)[0];      
                $email = $_POST['email'];               
                $emailService = new EmailService();
                $subject = 2;
                $emailService->email($pedido,$email, $subject);
            }
            $this->redirect('/pedido');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();           
        }else{
            Sessao::gravaFormulario($_POST);            
            Sessao::gravaMensagem("erro na atualizacao");
            $this->redirect('/pedido/edicao/' . $_POST['codControle']);
        }
        
    }

    public function exclusao($params)
    {
        
        $codControle    = $params[0];
        $pedido         = new Pedido();
        $pedidoService  = new PedidoService();
        
        
        $pedido->setCodControle($codControle);
        $pedido = $pedidoService->listar($pedido)[0];

        if (!$pedido) {
            Sessao::gravaMensagem("pedido inexistente");
            $this->redirect('/pedido');
        }

        self::setViewParam('pedido', $pedido);
        $this->render('/pedido/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $pedido = new Pedido();
        $pedido->setCodControle($_POST['codControle']);

        $pedidoService = new PedidoService();

        if (!$pedidoService->excluir($pedido)) {
            Sessao::gravaMensagem("pedido inexistente");
            $this->redirect('/pedido');
        }

        Sessao::gravaMensagem("pedido excluido com sucesso!");

        $this->redirect('/pedido');
    }
}
