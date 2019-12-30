<?php

namespace App\Models\DAO;

use App\Models\Entidades\EditalStatus;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;
/*
edt_id, edt_numero, edt_dataabertura, edt_hora, edt_dataresultado,  edt_proposta, edt_modalidade, 
edt_tipo, edt_garantia, edt_valor, edt_tatus, edt_analise, edt_observacao, edt_anexo, 
edt_representante, edt_cliente, edt_usuario, edt_instituicao, edt_datacadastro, edt_dataalteracao
*/
class EditalStatusDAO extends BaseDAO
{
    public  function listar($edtId = null)
    {        
       /* $SQL = " SELECT * 
		FROM edital edt
		INNER JOIN cadRepresentante r ON r.codRepresentante = edt.edt_representante
        INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = edt.edt_cliente
        INNER JOIN instituicao i ON i.inst_id = edt.edt_instituicao
		INNER JOIN usuarios u ON u.id = edt.edt_usuario ";
            if($edtId) 
            {    
                $SQL.= " WHERE edt.edt_id = $edtId";
            }         
            
            $resultado = $this->select($SQL);
            $dados = $resultado->fetchAll();
            $lista = [];
            foreach ($dados as $dado) {                
                $editalStatus = new Edital();
                $editalStatus->setEdtId($dado['edt_id']);;
                $editalStatus->setEdtNumero($dado['edt_numero']);
                $editalStatus->setEdtDataAbertura($dado['edt_dataabertura']);
                $editalStatus->setEdtHora($dado['edt_hora']);
                $editalStatus->setEdtDataResultado($dado['edt_dataresultado']);
                $editalStatus->setEdtProposta($dado['edt_proposta']);
                $editalStatus->setEdtModalidade($dado['edt_modalidade']);
                $editalStatus->setEdtTipo($dado['edt_tipo']);
                $editalStatus->setEdtGarantia($dado['edt_garantia']);
                $editalStatus->setEdtValor(number_format($dado['edt_valor'], 2, ',', '.'));
                $editalStatus->setEdtStatus($dado['edt_status']);
                $editalStatus->setEdtAnalise($dado['edt_analise']);
                $editalStatus->setEdtObservacao($dado['edt_observacao']);
                $editalStatus->setEdtAnexo($dado['edt_anexo']);
                $editalStatus->setEdtDataAlteracao($dado['edt_dataabertura']);
                $editalStatus->setEdtDataCadastro($dado['edt_datacadastro']);
                $editalStatus->setEdtDataAlteracao($dado['edt_dataalteracao']);
                $editalStatus->setRepresentante(new Representante());
                $editalStatus->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
                $editalStatus->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
                $editalStatus->setClienteLicitacao(new ClienteLicitacao());
                $editalStatus->getClienteLicitacao()->setCodCliente($dado['licitacaoCliente_cod']);
                $editalStatus->getClienteLicitacao()->setNomeFantasia($dado['nomefantasia']);
                $editalStatus->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);
                $editalStatus->getClienteLicitacao()->setCnpj($dado['CNPJ']);
                $editalStatus->getClienteLicitacao()->setTrocaMarca($dado['trocamarca']);
                $editalStatus->setInstituicao(new Instituicao());
                $editalStatus->getInstituicao()->setInst_Id($dado['inst_id']);                    
                $editalStatus->getInstituicao()->setInst_Nome($dado['inst_nome']);                    
                $editalStatus->setUsuario(new Usuario());
                $editalStatus->getUsuario()->setId($dado['id']);
                $editalStatus->getUsuario()->setNome($dado['nome']);
                
                $lista[] = $editalStatus;
            }
            return $lista;        
         */       
    }
   
    public  function listarDinamico(EditalStatus $editalStatus)
    {     
      /*  
        $codCliente         = $editalStatus->getEdtCliente();      
        $codEdital          = $editalStatus->getEdtId();
        $proposta           = $editalStatus->getEdtProposta();
        $numeroLicitacao    = $editalStatus->getEdtNumero();
        $status             = $editalStatus->getEdtStatus();
        $modalidade         = $editalStatus->getEdtModalidade();
        $representante      = $editalStatus->getEdtRepresentante();

        $SQL = " SELECT * 
		FROM edital edt
		INNER JOIN cadRepresentante r ON r.codRepresentante = edt.edt_representante
        INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = edt.edt_cliente
        INNER JOIN instituicao i ON i.inst_id = edt.edt_instituicao
		INNER JOIN usuarios u ON u.id = edt.edt_usuario ";                 
             $where = Array();
             if( $codCliente ){ $where[] = " edt.edt_cliente = {$codCliente}"; }
             if( $codEdital ){ $where[] = " edt.edt_id = {$codEdital}"; }
             if( $proposta ){ $where[] = " edt.edt_proposta = '{$proposta}'"; }
             if( $status ){ $where[] = " edt.edt_status = '{$status}'"; }
             if( $representante ){ $where[] = " r.codRepresentante = {$representante}"; }
             if( $modalidade ){ $where[] = " edt.edt_modalidade = '{$modalidade}'"; }
             if( $numeroLicitacao ){ $where[] = " edt.edt_numero = '{$numeroLicitacao}'"; }   
          
          if( sizeof( $where ) )
          $SQL .= ' WHERE '.implode( ' AND ',$where ); 

            $resultado = $this->select($SQL);
            $dados = $resultado->fetchAll();
            $lista = [];
            foreach ($dados as $dado) {                
                $editalStatus = new Edital();
                $editalStatus->setEdtId($dado['edt_id']);;
                $editalStatus->setEdtNumero($dado['edt_numero']);
                $editalStatus->setEdtDataAbertura($dado['edt_dataabertura']);
                $editalStatus->setEdtHora($dado['edt_hora']);
                $editalStatus->setEdtDataResultado($dado['edt_dataresultado']);
                $editalStatus->setEdtProposta($dado['edt_proposta']);
                $editalStatus->setEdtModalidade($dado['edt_modalidade']);
                $editalStatus->setEdtTipo($dado['edt_tipo']);
                $editalStatus->setEdtGarantia($dado['edt_garantia']);
                $editalStatus->setEdtValor(number_format($dado['edt_valor'], 2, ',', '.'));
                $editalStatus->setEdtStatus($dado['edt_status']);
                $editalStatus->setEdtAnalise($dado['edt_analise']);
                $editalStatus->setEdtObservacao($dado['edt_observacao']);
                $editalStatus->setEdtAnexo($dado['edt_anexo']);
                $editalStatus->setEdtDataAlteracao($dado['edt_dataabertura']);
                $editalStatus->setEdtDataCadastro($dado['edt_datacadastro']);
                $editalStatus->setEdtDataAlteracao($dado['edt_dataalteracao']);
                $editalStatus->setRepresentante(new Representante());
                $editalStatus->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
                $editalStatus->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
                $editalStatus->setClienteLicitacao(new ClienteLicitacao());
                $editalStatus->getClienteLicitacao()->setCodCliente($dado['licitacaoCliente_cod']);
                $editalStatus->getClienteLicitacao()->setNomeFantasia($dado['nomefantasia']);
                $editalStatus->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);
                $editalStatus->getClienteLicitacao()->setCnpj($dado['CNPJ']);
                $editalStatus->getClienteLicitacao()->setTrocaMarca($dado['trocamarca']);
                $editalStatus->setInstituicao(new Instituicao());
                $editalStatus->getInstituicao()->setInst_Id($dado['inst_id']);                    
                $editalStatus->getInstituicao()->setInst_Nome($dado['inst_nome']);                    
                $editalStatus->setUsuario(new Usuario());
                $editalStatus->getUsuario()->setId($dado['id']);
                $editalStatus->getUsuario()->setNome($dado['nome']);
                
                $lista[] = $editalStatus;
            }
            return $lista;        
        */        
    }
    
   
    public  function salvar(EditalStatus $editalStatus)
    {
      /*
        try {
            $edtNumero                     = $editalStatus->getEdtNumero();
            $edtDataAbertura               = $editalStatus->getEdtDataAbertura()->format('Y-m-d');
            $edtHora                       = $editalStatus->getEdtHora()->format('h:m:s');
            $edtDataResultado              = $editalStatus->getEdtDataResultado()->format('Y-m-d h:m:s');
            $edtProposta                   = $editalStatus->getEdtProposta();
            $edtModalidade                 = $editalStatus->getEdtModalidade();
            $edtTipo                       = $editalStatus->getEdtTipo();
            $edtGarantia                   = $editalStatus->getEdtGarantia();
            $edtValor                    = $editalStatus->getEdtValor();
           // $edtValor                      = str_replace(",", ".", $valorAtual);
            $edtStatus                     = $editalStatus->getEdtStatus();
            $edtAnalise                    = $editalStatus->getEdtAnalise();
            $edtObservacao                 = $editalStatus->getEdtObservacao();
            $edtAnexo                      = $editalStatus->getEdtAnexo();
            $edtRepresentante              = $editalStatus->getRepresentante()->getCodRepresentante();
            $edtCliente                    = $editalStatus->getClienteLicitacao()->getCodCliente();
            $edtUsuario                    = $editalStatus->getUsuario()->getId();           
            $edtInstituicao                = $editalStatus->getInstituicao()->getInst_Id();
            $edtDataCadastro               = $editalStatus->getEdtDataCadastro()->format('Y-m-d h:m:s');
            $edtDataAlteracao              = $editalStatus->getEdtDataAlteracao()->format('Y-m-d h:m:s');
            $nomeanexo = date('Y-m-d-h:m:s');
          
            if (!$_FILES['anexo']['name'] == "") {
                $validextensions = array("jpeg", "jpg", "png", "PNG", "JPG", "JPEG", "pdf", "PDF", "docx");
                $temporary = explode(".", $_FILES["anexo"]["name"]);
                $file_extension = end($temporary);
                $edtAnexo = md5($nomeanexo) . "." . $file_extension;
                //var_dump($file_extension);
                if (in_array($file_extension, $validextensions)) {
                    $sourcePath = $_FILES['anexo']['tmp_name'];
                    $targetPath = "public/assets/media/anexos/" . md5($nomeanexo) . "." . $file_extension;
                    move_uploaded_file($sourcePath, $targetPath); // Move arquivo                    
                }
            } else {
                    $edtAnexo = "sem_anexo1.png";
            }
            return $this->insert(
                'edital',
                ":edt_numero,:edt_dataabertura,:edt_hora,:edt_dataresultado,:edt_proposta,
                :edt_modalidade,:edt_tipo,:edt_garantia,:edt_valor,:edt_status,
                :edt_analise,:edt_observacao,:edt_anexo,:edt_representante,:edt_cliente,
                :edt_usuario,:edt_instituicao,:edt_datacadastro,:edt_dataalteracao",
                [
                    ':edt_numero' => $edtNumero,
                    ':edt_dataabertura' => $edtDataAbertura,
                    ':edt_hora' => $edtHora,
                    ':edt_dataresultado' => $edtDataResultado,
                    ':edt_proposta' => $edtProposta,
                    ':edt_modalidade' => $edtModalidade,
                    ':edt_tipo' => $edtTipo,
                    ':edt_garantia' => $edtGarantia,
                    ':edt_valor' => $edtValor,
                    ':edt_status' => $edtStatus,
                    ':edt_analise' => $edtAnalise,
                    ':edt_observacao' => $edtObservacao,
                    ':edt_anexo' => $edtAnexo,
                    ':edt_representante' => $edtRepresentante,
                    ':edt_cliente' => $edtCliente,
                    ':edt_usuario' => $edtUsuario,
                    ':edt_instituicao' => $edtInstituicao,
                    ':edt_datacadastro' => $edtDataCadastro,
                    ':edt_dataalteracao' => $edtDataAlteracao
                    ]
                );
            } catch (\Exception $e) {               
                throw new \Exception("Erro na gravação de dados. " . $e, 500);
            }
            */
    }
   
    public  function atualizar(EditalStatus $editalStatus)
    {
      /*  try {
            
            $edtId                         = $editalStatus->getEdtId();
            $edtNumero                     = $editalStatus->getEdtNumero();
            $edtDataAbertura               = $editalStatus->getEdtDataAbertura()->format('Y-m-d');
            $edtHora                       = $editalStatus->getEdtHora()->format('h:m:s');
            $edtDataResultado              = $editalStatus->getEdtDataResultado()->format('Y-m-d h:m:s');
            $edtProposta                   = $editalStatus->getEdtProposta();
            $edtModalidade                 = $editalStatus->getEdtModalidade();
            $edtTipo                       = $editalStatus->getEdtTipo();
            $edtGarantia                   = $editalStatus->getEdtGarantia();
            $edtValor                    = $editalStatus->getEdtValor();
            //$edtValor                      = str_replace(",", ".", $valorAtual);
            $edtStatus                     = $editalStatus->getEdtStatus();
            $edtAnalise                    = $editalStatus->getEdtAnalise();
            $edtObservacao                 = $editalStatus->getEdtObservacao();
            $edtAnexo                      = $editalStatus->getEdtAnexo();
            $edtRepresentante              = $editalStatus->getRepresentante()->getCodRepresentante();
            $edtCliente                    = $editalStatus->getClienteLicitacao()->getCodCliente();
            $edtUsuario                    = $editalStatus->getUsuario()->getId();           
            $edtInstituicao                = $editalStatus->getInstituicao()->getInst_Id();
            $edtDataCadastro               = $editalStatus->getEdtDataCadastro()->format('Y-m-d h:m:s');
            $edtDataAlteracao              = $editalStatus->getEdtDataAlteracao()->format('Y-m-d h:m:s');
            $nomeanexo = date('Y-m-d-h:m:s');
           
            if (!$_FILES['anexo']['name'] == "") {
                $validextensions = array("jpeg", "jpg", "png", "PNG", "JPG", "JPEG", "pdf", "PDF", "docx");
                $temporary = explode(".", $_FILES["anexo"]["name"]);
                $file_extension = end($temporary);
                $edtAnexo = md5($nomeanexo) . "." . $file_extension;
                //var_dump($file_extension);

                if (in_array($file_extension, $validextensions)) {
                    $sourcePath = $_FILES['anexo']['tmp_name'];
                    $targetPath = "public/assets/media/anexos/" . md5($nomeanexo) . "." . $file_extension;
                    move_uploaded_file($sourcePath, $targetPath); // Move arquivo                    
                }
            } else {
                if($edtAnexo == ""){
                $edtAnexo = "sem_anexo1.png";
                }
            }

            return $this->update(
                'edital',
                "edt_numero= :edtNumero, edt_dataabertura= :edtDataAbertura, edt_hora= :edtHora, edt_dataresultado= :edtDataAbertura,  edt_proposta= :edtProposta, edt_modalidade= :edtModalidade, 
edt_tipo= :edtTipo, edt_garantia= :edtGarantia, edt_valor= :edtValor, edt_status= :edtStatus, edt_analise= :edtAnalise, edt_observacao= :edtObservacao, edt_anexo= :edtAnexo, 
edt_representante= :edtRepresentante, edt_cliente= :edtCliente, edt_usuario= :edtUsuario, edt_instituicao= :edtInstituicao, edt_datacadastro= :edtDataCadastro, edt_dataalteracao=:edtDataAlteracao",
                [
                    ':edtId' => $edtId,
                    ':edtNumero' => $edtNumero,
                    ':edtDataAbertura' => $edtDataAbertura,
                    ':edtHora' => $edtHora,
                    ':edtDataResultado' => $edtDataResultado,
                    ':edtProposta' => $edtProposta,
                    ':edtModalidade' => $edtModalidade,
                    ':edtTipo' => $edtTipo,
                    ':edtGarantia' => $edtGarantia,
                    ':edtValor' => $edtValor,
                    ':edtStatus' => $edtStatus,
                    ':edtAnalise' => $edtAnalise,
                    ':edtObservacao' => $edtObservacao,
                    ':edtAnexo' => $edtAnexo,
                    ':edtRepresentante' => $edtRepresentante,
                    ':edtCliente' => $edtCliente,
                    ':edtUsuario' => $edtUsuario,
                    ':edtInstituicao' => $edtInstituicao,
                    ':edtDataCadastro' => $edtDataCadastro,
                    ':edtDataAlteracao' => $edtDataAlteracao, 
                ],
                "edt_id = :edtId"
                );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }*/
    }

    public function excluir(EditalStatus $editalStatus)
    {
        /*try {
            $edtId = $editalStatus->getEdtId();
            $this->delete('notificacao', "ntf_edital = $edtId");
            $this->delete('contrato', "ctr_edital = $edtId");
            $this->delete('edital', "edt_id = $edtId");
        } catch (Exception $e) {
            throw new \Exception("Erro ao excluir edital", 500);
        }*/
    }

}
