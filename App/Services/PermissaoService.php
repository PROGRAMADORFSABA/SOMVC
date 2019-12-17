<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\PermissaoDAO;

use App\Models\Validacao\PermissaoValidador;
use App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\Notificacao;
use App\Models\Entidades\Permissao;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\ClienteLicitacao;


class PermissaoService
{
    public function listar($permissaoId = null)
    {
        $permissaoDAO = new PermissaoDAO();
        return $permissaoDAO->listar($permissaoId);
    }
   
    public function listarDinamico(Permissao $permissao)
    {
        $permissaoDAO = new PermissaoDAO();
       // return $permissaoDAO->listarDinamico($permissao);
    }
   
    public function salvar(Permissao $permissao)
    {
        $transacao = new Transacao();
        $permissaoValidador = new PermissaoValidador();
        $resultadoValidacao = $permissaoValidador->validar($permissao);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
                $transacao->beginTransaction();
                $permissaoDAO = new PermissaoDAO();            
                $codPermissao =  $permissaoDAO->salvar($permissao);
                $transacao->commit(); 
                var_dump('permissao service');
                Sessao::gravaMensagem("cadastro realizado com sucesso!. <br><br> Numero: ".$codPermissao);
                Sessao::limpaFormulario();
                return $codPermissao;
                
            }catch(\Exception $e){
                var_dump($e);
                $transacao->rollBack(); 
                Sessao::gravaMensagem("Erro ao tentar cadastrar. ".$e);
               return false;
            }
        }
    }

   /*
    public function Editar(Notificacao $notificacao)
    {   
        $transacao = new Transacao();
        $notificacaoValidador = new NotificacaoValidador();
        $resultadoValidacao = $notificacaoValidador->validar($notificacao);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
               $transacao->beginTransaction();
                $notificacaoDAO = new NotificacaoDAO();            
                $notificacaoDAO->atualizar($notificacao);
                $transacao->commit();           
               
                Sessao::gravaMensagem("cadastro atualizado com sucesso!. <br><br> Numero: ".$notificacao->getNtf_cod());
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

    public function excluir(Notificacao $notificacao)
    {
        try {
            
            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $notificacaoDAO = new NotificacaoDAO();
                                   
            $notificacaoDAO->excluir($notificacao);
            $transacao->commit();            
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Notificacao Excluida com Sucesso!");
            return true;
        } catch (\Exception $e) {
           // var_dump($e);
            $transacao->rollBack();
            throw new \Exception(["Erro ao excluir a empresa"]);            
            return false;
        }
    }
    */
}
