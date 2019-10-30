<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\EditalDAO;
use App\Models\Entidades\Contrato;
use App\Models\Validacao\EditalValidador;
use App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\Edital;


class EditalService
{
    public function listar($edtId = null)
    {
        $editalDAO = new EditalDAO();
        return $editalDAO->listar($edtId);
    }
    public function listarDinamico(Edital $edital)
    {
        $editalDAO = new EditalDAO();
        return $editalDAO->listarDinamico($edital);
    }

    public function autoComplete(Edital $edital)
    { 
        $editalDAO = new EditalDAO();
        $busca = $editalDAO->listaPorNome($edital);          
        $exportar = new Exportar();
        return $exportar->exportarJSON($busca);
    }
    
    public function listarEstadosVinculadas(Edital $edital)
    {
        $editalDAO = new EditalDAO();
        return $editalDAO->listarEstadosVinculadas($edital);
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
                $transacao->rollBack(); 
                //var_dump($e);
                Sessao::gravaMensagem("Erro ao tentar cadastrar. ".$e);
               return false;
            }
        }
    }

    public function Editar(Edital $edital)
    {   
        $transacao = new Transacao();
        $editalValidador = new EditalValidador();
        $resultadoValidacao = $editalValidador->validar($edital);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
               $transacao->beginTransaction();
                $editalDAO = new EditalDAO();            
                $editalDAO->atualizar($edital);
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

    public function excluir(Edital $edital)
    {
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $editalDAO = new EditalDAO();
                                   
            $editalDAO->excluir($edital);
            $transacao->commit();            
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Edital Excluida com Sucesso!");
            return true;
        } catch (\Exception $e) {
            $transacao->rollBack();
            throw new \Exception(["Erro ao excluir a empresa"]);            
            return false;
        }
    }
}