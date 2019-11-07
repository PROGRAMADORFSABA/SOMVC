<?php
    
    
    namespace App\Services;
    
    use App\Lib\Sessao;
    use App\Lib\Transacao;

    use App\Models\DAO\ClienteDAO;
    use App\Models\DAO\ProdutoDAO;
    use App\Models\DAO\MarcaDAO;
    use App\Models\DAO\PedidoFaltaDAO;
    use App\Models\DAO\StatusDAO;
    
    use App\Models\Entidades\Cliente;
    use App\Models\Entidades\PedidoFalta;
    use App\Models\Entidades\Status;
    use App\Models\Entidades\Produto;
    use App\Models\Entidades\Marca;
    
    use App\Models\Validacao\PedidoFaltaValidador;
    use App\Models\Validacao\ResultadoValidacao;
    
    
    
    class PedidoFaltaService
    {
        public function listar($faltaCliente_cod = null)
        {
            $pedidofaltaDAO = new PedidoFaltaDAO();
            return $pedidofaltaDAO->listar($faltaCliente_cod);
        }
        
        public function editar( PedidoFalta $pedidoFalta)
        {
            $pedidofaltaValidador = new PedidoFaltaValidador();
            $resultadoValidacao = $pedidofaltaValidador->validar($pedidoFalta);
            
            if($resultadoValidacao->getErros()){
                Sessao::gravaErro($resultadoValidacao->getErros());
                return false;
                }else{
                    try {
                        $transacao = new Transacao();
                        $transacao->beginTransaction();
                        
                        $clienteDAO = new ClienteDAO();
                        $clienteDAO->excluir($pedidoFalta);
                        
                        $produtoDAO = new ProdutoDAO();
                        $produtoDAO->excluir($pedidoFalta);
                        
                        $marcaDAO = new MarcaDAO();
                        $marcaDAO->excluir($pedidoFalta);
                        
                        $statusDAO = new StatusDAO();
                        $statusDAO->excluir();
                        
                        $pedidofaltaDAO = new PedidoFaltaDAO();
                        $pedidofaltaDAO->addProduto($pedidoFalta);
                        $pedidoFalta->editar($pedidoFalta);
                        
                        
                        
                        $transacao->commit();
                        
                        Sessao::limpaFormulario();
                        Sessao::limpaMensagem();
                        Sessao::gravaMensagem("Nova Falta cadastrada com Sucesso !");
                        return true;
                        
                    }catch (\Exception $e){
                        Sessao::gravaErro(['Erro ao gravar vaga']);
                        $transacao->rollBack();
                        return false;
                }
            }
        }
        
        public function salvar(PedidoFalta $pedidoFalta)
        {
            $transacao = new Transacao();
            $pedidoValidador = new PedidoFaltaValidador();
            $resultadoValidacao = $pedidoValidador->validar($pedidoFalta);
            
            if($resultadoValidacao->getErros()){
                Sessao::gravaErro($resultadoValidacao->getErros());
                return false;
            }else{
                try{
                    $pedidoFaltaDAO= new PedidoFaltaDAO();
                    $transacao->beginTransaction();
                    $id = $pedidoFaltaDAO->salvar($pedidoFalta);
                    $pedidoFalta->setFaltaClienteCod($id);
                    
                    $pedidoFaltaDAO->addProduto($pedidoFalta);
                  
                   
                    $transacao->commit();
                    
                    Sessao::limpaFormulario();
                    Sessao::limpaMensagem();
                    Sessao::gravaMensagem("Falta Cadastrada com sucesso !");
                    
                    return true;
                    
                }catch (\Exception $e)
                {                    
                    Sessao::gravaErro(['Erro ao gravar Falta !']);
                    $transacao->rollBack();
                    
                    return false;
                }
            }
            
            
        }
        
    }