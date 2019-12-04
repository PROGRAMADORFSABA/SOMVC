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
    public function listarClientePedido($pedidoId = null)
    {
        $pedidoDAO = new PedidoDAO();
        return $pedidoDAO->listarClientePedido($pedidoId);
    }
    public function listarRepresentantePedido($pedidoId = null)
    {
        $pedidoDAO = new PedidoDAO();
        return $pedidoDAO->listarRepresentantePedido($pedidoId);
    }
    public function listarPorEdital($editalId = null)
    {
        $pedidoDAO = new PedidoDAO();
        return $pedidoDAO->listarPorEdital($editalId);
    }
    public function qtdePedidoPorEdital($editalId = null)
    {
        $pedidoDAO = new PedidoDAO();
        return $pedidoDAO->qtdePedidoPorEdital($editalId);
    }
    public function listarDinamico(Pedido $pedido)
    {
        $pedidoDAO = new PedidoDAO();
        return $pedidoDAO->listarDinamico($pedido);
    }

    public function autoCompletePedidoClienteRazaoSocial(ClienteLicitacao $clienteLicitacao)
    {
        
        $clienteLicitacao->getRazaoSocial();
        $pedidoDAO = new PedidoDAO();
        $busca = $pedidoDAO->autoCompletePedidoClienteRazaoSocial($clienteLicitacao);
        $exportar = new Exportar();
        echo $exportar->exportarJSON($busca);
    
    }
    public function autoCompleteNumeroPedidoCodCliente(Edital $edital,ClienteLicitacao $clienteLicitacao)
    {        
        $edital->getEdtNumero();
        $clienteLicitacao->getCodCliente();
       $pedidoDAO = new PedidoDAO();
        $busca = $pedidoDAO->autoCompleteNumeroPedidoCodCliente($edital, $clienteLicitacao);
        $exportar = new Exportar();
        echo $exportar->exportarJSON($busca);
    
    }
    public function autoCompleteEditalClienteRazaoSocial(ClienteLicitacao $clienteLicitacao)
    {        
        $clienteLicitacao->getRazaoSocial();
        $pedidoDAO = new PedidoDAO();
        $busca = $pedidoDAO->autoCompleteEditalClienteRazaoSocial($clienteLicitacao);
        $exportar = new Exportar();
        echo $exportar->exportarJSON($busca);
    
    }
    public function autoCompleteNumeroEditalCodCliente(Edital $edital,ClienteLicitacao $clienteLicitacao)
    {        
        $edital->getEdtNumero();
        $clienteLicitacao->getCodCliente();
       $pedidoDAO = new PedidoDAO();
        $busca = $pedidoDAO->autoCompleteNumeroEditalCodCliente($edital, $clienteLicitacao);
        $exportar = new Exportar();
        echo $exportar->exportarJSON($busca);
    
    }

    public function autoComplete(Pedido $pedido)
    { 
        $pedidoDAO = new PedidoDAO();
        $busca = $pedidoDAO->listaPorNome($pedido);          
        $exportar = new Exportar();
        return $exportar->exportarJSON($busca);
    }
    
    public function listarEstadosVinculadas(Pedido $pedido)
    {
        $pedidoDAO = new PedidoDAO();
        return $pedidoDAO->listarEstadosVinculadas($pedido);
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
                Sessao::gravaMensagem("cadastro realizado com sucesso!. <br>  <br> Pedido Numero: ".$codPedido);
                Sessao::limpaFormulario();
                return $codPedido;
            }catch(\Exception $e){
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