<?php
    
    
    namespace App\Models\DAO;
    
    use App\Models\Entidades\ClienteLicitacao;
    use App\Models\Entidades\PedidoFalta;
    use App\Models\Entidades\Produto;
    use App\Models\Entidades\Marca;

    
    
    
    class PedidoFaltaDAO extends BaseDAO
    {
        public function listar($faltaCliente_cod = null)
        {
            $SQL =
                'SELECT FC.faltaCliente_cod,
                        CL.nomefantasia,
                        FC.proposta,
                        FC.AFM,
                        FC.observacao,
                        FC.dataFalta,
                        CL.nomefantasia,
                        MF.marcanome,
                        SF.nomeStatus
                
                        FROM faltaCliente FC
                        inner join clienteLicitacao CL on CL.licitacaoCliente_cod = FC.fk_cliente
                        inner join marca MF on MF.marcacod = FC.fk_marca
                        inner join statusFalta SF on SF.faltaStatus_cod = FC.fk_status ';
            if ($faltaCliente_cod) {
                $SQL .= 'WHERE FC.faltaCliente_cod';
            }
        
            $resultado = $this->select($SQL);
            $dataSetFaltas = $resultado->fetchAll();
            $listaFaltas = [];
        
            foreach ($dataSetFaltas as $dataSetFalta) {
                    $pedidofalta = new PedidoFalta();
                    $pedidofalta->setFaltaClienteCod($dataSetFalta['idfalta']);
                    $pedidofalta->setAFM($pedidofalta['afm']);
                    $pedidofalta->setProposta($dataSetFalta['proposta']);
                    $pedidofalta->setObservacao($pedidofalta['observacao']);
                    
                    $pedidofalta->setFkCliente( new FkCLiente);
                    $pedidofalta->getFkCliente()->getNomeFantasia($dataSetFalta['nomefantasia']);
                    
                    $pedidofalta->getFkMarca(new Marca());
                    $pedidofalta->getFkMarca()->setMarcaNome($dataSetFalta['marca']);
                    
                    $pedidofalta->getFkProduto(new Produto());
                    $pedidofalta->getFkProduto()->setProNome($dataSetFalta['produto']);
                
                
       
                
                
                $listaFaltas[] = $pedidofalta;
            }
            return $listaFaltas;
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
                $fk_produto             = $pedidoFalta->getFkProduto();
                $fk_marca               = $pedidoFalta->getFkMarca();
                
                return $this->update(
                    'produtofalta',
                    ":proposta, :AFM, :observacao, :FK_CLIENTE, :FK_PRODUTO, FK_MARCA",
                    [
                        'faltaCliente_cod'  =>$faltaCliente_cod,
                        'proposta'          => $proposta,
                        'AFM'               => $AFM,
                        'observacao'        => $observacao,
                        'FK_CLIENTE'        => $fk_cliente,
                        'FK_PRODUTO'        => $fk_produto,
                        'FK_MARCA'          => $fk_marca
                    ],
                    "faltaCliente_cod = :faltaCliente_cod"
                );
            }
            catch (\Exception $e){
                throw new \Exception("Erro na gravação de dados", 500);
            }
        }
    }