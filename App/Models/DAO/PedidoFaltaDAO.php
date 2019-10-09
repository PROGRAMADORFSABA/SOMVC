<?php
    
    
    namespace App\Models\DAO;
    
    use App\Models\Entidades\ClienteLicitacao;
    use App\Models\Entidades\PedidoFalta;
    use App\Models\Entidades\Produto;
    use App\Models\Entidades\Marca;
    use App\Models\Entidades\Cliente;
    
    
    
    class PedidoFaltaDAO extends BaseDAO
    {
        public function listar($faltaCliente_cod = null)
        {
            $SQL = $this->select(
                'SELECT FC.faltaCliente_cod,
                       FC.proposta,
                       FC.AFM,
                       FC.observacao,
                       FC.dataFalta,
                       CL.nomefantasia,
                       MF.nome_Marca,
                       SF.nomeStatus
                
                        FROM faltaCliente FC
                        inner join clienteLicitacao CL on CL.licitacaoCliente_cod = FC.fk_cliente
                        inner join marcaFalta MF on MF.marcaFalta_cod = FC.fk_marca
                        inner join statusFalta SF on SF.faltaStatus_cod = FC.fk_status '
            );
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
                $pedidofalta->setFkCliente($pedidofalta['fkcliente']);
                $pedidofalta->setFkMarca($pedidofalta['fkmarca']);
                $pedidofalta->setProposta($pedidofalta['fkproduto']);
                $pedidofalta->setProposta($dataSetFalta['propodta']);
                $listaFaltas[] = $pedidofalta;
            }
            return $listaFaltas;
        }
    
        public function salvar(PedidoFalta $pedidoFalta)
        {
            try {
                $cliente        = $pedidoFalta->getFkCliente()->getCodCliente();
                $marca          = $pedidoFalta->getFkMarca();
                $status         = $pedidoFalta->getFkStatus();
                $afm            = $pedidoFalta->getAFM();
                $observacao     = $pedidoFalta->getObservacao();
                $dataFalta      = $pedidoFalta->getDataFalta();
                $proposta       = $pedidoFalta->getProposta();
                
                return $this->insert(
                    'faltaCliente',
                    ':faltaCliente_cod,:fk_marca, :status, afm, observacao, dataFalta, proposta',
                    [
                        ':faltaCliente_cod' => $cliente,
                        'fk_marca'      => $marca,
                        'fk_status'     => $status,
                        'afm'           => $afm,
                        'observacao'    => $observacao,
                        'dataFalta'     =>$dataFalta,
                        'proposta'      =>$proposta
                
                    ]
                );
            } catch (\Exception $e) {
                throw new \Exception('Erro ao gravar falta! ');
            }
        }
    
        public function addProduto(PedidoFalta $pedidoFalta)
        {
            try {
                $produtos = $pedidoFalta->getFkProduto();
                if (isset($produtos)) {
                    foreach ($produtos as $produto) {
                        $this->insert(
                            'faltaporcliente',
                            ":FK_ID_FALTACLIENTE,:FK_IDPRODUTO, :FK_MARCA",
                            [
                                ':FK_ID_FALATACLIENTE'  => $pedidoFalta->getFaltaClienteCod(),
                                ':FK_IDPRODUTO'         => $pedidoFalta->getFkProduto(),
                                ':FK_MARCA'             => $pedidoFalta->getFkMarca()
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
                    ":proposta, :AFM, :observacao, :",
                    [
                        'proposta'      => $proposta,
                        'AFM'           => $AFM,
                        'observacao'    => $observacao,
                        'FK_CLIENTE'    => $fk_cliente,
                        'FK_PRODUTO'    => $fk_produto,
                        'FK_MARCA'      => $fk_marca
                    ],
                    "faltaCliente_cod = :faltaCliente_cod"
                );
            }
            catch (\Exception $e){
                throw new \Exception("Erro na gravação de dados", 500);
            }
        }
    }