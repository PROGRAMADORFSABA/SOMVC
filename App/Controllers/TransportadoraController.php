<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\Entidades\Cidade;
use App\Models\Entidades\Transportadora;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Endereco;

use App\Models\Validacao\TransportadoraValidador;
use App\Services\TransportadoraServices;
use App\Services\EmailService;
use App\Services\InstituicaoService;
use App\Services\UsuarioService;
use App\Services\CidadeService;

class TransportadoraController extends Controller
{
    public function index()
    {
        $transportadora         = new Transportadora();
        $transportadoraServices = new TransportadoraServices();
        self::setViewParam('carregarTransportadoras', $transportadoraServices->listar($transportadora));   
        if($_POST)
        {
            $transportadora->setTraId($_POST['codigo']);
            $transportadora->setTraCnpj($_POST['cnpj']);
            $transportadora->setTraStatus($_POST['status']);
            $transportadora->setTraRazaoSocial($_POST['razaosocial']);
            $transportadora->setTraNomeFantasia($_POST['nomefantasia']);                     
        }
        self::setViewParam('listarTransportadoras', $transportadoraServices->listar($transportadora));
        $this->render('/transportadora/index');
        Sessao::limpaMensagem();
        Sessao::limpaErro();
        Sessao::limpaFormulario();
    }

    public function cadastro()
    {
        $transportadoraServices = new TransportadoraServices();
        $transportadora         = new Transportadora();
        $cidadeService          = new CidadeService();
        $instituicaoService     = new InstituicaoService();
        $usuarioService         = new UsuarioService(); 
        self::setViewParam('listarCidades', $cidadeService->listar());
        if(Sessao::existeFormulario()) {
            $cidadeId  = Sessao::retornaValorFormulario('cidade');
            var_dump($cidadeId);
            $cidade    = $cidadeService->listar($cidadeId)[0];
            
            $instituicaoId  = Sessao::retornaValorFormulario('instituicao');
            $instituicao    = $instituicaoService->listar($instituicaoId);
            
            $usuarioId      = Sessao::retornaValorFormulario('usuario');
            $usuario        = $usuarioService->listar($usuarioId);
            
            $transportadora->setTraRazaoSocial(Sessao::retornaValorFormulario('razaosocial'));
            $transportadora->setTraNomeFantasia(Sessao::retornaValorFormulario('nomefantasia'));
            $transportadora->setTraCnpj(Sessao::retornaValorFormulario('cnpj'));
            $transportadora->setTraIE(Sessao::retornaValorFormulario('inscricaoestadual'));
            $transportadora->setTraEmail(Sessao::retornaValorFormulario('email'));
            $transportadora->setTraContato(Sessao::retornaValorFormulario('contato'));
            $transportadora->setTraTelefone(Sessao::retornaValorFormulario('telefone'));
            $transportadora->setTraCelular(Sessao::retornaValorFormulario('celular'));
            $transportadora->setEndLongradouro(Sessao::retornaValorFormulario('longradouro'));
            $transportadora->setEndNumero(Sessao::retornaValorFormulario('numero'));
            $transportadora->setEndBairro(Sessao::retornaValorFormulario('bairro'));
            $transportadora->setEndCidade($cidade);
            $transportadora->setTraStatus(Sessao::retornaValorFormulario('status'));
            $transportadora->setTraObservacao(Sessao::retornaValorFormulario('observacao'));
            $transportadora->setTraUsuario($usuario);
            $transportadora->setTraInstituicao($instituicao);
            $transportadora->setEndPontoReferencia(Sessao::retornaValorFormulario('pontoreferencia'));
            $transportadora->setEndComplemento(Sessao::retornaValorFormulario('complemento'));            
        }else{
            $transportadora->setEndCidade(new Cidade());
        }
        if (!empty($_REQUEST['action']))
        {
            if ($_REQUEST['action'] == 'editar')
            {
                if (!empty($_GET['codigo']))
                {
                    $id = (int) $_GET['codigo'];
                    $this->visualisar($id);               
                }else{
                    var_dump( ' action editar sem ID informado! ');
                }
            }else if ($_REQUEST['action'] == 'salvar')
            {                      
                var_dump($_POST);      
             //   $this->salvar();            
            }else if ($_REQUEST['action'] == 'excluir')
            {  
                if (!empty($_GET['codigo']))
                {
                    $id = (int) $_GET['codigo']; 
                    Sessao::gravaMensagem("<h2 style='color: red'> Deseja excluir o cadastro abaixo?</h2>");    
                   $this->visualisar($id);
                }else{
                    var_dump( ' action editar sem ID informado! ');
                }             
            }
        }else{            
            //  $transportadora = $transportadoraServices->listar();    
                                  
            self::setViewParam('transportadora',  $transportadora);
            $this->render('/transportadora/cadastro');
        }
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }
    
    public function visualisar($id = null)
    {
        $transportadoraServices = new TransportadoraServices();
        $transportadora = new Transportadora();
        $cidadeService = new CidadeService();
        if($id){
            $transportadora = $transportadoraServices->listar($transportadora->setTraId($id))[0];            
        }        

        self::setViewParam('listarCidades', $cidadeService->listar());  
        self::setViewParam('transportadora', $transportadora);  
        $this->render('/transportadora/cadastro');
    }

    public function salvar()
    {  
        $transportadora         = new Transportadora();
        $transportadoraServices = new TransportadoraServices();
        $instituicaoService     = new InstituicaoService();
        $usuarioService         = new UsuarioService();
        $cidadeService          = new CidadeService();
        $usuario                = $usuarioService->listar($_POST['usuario']);
        $instituicao            = $instituicaoService->listar($_POST['instituicao']);
        $cidade                 = $cidadeService->listar($_POST['cidade'])[0];
              
        $transportadora->setTraRazaoSocial($_POST['razaosocial']);
        $transportadora->setTraNomeFantasia($_POST['nomefantasia']);
        $transportadora->setTraCnpj($_POST['cnpj']);
        $transportadora->setTraIE($_POST['inscricaoestadual']);
        $transportadora->setTraEmail($_POST['email']);
        $transportadora->setTraContato($_POST['contato']);
        $transportadora->setTraTelefone($_POST['telefone']);
        $transportadora->setTraCelular($_POST['celular']);
        $transportadora->setTraStatus($_POST['status']);
        $transportadora->setTraPessoa($_POST['pessoa']);
        $transportadora->setTraObservacao($_POST['observacao']);
        $transportadora->setTraUsuario($usuario);
        $transportadora->setTraInstituicao($instituicao);
        $transportadora->setEndLongradouro($_POST['longradouro']);
        $transportadora->setEndNumero($_POST['numero']);
        $transportadora->setEndBairro($_POST['bairro']);
        $transportadora->setEndCidade($cidade);
        $transportadora->setEndPontoReferencia($_POST['pontoreferencia']);
        $transportadora->setEndComplemento($_POST['complemento']);
        $transportadora->setEndPessoa($_POST['pessoa']);
        $mensagem = null;//($_POST['mensagem']);
        Sessao::gravaFormulario($_POST);        
        $transportadoraValidador = new TransportadoraValidador();
        $resultadoValidacao     = $transportadoraValidador->validar($transportadora);        
               
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/transportadora/cadastro');
        }else{
            if (!$transportadora) {           
                Sessao::gravaMensagem("sem dados informados");
                $this->redirect('/transportadora/cadastro');
            }
          //  $codTransportadora  = $transportadoraServices->salvar($transportadora);
            if ($_POST['acao'] == 'excluir')
            {  
                if (!empty($_POST['codigo']))
                {
                    $id = (int) $_POST['codigo'];                           
                     $this->excluir($id);
                }
            }else if($_POST['acao'] == 'alterar')
            {  
                if (!empty($_POST['codigo']))
                {
                    $id = (int) $_POST['codigo'];
                    $transportadora->setTraId($id);
                    $this->alterar($transportadora);                         
                      $codTransportadora  = $id;
                }
            } else if  ($_POST['acao'] == 'novo')
            {                             
                $codTransportadora  =  $this->gravar($transportadora);        
            }    
            if ($codTransportadora) {
               // $transportadora->setTraId($codTransportadora);
                //var_dump($transportadora->setTraId($codTransportadora));
               // $transportadora = $transportadoraServices->listar($transportadora)[0];
                
                $subject = 1;
                $emailService = new EmailService();
                $emailService->emailTransportadora($transportadora,$subject,$mensagem);
                
                $this->redirect('/transportadora'); 
                Sessao::limpaFormulario();
                Sessao::limpaMensagem();
                Sessao::limpaErro();               
            } else {
                $this->redirect('/transportadora/cadastro');
            }
        }
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

    }
    public function edicao()
    {
        if(!empty($_POST)){
            $arquivo = $_FILES['arquivo']['tmp_name'];
            $servidor = filter_input(INPUT_POST, 'servidor', FILTER_SANITIZE_STRING);
            $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
            $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
            $dbname = filter_input(INPUT_POST, 'dbname', FILTER_SANITIZE_STRING);
                       
         }
    }

    public function gravar($id)
    {
        $transportadora = new Transportadora();       

        $transportadoraService = new TransportadoraServices();        
        $transportadora = ($transportadoraService->listar($transportadora->setTraId($id))[0]);
        Sessao::gravaFormulario($_POST);
        if(!$transportadoraService->salvar($transportadora)) {
            Sessao::gravaMensagem("Cadastro inexistente");
            Sessao::gravaErro("Erro ao excluir cadastro!");
            $this->redirect('/transportadora/cadastro'.$transportadora->getTraId());
        }
        Sessao::gravaMensagem("Cadastro alterado com sucesso!");
        $this->redirect('/transportadora');

    }

    public function alterar($transportadora)
    {        
        $transportadoraService = new TransportadoraServices();        
        Sessao::gravaFormulario($_POST);        
        if(!$transportadoraService->alterar($transportadora)) {
            Sessao::gravaMensagem("Cadastro inexistente");
            Sessao::gravaErro("Erro ao excluir cadastro!");
            $this->redirect('/transportadora/cadastro/'.$transportadora->getTraId());
        }
        Sessao::gravaMensagem("Cadastro alterado com sucesso!");
        $this->redirect('/transportadora');

    }

    public function excluir($id)
    {
        $transportadora = new Transportadora();
        $transportadoraService = new TransportadoraServices();        
        $transportadora = ($transportadoraService->listar($transportadora->setTraId($id))[0]);
        if (!$transportadoraService->excluir($transportadora)) {
            Sessao::gravaMensagem("Cadastro inexistente");
            Sessao::gravaErro("Erro ao excluir cadastro!");
            $this->redirect('/transportadora/cadastro'.$transportadora->getTraId());
        }

        Sessao::gravaMensagem("Cadastro excluido com sucesso!");

       $this->redirect('/transportadora');
    }

}