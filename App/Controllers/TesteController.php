<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\PedidoDAO;
use App\Models\DAO\StatusDAO;
use App\Models\DAO\TesteDAO;
use App\Models\DAO\ClienteDAO;
use App\Models\DAO\RepresentanteDAO;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\Teste;
use App\Models\Entidades\EditalStatus;
use App\Services\TesteService;
use App\Models\Validacao\PedidoValidador;
use App\Services\EditalStatusService;
use Exception;

class TesteController extends Controller
{
    private $html;
    public function index($params)
    {
        $id = $params[0];

        $testeService = new TesteService();
        $teste = $testeService->listar($id);
        $this->setViewParam('teste', $teste);        
        
        $pedidoDAO = new ClienteDAO();
       // self::setViewParam('teste', $pedidoDAO->listar());
       

        $this->render('/teste/index');

        Sessao::limpaMensagem();
    }

    public function logistica()
    {
        $this->render('/teste/logistica');
    }
    public function __construct()
    {
        $this->html = file_get_contents('App/Views/teste/pessoa.php');
    }
    
    public function pessoa()
    {
        $editalStatusService = new EditalStatusService();
        $editalStatus = new EditalStatus();      
        
       if($_POST){
           $editalStatus->setStEdtId($_POST['codStatus']);           
           $editalStatus->setStEdtNome($_POST['nome']);                   
        }        
       // $pessoas = $editalStatusService->listar($editalStatus);
        if($pessoas = $editalStatusService->listar($editalStatus)){ 
            $items = "";
            $hos = APP_HOST;
            foreach ($pessoas as $pessoa)
            {  
                $item = file_get_contents('App/Views/teste/item.html'); 
                $item = str_replace( '{id}',    $pessoa->getStEdtId(), $item);
                $item = str_replace( '{nome}',    $pessoa->getStEdtNome(), $item);
                $item = str_replace( '{usuario}',    $pessoa->getStEdtUsuario()->getNome(), $item);
                $item = str_replace( '{data}',    $pessoa->getStEdtDataCadastro()->format('d/m/Y H:m'), $item);
                $teste = "<a class='dropdown-item' href=http://".APP_HOST."/teste/edicao/".$pessoa->getStEdtId()." title='Editar' class='btn btn-sm btn-clean btn-icon btn-icon-md'><i class='la la-edit'></i></a> ";
                $item = str_replace( '{APP_HOST}',    APP_HOST, $item);
                $item = str_replace( '{acoes}',    "
                <a  href=http://".APP_HOST."/teste/edicao/".$pessoa->getStEdtId()." title='Editar' class='btn btn-sm btn-clean btn-icon btn-icon-md'><i class='la la-edit'></i></a>
                <a  href=http://".APP_HOST."/teste/excluir/".$pessoa->getStEdtId()." title='Excluir' class='btn btn-sm btn-clean btn-icon btn-icon-md'><i class='la la-trash'></i></a> 
                <span class='dropdown'>
                <a href='#' class='btn btn-sm btn-clean btn-icon btn-icon-md' data-toggle='dropdown' aria-expanded='true'><i class='la la-ellipsis-h'></i></a>
                <div class='dropdown-menu dropdown-menu-right'>
                    <a class='dropdown-item' href=http://".APP_HOST."/teste/edicao/".$pessoa->getStEdtId()." title='Editar' class='btn btn-sm btn-clean btn-icon btn-icon-md'><i class='la la-edit'></i></a>
                    <a class='dropdown-item' href=http://".APP_HOST."/teste/excluir/".$pessoa->getStEdtId()." title='Excluir' class='btn btn-sm btn-clean btn-icon btn-icon-md'><i class='la la-trash'></i></a>
                    <a class='dropdown-item' href=http://".APP_HOST."/teste/excluir/".$pessoa->getStEdtId()." title='Excluir' class='btn btn-sm btn-clean btn-icon btn-icon-md'><i class='la la-trash'></i></a>
                </div>
                    </span>  ", $item);
                
                $items .= $item;
            }                
            // $item = str_replace('{itens}', $items, $item);                  
        }
        $list = file_get_contents('App/Views/teste/pessoa.php');
        $list = str_replace('{items}',   $items, $list);
        
        print $list;
        $this->render('/teste/pessoa');
    }    

    public function teste($params)
    {
        $id = $params[0];

        $testeService = new TesteService();
        $teste = $testeService->listar($id);
        $this->setViewParam('teste', $teste);        
        
        $pedidoDAO = new ClienteDAO();
       // self::setViewParam('teste', $pedidoDAO->listar());
       

        $this->render('/teste/teste');

        Sessao::limpaMensagem();
    }

    public function autoComplete($params)
    {
        $teste = new Teste();
        $teste->setNomeFantasiaCliente($params[0]);
        
        $testeService = new TesteService();
        $busca = $testeService->autoComplete($teste);
        
        echo $busca;
    }

    public function pesquisa()
    {

        $statusDAO = new StatusDAO();
        self::setViewParam('listaStatus', $statusDAO->listar());

        $testeDAO = new TesteDAO();
        self::setViewParam('listaClientes', $testeDAO->listar());
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
        $teste = new Teste();
        $statusDAO = new StatusDAO();
        self::setViewParam('listaStatus', $statusDAO->listar());
        $testeDAO = new ClienteDAO();
        self::setViewParam('listaClientes', $testeDAO->listar());
        $representanteDAO = new RepresentanteDAO();
        self::setViewParam('listaRepresentantes', $representanteDAO->listar());

        $id = Sessao::retornaValorFormulario('clientes');
            
        if(empty($id)) {
            $teste->setClientes(array());    
        } else {
            $testeService = new testeService(); 
            $id = $testeService->listaClientes($id);
            $teste->setClientes($id); 
        }



        $idCliente = Sessao::retornaValorFormulario('clientes');
        $testeDAO1 = new TesteDAO();
        $cliente = $testeDAO1->listar($idCliente)[0];
        $pedido->getCliente($cliente);
       

        $this->setViewParam('teste',$teste);
       $this->render('/teste/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
    }
    public function salvar()
    {
        $pedido = new Pedido();

        $pedido->setDataCadastro($_POST['dataCadastro']);
        //date_format($date, 'Y-m-d H:i:s');
        $pedido->setNumeroLicitacao($_POST['numeroPregao']);
        $pedido->setNumeroAf($_POST['numeroAf']);
        $pedido->setValorPedido($_POST['valorPedido']);
        $pedido->setCodStatus($_POST['codStatus']);
        $pedido->setCodCliente($_POST['codCliente']);
        $pedido->setAnexo($_POST['anexo']);
        $pedido->setObservacao($_POST['observacao']);
        $pedido->setCodRepresentante($_POST['codRepresentante']);
        $pedido->setFk_Instituicao($_POST['fk_instituicao']);
        $pedido->setDataFechamento($_POST['dataFechamento']);
        $pedido->setDataAlteracao($_POST['dataAlteracao']);

        Sessao::gravaFormulario($_POST);

        $pedidoDAO = new PedidoDAO();

        if ($pedidoDAO->salvar($pedido)) {

            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
        //    $this->redirect('/pedido');
        } else {
            Sessao::gravaMensagem("Erro ao gravar");
        }
    }
    public function edicao($params)
    {
        $editalStatus = new EditalStatus();
        $codigo = $editalStatus->setStEdtId($params[0]);
        
        if (!$codigo) {
            Sessao::gravaMensagem("Nenhum Cadastro Selecionado");
            $this->redirect('/teste');
        }
        $editalStatusService = new EditalStatusService();

        $pedido = $editalStatusService->listar($codigo);

        if (!$pedido) {
            Sessao::gravaMensagem("Pedido inexistente");
            $this->redirect('/pedido');
        }

        $testeDAO = new TesteDAO();
        self::setViewParam('listaClientes', $testeDAO->listar());
        $statusDAO = new StatusDAO();
        self::setViewParam('listaStatus', $statusDAO->listar());
        $representanteDAO = new RepresentanteDAO();
        self::setViewParam('listaRepresentantes', $representanteDAO->listar());

        self::setViewParam('editalStatus', $editalStatus);
        
       // $this->render('/pedido/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $pedido = new Pedido();
        //$pedido->setDataCadastro($_POST['dataCadastro']);
        //date_format($date, 'Y-m-d H:i:s');
        $pedido->setCodControle($_POST['codControle']);
        $pedido->setNumeroLicitacao($_POST['numeroPregao']);
        $pedido->setNumeroAf($_POST['numeroAf']);
        //$pedido->setValorPedido(number_format($_POST['valorPedido'], 2, ',', '.'));
        $pedido->setValorPedido($_POST['valorPedido']);
        $pedido->setCodStatus($_POST['codStatus']);
        $pedido->setCodCliente($_POST['codCliente']);
        $pedido->setAnexo($_POST['anexo']);
        $pedido->setObservacao($_POST['observacao']);
        $pedido->setCodRepresentante($_POST['codRepresentante']);
        $pedido->setFk_Instituicao($_POST['fk_instituicao']);
        $pedido->setDataFechamento($_POST['dataFechamento']);
        $pedido->setDataAlteracao($_POST['dataAlteracao']);

        Sessao::gravaFormulario($_POST);
        $pedidoValidador = new PedidoValidador();
        $resultadoValidacao = $pedidoValidador->validar($pedido);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/pedido/edicao/' . $_POST['codControle']);
        }

        $pedidoDAO = new PedidoDAO();


        $pedidoDAO->atualizar($pedido);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/pedido');
    }

    public function exclusao($params)
    {

        $id = $params[0];

        $pedidoDAO = new PedidoDAO();

        $pedido = $pedidoDAO->listar($id);

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

        $pedidoDAO = new PedidoDAO();

        if (!$pedidoDAO->excluir($pedido)) {
            Sessao::gravaMensagem("pedido inexistente");
            $this->redirect('/pedido');
        }

        Sessao::gravaMensagem("pedido excluido com sucesso!");

        $this->redirect('/pedido');
    }
}