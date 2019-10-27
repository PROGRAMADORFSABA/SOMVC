<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ContratoDAO;
use App\Models\DAO\EstadoDAO;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Contrato;
//use App\Models\Validacao\ContratoValidador;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Estado;
use App\Services\ContratoService;
use App\Services\EstadoService;
use App\Services\UsuarioService;


class ContratoController extends Controller
{
    public function index($params)
    {
        $cidId = $params[0];
        $contratoService = new ContratoService();

        self::setViewParam('listaContratos', $contratoService->listar($cidId));

        $this->render('/contrato/index');

        Sessao::limpaMensagem();
    }

    public function autoComplete($params)
    {
        $contrato = new Contrato();
        $contrato->CidNome($params[0]);        
        $contratoService = new ContratoService();
        $busca = $contratoService->autoComplete($contrato);
        
        echo $busca;
    }

    public function cadastro()
    {
        /*if(Sessao::existeFormulario()) { 
        $contrato = new Contrato();
        $estadoService = new EstadoService();
        $estId = Sessao::retornaValorFormulario('estado');
        $estado = $estadoService->listar($estId);
        $contrato->setEstado($estado);
        }else{
            $contrato = new Contrato();
            $contrato->setEstado(new Estado());
        }*/
        $this->setViewParam('contrato',$contrato);        
        $this->render('/contrato/cadastro');
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
        
        $contrato = new Contrato();
        $contrato->setCidNome($_POST['cidNome']);        
        $contrato->setEstado($estado);
        $contrato->setUsuario($usuario);

        Sessao::gravaFormulario($_POST);

        $contratoValidador    = new ContratoValidador();
        $resultadoValidacao = $contratoValidador->validar($contrato);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/contrato/cadastro');
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
        $cidId = $params[0];
        
        if(Sessao::existeFormulario()) { 
            $contrato = new Contrato();
            $contrato->setCidId(Sessao::retornaValorFormulario('cidId'));
            $contrato->setCidNome(Sessao::retornaValorFormulario('cidNome'));
            $contrato->setCidDataAlteracao(Sessao::retornaValorFormulario('dataAlteracao'));
            $estadoService = new EstadoService();
            $usuarioService = new UsuarioService();
            $estId = Sessao::retornaValorFormulario('estado');
            $id = Sessao::retornaValorFormulario('cidUsuario');
            $estado = $estadoService->listar($estId);
            $usuario = $usuarioService->listar($id);
            $contrato->setEstado($estado);
            $contrato->setUsuario($usuario);
            
        }else{           
            $contratoService = new ContratoService();
            $contrato = $contratoService->listar($cidId)[0]; 
        }
       
        if (!$contrato) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/contrato');
        }
            
       $this->setViewParam('contrato', $contrato);
       
        $this->render('/contrato/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $estadoService  = new EstadoService();        
        $usuarioService = new UsuarioService();        
        $estado         = $estadoService->listar($_POST['estado']);
        $usuario        = $usuarioService->listar($_POST['cidUsuario']);
        
        $contrato = new Contrato();
        $contrato->setCidId($_POST['cidId']);
        $contrato->setCidNome($_POST['cidNome']);
        $contrato->setEstado($estado);
        $contrato->setUsuario($usuario);
        $contrato->setCidDataAlteracao($_POST['dataAlteracao']);
        
        
        $contratoValidador = new ContratoValidador();
        $resultadoValidacao = $contratoValidador->validar($contrato);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            Sessao::gravaMensagem("erro na atualizacao");
            Sessao::gravaFormulario($_POST);
            $this->redirect('/contrato/edicao/' . $_POST['cidId']);
        }
        
        $contratoService = new ContratoService();        
        if ($contratoService->Editar($contrato)) {
            $this->redirect('/contrato');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
        }else{
            Sessao::gravaFormulario($_POST);            
            Sessao::gravaMensagem("erro na atualizacao");
          $this->redirect('/contrato/edicao/' . $_POST['cidId']);
        }

    }
    
    public function exclusao($params)
    {
        $cidId = $params[0];

        $contratoService = new ContratoService();

        $contrato = $contratoService->listar($cidId)[0];

        if (!$contrato) {
        Sessao::gravaMensagem("Contrato inexistente");
            $this->redirect('/contrato');
        }

        self::setViewParam('contrato', $contrato);

        $this->render('/contrato/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $contrato = new Contrato();
        $contrato->setCidId($_POST['cidId']);

        $contratoService= new ContratoService();

        if (!$contratoService->excluir($contrato)) {
            Sessao::gravaMensagem("Contrato inexistente");
            $this->redirect('/contrato/exclusao'.$contrato->getCidId());
        }

        Sessao::gravaMensagem("Contrato excluido com sucesso!");

        $this->redirect('/contrato');
    }

}
