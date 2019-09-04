<?php
    namespace App\Controllers;
    
    use App\Lib\Sessao;
    use App\Models\DAO\ClienteLicitacaoDAO;
    use App\Models\Entidades\ClienteLicitacao;

    class ClienteLicitacaoController extends Controller
    {
        
        public function index()
        {
            $clienteLicitacaoDAO = new ClienteLicitacaoDAO();
            
           //self::setViewParam('listaClienteLicitacao', $clienteLicitacaoDAO->listaClienteLicitacao());
            //self::setViewParam('listaClienteLicitacao2', $clienteLicitacaoDAO->listaClienteLicitacao2());
            self::setViewParam('listar', $clienteLicitacaoDAO->listar());
            
            $this->render('/clientelicitacao/index');
            
            Sessao::limpaMensagem();
        }
        public function cadastro()
        {
            $this->render('/clientelicitacao/cadastro');
    
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
        }
        public function salvar()
    {
        $clienteLicitacao = new ClienteLicitacao();

       // $clienteLicitacao->setDataCadastro($_POST['dataCadastro']);
        //date_format($date, 'Y-m-d H:i:s');
        $clienteLicitacao->setCnpj($_POST['cnpj']);
        $clienteLicitacao->setRazaoSocial($_POST['razaoSocial']);
        $clienteLicitacao->setNomeFantasia($_POST['nomeFantasia']);
        $clienteLicitacao->setTrocaMarca($_POST['torcaMarca']);
        Sessao::gravaFormulario($_POST);

        $clienteLicitacaoDAO = new ClienteLicitacaoDAO();

        if ($clienteLicitacaoDAO->salvar($clienteLicitacao)) {

            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
            $this->redirect('/clienteLicitacao');
        } else {
            Sessao::gravaMensagem("Erro ao gravar");
        }
    }
    }