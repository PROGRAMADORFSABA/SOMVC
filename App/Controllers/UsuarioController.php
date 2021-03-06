<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\DepartamentoDAO;
use App\Models\Entidades\Usuario;
use App\Services\UsuarioService;
use App\Services\EmailService;

use App\Models\Validacao\UsuarioValidador;

class UsuarioController extends Controller
{

    public function index()
    {
        $usuarioService = new UsuarioService();

        self::setViewParam('listaUsuarios', $usuarioService->listar());

        $this->render('/usuario/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {

        $departamentoDAO = new DepartamentoDAO();
        self::setViewParam('listaDepartamentos', $departamentoDAO->listar());
        $this->render('/usuario/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
    }

    public function salvar()
    {
        $usuario = new Usuario();
        $usuarioService = new UsuarioService();
        $usuario->setNome($_POST['nome']);
        $usuario->setNivel($_POST['nivel']);
        $usuario->setEmail($_POST['email']);
        $usuario->setId_dep($_POST['id_dep']);
        $usuario->setStatus($_POST['status']);
        $usuario->setDataCadastro($_POST['dataCadastro']);
        $usuario->setValida($_POST['valida']);
        $usuario->setDica($_POST['dica']);
        $usuario->setSenha($_POST['senha']);
        $usuario->setFk_Instituicao($_POST['fk_instituicao']);

        Sessao::gravaFormulario($_POST);

        if ($usuarioService->verificaEmail($_POST['email'])) {
            Sessao::gravaMensagem("Email existente");
            $this->redirect('/usuario/cadastro');
        }

        if ($usuarioId = $usuarioService->salvar($usuario)) {
           // $usuario->setId($usuarioId);
            $usuarioId = $usuarioService->listar($usuarioId);
            $email = $_POST['email'];               
            $emailService = new EmailService();
            $subject = 1;
            $emailService->emailUsuario($usuario,$email, $subject);

            //$to = $usuario->setEmail($_POST['email']);
            $to = "vendas2@fabmed.com.br";
			$valida = md5($to);
          
			$subject = "Cadastro no Sistema de Ocorrencias"; // assunto
			$message = "Validacao de cadastro " . "\r\n";
            $message .= "<a href=http://www.coisavirtual.com.br/usuario/validaUsuario/?v=$valida&v2=$to&v3=$usuarioId> Click aqui para validar seu cadastro </a>";
            $message .= "<a href=http://localhost/SOMVC/usuario/validausuario/?v=$valida&v2=$to&v3=$usuarioId> Click aqui para validar seu cadastro </a>";          
            $headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n"; //formato
			//$headers .= 'To: Carlos Andre <programadorfsaba@gmail.com>' . "\r\n"; //
			$headers .= 'From:< noreply@devaction.com.br>' . "\r\n"; //email de envio
			//$headers .= 'From:< contato@sistemaocorrencia.com.br>' . "\r\n"; //email de envio
			//$headers .= 'CC:<' . $emailUser . '>' . "\r\n"; //email com copia
			$headers .= 'Reply-To: < suporte@devaction.com.br>' . "\r\n"; //email para resposta
			mail($to, $subject, $message, $headers);

            $this->redirect('/usuario/sucesso');
        } else {
            Sessao::gravaMensagem("Erro ao gravar");
        }
    }

    public function validausuario()
    {        
        $to = "programadorfsaba@gmail.com";
            $valida = md5($to);
            $usuarioId = 25;
        $message .= "<a href=http://localhost/SOMVC/usuario/validausuario/?v=$valida&v2=$to> SO - Click aqui para validar seu cadastro </a>";
        $message .= "<a href=http://www.coisavirtual.com.br/usuario/validaUsuario/?v=$valida&v2=$to&v3=$usuarioId> Click aqui para validar seu cadastro </a>";          
                   
        $valida  = $_GET['v'];
        $email  = $_GET['v2'];
        $codigo  = $_GET['v3'];
        
        if ($valida == "" || $email == "" ) {               
            $this->redirect('/mensagem/erro');          
        }else {
            $usuarioService = new UsuarioService();
            $usuarioService->validacadastro($codigo,$valida,$email); 
            $usuario = new Usuario();
            $usuario->setId($codigo);
            $usuario->setValida($valida);
            $usuario->setEmail($email);
            $usuario->setStatus("Ativo");
            
            echo $message;
           
            if($usuarioService->ativarcadastro($usuario)){

                $this->redirect('/mensagem/sucesso');
            }else{
                $this->redirect('/mensagem/erro');  
            }
        }
        
    }
    public function edicao($params)
    {

        $id = $params[0];
        if (!$id) {
            Sessao::gravaMensagem("Nenhum Cadastro Selecionado");
            $this->redirect('/usuario');
        }
        $usuarioService = new UsuarioService();

        $usuario = $usuarioService->listar($id);

        if (!$usuario) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/usuario');
        }

        $departamentoDAO = new DepartamentoDAO();
        self::setViewParam('listaDepartamentos', $departamentoDAO->listar());
        self::setViewParam('usuario', $usuario);
        $this->render('/usuario/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
       
        $usuarioService = new UsuarioService();
        
        $usuario = $usuarioService->listar($_POST['id']);
        $email = $usuario->getEmail();
        
        $usuario = new Usuario();
        $usuario->setId($_POST['id']);
        $usuario->setNome($_POST['nome']);
        $usuario->setNivel($_POST['nivel']);
        $usuario->setEmail($_POST['email']);
        $usuario->setId_dep($_POST['id_dep']);
        $usuario->setStatus($_POST['status']);
        //$usuario->setDataCadastro($_POST['dataCadastro']);
        //$usuario->setValida($_POST['valida']);
        $usuario->setDica($_POST['dica']);
        //$usuario->setSenha($_POST['senha']);
        $usuario->setFk_Instituicao($_POST['fk_instituicao']);

        Sessao::gravaFormulario($_POST);
        $usuarioValidador = new UsuarioValidador();
        $resultadoValidacao = $usuarioValidador->validar($usuario);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/usuario/edicao/' . $_POST['id']);
        }      

        if ($_POST['email'] !=  $email) {            
            if($usuarioService->verificaEmail($_POST['email'])){                
                Sessao::gravaMensagem("Email existente");
                $this->redirect('/usuario/edicao/' . $_POST['id']);
            }
        }      
        $atualizar = $usuarioService->atualizar($usuario);
        
        if( $atualizar > 0){
           
            $email = $_POST['email'];               
            $emailService = new EmailService();
            $subject = 2;
            $emailService->emailUsuario($usuario,$email, $subject);
            //$to = $usuario->setEmail($_POST['email']);
            $to = "vendas2@fabmed.com.br";
            $valida = md5($to);
        
            $subject = "Cadastro no Sistema de Ocorrencias"; // assunto
            $message = "Validacao de cadastro " . "\r\n";
            // $message .= "<a href=http://www.coisavirtual.com.br/usuario/validaUsuario/valida_cadastro.php?v=$valida&v2=$to> SO - Click aqui para validar seu cadastro </a>";
            $message .= "<a href=http://localhost/SOMVC/usuario/validausuario/?v=$valida&v2=$to> SO - Click aqui para validar seu cadastro </a>";          
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'content-type: text/html; charset=iso-8859-1' . "\r\n"; //formato
            //$headers .= 'To: Carlos Andre <programadorfsaba@gmail.com>' . "\r\n"; //
            $headers .= 'From:< noreply@sistemadevnogueira.online>' . "\r\n"; //email de envio
            //$headers .= 'From:< contato@sistemaocorrencia.com.br>' . "\r\n"; //email de envio
            //$headers .= 'CC:<' . $emailUser . '>' . "\r\n"; //email com copia
            $headers .= 'Reply-To: < suporte@sistemadevnogueira.online>' . "\r\n"; //email para resposta
            var_dump($message);
            mail($to, $subject, $message, $headers);

            $this->redirect('/usuario');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();           
       } else if ($atualizar == 0) {
            Sessao::gravaMensagem("nenhuma alteração indetificada");
            $this->redirect('/usuario');
        }else {       
            Sessao::gravaMensagem("erro na atualizacao");
            $this->redirect('/usuario/edicao/' . $_POST['id']);
        }
    }

    public function exclusao($params)
    {

        $id = $params[0];
        if (!$id) {
            Sessao::gravaMensagem("Nenhum Cadastro Selecionado");
            $this->redirect('/usuario');
        }
        $usuarioService = new UsuarioService();

        $usuario = $usuarioService->listar($id);

        if (!$usuario) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/usuario');
        }

        self::setViewParam('Usuario', $usuario);
        $this->render('/usuario/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $usuario = new Usuario();
        $usuario->setId($_POST['id']);

        $usuarioService = new UsuarioService();

        if (!$usuarioService->excluir($usuario)) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/usuario');
        }

        $this->redirect('/usuario');
    }

    public function sucesso()
    {
        if (Sessao::retornaValorFormulario('nome')) {
            $this->render('/usuario/sucesso');

            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
        } else {
            $this->redirect('/');
        }
    }
}