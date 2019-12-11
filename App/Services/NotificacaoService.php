<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\NotificacaoDAO;

use App\Models\Validacao\NotificacaoValidador;
use App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\Notificacao;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\ClienteLicitacao;


class NotificacaoService
{
    public function listar($notificacaoId = null)
    {
        $notificacaoDAO = new NotificacaoDAO();
        return $notificacaoDAO->listar($notificacaoId);
    }
    public function listarClienteNotificacao($notificacaoId = null)
    {
        $notificacaoDAO = new NotificacaoDAO();
        return $notificacaoDAO->listarClienteNotificacao($notificacaoId);
    }
    public function listarRepresentanteNotificacao($notificacaoId = null)
    {
        $notificacaoDAO = new NotificacaoDAO();
        return $notificacaoDAO->listarRepresentanteNotificacao($notificacaoId);
    }
    public function listarPorEdital($editalId = null)
    {
        $notificacaoDAO = new NotificacaoDAO();
        return $notificacaoDAO->listarPorEdital($editalId);
    }
    public function qtdeNotificacaoPorEdital($editalId = null)
    {
        $notificacaoDAO = new NotificacaoDAO();
        return $notificacaoDAO->qtdeNotificacaoPorEdital($editalId);
    }
    
    public function listarDinamico(Notificacao $notificacao)
    {
        $notificacaoDAO = new NotificacaoDAO();
        return $notificacaoDAO->listarDinamico($notificacao);
    }
    
/*
    public function autoCompleteNotificacaoClienteRazaoSocial(ClienteLicitacao $clienteLicitacao)
    {
        
        $clienteLicitacao->getRazaoSocial();
        $notificacaoDAO = new NotificacaoDAO();
        $busca = $notificacaoDAO->autoCompleteNotificacaoClienteRazaoSocial($clienteLicitacao);
        $exportar = new Exportar();
        echo $exportar->exportarJSON($busca);
    
    }
    public function autoCompleteNumeroNotificacaoCodCliente(Edital $edital,ClienteLicitacao $clienteLicitacao)
    {        
        $edital->getEdtNumero();
        $clienteLicitacao->getCodCliente();
       $notificacaoDAO = new NotificacaoDAO();
        $busca = $notificacaoDAO->autoCompleteNumeroNotificacaoCodCliente($edital, $clienteLicitacao);
        $exportar = new Exportar();
        echo $exportar->exportarJSON($busca);
    
    }
    public function autoCompleteEditalClienteRazaoSocial(ClienteLicitacao $clienteLicitacao)
    {        
        $clienteLicitacao->getRazaoSocial();
        $notificacaoDAO = new NotificacaoDAO();
        $busca = $notificacaoDAO->autoCompleteEditalClienteRazaoSocial($clienteLicitacao);
        $exportar = new Exportar();
        echo $exportar->exportarJSON($busca);
    
    }
    public function autoCompleteNumeroEditalCodCliente(Edital $edital,ClienteLicitacao $clienteLicitacao)
    {        
        $edital->getEdtNumero();
        $clienteLicitacao->getCodCliente();
       $notificacaoDAO = new NotificacaoDAO();
        $busca = $notificacaoDAO->autoCompleteNumeroEditalCodCliente($edital, $clienteLicitacao);
        $exportar = new Exportar();
        echo $exportar->exportarJSON($busca);
    
    }

    public function autoComplete(Notificacao $notificacao)
    { 
        $notificacaoDAO = new NotificacaoDAO();
        $busca = $notificacaoDAO->listaPorNome($notificacao);          
        $exportar = new Exportar();
        return $exportar->exportarJSON($busca);
    }
    
    public function listarEstadosVinculadas(Notificacao $notificacao)
    {
        $notificacaoDAO = new NotificacaoDAO();
        return $notificacaoDAO->listarEstadosVinculadas($notificacao);
    }
*/
    public function salvar(Notificacao $notificacao)
    {
        $transacao = new Transacao();
        $notificacaoValidador = new NotificacaoValidador();
        $resultadoValidacao = $notificacaoValidador->validar($notificacao);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
               $transacao->beginTransaction();
                $notificacaoDAO = new NotificacaoDAO();            
                $codNotificacao =  $notificacaoDAO->salvar($notificacao);
                $transacao->commit(); 
                Sessao::gravaMensagem("cadastro realizado com sucesso!. <br><br> Numero: ".$codNotificacao);
                Sessao::limpaFormulario();
                return $codNotificacao;
            }catch(\Exception $e){
              // var_dump($e);
                $transacao->rollBack(); 
                Sessao::gravaMensagem("Erro ao tentar cadastrar. ".$e);
               return false;
            }
        }
    }

    public function Editar(Notificacao $notificacao)
    {   
        $transacao = new Transacao();
        $notificacaoValidador = new NotificacaoValidador();
        $resultadoValidacao = $notificacaoValidador->validar($notificacao);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
               $transacao->beginTransaction();
                $notificacaoDAO = new NotificacaoDAO();            
                $notificacaoDAO->atualizar($notificacao);
                $transacao->commit();           
               
                Sessao::gravaMensagem("cadastro atualizado com sucesso!. <br><br> Numero: ".$notificacao->getNtf_cod());
                Sessao::gravaMensagem("cadastro alterado com sucesso!.");
                Sessao::limpaFormulario();
                return true;
            }catch(\Exception $e){
                $transacao->rollBack(); 
             //var_dump($e);
                Sessao::gravaMensagem("Erro ao tentar alterar. ".$e);
               return false;
            }
        }

    }

    public function excluir(Notificacao $notificacao)
    {
        try {
            
            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $notificacaoDAO = new NotificacaoDAO();
                                   
            $notificacaoDAO->excluir($notificacao);
            $transacao->commit();            
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Notificacao Excluida com Sucesso!");
            return true;
        } catch (\Exception $e) {
           // var_dump($e);
            $transacao->rollBack();
            throw new \Exception(["Erro ao excluir a empresa"]);            
            return false;
        }
    }
}
