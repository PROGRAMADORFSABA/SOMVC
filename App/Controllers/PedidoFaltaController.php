<?php
    
    
    namespace App\Controllers;
    
    use App\Lib\Sessao;
    use App\Models\DAO\PedidoFaltaDAO;
    use App\Models\Entidades\Cliente;
    use App\Models\DAO\ClienteDAO;
    
    class PedidoFaltaController extends Controller
    {
        public function  index()
        {
            $clienteFaltaDAO = new PedidoFaltaDAO();
            
            $this->render('/pedidofalta/index');
            
            Sessao::limpaMensagem();
        }
        
        public function cadastro()
        {
            $pedidoFalta = new PedidoFaltaDAO();
             $this->render('/pedidofalta/cadastro');
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