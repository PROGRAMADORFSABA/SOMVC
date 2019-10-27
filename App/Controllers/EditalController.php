<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\EditalDAO;
use App\Models\DAO\EstadoDAO;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Edital;
//use App\Models\Validacao\EditalValidador;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Estado;
use App\Services\EditalService;
use App\Services\EstadoService;
use App\Services\UsuarioService;


class EditalController extends Controller
{
    public function index($params)
    {
        $cidId = $params[0];
        $editalService = new EditalService();

        self::setViewParam('listaEditais', $editalService->listar($cidId));

        $this->render('/edital/index');

        Sessao::limpaMensagem();
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
        /*if(Sessao::existeFormulario()) { 
        $edital = new Edital();
        $estadoService = new EstadoService();
        $estId = Sessao::retornaValorFormulario('estado');
        $estado = $estadoService->listar($estId);
        $edital->setEstado($estado);
        }else{
            $edital = new Edital();
            $edital->setEstado(new Estado());
        }*/
        $this->setViewParam('edital',$edital);        
        $this->render('/edital/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $estadoService  = new EstadoService();        
        $usuarioService = new UsuarioService();        
        $estado         = $estadoService->listar($_POST['estado']);
        $usuario        = $usuarioService->listar($_POST['cidUsuario']);
        
        $edital = new Edital();
        $edital->setCidNome($_POST['cidNome']);        
        $edital->setEstado($estado);
        $edital->setUsuario($usuario);

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
        $cidId = $params[0];
        
        if(Sessao::existeFormulario()) { 
            $edital = new Edital();
            $edital->setCidId(Sessao::retornaValorFormulario('cidId'));
            $edital->setCidNome(Sessao::retornaValorFormulario('cidNome'));
            $edital->setCidDataAlteracao(Sessao::retornaValorFormulario('dataAlteracao'));
            $estadoService = new EstadoService();
            $usuarioService = new UsuarioService();
            $estId = Sessao::retornaValorFormulario('estado');
            $id = Sessao::retornaValorFormulario('cidUsuario');
            $estado = $estadoService->listar($estId);
            $usuario = $usuarioService->listar($id);
            $edital->setEstado($estado);
            $edital->setUsuario($usuario);
            
        }else{           
            $editalService = new EditalService();
            $edital = $editalService->listar($cidId)[0]; 
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
        $estadoService  = new EstadoService();        
        $usuarioService = new UsuarioService();        
        $estado         = $estadoService->listar($_POST['estado']);
        $usuario        = $usuarioService->listar($_POST['cidUsuario']);
        
        $edital = new Edital();
        
        $edital->setCidId($_POST['cidId']);
        $edital->setCidNome($_POST['cidNome']);
        $edital->setEstado($estado);
        $edital->setUsuario($usuario);
        $edital->setCidDataAlteracao($_POST['dataAlteracao']);
        
        
        $editalValidador = new EditalValidador();
        $resultadoValidacao = $editalValidador->validar($edital);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            Sessao::gravaMensagem("erro na atualizacao");
            Sessao::gravaFormulario($_POST);
            $this->redirect('/edital/edicao/' . $_POST['cidId']);
        }
        
        $editalService = new EditalService();        
        if ($editalService->Editar($edital)) {
            $this->redirect('/edital');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
        }else{
            Sessao::gravaFormulario($_POST);            
            Sessao::gravaMensagem("erro na atualizacao");
          $this->redirect('/edital/edicao/' . $_POST['cidId']);
        }

    }
    
    public function exclusao($params)
    {
        $cidId = $params[0];

        $editalService = new EditalService();

        $edital = $editalService->listar($cidId)[0];

        if (!$edital) {
        Sessao::gravaMensagem("Edital inexistente");
            $this->redirect('/edital');
        }

        self::setViewParam('edital', $edital);

        $this->render('/edital/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $edital = new Edital();
        $edital->setCidId($_POST['cidId']);

        $editalService= new EditalService();

        if (!$editalService->excluir($edital)) {
            Sessao::gravaMensagem("Edital inexistente");
            $this->redirect('/edital/exclusao'.$edital->getCidId());
        }

        Sessao::gravaMensagem("Edital excluido com sucesso!");

        $this->redirect('/edital');
    }

}
