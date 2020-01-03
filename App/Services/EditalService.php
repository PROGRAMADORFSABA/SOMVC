<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\EditalDAO;
use App\Models\DAO\ContratoDAO;
use App\Models\Entidades\Contrato;
use App\Models\Entidades\ClienteLicitacao;
use App\Services\EmailService;
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
    public function listarRepresentanteEdital($edtId = null)
    {
        $editalDAO = new EditalDAO();
        return $editalDAO->listarRepresentanteEdital($edtId);
    }
    public function listarDinamico(Edital $edital)
    {
        $editalDAO = new EditalDAO();
        return $editalDAO->listarDinamico($edital);
    }

    public function autoComplete(Edital $edital)
    { 
        $editalDAO = new EditalDAO();
      //  $busca = $editalDAO->listaPorNome($edital);          
        $exportar = new Exportar();
       // return $exportar->exportarJSON($busca);
    }
    
    public function autoCompleteEditalClienteRazaoSocial(ClienteLicitacao $clienteLicitacao)
    {
        
        $clienteLicitacao->getRazaoSocial();
        $editalDAO = new EditalDAO();
        $busca = $editalDAO->autoCompleteEditalClienteRazaoSocial($clienteLicitacao);
        $exportar = new Exportar();
        echo $exportar->exportarJSON($busca);
    
    }
    public function autoCompleteNumeroEditalCodCliente(Edital $edital,ClienteLicitacao $clienteLicitacao)
    {        
        $edital->getEdtNumero();
        $clienteLicitacao->getCodCliente();
       $editalDAO = new EditalDAO();
        $busca = $editalDAO->autoCompleteNumeroEditalCodCliente($edital, $clienteLicitacao);
        $exportar = new Exportar();
        echo $exportar->exportarJSON($busca);
    
    }

    public function listarEstadosVinculadas(Edital $edital)
    {
        $editalDAO = new EditalDAO();
       // return $editalDAO->listarEstadosVinculadas($edital);
    }

    public function salvar(Edital $edital)
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
                $codEdital = $editalDAO->salvar($edital);
                $transacao->commit(); 
                Sessao::gravaMensagem("cadastro realizado com sucesso! <br> <br> Pedido Numero: ".$codEdital);
                Sessao::limpaFormulario();
                return true;
            }catch(\Exception $e){
                $emailService = new EmailService();
                $tela = "Cadastro Edital - Codigo ".$codEdital;
                $emailService->emailSuporte($e, $tela);
                Sessao::gravaMensagem("Erro ao tentar cadastrar. ".$e);
                $transacao->rollBack();             
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
                Sessao::gravaMensagem("cadastro alterado com sucesso! <br> <br>  Codigo ".$edital->getEdtId());
                Sessao::limpaFormulario();
                return true;
            }catch(\Exception $e){
                $emailService = new EmailService();
                $tela = "Alteracao Edital - Codigo ".$edital->getEdtId();
                $emailService->emailSuporte($e, $tela);
                $transacao->rollBack(); 
                Sessao::gravaMensagem("Erro ao tentar alterar.");
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
            $emailService = new EmailService();
            $tela = "Exclusao Edital - Codigo ".$edital->getEdtId();
            $emailService->emailSuporte($e, $tela);
            $transacao->rollBack();
            throw new \Exception(["Erro ao excluir cadastro"]);            
            return false;
        }
    }
}