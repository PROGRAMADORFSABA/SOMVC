<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\PedidoDAO;

use App\Models\Validacao\PedidoValidador;
use App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\Edital;
use App\Models\Entidades\ClienteLicitacao;
use App\Services\EmailService;


class PedidoService
{
    public function listar(Pedido $pedido)
    {
        $pedidoDAO = new PedidoDAO();
        return $pedidoDAO->listar($pedido);
    }
    
    public function salvar(Pedido $pedido)
    {
        $transacao = new Transacao();
        $pedidoValidador = new PedidoValidador();
        $resultadoValidacao = $pedidoValidador->validar($pedido);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
               $transacao->beginTransaction();
                $pedidoDAO = new PedidoDAO();            
               $codPedido = $pedidoDAO->salvar($pedido);
               $transacao->commit();   
              
                Sessao::gravaMensagem("cadastro realizado com sucesso!.  <br> Pedido Numero: ".$codPedido);
                Sessao::limpaFormulario();
                return $codPedido;
            }catch(\Exception $pe){
                 $emailService = new EmailService();
                $emailService->emailSuporte($e);
                //var_dump($e);
                $transacao->rollBack(); 
                Sessao::gravaMensagem("Erro ao tentar cadastrar. ".$e);
               return false;
            }
        }
    }

    public function Editar(Pedido $pedido)
    {   
        $transacao = new Transacao();
        $pedidoValidador = new PedidoValidador();
        $resultadoValidacao = $pedidoValidador->validar($pedido);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
               $transacao->beginTransaction();
                $pedidoDAO = new PedidoDAO();            
                $pedidoDAO->atualizar($pedido);
                $transacao->commit(); 
                Sessao::gravaMensagem("cadastro alterado com sucesso!. <br> <br>  Codigo ".$pedido->getCodControle());
                Sessao::limpaFormulario();
                return true;
            }catch(\Exception $e){
                 $emailService = new EmailService();
                $emailService->emailSuporte($e);
                $transacao->rollBack(); 
              //var_dump($e);
                Sessao::gravaMensagem("Erro ao tentar alterar. ".$e);
               return false;
            }
        }

    }

    public function excluir(Pedido $pedido)
    {
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $pedidoDAO = new PedidoDAO();
                                   
            $pedidoDAO->excluir($pedido);
            $transacao->commit();            
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Pedido Excluida com Sucesso!");
            return true;
        } catch (\Exception $e) {
             $emailService = new EmailService();
                $emailService->emailSuporte($e);
            $transacao->rollBack();
            throw new \Exception(["Erro ao excluir a empresa"]);            
            return false;
        }
    }
}