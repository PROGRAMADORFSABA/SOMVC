<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\StatusDAO;


use App\Models\Validacao\StatusValidador;
use App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\Status;


class StatusService
{
    public function listar($statusId = null)
    {
        
        $statusDAO = new StatusDAO();
        return $statusDAO->listar($statusId);
    }

    
    public function salvar(Status $status)
    {
        $statusValidador = new StatusValidador();
        $resultadoValidacao = $statusValidador->validar($status);

        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            $statusDAO = new StatusDAO();            
            $statusDAO->salvar($status);
            Sessao::gravaMensagem("cadastrado realiado com sucesso!.");
            Sessao::limpaFormulario();
            return true;
        }
        return false;
    }

    public function Editar(Status $status)
    {        
        $statusDAO = new StatusDAO();
        $status = $statusDAO->listar($status->getCodStatus())[0];

        $statusValidador = new StatusValidador();
        $resultadoValidacao = $statusValidador->validar($status);

        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            Sessao::limpaFormulario(); 
            Sessao::limpaMensagem();           
            Sessao::gravaMensagem("Cadastro atualizada com sucesso!");
            $statusDAO = new StatusDAO();
            return $statusDAO->atualizar($status);
        }
        return false;
    }

    public function excluir(Status $status)
    {
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $statusDAO = new StatusDAO();
            
            $statusDAO->excluir($status);
            $transacao->commit();            
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Cadastro Excluido com Sucesso!");
            return true;
        } catch (\Exception $e) {
            $transacao->rollBack();
            throw new \Exception(["Erro ao excluir cadastro"]);            
            return false;
        }
    }
}