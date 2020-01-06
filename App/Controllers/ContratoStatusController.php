<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\Entidades\ContratoStatus;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;
use App\Models\Validacao\ContratoStatusValidador;
use App\Services\ContratoStatusService;
use App\Services\UsuarioService;
use App\Services\InstituicaoService;


class ContratoStatusController extends Controller
{
    public function index()
    {       
       
        $contratoStatusService = new ContratoStatusService();
        $contratoStatus = new ContratoStatus();      
        
       if($_POST){
           $contratoStatus->setStEdtId($_POST['codStatus']);           
           $contratoStatus->setStEdtNome($_POST['nome']);                   
        }
        
        self::setViewParam('listarContratoStatus', $contratoStatusService->listar($contratoStatus));
        //$this->render('/ContratoStatus/index');
        //$this->render('/home/index');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
    }

    public function cadastro()
    {
        
        $instituicaoService = new InstituicaoService();
        $usuarioService = new UsuarioService();
        $contratoStatus = new ContratoStatus();

        if(Sessao::existeFormulario()) {
     
        $instituicaoId = Sessao::retornaValorFormulario('instituicao');
        $instituicao = $instituicaoService->listar($instituicaoId)[0];
        $contratoStatus->setStEdtInstituicao($instituicao);
       
        $usuarioId = Sessao::retornaValorFormulario('usuario');
        $usuario = $usuarioService->listar($usuarioId)[0];
        $contratoStatus->setStEdtUsuario($usuario);
        }else{                        
            $contratoStatus->setStEdtInstituicao(new Instituicao());
            $contratoStatus->setStEdtUsuario(new Usuario());
        }
        $this->setViewParam('ContratoStatus',$contratoStatus);        
        //$this->render('/ContratoStatus/cadastro');
        //$this->render('/home/index');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {       
        $usuarioService     = new UsuarioService();        
        $instituicaoService = new InstituicaoService();   
        $contratoStatus     = new ContratoStatus();          
        $usuario            = $usuarioService->listar($_POST['usuario']);
        $instituicao        = $instituicaoService->listar($_POST['instituicao']);
        
        $contratoStatus->setStEdtNome($_POST['nome']);       
        $contratoStatus->setStEdtDataCadastro($_POST['dataCadastro']);        
        $contratoStatus->setStEdtDataAlteracao($_POST['dataAlteracao']);  
        $contratoStatus->setStEdtObservacao($_POST['observacao']);        
        $contratoStatus->setInstituicao($instituicao);
        $contratoStatus->setUsuario($usuario);

        Sessao::gravaFormulario($_POST);

        $contratoStatusValidador = new ContratoStatusValidador();
        $resultadoValidacao    = $contratoStatusValidador->validar($contratoStatus);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
           //$this->redirect('/ContratoStatus/cadastro');
        }

        $contratoStatusService = new ContratoStatusService();
    
       if($contratoStatusService->salvar($contratoStatus)){
            //$this->redirect('/ContratoStatus');
        }else{
            //$this->redirect('/ContratoStatus/cadastro');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function edicao($params)
    {
        $contratoStatusId    = $params[0];
        $instituicaoService  = new InstituicaoService();
        $usuarioService      = new UsuarioService();
        $contratoStatus      = new ContratoStatus();
        $contratoStatus->setStCtrId($contratoStatusId);

        if(Sessao::existeFormulario()) { 
            $instituicaoId  = Sessao::retornaValorFormulario('instituicao');
            $instituicao    = $instituicaoService->listar($instituicaoId)[0];
            $usuarioId      = Sessao::retornaValorFormulario('usuario');
            $usuario        = $usuarioService->listar($usuarioId)[0];

            $contratoStatus->setStEdtInstituicao($instituicao);
            $contratoStatus->setStEdtUsuario($usuario);
            
        }else{                       
            $contratoStatusService = new ContratoStatusService();
            $contratoStatus        = $contratoStatusService->listar($contratoStatus)[0]; 
        }        

        if (!$contratoStatus) {
            Sessao::gravaMensagem("Cadastro inexistente");
            //$this->redirect('/ContratoStatus');           
        }
            
        $this->setViewParam('ContratoStatus', $contratoStatus);
       
        //$this->render('/ContratoStatus/editar');
        //$this->render('/home/index');
        Sessao::limpaMensagem();
    }

    public function atualizar()
    {       
        $contratoStatus     = new ContratoStatus();
        $usuarioService     = new UsuarioService();             
        $instituicaoService = new InstituicaoService();        
        $usuario            = $usuarioService->listar($_POST['usuario']);
        $instituicao        = $instituicaoService->listar($_POST['instituicao']);

        $contratoStatus = new ContratoStatus();
        $contratoStatus->setStEdtId($_POST['codStatus']);
        $contratoStatus->setStEdtNome($_POST['nome']);
        $contratoStatus->setStEdtDataCadastro($_POST['dataCadastro']); 
        $contratoStatus->setStEdtDataAlteracao($_POST['dataAlteracao']);  
        $contratoStatus->setStEdtObservacao($_POST['observacao']);        
        $contratoStatus->setInstituicao($instituicao);
        $contratoStatus->setUsuario($usuario);

        Sessao::gravaFormulario($_POST);

        $contratoStatusService = new ContratoStatusService();
    
        $contratoStatusValidador = new ContratoStatusValidador();
        $resultadoValidacao = $contratoStatusValidador->validar($contratoStatus);
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            Sessao::gravaMensagem("erro na atualizacao");
            Sessao::gravaFormulario($_POST);
           //$this->redirect('/ContratoStatus/edicao/' . $_POST['codigo']);
        }
        
         if ($contratoStatusService->Editar($contratoStatus)) {
            $this->redirect('/ContratoStatus');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
           
        }else{
            Sessao::gravaFormulario($_POST);            
            Sessao::gravaMensagem("erro na atualizacao");
          //$this->redirect('/ContratoStatus/edicao/' . $_POST['codigo']);
        }

    }
    
    public function exclusao($params)
    {
        $contratoStatusId         = $params[0];
        $contratoStatusService    = new ContratoStatusService();
        $contratoStatus           = $contratoStatusService->listar($contratoStatusId)[0];

        if (!$contratoStatus) {
        Sessao::gravaMensagem("Cadastro inexistente!");
            //$this->redirect('/ContratoStatus');
        }
       
        self::setViewParam('ContratoStatus', $contratoStatus);           

       // $this->render('/ContratoStatus/exclusao');
       //$this->render('/home/index');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $contratoStatus = new ContratoStatus();
        $contratoStatus->setStEdtId($_POST['codStatus']);

        $contratoStatusService = new ContratoStatusService();        

        if (!$contratoStatusService->excluir($contratoStatus)) {
            Sessao::gravaMensagem("ContratoStatus inexistente");
            //$this->redirect('/ContratoStatus/exclusao'.$contratoStatus->getStCtrId());
        }

        Sessao::gravaMensagem("ContratoStatus excluido com sucesso!");

        //$this->redirect('/ContratoStatus');
    }

}
