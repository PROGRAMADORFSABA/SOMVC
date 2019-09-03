<?php
    
    
    namespace App\Controllers;
    
    use App\Lib\Sessao;
    use App\Models\DAO\ClienteLicitacaoDAO;
   
    
    
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

    }