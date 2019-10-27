<?php
    
    
    namespace App\Services;
    
    use App\Lib\Sessao;
    use App\Lib\Exportar;
    use App\Lib\Transacao;

    use App\Models\DAO\ProdutoDAO;
    use App\Models\Entidades\ClienteLicitacao;
    use App\Models\Entidades\PedidoFalta;
    
    use App\Models\DAO\ClienteLicitacaoDAO;
    use App\Models\Entidades\Produto;

    class ClienteLicitacaoService
    {
        public function listar($codCliente = null)
        {
           
            $clienteLicitacaoDAO = new ClienteLicitacaoDAO();
            return $clienteLicitacaoDAO->listar($codCliente);
           // return $clienteLicitacaoDAO->listarTeste($codCliente);
        }
        public function listarPorProduto(Produto $produto)
        {
            $produtoDAO =  new ProdutoDAO();
            return $produtoDAO->listarPorProduto($produto->getProCodigo());
        }
        public function listraPorCliente(ClienteLicitacao $clienteLicitacao)
        {
            $clienteLicitacaoDAO =  new ClienteLicitacaoDAO();
            $clienteLicitacao = $clienteLicitacaoDAO->listarPorNomeFantasia($clienteLicitacao);
        }
        
        public function autoComplete(ClienteLicitacao $clienteLicitacao)
        {
            $clienteLicitacao->getRazaoSocial();
            $clienteLicitacaoDAO = new ClienteLicitacaoDAO();
            $busca = $clienteLicitacaoDAO->listarPorRazaoSocial($clienteLicitacao);
            $exportar = new Exportar();
            echo $exportar->exportarJSON($busca);
        
        }
    }