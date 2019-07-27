<?php
    
    
    namespace App\Controllers;
    
    use App\Lib\Sessao;
    use App\Models\DAO\ClienteLicitacaoDAO;
    use App\Models\Entidades\Licitacao;
    
    
    class ClienteLicitacaoController extends Controller
    {
        
        public function index()
        {
            $clienteLicitacaoDAO = new ClienteLicitacaoDAO();
            
           //self::setViewParam('listaClienteLicitacao', $clienteLicitacaoDAO->listaClienteLicitacao());
            self::setViewParam('listaClienteLicitacao2', $clienteLicitacaoDAO->listaClienteLicitacao2());
            
            $this->render('/clientelicitacao/index');
            
            Sessao::limpaMensagem();
        }

    }