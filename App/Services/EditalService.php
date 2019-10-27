<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

//use App\Models\DAO\EditalDAO;
use App\Models\DAO\EstadoDAO;


use App\Models\Validacao\EditalValidador;
use App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\Edital;


class EditalService
{
    public function listar($cidId = null)
    {
        
        $cidadeDAO = new EditalDAO();
        return $cidadeDAO->listar($cidId);
    }

    public function autoComplete(Edital $cidade)
    { 
        $cidadeDAO = new EditalDAO();
        $busca = $cidadeDAO->listaPorNome($cidade);          
        $exportar = new Exportar();
        return $exportar->exportarJSON($busca);
    }
    
    public function listarEstadosVinculadas(Edital $cidade)
    {
        $cidadeDAO = new EditalDAO();
        return $cidadeDAO->listarEstadosVinculadas($cidade);
    }

    public function salvar(Edital $cidade)
    {
        $transacao = new Transacao();
        $cidadeValidador = new EditalValidador();
        $resultadoValidacao = $cidadeValidador->validar($cidade);

        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
                $transacao->beginTransaction();
                $cidadeDAO = new EditalDAO();            
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

    public function Editar(Edital $cidade)
    {        
        //$cidadeDAO = new EditalDAO();
       // $cidade = $cidadeDAO->listar($cidade->getCidId())[0];

        $cidadeValidador = new EditalValidador();
        $resultadoValidacao = $cidadeValidador->validar($cidade);

        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            Sessao::limpaFormulario(); 
            Sessao::limpaMensagem();           
            Sessao::gravaMensagem("Cadastro atualizado com sucesso! ");
            $cidadeDAO = new EditalDAO();
            return $cidadeDAO->atualizar($cidade);
        }
        return false;
    }

    public function excluir(Edital $cidade)
    {
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $cidadeDAO = new EditalDAO();
           // $vagas = $cidadeDAO->listarEstadosVinculadas($cidade);
                        
            $cidadeDAO->excluir($cidade);
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