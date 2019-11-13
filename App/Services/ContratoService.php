<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\ContratoDAO;

use App\Models\Validacao\ContratoValidador;
use App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\Contrato;
use App\Models\Entidades\Edital;
use App\Models\Entidades\ClienteLicitacao;


class ContratoService
{
    public function listar($contratoId = null)
    {
        $contratoDAO = new ContratoDAO();
        return $contratoDAO->listar($contratoId);
    }
    public function listarClienteContrato($contratoId = null)
    {
        $contratoDAO = new ContratoDAO();
        return $contratoDAO->listarClienteContrato($contratoId);
    }
    public function listarRepresentanteContrato($contratoId = null)
    {
        $contratoDAO = new ContratoDAO();
        return $contratoDAO->listarRepresentanteContrato($contratoId);
    }
    public function listarPorEdital($editalId = null)
    {
        $contratoDAO = new ContratoDAO();
        return $contratoDAO->listarPorEdital($editalId);
    }
    public function qtdeContratoPorEdital($editalId = null)
    {
        $contratoDAO = new ContratoDAO();
        return $contratoDAO->qtdeContratoPorEdital($editalId);
    }
    public function listarDinamico(Contrato $contrato)
    {
        $contratoDAO = new ContratoDAO();
        return $contratoDAO->listarDinamico($contrato);
    }

    public function autoCompleteContratoClienteRazaoSocial(ClienteLicitacao $clienteLicitacao)
    {
        
        $clienteLicitacao->getRazaoSocial();
        $contratoDAO = new ContratoDAO();
        $busca = $contratoDAO->autoCompleteContratoClienteRazaoSocial($clienteLicitacao);
        $exportar = new Exportar();
        echo $exportar->exportarJSON($busca);
    
    }
    public function autoCompleteNumeroContratoCodCliente(Edital $edital,ClienteLicitacao $clienteLicitacao)
    {        
        $edital->getEdtNumero();
        $clienteLicitacao->getCodCliente();
       $contratoDAO = new ContratoDAO();
        $busca = $contratoDAO->autoCompleteNumeroContratoCodCliente($edital, $clienteLicitacao);
        $exportar = new Exportar();
        echo $exportar->exportarJSON($busca);
    
    }
    public function autoCompleteEditalClienteRazaoSocial(ClienteLicitacao $clienteLicitacao)
    {        
        $clienteLicitacao->getRazaoSocial();
        $contratoDAO = new ContratoDAO();
        $busca = $contratoDAO->autoCompleteEditalClienteRazaoSocial($clienteLicitacao);
        $exportar = new Exportar();
        echo $exportar->exportarJSON($busca);
    
    }
    public function autoCompleteNumeroEditalCodCliente(Edital $edital,ClienteLicitacao $clienteLicitacao)
    {        
        $edital->getEdtNumero();
        $clienteLicitacao->getCodCliente();
       $contratoDAO = new ContratoDAO();
        $busca = $contratoDAO->autoCompleteNumeroEditalCodCliente($edital, $clienteLicitacao);
        $exportar = new Exportar();
        echo $exportar->exportarJSON($busca);
    
    }

    public function autoComplete(Contrato $contrato)
    { 
        $contratoDAO = new ContratoDAO();
        $busca = $contratoDAO->listaPorNome($contrato);          
        $exportar = new Exportar();
        return $exportar->exportarJSON($busca);
    }
    
    public function listarEstadosVinculadas(Contrato $contrato)
    {
        $contratoDAO = new ContratoDAO();
        return $contratoDAO->listarEstadosVinculadas($contrato);
    }

    public function salvar(Contrato $contrato)
    {
        $transacao = new Transacao();
        $contratoValidador = new ContratoValidador();
        $resultadoValidacao = $contratoValidador->validar($contrato);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
               $transacao->beginTransaction();
                $contratoDAO = new ContratoDAO();            
                $contratoDAO->salvar($contrato);
                $transacao->commit(); 
                Sessao::gravaMensagem("cadastro realizado com sucesso!.");
                Sessao::limpaFormulario();
                return true;
            }catch(\Exception $e){
                var_dump($e);
                $transacao->rollBack(); 
                Sessao::gravaMensagem("Erro ao tentar cadastrar. ".$e);
               return false;
            }
        }
    }

    public function Editar(Contrato $contrato)
    {   
        $transacao = new Transacao();
        $contratoValidador = new ContratoValidador();
        $resultadoValidacao = $contratoValidador->validar($contrato);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
               $transacao->beginTransaction();
                $contratoDAO = new ContratoDAO();            
                $contratoDAO->atualizar($contrato);
                $transacao->commit(); 
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

    public function excluir(Contrato $contrato)
    {
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $contratoDAO = new ContratoDAO();
                                   
            $contratoDAO->excluir($contrato);
            $transacao->commit();            
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Contrato Excluida com Sucesso!");
            return true;
        } catch (\Exception $e) {
            $transacao->rollBack();
            throw new \Exception(["Erro ao excluir a empresa"]);            
            return false;
        }
    }
}