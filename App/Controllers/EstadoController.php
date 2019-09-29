<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\EstadoDAO;
use App\Models\Entidades\Estado;
use App\Models\Validacao\EstadoValidador;
use App\Services\EstadoService;

class EstadoController extends Controller
{
    public function index()
    {
        $estadoDAO = new EstadoDAO();

        self::setViewParam('listaEstados',$estadoDAO->listar());      

        $this->render('/estado/index');

        Sessao::limpaMensagem();
    }

    public function autoComplete($params)
    {
        $estado = new Estado();
        $estado->setEstNome($params[0]);        
        $estadoService = new EstadoService();
        $busca = $estadoService->autoComplete($estado);
        
        echo $busca;
    }


    public function cadastro()
    {
        $this->render('/estado/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar() {
        $estado = new Estado();
        $estado->setEstNome($_POST['estNome']);
        $estado->setEstUf($_POST['estUf']);
        $estado->setEstUsuario($_POST['estUsuario']);
        
        Sessao::gravaFormulario($_POST);

        $estadoValidador = new EstadoValidador();
        $resultadoValidacao = $estadoValidador->validar($estado);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/estado/cadastro');
        }

        $estadoDAO = new EstadoDAO();

        $estadoDAO->salvar($estado);
        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/estado');
      
    }
    
    public function edicao($params){
        $estId = $params[0];

        $estadoDAO = new EstadoDAO();

        $estado = $estadoDAO->listar($estId);

        if(!$estado){
            Sessao::gravaMensagem("Estado inexistente");
            $this->redirect('/estado');
        }

        self::setViewParam('estado',$estado);

        $this->render('/estado/editar');

        Sessao::limpaMensagem();

    }

    public function atualizar()   {

        $estado = new Estado();
        $estado->setEstId($_POST['estId']);
        $estado->setEstNome($_POST['estNome']);
        $estado->setEstUf($_POST['estUf']);
        $estado->setEstUsuario($_POST['estUsuario']);
        
        Sessao::gravaFormulario($_POST);

        $estadoValidador = new EstadoValidador();
        $resultadoValidacao = $estadoValidador->validar($estado);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/estado/edicao/'.$_POST['estId']);
        }

        $estadoDAO = new EstadoDAO();

        $estadoDAO->atualizar($estado);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/estado');

    }
    
    public function exclusao($params)
    {
        $estId = $params[0];

        $estadoDAO = new EstadoDAO();

        $estado = $estadoDAO->listar($estId);

        if(!$estado){
            Sessao::gravaMensagem("Estado inexistente");
            $this->redirect('/estado');
        }

        self::setViewParam('estado',$estado);

        $this->render('/estado/exclusao');

        Sessao::limpaMensagem();

    }

    public function excluir()
    {
        $estado = new Estado();
        $estado->setEstId($_POST['estId']);

        $estadoDAO = new EstadoDAO();

        if(!$estadoDAO->excluir($estado)){
            Sessao::gravaMensagem("Estado inexistente");
            $this->redirect('/estado');
        }

        Sessao::gravaMensagem("Estado excluido com sucesso!");

        $this->redirect('/estado');
 
        Sessao::limpaMensagem();

    }
}