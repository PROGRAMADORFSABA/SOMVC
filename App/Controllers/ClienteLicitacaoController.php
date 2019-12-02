<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ClienteLicitacaoDAO;
use App\Models\Entidades\ClienteLicitacao;
use App\Models\Entidades\Contrato;
use App\Models\Validacao\ClienteLicitacaoValidador;
use App\Services\ClienteLicitacaoService;

class ClienteLicitacaoController extends Controller
{

    public function index()
    {
        $clienteLicitacaoService = new ClienteLicitacaoService();

        self::setViewParam('listar', $clienteLicitacaoService->listar());

        $this->render('/clientelicitacao/index');

        Sessao::limpaMensagem();
    }

    public function autoComplete($params)
    {        
        $clienteLicitacao = new ClienteLicitacao();
        $clienteService   = new ClienteLicitacaoService();
        $clienteLicitacao->setRazaoSocial($params[0]);
        
        $busca = $clienteService->autoComplete($clienteLicitacao);
        
        echo $busca;
    }
    
    public function listarClienteFalta($params)
    {
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $clienteLicitacao        =  new ClienteLicitacao();

        $clienteLicitacao->setNomeFantasia($params[0]);

        $busca = $clienteLicitacaoService->listarClienteFalta($clienteLicitacao);

        echo $busca;
    }
    
    public function cadastro()
    {
        $clienteLicitacao = new ClienteLicitacao();

        if(Sessao::existeFormulario()) {             
            $clienteLicitacao->setCnpj(Sessao::retornaValorFormulario('cnpj'));
            $clienteLicitacao->setRazaoSocial(Sessao::retornaValorFormulario('razaoSocial'));
            $clienteLicitacao->setNomeFantasia(Sessao::retornaValorFormulario('nomeFantasia'));
            $clienteLicitacao->setTipoCliente(Sessao::retornaValorFormulario('tipoCliente'));            
        }
        
        $this->render('/clientelicitacao/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $clienteLicitacao        = new ClienteLicitacao();
        $clienteLicitacaoService = new ClienteLicitacaoService();

        // $clienteLicitacao->setDataCadastro($_POST['dataCadastro']);
        //date_format($date, 'Y-m-d H:i:s');
        $clienteLicitacao->setCnpj($_POST['cnpj']);
        $clienteLicitacao->setRazaoSocial($_POST['razaoSocial']);
        $clienteLicitacao->setNomeFantasia($_POST['nomeFantasia']);
        $clienteLicitacao->setTrocaMarca($_POST['trocaMarca']);
        $clienteLicitacao->setTipoCliente($_POST['tipoCliente']);
        Sessao::gravaFormulario($_POST);

        if ($clienteLicitacaoService->salvar($clienteLicitacao)) {
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
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $clienteLicitacao        = new ClienteLicitacao();
        if(Sessao::existeFormulario()) {             
            $clienteLicitacao->setCodCliente(Sessao::retornaValorFormulario('codCliente'));
            $clienteLicitacao->setCnpj(Sessao::retornaValorFormulario('cnpj'));
            $clienteLicitacao->setRazaoSocial(Sessao::retornaValorFormulario('razaoSocial'));
            $clienteLicitacao->setNomeFantasia(Sessao::retornaValorFormulario('nomeFantasia'));
            $clienteLicitacao->setTipoCliente(Sessao::retornaValorFormulario('tipoCliente'));            
        }else{            
            $clienteLicitacao = $clienteLicitacaoService->listar($codCliente);
        }
        if (!$codCliente) {
            Sessao::gravaMensagem("Nenhum Cadastro Selecionado");
            $this->redirect('/clientelicitacao');
        }
        if (!$clienteLicitacao) {
            Sessao::gravaMensagem("Cliente inexistente");
            $this->redirect('/clientelicitacao');
        }

        self::setViewParam('clientelicitacao', $clienteLicitacao);
        $this->render('/clientelicitacao/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $clienteLicitacao        = new ClienteLicitacao();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        //$clienteLicitacao->setDataCadastro($_POST['dataCadastro']);
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

        Sessao::gravaFormulario($_POST);
        $clienteLicitacaoValidacao = new ClienteLicitacaoValidador();
        $clienteLicitacaoValidacao = $clienteLicitacaoValidacao->validar($clienteLicitacao);
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
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $clienteLicitacao        = $clienteLicitacaoService->listar($codCliente);

        if (!$clienteLicitacao) {
            Sessao::gravaMensagem("Cliente inexistente");
            $this->redirect('/clientelicitacao');
        }

        self::setViewParam('clientelicitacao', $clienteLicitacao);
        $this->render('/clientelicitacao/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $clienteLicitacao        = new ClienteLicitacao();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $clienteLicitacao->setCodControle($_POST['codControle']);

        $clienteLicitacaoDAO = new ClienteLicitacaoDAO();

        if (!$clienteLicitacaoDAO->excluir($clienteLicitacao)) {
            Sessao::gravaMensagem("cliente Licitacao inexistente");
            $this->redirect('/clientelicitacao');
        }

        Sessao::gravaMensagem("Cadastro excluido com sucesso!");

        $this->redirect('/clientelicitacao');
    }
}
