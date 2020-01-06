<?php

namespace App\Models\DAO;

use App\Models\Entidades\ContratoStatus;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;
use Exception;

class ContratoStatusDAO extends BaseDAO
{     
    public  function listar(ContratoStatus $contratoStatus)
    {     
        
        $stCtrCodigo        = $contratoStatus->getStCtrId();      
        $stCtrNome          = $contratoStatus->getStCtrNome();
        /*$proposta           = $contratoStatus->getEdtProposta();
        $numeroLicitacao    = $contratoStatus->getEdtNumero();
        $status             = $contratoStatus->getEdtStatus();
        $modalidade         = $contratoStatus->getEdtModalidade();
        $representante      = $contratoStatus->getEdtRepresentante();*/

        $SQL = " SELECT * 
		FROM contratoStatus stctr
        INNER JOIN instituicao i ON i.inst_id = stctr.stctr_instituicao
        INNER JOIN usuarios u ON u.id = stctr.stctr_usuario ";       

             $where = Array();
             if( $stCtrCodigo ){ $where[] = " stctr.stctr_id = {$stCtrCodigo}"; }
             if( $stCtrNome ){ $where[] = " stctr.stctr_nome = '{$stCtrNome}'"; }
            /* if( $proposta ){ $where[] = " stedt.edt_proposta = '{$proposta}'"; }
             if( $status ){ $where[] = " stedt.edt_status = '{$status}'"; }
             if( $representante ){ $where[] = " r.codRepresentante = {$representante}"; }
             if( $modalidade ){ $where[] = " stedt.edt_modalidade = '{$modalidade}'"; }
             if( $numeroLicitacao ){ $where[] = " stedt.edt_numero = '{$numeroLicitacao}'"; } */  
          
          if( sizeof( $where ) ){
              $SQL .= ' WHERE '.implode( ' AND ',$where ); 
            }else {
                $SQL .= " ORDER BY stctr.stctr_nome ";
            }
            $resultado = $this->select($SQL);
            $dados = $resultado->fetchAll();
            
            $lista = [];
            foreach ($dados as $dado) {                
                $contratoStatus = new ContratoStatus();
                
                $contratoStatus->setStCtrId($dado['stctr_id']);;
                $contratoStatus->setStCtrNome($dado['stctr_nome']);
                $contratoStatus->setStCtrObservacao($dado['stctr_observacao']);
                $contratoStatus->setStCtrDataCadastro($dado['stctr_datacadastro']);
                $contratoStatus->setStCtrDataAlteracao($dado['stctr_dataalteracao']);
                $contratoStatus->setStCtrInstituicao(new Instituicao());
                $contratoStatus->getStCtrInstituicao()->setInst_Id($dado['inst_id']);                    
                $contratoStatus->getStCtrInstituicao()->setInst_Nome($dado['inst_nome']);                    
                $contratoStatus->setStCtrUsuario(new Usuario());
                $contratoStatus->getStCtrUsuario()->setId($dado['id']);
                $contratoStatus->getStCtrUsuario()->setNome($dado['nome']);
                
                $lista[] = $contratoStatus;
            }
            return $lista;        
               
    }
    
   
    public  function salvar(ContratoStatus $contratoStatus)
    {
      
        try {
            
            $stCtrNome                     = $contratoStatus->getStCtrNome();
            $stCtrObservacao               = $contratoStatus->getStCtrObservacao();
            $stCtrUsuario                  = $contratoStatus->getStCtrUsuario()->getId();           
            $stCtrInstituicao              = $contratoStatus->getStCtrInstituicao()->getInst_Id();
            $stCtrDataAltercacao           = $contratoStatus->getStCtrDataAlteracao()->format('Y-m-d h:m:s');
            $stCtrDataCadastro             = $contratoStatus->getStCtrDataCadastro()->format('Y-m-d h:m:s');
            
            return $this->insert(
                'contratoStatus',
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
   
    public  function atualizar(ContratoStatus $contratoStatus)
    {
        try {
            
            $stCtrId                       = $contratoStatus->getStCtrId();
            $stCtrDataAltercacao           = $contratoStatus->getStCtrDataAlteracao()->format('Y-m-d h:m:s');
            $stCtrDataCadastro             = $contratoStatus->getStCtrDataCadastro()->format('Y-m-d h:m:s');
            $stCtrNome                     = $contratoStatus->getStCtrNome();
            $stCtrObservacao               = $contratoStatus->getStCtrObservacao();
            $stCtrUsuario                  = $contratoStatus->getStCtrUsuario()->getId();           
            $stCtrInstituicao              = $contratoStatus->getStCtrInstituicao()->getInst_Id();;

            return $this->update(
                'contratoStatus',
                "stctr_nome= :nome, stctr_observacao= :observacao, stctr_usuario= :usuario, stctr_instituicao= :instituicao,  
                stctr_datacadastro= :datacadastro, stctr_dataalteracao= :dataalteracao",
                [
                    ':ctrId'            => $stCtrId,
                    ':nome'             => $stCtrNome,
                    ':observacao'       => $stCtrObservacao,
                    ':usuario'          => $stCtrUsuario,
                    ':instituicao'      => $stCtrInstituicao,
                    ':datacadastro'     => $stCtrDataCadastro,
                    ':dataalteracao'    => $stCtrDataCadastro, 
                ],
                "stctr_id = :ctrId"
                );
        } catch (\Exception $e) {
            throw new \Exception("Erro na atualização dos dados. ".$e, 500);
        }
    }

    public function excluir(ContratoStatus $contratoStatus)
    {
        try {
            $edtId = $contratoStatus->getStEdtId();            
            $this->delete('contratoStatus', "stctr_id = $edtId");
        } catch (Exception $e) {
            throw new \Exception("Erro ao excluir Cadastro", 500);
        }
    }

}
