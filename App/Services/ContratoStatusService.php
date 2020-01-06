<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\ContratoStatusDAO;
use App\Models\Validacao\ContratoStatusValidador;
use App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\ContratoStatus;


class ContratoStatusService
{
    public function listar(ContratoStatus $contratoStatus)
    {
        $contratoStatusDAO = new ContratoStatusDAO();
        return $contratoStatusDAO->listar($contratoStatus);
    }
    
    public function salvar(ContratoStatus $contratoStatus)
    {
        $transacao              = new Transacao();
        $contratoStatusValidador  = new ContratoStatusValidador();
        $resultadoValidacao     = new ResultadoValidacao();
        $resultadoValidacao     = $contratoStatusValidador->validar($contratoStatus);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
               $transacao->beginTransaction();
                $contratoStatusDAO = new ContratoStatusDAO();            
                $contratoStatusDAO->salvar($contratoStatus);
                $transacao->commit(); 
                Sessao::gravaMensagem("Cadastro realizado com sucesso!.");
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

    public function Editar(ContratoStatus $contratoStatus)
    {   
        $transacao              = new Transacao();
        $contratoStatusValidador  = new ContratoStatusValidador();
        $resultadoValidacao     = new ResultadoValidacao();
        $resultadoValidacao     = $contratoStatusValidador->validar($contratoStatus);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
               $transacao->beginTransaction();
                $contratoStatusDAO = new ContratoStatusDAO();            
                $contratoStatusDAO->atualizar($contratoStatus);
                $transacao->commit(); 
                Sessao::gravaMensagem("Cadastro alterado com sucesso!.");
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

    public function excluir(ContratoStatus $contratoStatus)
    {
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $contratoStatusDAO = new ContratoStatusDAO();        

            $contratoStatusDAO->excluir($contratoStatus);
            
            $transacao->commit();            
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Cadastro Excluido com Sucesso!");
            return true;
        } catch (\Exception $e) {
            $transacao->rollBack();
            throw new \Exception(["Erro ao excluir a empresa"]);            
            return false;
        }
    }
}