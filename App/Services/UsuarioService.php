<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\UsuarioDAO;



use App\Models\Validacao\UsuarioValidador;
use App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\Usuario;

use App\Services\TecnologiaService;

class UsuarioService
{
    public function listar($idUsuario = null)
    {
        $usuarioDAO = new UsuarioDAO();
        return $usuarioDAO->listar($idUsuario);
    }
   
    public function validacadastro($codigo,$email,$valida)
    {
        $usuarioDAO = new UsuarioDAO();
        return $usuarioDAO->validacadastro($codigo,$email,$valida);
    }
    public function ativarcadastro(Usuario $usuario)
    {
        $usuarioDAO = new UsuarioDAO();
        return $usuarioDAO->ativarcadastro($usuario);
    }

  /*public function autoComplete(Usuario $usuario)
    { 
        $usuarioDAO = new UsuarioDAO();
        $busca = $usuarioDAO->listaPorNome($usuario);          
        $exportar = new Exportar();
        return $exportar->exportarJSON($busca);
    }*/
    
    /*public function listarEstadosVinculadas(Usuario $usuario)
    {
        $usuarioDAO = new UsuarioDAO();
        return $usuarioDAO->listarEstadosVinculadas($usuario);
    }*/

    /*public function salvar(Usuario $usuario)
    {
        $transacao = new Transacao();
        $usuarioValidadorInserir = new UsuarioValidadorInserir();
        $resultadoValidacao = $usuarioValidadorInserir->validar($usuario);

        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
                $transacao->beginTransaction();
                $usuarioDAO = new UsuarioDAO();            
                $usuarioDAO->salvar($usuario);
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
    }*/

    public function Editar(Usuario $usuario)
    {
        $transacao              = new Transacao();
        $usuarioValidador       = new UsuarioValidador();
        $resultadoValidacao     = new ResultadoValidacao();
        $resultadoValidacao     = $usuarioValidador->validar($usuario);
        
        if ($resultadoValidacao->getErros()) {
            Sessao::limpaErro();
            Sessao::gravaErro($resultadoValidacao->getErros());
        } else {
            try{
                $transacao->beginTransaction();
                $usuarioDAO = new UsuarioDAO();            
                $usuarioDAO->atualizar($usuario);
                $transacao->commit(); 
                Sessao::gravaMensagem("cadastro alterado com sucesso! <br> <br>  Codigo ".$usuario->getId());
                Sessao::limpaFormulario();
                return true;
            }catch(\Exception $e){
                var_dump("editar usuario ".$e);
                $transacao->rollBack(); 
                //var_dump($e);
                Sessao::gravaMensagem("Erro ao tentar alterar. ");
               return false;
            }
        }




    }

    /*public function excluir(Usuario $usuario)
    {
        try {

            $transacao = new Transacao();
            $transacao->beginTransaction();
            
            $usuarioDAO = new UsuarioDAO();
            $vagas = $usuarioDAO->listarEstadosVinculadas($usuario);

            if (isset($vagas)) {                
                $vagaDAO = new EstadoDAO();
                foreach ($vagas as $vaga) {                    
                    $vagaDAO->excluirComRelacionamentos($vaga);          
                }
            }
            
            $usuarioDAO->excluir($usuario);
            $transacao->commit();            
            
            Sessao::limpaMensagem();
            Sessao::gravaMensagem("Usuario Excluida com Sucesso!");
            return true;
        } catch (\Exception $e) {
            $transacao->rollBack();
            throw new \Exception(["Erro ao excluir a empresa"]);            
            return false;
        }
    }*/
}