<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\Entidades\EditalStatus;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;
use App\Models\Validacao\EditalStatusValidador;
use App\Services\EditalStatusService;
use App\Services\UsuarioService;
use App\Services\InstituicaoService;


class EditalStatusController extends Controller
{
    public function index()
    {        
        $editalStatusService = new EditalStatusService();
        $editalStatus = new EditalStatus();      
        
       if($_POST){
           $editalStatus->setStEdtId($_POST['codStatus']);           
           $editalStatus->setStEdtNome($_POST['nome']);                   
        }
        
        self::setViewParam('listaEditaisStatus', $editalStatusService->listar($editalStatus));
        //$this->render('/EditalStatus/index');
        $this->render('/home/index');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
    }

    public function cadastro()
    {
        
        $instituicaoService = new InstituicaoService();
        $usuarioService = new UsuarioService();
        $editalStatus = new EditalStatus();

        if(Sessao::existeFormulario()) {
     
        $instituicaoId = Sessao::retornaValorFormulario('instituicao');
        $instituicao = $instituicaoService->listar($instituicaoId)[0];
        $editalStatus->setStEdtInstituicao($instituicao);
       
        $usuarioId = Sessao::retornaValorFormulario('usuario');
        $usuario = $usuarioService->listar($usuarioId)[0];
        $editalStatus->setStEdtUsuario($usuario);
        }else{                        
            $editalStatus->setStEdtInstituicao(new Instituicao());
            $editalStatus->setStEdtUsuario(new Usuario());
        }
        $this->setViewParam('EditalStatus',$editalStatus);        
        //$this->render('/EditalStatus/cadastro');
        $this->render('/home/index');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {       
        $usuarioService     = new UsuarioService();        
        $instituicaoService = new InstituicaoService();   
        $editalStatus       = new EditalStatus();          
        $usuario            = $usuarioService->listar($_POST['usuario']);
        $instituicao        = $instituicaoService->listar($_POST['instituicao']);
        
        $editalStatus->setStEdtNome($_POST['nome']);       
        $editalStatus->setStEdtDataCadastro($_POST['dataCadastro']);        
        $editalStatus->setStEdtDataAlteracao($_POST['dataAlteracao']);  
        $editalStatus->setStEdtObservacao($_POST['observacao']);        
        $editalStatus->setInstituicao($instituicao);
        $editalStatus->setUsuario($usuario);

        Sessao::gravaFormulario($_POST);

        $editalStatusValidador = new EditalStatusValidador();
        $resultadoValidacao    = $editalStatusValidador->validar($editalStatus);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
           $this->redirect('/EditalStatus/cadastro');
        }

        $editalStatusService = new EditalStatusService();
    
       if($editalStatusService->salvar($editalStatus)){
            $this->redirect('/EditalStatus');
        }else{
            $this->redirect('/EditalStatus/cadastro');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function edicao($params)
    {
        $editalStatusId      = $params[0];
        $instituicaoService  = new InstituicaoService();
        $usuarioService     = new UsuarioService();
        $editalStatus       = new EditalStatus();
        
        if(Sessao::existeFormulario()) { 
            $instituicaoId  = Sessao::retornaValorFormulario('instituicao');
            $instituicao    = $instituicaoService->listar($instituicaoId)[0];
            $usuarioId      = Sessao::retornaValorFormulario('usuario');
            $usuario        = $usuarioService->listar($usuarioId)[0];

            $editalStatus->setStEdtInstituicao($instituicao);
            $editalStatus->setStEdtUsuario($usuario);
            
        }else{                       
            $editalStatusService = new EditalStatusService();
            $editalStatus        = $editalStatusService->listar($editalStatusId)[0]; 
        }        

        if (!$editalStatus) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/EditalStatus');           
        }
            
        $this->setViewParam('EditalStatus', $editalStatus);
       
        //$this->render('/EditalStatus/editar');
        $this->render('/home/index');
        Sessao::limpaMensagem();
    }

    public function atualizar()
    {       
        $editalStatus       = new EditalStatus();
        $usuarioService     = new UsuarioService();             
        $instituicaoService = new InstituicaoService();        
        $usuario            = $usuarioService->listar($_POST['usuario']);
        $instituicao        = $instituicaoService->listar($_POST['instituicao']);

        $editalStatus = new EditalStatus();
        $editalStatus->setStEdtId($_POST['codStatus']);           
        $editalStatus->setStEdtNome($_POST['nome']);       
        $editalStatus->setStEdtDataCadastro($_POST['dataCadastro']);        
        $editalStatus->setStEdtDataAlteracao($_POST['dataAlteracao']);  
        $editalStatus->setStEdtObservacao($_POST['observacao']);        
        $editalStatus->setInstituicao($instituicao);
        $editalStatus->setUsuario($usuario);

        Sessao::gravaFormulario($_POST);

        $editalStatusService = new EditalStatusService();
    
        $editalStatusValidador = new EditalStatusValidador();
        $resultadoValidacao = $editalStatusValidador->validar($editalStatus);
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            Sessao::gravaMensagem("erro na atualizacao");
            Sessao::gravaFormulario($_POST);
           $this->redirect('/EditalStatus/edicao/' . $_POST['codigo']);
        }
        
         if ($editalStatusService->Editar($editalStatus)) {
            $this->redirect('/EditalStatus');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
           
        }else{
            Sessao::gravaFormulario($_POST);            
            Sessao::gravaMensagem("erro na atualizacao");
          $this->redirect('/EditalStatus/edicao/' . $_POST['codigo']);
        }

    }
    
    public function exclusao($params)
    {
        $editalStatusId         = $params[0];
        $editalStatusService    = new EditalStatusService();
        $editalStatus           = $editalStatusService->listar($editalStatusId)[0];

        if (!$editalStatus) {
        Sessao::gravaMensagem("Cadastro inexistente!");
            $this->redirect('/EditalStatus');
        }
       
        self::setViewParam('EditalStatus', $editalStatus);           

       // $this->render('/EditalStatus/exclusao');
       $this->render('/home/index');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $editalStatus = new EditalStatus();
        $editalStatus->setStEdtId($_POST['codStatus']);

        $editalStatusService = new EditalStatusService();        

        if (!$editalStatusService->excluir($editalStatus)) {
            Sessao::gravaMensagem("EditalStatus inexistente");
            $this->redirect('/EditalStatus/exclusao'.$editalStatus->getStEdtId());
        }

        Sessao::gravaMensagem("EditalStatus excluido com sucesso!");

        $this->redirect('/EditalStatus');
    }

}
