<?php
namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\PedidoDAO;
use App\Models\Entidades\Pedido;
use App\Models\Validacao\ProdutoValidador;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidoDAO = new PedidoDAO();

        //self::setViewParam('listaPedido', $pedidoDAO->listar());

        $this->render('/pedido/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $this->render('/pedido/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::retornaErro();

    }

    public function salvar()
    {
    
    }
}