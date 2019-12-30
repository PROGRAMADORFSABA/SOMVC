<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\EditalStatusDAO;
use App\Models\Validacao\EditalStatusValidador;
use App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\EditalStatus;


class EditalStatusService
{
    public function listar($edtId = null)
    {
        $editalStatusDAO = new EditalStatusDAO();
        return $editalStatusDAO->listar($edtId);
    }
    
    public function listarDinamico(EditalStatus $editalStatus)
    {
        $editalStatusDAO = new EditalStatusDAO();
        return $editalStatusDAO->listarDinamico($editalStatus);
    }

    public function salvar(EditalStatus $editalStatus)
    {
        $transacao = new Transacao();
        $editalValidador = new EditalValidador();
        $resultadoValidacao = $editalValidador->validar($editalStatus);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
               $transacao->beginTransaction();
                $editalStatusDAO = new EditalStatusDAO();            
                $editalStatusDAO->salvar($editalStatus);
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

    public function Editar(EditalStatus $editalStatus)
    {   
        $transacao = new Transacao();
        $editalValidador = new EditalValidador();
        $resultadoValidacao = $editalValidador->validar($editalStatus);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
               $transacao->beginTransaction();
                $editalStatusDAO = new EditalStatusDAO();            
                $editalStatusDAO->atualizar($editalStatus);
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

    public function excluir(EditalStatus $editalStatus)
    {
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $editalStatusDAO = new EditalStatusDAO();        

            $editalStatusDAO->excluir($editalStatus);
            
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