<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\CidadeDAO;
use App\Models\DAO\EstadoDAO;


use App\Models\Validacao\CidadeValidador;
use App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\Cidade;

use App\Services\TecnologiaService;

class CidadeService
{
    public function listar($idCidade = null)
    {
        $cidadeDAO = new CidadeDAO();
        return $cidadeDAO->listar($idCidade);
    }

    public function autoComplete(Cidade $cidade)
    { 
        $cidadeDAO = new CidadeDAO();
        $busca = $cidadeDAO->listaPorNome($cidade);          
        $exportar = new Exportar();
        return $exportar->exportarJSON($busca);
    }
    
    public function listarEstadosVinculadas(Cidade $cidade)
    {
        $cidadeDAO = new CidadeDAO();
        return $cidadeDAO->listarEstadosVinculadas($cidade);
    }

    public function salvar(Cidade $cidade)
    {
        $cidadeValidadorInserir = new CidadeValidadorInserir();
        $resultadoValidacao = $cidadeValidadorInserir->validar($cidade);

        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            $cidadeDAO = new empresaDAO();            
            $cidadeDAO->salvar($cidade);
            Sessao::gravaMensagem("Nova empresa cadastrada com sucesso.");
            Sessao::limpaFormulario();
            return true;
        }
        return false;
    }

    public function Editar(Cidade $novaCidade)
    {        
        $cidadeDAO = new CidadeDAO();
        $cidadeCadastrada = $cidadeDAO->listar($novaCidade->getIdCidade())[0];

        $cidadeValidadorEditar = new CidadeValidadorEditar();
        $resultadoValidacao = $cidadeValidadorEditar->validar($novaCidade, $cidadeCadastrada);

        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            Sessao::limpaFormulario(); 
            Sessao::limpaMensagem();           
            Sessao::gravaMensagem("Cidade atualizada com sucesso!");
            $cidadeDAO = new CidadeDAO();
            return $cidadeDAO->editar($novaCidade);
        }
        return false;
    }

    public function excluir(Cidade $cidade)
    {
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $cidadeDAO = new CidadeDAO();
            $vagas = $cidadeDAO->listarEstadosVinculadas($cidade);

            if (isset($vagas)) {                
                $vagaDAO = new EstadoDAO();
                foreach ($vagas as $vaga) {                    
                    $vagaDAO->excluirComRelacionamentos($vaga);          
                }
            }
            
            $cidadeDAO->excluir($cidade);
            $transacao->commit();            
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Cidade Excluida com Sucesso!");
            return true;
        } catch (\Exception $e) {
            $transacao->rollBack();
            throw new \Exception(["Erro ao excluir a empresa"]);            
            return false;
        }
    }
}