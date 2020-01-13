<?php

namespace App\Models\DAO;

use App\Models\Entidades\EditalStatus;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;
use Exception;

class EditalStatusDAO extends BaseDAO
{     
    public  function listar(EditalStatus $editalStatus)
    {     
        
        $stEdtCodigo        = $editalStatus->getStEdtId();      
        $stEdtNome          = $editalStatus->getStEdtNome();
        /*$proposta           = $editalStatus->getEdtProposta();
        $numeroLicitacao    = $editalStatus->getEdtNumero();
        $status             = $editalStatus->getEdtStatus();
        $modalidade         = $editalStatus->getEdtModalidade();
        $representante      = $editalStatus->getEdtRepresentante();*/

        $SQL = " SELECT * 
		FROM editalStatus stedt
        INNER JOIN instituicao i ON i.inst_id = stedt.stedt_instituicao
        INNER JOIN usuarios u ON u.id = stedt.stedt_usuario ";       

             $where = Array();
             if( $stEdtCodigo ){ $where[] = " stedt.stedt_id = {$stEdtCodigo}"; }
             if( $stEdtNome ){ $where[] = " stedt.stedt_nome = '{$stEdtNome}'"; }
            /* if( $proposta ){ $where[] = " stedt.edt_proposta = '{$proposta}'"; }
             if( $status ){ $where[] = " stedt.edt_status = '{$status}'"; }
             if( $representante ){ $where[] = " r.codRepresentante = {$representante}"; }
             if( $modalidade ){ $where[] = " stedt.edt_modalidade = '{$modalidade}'"; }
             if( $numeroLicitacao ){ $where[] = " stedt.edt_numero = '{$numeroLicitacao}'"; } */  
          
          if( sizeof( $where ) ){
              $SQL .= ' WHERE '.implode( ' AND ',$where ); 
            }else {
                $SQL .= " ORDER BY stedt.stedt_nome ";
            }
            $resultado = $this->select($SQL);
            $dados = $resultado->fetchAll();
            
            $lista = [];
            foreach ($dados as $dado) {                
                $editalStatus = new EditalStatus();
                
                $editalStatus->setStEdtId($dado['stedt_id']);;
                $editalStatus->setStEdtNome($dado['stedt_nome']);
                $editalStatus->setStEdtObservacao($dado['stedt_observacao']);
                $editalStatus->setStEdtDataCadastro($dado['stedt_datacadastro']);
                $editalStatus->setStEdtDataAlteracao($dado['stedt_dataalteracao']);
                $editalStatus->setStEdtInstituicao(new Instituicao());
                $editalStatus->getStEdtInstituicao()->setInst_Id($dado['inst_id']);                    
                $editalStatus->getStEdtInstituicao()->setInst_Nome($dado['inst_nome']);                    
                $editalStatus->setStEdtUsuario(new Usuario());
                $editalStatus->getStEdtUsuario()->setId($dado['id']);
                $editalStatus->getStEdtUsuario()->setNome($dado['nome']);
                
                $lista[] = $editalStatus;
            }           

            return $lista;        
               
    }
    
   
    public  function salvar(EditalStatus $editalStatus)
    {
      
        try {
            
            $stEdtNome                     = $editalStatus->getStEdtNome();
            $stEdtObservacao               = $editalStatus->getStEdtObservacao();
            $stEdtUsuario                  = $editalStatus->getStEdtUsuario()->getId();           
            $stEdtInstituicao              = $editalStatus->getStEdtInstituicao()->getInst_Id();
            $stEdtDataAltercacao           = $editalStatus->getStEdtDataAlteracao()->format('Y-m-d h:m:s');
            $stEdtDataCadastro             = $editalStatus->getStEdtDataCadastro()->format('Y-m-d h:m:s');
            
            return $this->insert(
                'editalStatus',
                ":nome, :observacao, :usuario, :instituicao, :datacadastro, :dataalteracao",
                [
                    ':nome'             => $stEdtNome,
                    ':observacao'       => $stEdtObservacao,
                    ':usuario'          => $stEdtUsuario,
                    ':instituicao'      => $stEdtInstituicao,
                    ':datacadastro'     => $stEdtDataCadastro,
                    ':dataalteracao'    => $stEdtDataAltercacao
                    ]
                );
                     
            } catch (\Exception $e) {               
                throw new \Exception("Erro na gravação de dados. " . $e, 500);
            }
            
    }
   
    public  function atualizar(EditalStatus $editalStatus)
    {
        try {
            
            $stEdtId                       = $editalStatus->getStEdtId();
            $stEdtDataAltercacao           = $editalStatus->getStEdtDataAlteracao()->format('Y-m-d h:m:s');
            $stEdtDataCadastro             = $editalStatus->getStEdtDataCadastro()->format('Y-m-d h:m:s');
            $stEdtNome                     = $editalStatus->getStEdtNome();
            $stEdtObservacao               = $editalStatus->getStEdtObservacao();
            $stEdtUsuario                  = $editalStatus->getStEdtUsuario()->getId();           
            $stEdtInstituicao              = $editalStatus->getStEdtInstituicao()->getInst_Id();;

            return $this->update(
                'editalStatus',
                "stedt_nome= :nome, stedt_observacao= :observacao, stedt_usuario= :usuario, stedt_instituicao= :instituicao,  
                stedt_datacadastro= :datacadastro, stedt_dataalteracao= :dataalteracao",
                [
                    ':edtId'            => $stEdtId,
                    ':nome'             => $stEdtNome,
                    ':observacao'       => $stEdtObservacao,
                    ':usuario'          => $stEdtUsuario,
                    ':instituicao'      => $stEdtInstituicao,
                    ':datacadastro'     => $stEdtDataCadastro,
                    ':dataalteracao'    => $stEdtDataCadastro, 
                ],
                "stedt_id = :edtId"
                );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

    public function excluir(EditalStatus $editalStatus)
    {
        try {
            $edtId = $editalStatus->getStEdtId();            
            $this->delete('editalStatus', "stedt_id = $edtId");
        } catch (Exception $e) {
            throw new \Exception("Erro ao excluir edital", 500);
        }
    }

}
