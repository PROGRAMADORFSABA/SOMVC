<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\SugestoesDAO;
use App\Services\SugestoesService;
use App\Services\InstituicaoService;
use App\Services\UsuarioService;
use App\Services\ClienteLicitacaoService;
use App\Services\EmailService;
use App\Models\Entidades\Sugestoes;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Usuario;
use App\Models\Validacao\SugestoesValidador;

class SugestoesController extends Controller
{

    public function index()
    {
        $sugestoes              = new Sugestoes();
        
        if($_POST){
            $sugestoes->setSugId($_POST['codigo']);
            $sugestoes->setSugDescricao($_POST['descricao']);
            $sugestoes->setSugStatus($_POST['status']);
            $sugestoes->setSugAnexo($_POST['anexo']);
            $sugestoes->setSugTipo($_POST['tipo']);
            $sugestoes->setSugDataCadastro($_POST['dataCadastro']);
            $sugestoes->setCodInstituicao($_POST['instituicao']);
            $sugestoes->getCodUsuario($_POST['usuario']);
         }
         $sugestoesService       = new SugestoesService();
         $usuarioService         = new UsuarioService();         
         $instituicaoService     = new InstituicaoService();

         self::setViewParam('listarUsuarios', $usuarioService->listar());                 
         self::setViewParam('listarSugestoes', $sugestoesService->listar($sugestoes));
       
        $this->render('/sugestoes/index');
        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
    }

    public function cadastro()
    {
        $sugestoes      = new Sugestoes();
           
        $instituicaoService = new InstituicaoService();     
        $usuarioService     = new UsuarioService();        
        
        self::setViewParam('listarUsuarios', $usuarioService->listar()); 
        self::setViewParam('listarInstituicao', $instituicaoService->listar()); 

        if(Sessao::existeFormulario()) {
            $instituicaoId  = Sessao::retornaValorFormulario('instituicao');
            $instituicao    = $instituicaoService->listar($instituicaoId);
            
            $usuarioId      = Sessao::retornaValorFormulario('usuario');
            $usuario        = $usuarioService->listar($usuarioId);
            
            $sugestoes->setInstituicao($instituicao);              
            $sugestoes->setUsuario($usuario);     
            $sugestoes->setSugDataCadastro(Sessao::retornaValorFormulario('dataCadastro'));                       
            $sugestoes->setSugTipo(Sessao::retornaValorFormulario('tipo'));                       
            $sugestoes->setSugDescricao(Sessao::retornaValorFormulario('descricao'));
            $sugestoes->setSugStatus(Sessao::retornaValorFormulario('status'));
            $sugestoes->setSugAnexo(Sessao::retornaValorFormulario('anexo'));
            
        }else{            
            $sugestoes->setUsuario(new Usuario());
            $sugestoes->setInstituicao(new Instituicao());          
        }
        $this->setViewParam('sugestoes',$sugestoes); 
        $this->render('/sugestoes/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }
    public function salvar()
    {              
        $usuarioService           = new UsuarioService();      
        $instituicaoService       = new InstituicaoService();        
        $sugestoesService         = new SugestoesService();
        $sugestoes                = new Sugestoes();
        $usuario                  = $usuarioService->listar($_POST['usuario']);
        $instituicao              = $instituicaoService->listar($_POST['instituicao']);
        
        $sugestoes->setSugDescricao($_POST['descricao']);
        $sugestoes->setSugStatus($_POST['status']);
        $sugestoes->setSugTipo($_POST['tipo']);
        $sugestoes->setSugAnexo($_POST['anexo']);
        $sugestoes->setSugDataCadastro($_POST['dataCadastro']);
        $sugestoes->setInstituicao($instituicao);
        $sugestoes->setUsuario($usuario);
        Sessao::gravaFormulario($_POST);        
               
        $sugestoesValidador   = new SugestoesValidador();
        $resultadoValidacao     = $sugestoesValidador->validar($sugestoes);
                
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/sugestoes/cadastro');
        }else{                 
            if (!$sugestoes) {           
                Sessao::gravaMensagem("sem dados informados");
                $this->redirect('/sugestoes/cadastro');
            }
            if ($codSugestoes  = $sugestoesService->salvar($sugestoes)) {
                $sugestoes->setSugId($codSugestoes);
                $sugestoes = $sugestoesService->listar($sugestoes)[0];    
                $emailService = new EmailService();
                $subject = 1;
                $emailService->emailSugestoes($sugestoes,$subject);
                $this->redirect('/sugestoes');
                Sessao::limpaFormulario();
                Sessao::limpaMensagem();
                Sessao::limpaErro();
            } else {
                Sessao::gravaMensagem("Erro ao gravar");
                $this->redirect('/sugestoes/cadastro');
            }
        }
    }

    public function edicao($params)
    {
        $codSugestoes = $params[0];
        
        $sugestoes      = new Sugestoes();
        $sugestoes->setSugId($codSugestoes);
        $instituicaoService = new InstituicaoService();     
        $usuarioService     = new UsuarioService();        
        $sugestoesService     = new SugestoesService();        

        if(Sessao::existeFormulario()) {
            $instituicaoId  = Sessao::retornaValorFormulario('instituicao');
            $instituicao    = $instituicaoService->listar($instituicaoId);
            
            $usuarioId      = Sessao::retornaValorFormulario('usuario');
            $usuario        = $usuarioService->listar($usuarioId);
            
            $sugestoes->setInstituicao($instituicao);              
            $sugestoes->setUsuario($usuario);     
            $sugestoes->setSugId(Sessao::retornaValorFormulario('codigo'));                       
            $sugestoes->setSugDataCadastro(Sessao::retornaValorFormulario('dataCadastro'));                       
            $sugestoes->setSugTipo(Sessao::retornaValorFormulario('tipo'));                       
            $sugestoes->setSugDescricao(Sessao::retornaValorFormulario('descricao'));
            $sugestoes->setSugStatus(Sessao::retornaValorFormulario('status'));
            $sugestoes->setSugAnexo(Sessao::retornaValorFormulario('anexoAlt'));
        }else{
            $sugestoes->setUsuario(new Usuario());
            $sugestoes->setInstituicao(new Instituicao());
            $sugestoes = $sugestoesService->listar($sugestoes)[0];
        }
        if (!$sugestoes) {
            $this->redirect('/sugestoes');
            Sessao::gravaMensagem("sugestoes inexistente");
        }
        self::setViewParam('sugestoes', $sugestoes);
        $this->render('/sugestoes/editar');
        Sessao::limpaMensagem();
    }
    
    public function atualizar()
    {
        $sugestoes = new Sugestoes();
        //sug_id, sug_tipo, sug_descricao, sug_status, sug_anexo, sug_datacadastro, sug_dataalteracao ,sug_instituicao, sug_usuario   
        
        $usuarioService       = new UsuarioService();        
        $sugestoesService     = new SugestoesService();        
        $instituicaoService   = new InstituicaoService();        
        
        $instituicaoId  = Sessao::retornaValorFormulario('instituicao');
        var_dump($instituicaoId);
        $instituicao    = $instituicaoService->listar($instituicaoId)[0];
        
        $usuarioId      = Sessao::retornaValorFormulario('usuario');
        $usuario        = $usuarioService->listar($usuarioId)[0];
        $sugestoes->setSugId($_POST['codigo']);
        $sugestoes->setSugDescricao($_POST['descricao']);
        $sugestoes->setSugStatus($_POST['status']);
        $sugestoes->setSugTipo($_POST['tipo']);
        $sugestoes->setSugAnexo($_POST['anexo']);
        $sugestoes->setSugDataCadastro($_POST['dataCadastro']);
        $sugestoes->setInstituicao($instituicao);
        $sugestoes->setUsuario($usuario);
        $anexo =  $_POST['anexo'];
        if($anexo == ""){
            $sugestoes->setSugAnexo($_POST['anexoAlt']);                    
        } else{
            $sugestoes->setSugAnexo($_POST['anexo']);        
        }
        Sessao::gravaFormulario($_POST);
        $sugestoesValidador = new SugestoesValidador();
        $resultadoValidacao = $sugestoesValidador->validar($sugestoes);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
           $this->redirect('/sugestoes/edicao/' . $_POST['codigo']);
        }
        if ($sugestoesService->Editar($sugestoes)) {
            $emailService = new EmailService();
            $subject = 2;
            $emailService->emailSugestoes($sugestoes, $subject);
                       
            $this->redirect('/sugestoes');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();           
        }else{
            Sessao::gravaFormulario($_POST);            
            Sessao::gravaMensagem("erro na atualizacao");
           // $this->redirect('/sugestoes/edicao/' . $_POST['codigo']);
        }
        
    }

    public function exclusao($params)
    {
        $id = $params[0];

        $sugestoesService = new SugestoesService();

        $sugestoes = $sugestoesService->listar($id)[0];

        if (!$sugestoes) {
            Sessao::gravaMensagem("sugestao inexistente");
            $this->redirect('/sugestoes');
        }

        self::setViewParam('sugestoes', $sugestoes);
        $this->render('/sugestoes/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $sugestoes          = new Sugestoes();
        $sugestoesService   = new SugestoesService();
        $sugestoes->setSugId($_POST['codigo']);

        if (!$sugestoesService->excluir($sugestoes)) {
            Sessao::gravaMensagem("sugestao inexistente");
            $this->redirect('/sugestoes');
        }
        $this->redirect('/sugestoes');

        Sessao::gravaMensagem("Cadastro excluido com sucesso!");

    }
}
