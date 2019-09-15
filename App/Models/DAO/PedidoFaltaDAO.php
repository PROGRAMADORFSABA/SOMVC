<?php
    
    
    namespace App\Models\DAO;
    
    use App\Models\Entidades\PedidoFalta;
    use App\Models\Entidades\Produto;
    use App\Models\Entidades\Marca;
    use App\Models\Entidades\Cliente;
    
    
    
    class PedidoFaltaDAO extends BaseDAO
    {
        public function listar($faltaCliente_cod = null)
        {
            $SQL = $this->select(
                "SELECT FC.faltaCliente_cod,
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
                        inner join statusFalta SF on SF.faltaStatus_cod = FC.fk_status "
            );
            if($faltaCliente_cod)
            {
                $SQL.="WHERE FC.faltaCliente_cod";
            }
            
            $resultado = $this->select($SQL);
            $dataSetFaltas = $resultado->fetchAll();
            $listaFaltas = [];
            
            foreach ($dataSetFaltas as $dataSetFalta)
            {
                $pedidofalta= new PedidoFalta();
                $
                
            }
        }
    }