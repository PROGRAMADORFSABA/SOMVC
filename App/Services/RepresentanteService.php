<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\RepresentanteDAO;


use App\Models\Validacao\RepresentanteValidador;
use App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\Representante;


class RepresentanteService
{
    public function listar($representanteId = null)
    {
        $representanteDAO = new RepresentanteDAO();
        return $representanteDAO->listar($representanteId);
    }

    /*public function autoComplete(Representante $representante)
    { 
        $representanteDAO = new RepresentanteDAO();
        $busca = $representanteDAO->listaPorNome($representante);          
        $exportar = new Exportar();
        
        return $exportar->exportarJSON($busca);
    }*/

    public function autoComplete1(Representante $representante)
    { 
        $representanteDAO = new RepresentanteDAO();
        $busca = $representanteDAO->listaPorUf($representante);          
        $exportar = new Exportar();
        
        return $exportar->exportarJSON($busca);
    }
    
    public function listarRepresentantesVinculadas(Representante $representante)
    {
        $representanteDAO = new RepresentanteDAO();
        return $representanteDAO->listarRepresentantesVinculadas($representante);
    }

    public function salvar(Representante $representante)
    {
        $representanteValidador = new RepresentanteValidador();
       $resultadoValidacao = $representanteValidador->validar($representante);

        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            $representanteDAO = new empresaDAO();            
            $representanteDAO->salvar($representante);
            Sessao::gravaMensagem("cadastrado com sucesso.");
            Sessao::limpaFormulario();
            return true;
        }
        return false;
    }

    public function Editar(Representante $representante)
    {        
        $representanteDAO = new RepresentanteDAO();
        $representanteCadastrada = $representanteDAO->listar($representante->getIdRepresentante())[0];

        $representanteValidadorEditar = new RepresentanteValidadorEditar();
        $resultadoValidacao = $representanteValidadorEditar->validar($representante, $representanteCadastrada);

        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            Sessao::limpaFormulario(); 
            Sessao::limpaMensagem();           
            Sessao::gravaMensagem("Representante atualizada com sucesso!");
            $representanteDAO = new RepresentanteDAO();
            return $representanteDAO->editar($representante);
        }
        return false;
    }

    public function excluir(Representante $representante)
    {
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $representanteDAO = new RepresentanteDAO();
            
            $representanteDAO->excluir($representante);
            $transacao->commit();            
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Representante Excluido com Sucesso!");
            return true;
        } catch (\Exception $e) {
            $transacao->rollBack();
            throw new \Exception(["Erro ao excluir cadastro"]);            
            return false;
        }
    }
}