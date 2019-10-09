<?php
    
    
    namespace App\Models\Validacao;
    
    
    use App\Models\Entidades\PedidoFalta;

    class PedidoFaltaValidador
    {
        public function validar(PedidoFalta $pedidoFalta)
        {
            $resultdoValidacao = new ResultadoValidacao();
            
            if(empty($pedidoFalta->getFkCliente()))
            {
                $resultdoValidacao->addErro('fkcliente',"<b>Cliente</b> Este campo não pode ser vazio");
            }
            
            if(empty($pedidoFalta->getFkProduto()))
            {
                $resultdoValidacao->addErro('fkproduto', "<b>Produto</b> É necessário no minimo 1 produto");
            }
            
            if(empty($pedidoFalta->getFkMarca()))
            {
                $resultdoValidacao->addErro('marca',"<b>Marca</b> Este campo não pode ser vazio");
            }
            
            if(empty($pedidoFalta->getAFM()))
            {
                $resultdoValidacao->addErro('afm',"<b>AFM</b> Este campo não pode ser vazio");
            }
            
            if(empty($pedidoFalta->getProposta()))
            {
                $resultdoValidacao->addErro('proposta', "<b>Proposta</b> Este campo não pode ser vazio");
            }
            
            if(empty($pedidoFalta->getFkStatus()))
            {
                $resultdoValidacao->addErro('fkstatus',"<b>status</b> Este campo não pode ser vazio");
            }
            
            return $resultdoValidacao;
        }
        
    }