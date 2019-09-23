<?php
    
    
    namespace App\Controllers;
    
    use App\Lib\Sessao;
    use App\Models\Entidades\PedidoFalta;
    use App\Models\Entidades\Cliente;
    
    use App\Models\DAO\PedidoFaltaDAO;
    use App\Models\DAO\ClienteDAO;
    
    use App\Services\PedidoFaltaService;
    
    class PedidoFaltaController extends Controller
    {
        public function  index($params, $pedidofalta)
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
            {s
                $pedidoFalta = new PedidoFalta();
                $pedidoFalta->setFaltaClienteCod(Sessao::retornaValorFormulario('idFaltaCliente'));
                $pedidoFalta->setFkCliente(Sessao::retornaValorFormulario('idCliente'));
                $pedidoFalta->setFkMarca(Sessao::retornaValorFormulario('idMarca'));
                $pedidoFalta->getFkProduto(Sessao::retornaValorFormulario('idProduto'));
                $pedidoFalta->setProposta(Sessao::retornaValorFormulario('proposta'));
                $pedidoFalta->setAFM(Sessao::retornaValorFormulario('AFM'));
                $pedidoFalta->setFkStatus(Sessao::retornaValorFormulario('status'));
                $pedidoFalta->setObservacao(Sessao::retornaValorFormulario('observacao'));
                $pedidoFalta->setDataFalta(Sessao::retornaValorFormulario('dataFalta'));
                
    
                $this->render('/pedidofalta/cadastro');
            }

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