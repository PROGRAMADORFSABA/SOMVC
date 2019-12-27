<?php
    
    
    namespace App\Services;
    
    use App\Lib\Sessao;
    use App\Lib\Exportar;
    use App\Lib\Transacao;

    use App\Models\Entidades\ClienteLicitacao;
    
    use App\Models\DAO\ClienteLicitacaoDAO;
        class ClienteLicitacaoService
    {
        public function listar($codCliente = null)
        {
           
            $clienteLicitacaoDAO = new ClienteLicitacaoDAO();
            return $clienteLicitacaoDAO->listar($codCliente);
           
           // return $clienteLicitacaoDAO->listarTeste($codCliente);
        }
        public function listaClientesPedido()
        {           
            $clienteLicitacaoDAO = new ClienteLicitacaoDAO();
            return $clienteLicitacaoDAO->listaClientesPedido();
        }
        public function listaTipoCliente(ClienteLicitacao $clienteLicitacao)
        {           
            $clienteLicitacaoDAO = new ClienteLicitacaoDAO();
            return $clienteLicitacaoDAO->listaTipoClienteLicitacao($clienteLicitacao);
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
       
        public function listarClienteFalta(ClienteLicitacao $clienteLicitacao)
        {
            $clienteLicitacao->getNomeFantasia();
            $clienteLicitacaoDAO =  new ClienteLicitacaoDAO();
            $busca = $clienteLicitacaoDAO->listarClienteLicitacao($clienteLicitacao);

            $exportar = new Exportar();
            echo $exportar->exportarJSON($busca);
        }

        public function salvar(ClienteLicitacao $clienteLicitacao)
        {
            $transacao = new Transacao();
            $clienteLicitacaoValidador = new ClienteLicitacaoValidador();
            $resultadoValidacao = $clienteLicitacaoValidador->validar($clienteLicitacao);
            
            if ($resultadoValidacao->getErros()) {
                Sessao::limpaErro();
                Sessao::gravaErro($resultadoValidacao->getErros());
            } else {
                try{
                   $transacao->beginTransaction();
                    $clienteLicitacaoDAO = new ClienteLicitacaoDAO();            
                    $clienteLicitacaoDAO->salvar($clienteLicitacao);
                    $transacao->commit(); 
                    Sessao::gravaMensagem("cadastro realizado com sucesso!.");
                    Sessao::limpaFormulario();
                    return true;
                }catch(\Exception $e){
                    //var_dump($e);
                    $transacao->rollBack(); 
                    Sessao::gravaMensagem("Erro ao tentar cadastrar. ".$e);
                   return false;
                }
            }
        }

        public function atualizar(ClienteLicitacao $clienteLicitacao)
        {   
            $transacao = new Transacao();
            $clienteLicitacaoValidador = new ClienteLicitacaoValidador();
            $resultadoValidacao = $clienteLicitacaoValidador->validar($clienteLicitacao);
            
            if ($resultadoValidacao->getErros()) {
                Sessao::limpaErro();
                Sessao::gravaErro($resultadoValidacao->getErros());
            } else {
                try{
                   $transacao->beginTransaction();
                    $clienteLicitacaoDAO = new ClienteLicitacaoDAO();            
                    $clienteLicitacaoDAO->atualizar($clienteLicitacao);
                    $transacao->commit(); 
                    Sessao::gravaMensagem("cadastro alterado com sucesso!.");
                    Sessao::limpaFormulario();
                    return true;
                }catch(\Exception $e){
                    $transacao->rollBack(); 
                  //var_dump($e);
                    Sessao::gravaMensagem("Erro ao tentar alterar. ".$e);
                   return false;
                }
            }
    
        }
        public function excluir(ClienteLicitacao $clienteLicitacao)
        {
            try {
    
                $transacao = new Transacao();
                $transacao->beginTransaction();
                
                $clienteLicitacaoDAO = new ClienteLicitacaoDAO();
                                       
                $clienteLicitacaoDAO->excluir($clienteLicitacao);
                $transacao->commit();            
                
                Sessao::limpaMensagem();
                Sessao::gravaMensagem("Cadastro Excluido com Sucesso!");
                return true;
            } catch (\Exception $e) {
                $transacao->rollBack();
                throw new \Exception(["Erro ao excluir a cadastro"]);            
                return false;
            }
        }






    }