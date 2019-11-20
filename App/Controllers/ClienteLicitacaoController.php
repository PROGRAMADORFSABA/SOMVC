<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ClienteLicitacaoDAO;
use App\Models\Entidades\ClienteLicitacao;

use App\Models\Validacao\ClienteLicitacaoValidador;
use App\Services\ClienteLicitacaoService;

class ClienteLicitacaoController extends Controller
{

    public function index()
    {
        $clienteLicitacaoDAO = new ClienteLicitacaoDAO();

        //self::setViewParam('listaClienteLicitacao', $clienteLicitacaoDAO->listaClienteLicitacao());
        //self::setViewParam('listaClienteLicitacao2', $clienteLicitacaoDAO->listaClienteLicitacao2());
        self::setViewParam('listar', $clienteLicitacaoDAO->listar());

        $this->render('/clientelicitacao/index');

        Sessao::limpaMensagem();
    }
    public function autoComplete($params)
    {
        
        $clienteLicitacao = new ClienteLicitacao();
        $clienteLicitacao->setRazaoSocial($params[0]);
        
        $clienteService = new ClienteLicitacaoService();
        $busca = $clienteService->autoComplete($clienteLicitacao);
        
        echo $busca;
    }
    
    public function listarClienteFalta($params)
    {
        $clienteLicitacaoService = new ClienteLicitacaoService();

        $clienteLicitacao =  new ClienteLicitacao();
        $clienteLicitacao->setNomeFantasia($params[0]);

        $busca = $clienteLicitacaoService->listarClienteFalta($clienteLicitacao);

        echo $busca;
    }
    
    public function cadastro()
    {
        $this->render('/clientelicitacao/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }
    public function salvar()
    {
        $clienteLicitacao = new ClienteLicitacao();

        // $clienteLicitacao->setDataCadastro($_POST['dataCadastro']);
        //date_format($date, 'Y-m-d H:i:s');
        $clienteLicitacao->setCnpj($_POST['cnpj']);
        $clienteLicitacao->setRazaoSocial($_POST['razaoSocial']);
        $clienteLicitacao->setNomeFantasia($_POST['nomeFantasia']);
        $clienteLicitacao->setTrocaMarca($_POST['trocaMarca']);
        $clienteLicitacao->setTipoCliente($_POST['tipoCliente']);
        Sessao::gravaFormulario($_POST);

        $clienteLicitacaoDAO = new ClienteLicitacaoDAO();

        if ($clienteLicitacaoDAO->salvar($clienteLicitacao)) {

            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
            $this->redirect('/clientelicitacao');
        } else {
            Sessao::gravaMensagem("Erro ao gravar");
        }
    }
      
    public function edicao($params)
    {
        $codCliente = $params[0];

        if (!$codCliente) {
            Sessao::gravaMensagem("Nenhum Cadastro Selecionado");
            $this->redirect('/clientelicitacao');
        }
        $clienteLicitacaoDAO = new ClienteLicitacaoDAO();

        $clienteLicitacao = $clienteLicitacaoDAO->listar($codCliente);

        if (!$clienteLicitacao) {
            Sessao::gravaMensagem("Cliente inexistente");
            $this->redirect('/clientelicitacao');
        }

        self::setViewParam('clienteLicitacao', $clienteLicitacao);
        $this->render('/clientelicitacao/editar');

        Sessao::limpaMensagem();
    }
    public function atualizar()
    {
        $clienteLicitacao = new ClienteLicitacao();
        //$pedido->setDataCadastro($_POST['dataCadastro']);
        //date_format($date, 'Y-m-d H:i:s');
        $clienteLicitacao->setCodCliente($_POST['codCliente']);
        $clienteLicitacao->setCnpj($_POST['cnpj']);
        $clienteLicitacao->setRazaoSocial($_POST['razaoSocial']);
        $clienteLicitacao->setNomeFantasia($_POST['nomeFantasia']);
        $clienteLicitacao->setTrocaMarca($_POST['trocaMarca']);
        $clienteLicitacao->setTipoCliente($_POST['tipoCliente']);

        Sessao::gravaFormulario($_POST);
        $clienteLicitacaoValidador = new ClienteLicitacaoValidador();
        $resultadoValidacao = $clienteLicitacaoValidador->validar($clienteLicitacao);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/clientelicitacao/edicao/' . $_POST['codCliente']);
        }

        $clienteLicitacaoDAO = new ClienteLicitacaoDAO();

        $clienteLicitacaoDAO->atualizar($clienteLicitacao);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/clientelicitacao');
    }

    public function exclusao($params)
    {

        $codCliente = $params[0];

        $clienteLicitacaoDAO = new ClienteLicitacaoDAO();

        $clienteLicitacao = $clienteLicitacaoDAO->listar($codCliente);

        if (!$clienteLicitacao) {
            Sessao::gravaMensagem("Cliente inexistente");
            $this->redirect('/clientelicitacao');
        }

        self::setViewParam('clienteLicitacao', $clienteLicitacao);
        $this->render('/clientelicitacao/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $clienteLicitacao = new ClienteLicitacao();
        $clienteLicitacao->setCodControle($_POST['codControle']);

        $clienteLicitacaoDAO = new ClienteLicitacaoDAO();

        if (!$clienteLicitacaoDAO->excluir($clienteLicitacao)) {
            Sessao::gravaMensagem("clienteLicitacao inexistente");
            $this->redirect('/clientelicitacao');
        }

        Sessao::gravaMensagem("clienteL excluido com sucesso!");

        $this->redirect('/clientelicitacao');
    }
}
