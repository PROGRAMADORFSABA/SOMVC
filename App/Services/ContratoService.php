<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

//use App\Models\DAO\ContratoDAO;
use App\Models\DAO\EstadoDAO;


use App\Models\Validacao\ContratoValidador;
use App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\Contrato;


class ContratoService
{
    public function listar($cidId = null)
    {
        
        $cidadeDAO = new ContratoDAO();
        return $cidadeDAO->listar($cidId);
    }

    public function autoComplete(Contrato $cidade)
    { 
        $cidadeDAO = new ContratoDAO();
        $busca = $cidadeDAO->listaPorNome($cidade);          
        $exportar = new Exportar();
        return $exportar->exportarJSON($busca);
    }
    
    public function listarEstadosVinculadas(Contrato $cidade)
    {
        $cidadeDAO = new ContratoDAO();
        return $cidadeDAO->listarEstadosVinculadas($cidade);
    }

    public function salvar(Contrato $cidade)
    {
        $transacao = new Transacao();
        $cidadeValidador = new ContratoValidador();
        $resultadoValidacao = $cidadeValidador->validar($cidade);

        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
                $transacao->beginTransaction();
                $cidadeDAO = new ContratoDAO();            
                $cidadeDAO->salvar($cidade);
                $transacao->commit(); 
                Sessao::gravaMensagem("cadastro realizado com sucesso!.");
                Sessao::limpaFormulario();
                return true;
            }catch(\Exception $e){
                Sessao::gravaMensagem("Erro ao tentar cadastrar.");
                $transacao->rollBack(); 
                return false;
            }
        }
    }

    public function Editar(Contrato $cidade)
    {        
        //$cidadeDAO = new ContratoDAO();
       // $cidade = $cidadeDAO->listar($cidade->getCidId())[0];

        $cidadeValidador = new ContratoValidador();
        $resultadoValidacao = $cidadeValidador->validar($cidade);

        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            Sessao::limpaFormulario(); 
            Sessao::limpaMensagem();           
            Sessao::gravaMensagem("Cadastro atualizado com sucesso! ");
            $cidadeDAO = new ContratoDAO();
            return $cidadeDAO->atualizar($cidade);
        }
        return false;
    }

    public function excluir(Contrato $cidade)
    {
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $cidadeDAO = new ContratoDAO();
           // $vagas = $cidadeDAO->listarEstadosVinculadas($cidade);
                        
            $cidadeDAO->excluir($cidade);
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