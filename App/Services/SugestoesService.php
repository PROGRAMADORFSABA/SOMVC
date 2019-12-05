<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\SugestoesDAO;

use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Sugestoes;
use App\Models\Validacao\SugestoesValidador;

class SugestoesService
{
    public function listar(Sugestoes $sugestoes)
    {
        $sugestoesDAO = new SugestoesDAO();
        return $sugestoesDAO->listar($sugestoes);
    }
   

    public function salvar(Pedido $sugestoes)
    {
        $transacao = new Transacao();
        $sugestoesValidador = new SugestoesValidador();
        $resultadoValidacao = $sugestoesValidador->validar($sugestoes);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
               $transacao->beginTransaction();
                $sugestoesDAO = new SugestoesDAO();            
                $codPedido = $sugestoesDAO->salvar($sugestoes);

                $transacao->commit(); 
                Sessao::gravaMensagem("cadastro realizado com sucesso!. <br>  <br> Pedido Numero: ".$codPedido);
                Sessao::limpaFormulario();
                return $codPedido;
            }catch(\Exception $e){
                $emailService = new EmailService();
                $emailService->emailSuporte($e);
                //var_dump($e);
                $transacao->rollBack(); 
                Sessao::gravaMensagem("Erro ao tentar cadastrar. ".$e);
               return false;
            }
        }
    }

    public function Editar(Pedido $sugestoes)
    {   
        $transacao = new Transacao();
        $sugestoesValidador = new SugestoesValidador();
        $resultadoValidacao = $sugestoesValidador->validar($sugestoes);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
               $transacao->beginTransaction();
                $sugestoesDAO = new SugestoesDAO();            
                $sugestoesDAO->atualizar($sugestoes);
                
                $transacao->commit(); 
                Sessao::gravaMensagem("cadastro alterado com sucesso!. <br> <br>  Codigo ".$sugestoes->getCodControle());
                Sessao::limpaFormulario();
                return true;
            }catch(\Exception $e){
                $emailService = new EmailService();
                $emailService->emailSuporte($e);
                $transacao->rollBack(); 
              //var_dump($e);
                Sessao::gravaMensagem("Erro ao tentar alterar. ".$e);
               return false;
            }
        }

    }

    public function excluir(Pedido $sugestoes)
    {
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $sugestoesDAO = new SugestoesDAO();
                                   
            $sugestoesDAO->excluir($sugestoes);
            $transacao->commit();            
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Pedido Excluida com Sucesso!");
            return true;
        } catch (\Exception $e) {
            $emailService = new EmailService();
            $emailService->emailSuporte($e);
            $transacao->rollBack();
            throw new \Exception(["Erro ao excluir a empresa"]);            
            return false;
        }
    }
    
}