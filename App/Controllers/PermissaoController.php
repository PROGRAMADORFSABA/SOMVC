<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\PermissaoDAO;
use App\Services\SugestoesService;
use App\Services\PermissaoService;
use App\Services\InstituicaoService;
use App\Services\UsuarioService;
use App\Services\ClienteLicitacaoService;
use App\Services\EmailService;
use App\Models\Entidades\Sugestoes;
use App\Models\Entidades\Permissao;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Usuario;
use App\Models\Validacao\PermissaoValidador;
use App\Models\Validacao\SugestoesValidador;

class PermissaoController extends Controller
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
       
        $this->render('/permissao/index');
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
            $instituicao    = $instituicaoService->listar($instituicaoId)[0];
            
            $usuarioId      = Sessao::retornaValorFormulario('usuario');
            $usuario        = $usuarioService->listar($usuarioId)[0];
            
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
        $this->render('/permissao/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }
    public function salvar()
    {
       
        $teste = $_POST['tabela'];
         var_dump($teste);
            for ($i = 0; $i < count($teste) ; $i++) { 
                echo "<br> teste  " .$i. "<br>";
            }
        if(isset($_POST['tabela'])){
            $tabelas = $_POST['tabela'];
           
            foreach($tabelas as $tabela){
                if($tabela == "1"){       
                    $tabela = 1;             
                    echo "<br> checado = ". $tabela."<br>";   
                }else{                
                    echo "<br> nao checado = ". $tabela."<br>";   
                }
            }
        }  else{
            $tabela = 0;             
                echo "<br> teste $tabela <br>";
        }    
        
        //12 campo
        $usuarioService           = new UsuarioService();      
        $instituicaoService       = new InstituicaoService();        
        $permissaoService         = new PermissaoService();
        $permissao                = new Permissao();
       /* $permissaos = ['3','2','3','4','5','6','7','2019-06-04 10:34:57','2019-06-04 10:34:57','3','8'];
        $usuario                  = $usuarioService->listar(8);//($_POST['usuario']);
        $instituicao              = $instituicaoService->listar(3);//($_POST['instituicao']);                   
        
        if (isset($permissao)){
            
            for ($i = 0; $i < count($permissaos) ; $i++) { 
                    $permissao->setPerCodigo($permissaos);
                    $permissao->setPerAlterar($permissaos);
                    $permissao->setPerGrupo($permissaos);
                    $permissao->setPerIncluir($permissaos);
                    $permissao->setPerExcluir($permissaos);
                    $permissao->setPerImprimir($permissaos);
                    $permissao->setPerRelatorio($permissaos);
                    $permissao->setPerVisualisar($permissaos);
                    $permissao->setPerPesquisar($permissaos);
                    $permissao->setPerTela($permissaos);
                    $permissao->setPerDataCadastro($permissaos);
                    $permissao->setPerDataAlteracao($permissaos);
                    $permissao->setInstituicao( $instituicao);
                    $permissao->setUsuario($usuario);              
                   
//                    var_dump($permissao);
                    $permissaoService->salvar($permissao);
                }
            }*/
            Sessao::gravaFormulario($_POST);        
            
            $permissaoValidador     = new PermissaoValidador();
            $resultadoValidacao     = $permissaoValidador->validar($permissao);
            
            if ($resultadoValidacao->getErros()) {
                Sessao::gravaErro($resultadoValidacao->getErros());
              //  $this->redirect('/permissao/cadastro');
            }else{                 
                if (!$permissao) {           
                    Sessao::gravaMensagem("sem dados informados");
                //    $this->redirect('/permissao/cadastro');
                }
           /* if ($codPermissao  = $permissaoService->salvar($permissao)) {
               
                $this->redirect('/permissao');
                Sessao::limpaFormulario();
                Sessao::limpaMensagem();
                Sessao::limpaErro();
            } else {
                Sessao::gravaMensagem("Erro ao gravar");
                //$this->redirect('/permissao/cadastro');
            }*/
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
            $this->redirect('/permissao');
            Sessao::gravaMensagem("sugestoes inexistente");
        }
        self::setViewParam('sugestoes', $sugestoes);
        $this->render('/permissao/editar');
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
       // var_dump($instituicaoId);
        $instituicao    = $instituicaoService->listar($instituicaoId);
        
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
           $this->redirect('/permissao/edicao/' . $_POST['codigo']);
        }
        if ($sugestoesService->Editar($sugestoes)) {
            $emailService = new EmailService();
            $subject = 2;
            $emailService->emailSugestoes($sugestoes, $subject);
                       
            $this->redirect('/permissao');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();           
        }else{
            Sessao::gravaFormulario($_POST);            
            Sessao::gravaMensagem("erro na atualizacao");
            $this->redirect('/permissao/edicao/' . $_POST['codigo']);
        }
        
    }

    public function exclusao($params)
    {
        $sugestoes          = new Sugestoes();
        $sugestoesService   = new SugestoesService();
        $codSugestoes = $params[0];

        $sugestoes->setSugId($codSugestoes);
        $sugestoes = $sugestoesService->listar($sugestoes)[0];

        if (!$sugestoes) {
            Sessao::gravaMensagem("sugestao inexistente");
            $this->redirect('/permissao');
        }

        self::setViewParam('sugestoes', $sugestoes);
        $this->render('/permissao/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $sugestoes          = new Sugestoes();
        $sugestoesService   = new SugestoesService();
        $sugestoes->setSugId($_POST['codigo']);

        if (!$sugestoesService->excluir($sugestoes)) {
            Sessao::gravaMensagem("sugestao inexistente");
            $this->redirect('/permissao');
        }
              
        $this->redirect('/permissao');

        Sessao::gravaMensagem("Cadastro excluido com sucesso!");

    }
}
