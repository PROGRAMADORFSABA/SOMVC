<?php
    
    namespace App\Models\DAO;
    
    
    use App\Models\Entidades\ClienteLicitacao;

    use League\Flysystem\Exception;

    class ClienteLicitacaoDAO extends  BaseDAO
    {

        public  function listar($codCliente = null)
        {
            
            if ($codCliente) {
                $resultado = $this->select(
                    "SELECT * FROM clienteLicitacao WHERE licitacaoCliente_cod = $codCliente"
                );
                $dado = $resultado->fetch();
    
                if ($dado) {
                    $clienteLicitacao = new ClienteLicitacao();
                    $clienteLicitacao->setCodCliente($dado['licitacaoCliente_cod']);
                    $clienteLicitacao->setRazaoSocial($dado['razaosocial']);
                    $clienteLicitacao->setNomeFantasia($dado['nomefantasia']);
                    $clienteLicitacao->setCnpj($dado['CNPJ']);
                    $clienteLicitacao->setTrocaMarca($dado['trocamarca']);
                    // $clienteLicitacao->setDataCadastro($dado['dataCadastro']);
    
                    return $clienteLicitacao;
                }
            } else {
    
                $resultado = $this->select(
                    ' SELECT * FROM clienteLicitacao '
                );
                $dados = $resultado->fetchAll();
    
                if ($dados) {
    
                    $lista = [];
    
                    foreach ($dados as $dado) {
    
                        $clienteLicitacao = new ClienteLicitacao();
                        $clienteLicitacao->setCodCliente($dado['licitacaoCliente_cod']);
                        $clienteLicitacao->setRazaoSocial($dado['razaosocial']);
                        $clienteLicitacao->setNomeFantasia($dado['nomefantasia']);
                        $clienteLicitacao->setCnpj($dado['CNPJ']);
                        $clienteLicitacao->setTrocaMarca($dado['trocamarca']);
                       // $clienteLicitacao->setDataCadastro($dado['dataCadastro']);
    
                        $lista[] = $clienteLicitacao;
                    }
                    return $lista;
                }
            }
            return false;
        }


        public  function listaClienteLicitacao2() {
            $resultado = $this->select(
                'SELECT * FROM cliente c INNER JOIN tipoCliente tp ON tp.codTipoCliente = c.idTipoCliente'
            );
    
            $dataSetclienteLicitacaos = $resultado->fetchAll();
    
            if($dataSetclienteLicitacaos) {
               
                $listaClienteLicitacao2 = [];

               foreach($dataSetclienteLicitacaos as $dataSetclienteLicitacao){
               
                $clienteLicitacao = new ClienteLicitacao();
                $clienteLicitacao->setIdCliente($dataSetclienteLicitacao['idCliente']);
                $clienteLicitacao->setNome($dataSetclienteLicitacao['nome']);
                $clienteLicitacao->setNomeFantasia($dataSetclienteLicitacao['nomeFantasia']);
                $clienteLicitacao->getTipoCliente()->setNomeTipo($dataSetclienteLicitacao['nomeTipo']);
               
                $listaClienteLicitacao2[] = $clienteLicitacao;
               }
                return $listaClienteLicitacao2;
            }
    
            return false;
        }

        public function listaClienteLicitacao($idCliente = null){
            
            if ($idCliente){
                
                $resultado = $this->select(
                    "SELECT * FROM cliente c INNER JOIN tipoCliente tp ON tp.codTipoCliente = c.tipoCliente WHERE c.idTipoCliente = $idCliente"
                );
                
                return $resultado->fetchObject(ClienteLicitacao::class);
            }else {
                $resultado = $this->select(
                    'SELECT * FROM cliente c INNER JOIN tipoCliente tp ON tp.codTipoCliente = c.idTipoCliente '
                );
                
                return  $resultado->fetchAll(\PDO::FETCH_CLASS, ClienteLicitacao::class);
            }
            
            return false;
        }
        
        public function salvarClienteLicitacao(ClienteLicitacao $clienteLicitacao){
            
            try{
                
                $nome               = $clienteLicitacao->getNome();
                $nomeFantasia       = $clienteLicitacao->getNomeFantasia();
                $tipoCliente_cod    = $clienteLicitacao->getTipoCliente()->getCodTipoCliente();
                
                return $this->insert(
                    'cliente',
                    ":nome, :nomeFantasia, :idTipoCliente",
                    [
                        ":nome"            =>$nome,
                        ":nomeFantasia"    =>$nomeFantasia,
                        ":idTipoCliente"     =>$tipoCliente_cod
                    ]
                );
                
                
            }catch (\Exception $e){
                throw new \Exception("Erro na gravação de dados:". $e->getMessage(),500);
            }
        }
        
        public function atualizarCliente(ClienteLicitacao $clienteLicitacao)
        {
            try{
                
                $idCliente        = $clienteLicitacao->getIdCliente();
                $nome             = $clienteLicitacao->getNome();
                $nomeFantasia     = $clienteLicitacao->getNomeFantasia();
                $tipoCliente_cod  = $clienteLicitacao->getTipoCliente()->getCodTipoCliente();
                
                return $this->update(
                    'cliente',
                    ":nome, :nomeFantasia, :idTipoCliente",
                    [
                        "idCliente"         =>$idCliente,
                        ":nome"             =>$nome,
                        ":nomeFantasia"     =>$nomeFantasia,
                        "idTipoCliente"       =>$tipoCliente_cod
                    ],
                    "idCliente = :idCliente"
                );
                
            }catch (\Exception $e){
                throw new \Exception("Erro ao gravar dados".$e->getMessage(), 500);
            }
        }
        
        public function excluirCliente(ClienteLicitacao $clienteLicitacao)
        {
            try{
                
                $idCliente = $clienteLicitacao->getIdCliente();
                
                return $this->delete('cliente',":idcliente = $idCliente");
            }catch (\Exception $e){
                throw new \Exception("Erro ao deletar".$e->getMessage(),500);
            }
        }
        
        
    }