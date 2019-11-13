<?php
    
    
    namespace App\Models\DAO;
    
    use App\Models\Entidades\ClienteLicitacao;
    use App\Models\Entidades\PedidoFalta;
    use App\Models\Entidades\Produto;
    use App\Models\Entidades\Marca;
    use App\Models\Entidades\Fornecedor;
    use App\Models\Entidades\Status;

    
    
    
    class PedidoFaltaDAO extends BaseDAO
    {
        public function listar($faltaCliente_cod = null)
        {
            $SQL =
                'SELECT 
                    FC.faltaCliente_cod,
                    P.ProNome,
                    CL.nomefantasia as clientelicitacao,
                    F.nomefantasia as marca,
                    SF.nomeStatus,
                    FC.proposta,
                    FC.AFM,
                    FC.observacao,
                    FC.dataFalta
                
            FROM faltaCliente FC
                
                INNER JOIN faltaporcliente FPC on FPC.FK_ID_FALTACLIENTE = FC.faltaCliente_cod
                INNER JOIN clienteLicitacao CL on CL.licitacaoCliente_cod = FC.fk_cliente
                INNER JOIN Produto P on P.ProCodigo = FPC.FK_IDPRODUTO
                INNER JOIN fornecedor F on F.fornecedor_cod = P.ProFornecedor
                INNER JOIN statusFalta SF on SF.faltaStatus_cod = FC.fk_status';
            if ($faltaCliente_cod) {
                $SQL .= 'WHERE FC.faltaCliente_cod';
            }
        
            $resultado = $this->select($SQL);
            $dataSetFaltas = $resultado->fetchAll();
            $listaFaltas = [];
        
            foreach ($dataSetFaltas as $dataSetFalta) {
                    $pedidofalta = new PedidoFalta();
                    $pedidofalta->setFaltaClienteCod($dataSetFalta['faltaCliente_cod']);
                    $pedidofalta->setAFM($dataSetFalta['AFM']);
                    $pedidofalta->setProposta($dataSetFalta['proposta']);
                    $pedidofalta->setObservacao($dataSetFalta['observacao']);
                    
                    $pedidofalta->setFkCliente( new ClienteLicitacao());
                    $pedidofalta->getFkCliente()->setNomeFantasia($dataSetFalta['clientelicitacao']);

                    $pedidofalta->setFkProduto(new Produto());
                    $pedidofalta->getFkProduto()->setProNome($dataSetFalta['ProNome']);
                    
                    $pedidofalta->setFkStatus(new Status());
                    $pedidofalta->getFkStatus()->setNome($dataSetFaltas['nomeStatus']);

                    $pedidofalta->setFkMarca(new Fornecedor());
                    $pedidofalta->getFkMarca()->setNomeFantasia($dataSetFalta['marca']);

                    
                $listaFaltas[] = $pedidofalta;
            }
           
            return $listaFaltas;
        }

        public function listarPorProduto($ProCodigo = null)
        {
            $resultado = $this->select(
                ""
            );

            return $resultado->fetchAll();
        }
    
        public function salvar(PedidoFalta $pedidoFalta)
        {
            
            try {
                $cliente        = $pedidoFalta->getFkCliente()->getCodCliente();
                //$marca          = $pedidoFalta->getFkMarca();
                //$status         = $pedidoFalta->getFkStatus();
                $afm            = $pedidoFalta->getAFM();
                $observacao     = $pedidoFalta->getObservacao();
                //$dataFalta      = $pedidoFalta->getDataFalta();
                $proposta       = $pedidoFalta->getProposta();
          
                return $this->insert(
                    'faltaCliente',
                    ':fk_cliente, :afm, :observacao, :proposta',
                    [
                        ':fk_cliente' => $cliente,
                        //'fk_marca'          => $marca,
                        //'fk_status'         => $status,
                        ':afm'               => $afm,
                        ':observacao'        => $observacao,
                        //'dataFalta'         =>$dataFalta,
                        ':proposta'          =>$proposta
                
                    ]
                );
                
            } catch (\Exception $e) {
                throw new \Exception('Erro ao gravar falta! ');
            }
        }
    
        public function addProduto(PedidoFalta $pedidoFalta)
        {
            try {
             
                $produtos = $pedidoFalta->getFk_Produto();
                if (isset($produtos)) {
                    foreach ($produtos as $produto) {
                      
                       
                        $this->insert(
                            'faltaporcliente',
                            ':FK_ID_FALTACLIENTE,:FK_IDPRODUTO',
                            [
                                ':FK_ID_FALTACLIENTE'  => $pedidoFalta->getFaltaClienteCod(),
                                ':FK_IDPRODUTO'         => $produto->getProCodigo()
                            ]
                            );
                    }
                }
                return false;
            } catch (\Exception $e) {
                throw new \Exception("Erro na gravação de dados !", 500);
            }
        }
        
        public function editar(PedidoFalta $pedidoFalta)
        {
            try
            {
                $faltaCliente_cod       = $pedidoFalta->getFaltaClienteCod();
                $proposta               = $pedidoFalta->getProposta();
                $AFM                    = $pedidoFalta->getAFM();
                $observacao             = $pedidoFalta->getObservacao();
                $fk_cliente             = $pedidoFalta->getFkCliente()->getCodCliente();
                $fk_produto             = $pedidoFalta->getFk_Produto();
                
                return $this->update(
                    'produtofalta',
                    ":proposta, :AFM, :observacao, :FK_CLIENTE, :FK_PRODUTO",
                    [
                        'faltaCliente_cod'  =>$faltaCliente_cod,
                        'proposta'          => $proposta,
                        'AFM'               => $AFM,
                        'observacao'        => $observacao,
                        'FK_CLIENTE'        => $fk_cliente,
                        'FK_PRODUTO'        => $fk_produto,
                    ],
                    "faltaCliente_cod = :faltaCliente_cod"
                );
            }
            catch (\Exception $e){
                throw new \Exception("Erro na gravação de dados", 500);
            }
        }
    }