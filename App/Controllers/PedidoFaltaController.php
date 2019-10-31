<?php
    
    
    namespace App\Controllers;
    
    use App\Lib\Sessao;
    use App\Models\Entidades\PedidoFalta;
    use App\Models\Entidades\ClienteLicitacao;
    use App\Models\Entidades\Produto;

    use App\Models\DAO\PedidoFaltaDAO;
    use App\Models\DAO\ClienteLicitacaoDAO;

    use App\Services\ClienteLicitacaoService;
    use App\Services\PedidoFaltaService;
    use App\Services\FornecedorService;
    use App\Services\MarcaService;
    use App\Services\ProdutoService;

    
    class PedidoFaltaController extends Controller
    {
        public function  index($params)
        {
            $faltaCliente_cod = $params[0];
            $pedidoFaltaService = new PedidoFaltaService();
            $pedidoFalta = $pedidoFaltaService->listar($faltaCliente_cod);
            
            $this->setViewParam('pedidofalta', $pedidoFalta);
            $this->render('/pedidofalta/index');
            
            Sessao::limpaMensagem();
        }
        
        public function cadastro()
        {
            if(Sessao::existeFormulario())
            {
                $pedidoFalta = new PedidoFalta();
                $pedidoFalta->setFaltaClienteCod(Sessao::retornaValorFormulario('idFaltaCliente'));
                $pedidoFalta->setProposta(Sessao::retornaValorFormulario('proposta'));
                $pedidoFalta->setAFM(Sessao::retornaValorFormulario('AFM'));
                $pedidoFalta->setFkStatus(Sessao::retornaValorFormulario('status'));
                $pedidoFalta->setObservacao(Sessao::retornaValorFormulario('observacao'));
                $pedidoFalta->setDataFalta(Sessao::retornaValorFormulario('dataFalta'));
                
                $codCliente = Sessao::retornaValorFormulario('clienteLicitacao');
                $clienteLicitacaoServices = new ClienteLicitacaoService();
                $clienteLicitacao = $clienteLicitacaoServices->listar($codCliente)[0];
                $pedidoFalta->setFkCliente($clienteLicitacao);
                
                $produtos = Sessao::retornaValorFormulario('produtos');
                
                if(empty($produtos)){
                    $pedidoFalta->setFkProduto(array());
                }else{
                    $produtoService = new ProdutoService();
                    $produtos = $produtoService->preencheProduto($produtos);
                    $pedidoFalta->setFkProduto($produtos);
                }
                
            }else{
                
                $pedidofalta = new PedidoFalta();
                $pedidofalta->setFkCliente(new ClienteLicitacao());
                $pedidofalta->setFkProduto(array());
                
            }
            $this->setViewParam('pedidofalta', $pedidofalta);
            $this->render('/pedidofalta/cadastro');
            
            Sessao::limpaErro();
            Sessao::limpaFormulario();

        }
        
        public function salvar()
        {
            $pedidoFalta =  new PedidoFalta();
            $pedidoFalta->setProposta(trim($_POST['proposta']));
            $pedidoFalta->setAFM(trim($_POST['afm']));
            $pedidoFalta->setObservacao(trim($_POST['observacao']));
        
        
        }
        
        public function editar()
        {
            $this->render('/pedidofalta/editar');
        }
        
        public function excluir()
        {
            $this->render('/pedidofalta/excluir');
        }
    }