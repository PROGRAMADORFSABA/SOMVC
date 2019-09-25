<?php
    
    
    namespace App\Services;
    
    use App\Lib\Sessao;
    use App\Lib\Exportar;
    use App\Lib\Transacao;
    
    use App\Models\Entidades\ClienteLicitacao;
    use App\Models\Entidades\PedidoFalta;
    
    use App\Models\DAO\ClienteLicitacaoDAO;
    
    class ClienteLicitacaoService
    {
        public function listar($codCliente = null)
        {
            $clienteLicitacaoDAO = new ClienteLicitacaoDAO();
            return $clienteLicitacaoDAO->listaClienteLicitacao($codCliente);
        }
        
        
        public function autoComplete(ClienteLicitacao $clienteLicitacao)
        {
            $clienteLicitacao->getNomeFantasia();
            $clienteLicitacaoDAO = new ClienteLicitacaoDAO();
            $busca = $clienteLicitacaoDAO->listarPorNomeFantasia($clienteLicitacao);
            $exportar = new Exportar();
            echo $exportar->exportarJSON($busca);
        
        }
    }