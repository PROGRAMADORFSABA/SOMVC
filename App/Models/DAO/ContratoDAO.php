<?php

namespace App\Models\DAO;

use App\Models\Entidades\Edital;
use App\Models\Entidades\Contrato;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Representante;
use App\Models\Entidades\ClienteLicitacao;

class ContratoDAO extends BaseDAO
{
    public  function listar($edtId = null)
    {        
        $SQL = " SELECT * 
		FROM contrato ctr
		INNER JOIN edital edt ON edt.edt_id = ctr.ctr_edital
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
                /*
ctr_id, ctr_numero, ctr_datainicio,  ctr_datavencimento, ctr_valor, ctr_status, ctr_observacao, ctr_anexo, ctr_clientelicitacao, ctr_usuario, 
ctr_prazoentrega, ctr_prazopagamento, ctr_instituicao, ctr_datacadastro, ctr_dataalteracao
*/
                $contrato = new Contrato();
                $contrato->setCtrId($dado['ctr_id']);
                $contrato->getEdital(new Edital());
                $contrato->getEdital()->setEdtId($dado['edt_id']);
                $contrato->getEdital()->setEdtNumero($dado['ctr_numero']);
                $contrato->getEdital()->setEdtDataInicio($dado['ctr_datainicio']);
                $contrato->getEdital()->setEdtDataVencimento($dado['ctr_datavencimento']);
                $contrato->getEdital()->setEdtValor(number_format($dado['ctr_valor'], 2, ',', '.'));
                $contrato->getEdital()->setEdtStatus($dado['ctr_status']);
                $contrato->getEdital()->setEdtObservacao($dado['ctr_observacao']);
                $contrato->getEdital()->setEdtDataVencimento($dado['ctr_anexo']);
                $contrato->getEdital()->setEdtUsuario($dado['ctr_usuario']);
                $contrato->getEdital()->setEdtPrazoEntrega($dado['ctr_prazoentrega']);
                $contrato->getEdital()->setEdtPrazoPagamento($dado['ctr_prazopagamento']);
                $contrato->getEdital()->setEdtInstituicao($dado['ctr_instituicao']);
                $contrato->getEdital()->setEdtDataCadastro($dado['ctr_datacadastro']);
                $contrato->getEdital()->setEdtDataAlteracao($dado['ctr_dataalteracao']);
                $contrato->getEdital()->setEdtNumero($dado['edt_numero']);
                $contrato->getEdital()->setEdtDataAbertura($dado['edt_dataabertura']);
                $contrato->getEdital()->setEdtHora($dado['edt_hora']);
                $contrato->getEdital()->setEdtDataResultado($dado['edt_dataresultado']);
                $contrato->getEdital()->setEdtProposta($dado['edt_proposta']);
                $contrato->getEdital()->setEdtModalidade($dado['edt_modalidade']);
                $contrato->getEdital()->setEdtTipo($dado['edt_tipo']);
                $contrato->getEdital()->setEdtGarantia($dado['edt_garantia']);
                $contrato->getEdital()->setEdtValor(number_format($dado['edt_valor'], 2, ',', '.'));
                $contrato->getEdital()->setEdtStatus($dado['edt_status']);
                $contrato->getEdital()->setEdtAnalise($dado['edt_analise']);
                $contrato->getEdital()->setEdtObservacao($dado['edt_observacao']);
                $contrato->getEdital()->setEdtAnexo($dado['edt_anexo']);
                $contrato->getEdital()->setEdtDataAlteracao($dado['edt_dataabertura']);
                $contrato->getEdital()->setEdtDataCadastro($dado['edt_datacadastro']);
                $contrato->getEdital()->setEdtDataAlteracao($dado['edt_dataalteracao']);
                $contrato->setRepresentante(new Representante());
                $contrato->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
                $contrato->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
                $contrato->setClienteLicitacao(new ClienteLicitacao());
                $contrato->getClienteLicitacao()->setCodCliente($dado['licitacaoCliente_cod']);
                $contrato->getClienteLicitacao()->setNomeFantasia($dado['nomefantasia']);
                $contrato->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);
                $contrato->getClienteLicitacao()->setCnpj($dado['CNPJ']);
                $contrato->getClienteLicitacao()->setTrocaMarca($dado['trocamarca']);
                $contrato->setInstituicao(new Instituicao());
                $contrato->getInstituicao()->setInst_Id($dado['inst_id']);                    
                $contrato->getInstituicao()->setInst_Nome($dado['inst_nome']);                    
                $contrato->setUsuario(new Usuario());
                $contrato->getUsuario()->setId($dado['id']);
                $contrato->getUsuario()->setNome($dado['nome']);
                
                $lista[] = $contrato;
            }
            return $lista;        
                
    }
    public  function listarDinamico(Edital $contrato)
    {     
        
        $codCliente         = $contrato->getEdtCliente();      
        $codEdital          = $contrato->getEdtId();
        $proposta           = $contrato->getEdtProposta();
        $numeroLicitacao    = $contrato->getEdtNumero();
        $status             = $contrato->getEdtStatus();
        $modalidade         = $contrato->getEdtModalidade();

        if ($codEdital && $numeroLicitacao && $status && $proposta && $codCliente && $modalidade) {
            $WHERE = "  WHERE edt.edt_id = $codEdital AND edt_proposta = '". $proposta ."'  AND edt.edt_status = '" . $status . "' AND edt.edt_modalidade = '" . $modalidade . "' AND edt.edt_numero = '" . $numeroLicitacao . "'";
        } elseif ($codEdital && $numeroLicitacao && $proposta && $modalidade) {
            $WHERE = "  WHERE edt.edt_id = $codEdital AND edt.edt_proposta = '". $proposta . "' AND edt.edt_modalidade = '" . $modalidade . "'  AND edt.edt_numero = '" . $numeroLicitacao . "'";
        } elseif ($codEdital && $status && $proposta && $modalidade) {
            $WHERE = "  WHERE edt.edt_id = $codEdital AND edt.edt_proposta = '". $proposta . "' AND edt.edt_modalidade = '" . $modalidade ."'  AND edt.edt_status = '" . $status . "'";
        } elseif ($codEdital && $numeroLicitacao && $modalidade) {
            $WHERE = "  WHERE edt.edt_id = $codEdital  AND edt.edt_numero = '" .  $numeroLicitacao . "' AND edt.edt_modalidade = '" . $modalidade .   "'";
        } elseif ($codEdital && $proposta) {
            $WHERE = "  WHERE edt.edt_id = $codEdital AND edt.edt_proposta = '". $proposta ."' ";
        } elseif ($codEdital) {
            $WHERE = "  WHERE edt.edt_id = $codEdital ";
        } elseif ($numeroLicitacao && $status && $proposta) {
            $WHERE = "  WHERE edt.edt_proposta = '". $proposta ."'  AND edt.edt_status = '" . $status . "' AND edt.edt_numero = '" . $numeroLicitacao . "'";
        } elseif ($numeroLicitacao && $status) {
            $WHERE = "  WHERE edt.edt_status = '" . $status . "' AND edt.edt_numero = '" . $numeroLicitacao . "'";
        } elseif ($numeroLicitacao && $proposta) {
            $WHERE = "  WHERE edt.edt_proposta = '". $proposta ."'  AND edt.edt_numero = '" . $numeroLicitacao . "'";
        } elseif ($numeroLicitacao) {
            $WHERE = "  WHERE edt.edt_numero = '" . $numeroLicitacao . "'";
        } elseif ($numeroLicitacao) {
            $WHERE = "  WHERE  edt.edt_numero = '" . $numeroLicitacao . "'";
        } elseif ($status && $proposta) {
            $WHERE = "  WHERE edt.edt_proposta = '". $proposta ."'  AND edt.edt_status = '" . $status . "'";
        } elseif ($status) {
            $WHERE = "  WHERE edt.edt_status = '" . $status . "'";
        } elseif ($proposta && $codCliente) {
            $WHERE = "  WHERE edt.edt_proposta = '". $proposta ."'  AND edt.codCliente = $codCliente";
        } elseif ($proposta) {
            $WHERE = "  WHERE edt.edt_proposta = '". $proposta ."' ";
        } elseif ($codCliente) {
            $WHERE = "  WHERE edt.edt_cliente = $codCliente";
        } elseif ($modalidade) {
            $WHERE = "  WHERE edt.edt_modalidade = '" . $modalidade ."'";
        } else {
            $WHERE = "";
        }   
        $SQL = " SELECT * 
		FROM edital edt
		INNER JOIN cadRepresentante r ON r.codRepresentante = edt.edt_representante
        INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = edt.edt_cliente
        INNER JOIN instituicao i ON i.inst_id = edt.edt_instituicao
		INNER JOIN usuarios u ON u.id = edt.edt_usuario $WHERE ";                 
            
            $resultado = $this->select($SQL);
            $dados = $resultado->fetchAll();
            $lista = [];
            foreach ($dados as $dado) {                
                $contrato = new Edital();
                $contrato->setEdtId($dado['edt_id']);;
                $contrato->setEdtNumero($dado['edt_numero']);
                $contrato->setEdtDataAbertura($dado['edt_dataabertura']);
                $contrato->setEdtHora($dado['edt_hora']);
                $contrato->setEdtDataResultado($dado['edt_dataresultado']);
                $contrato->setEdtProposta($dado['edt_proposta']);
                $contrato->setEdtModalidade($dado['edt_modalidade']);
                $contrato->setEdtTipo($dado['edt_tipo']);
                $contrato->setEdtGarantia($dado['edt_garantia']);
                $contrato->setEdtValor(number_format($dado['edt_valor'], 2, ',', '.'));
                $contrato->setEdtStatus($dado['edt_status']);
                $contrato->setEdtAnalise($dado['edt_analise']);
                $contrato->setEdtObservacao($dado['edt_observacao']);
                $contrato->setEdtAnexo($dado['edt_anexo']);
                $contrato->setEdtDataAlteracao($dado['edt_dataabertura']);
                $contrato->setEdtDataCadastro($dado['edt_datacadastro']);
                $contrato->setEdtDataAlteracao($dado['edt_dataalteracao']);
                $contrato->setRepresentante(new Representante());
                $contrato->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
                $contrato->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
                $contrato->setClienteLicitacao(new ClienteLicitacao());
                $contrato->getClienteLicitacao()->setCodCliente($dado['licitacaoCliente_cod']);
                $contrato->getClienteLicitacao()->setNomeFantasia($dado['nomefantasia']);
                $contrato->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);
                $contrato->getClienteLicitacao()->setCnpj($dado['CNPJ']);
                $contrato->getClienteLicitacao()->setTrocaMarca($dado['trocamarca']);
                $contrato->setInstituicao(new Instituicao());
                $contrato->getInstituicao()->setInst_Id($dado['inst_id']);                    
                $contrato->getInstituicao()->setInst_Nome($dado['inst_nome']);                    
                $contrato->setUsuario(new Usuario());
                $contrato->getUsuario()->setId($dado['id']);
                $contrato->getUsuario()->setNome($dado['nome']);
                
                $lista[] = $contrato;
            }
            return $lista;        
                
    }
    
   /* public function listarPorEdital($edtNome = null)
    {
        if($edtNome)
        {
            $resultado = $this->select(
                "SELECT * 
                FROM cidade c
                INNER JOIN estado e ON e.estid = cidestado 
                INNER JOIN usuarios u ON u.id = cidusuario WHERE c. = $edtNome"
            );
        }
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Edital::class);
    }*/

    public  function salvar(Edital $contrato)
    {
      
        try {
            $edtNumero                     = $contrato->getEdtNumero();
            $edtDataAbertura               = $contrato->getEdtDataAbertura()->format('Y-m-d');
            $edtHora                       = $contrato->getEdtHora()->format('h:m:s');
            $edtDataResultado              = $contrato->getEdtDataResultado()->format('Y-m-d h:m:s');
            $edtProposta                   = $contrato->getEdtProposta();
            $edtModalidade                 = $contrato->getEdtModalidade();
            $edtTipo                       = $contrato->getEdtTipo();
            $edtGarantia                   = $contrato->getEdtGarantia();
            $valorAtual                    = $contrato->getEdtValor();
            $edtValor                      = str_replace(",", ".", $valorAtual);
            $edtStatus                     = $contrato->getEdtStatus();
            $edtAnalise                    = $contrato->getEdtAnalise();
            $edtObservacao                 = $contrato->getEdtObservacao();
            $edtAnexo                      = $contrato->getEdtAnexo();
            $edtRepresentante              = $contrato->getRepresentante()->getCodRepresentante();
            $edtCliente                    = $contrato->getClienteLicitacao()->getCodCliente();
            $edtUsuario                    = $contrato->getUsuario()->getId();           
            $edtInstituicao                = $contrato->getInstituicao()->getInst_Id();
            $edtDataCadastro               = $contrato->getEdtDataCadastro()->format('Y-m-d h:m:s');
            $edtDataAlteracao              = $contrato->getEdtDataAlteracao()->format('Y-m-d h:m:s');
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
    }
        
    /*public  function listaPorNome(Edital $contrato)
    {       
        $resultado = $this->select(
            "SELECT * FROM cidade WHERE cidnome 
             like '%".$contrato->getCidNome()."%' LIMIT 0,6 "
        );        
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);        
    }*/

    public  function atualizar(Edital $contrato)
    {
        try {
            
            $edtId                         = $contrato->getEdtId();
            $edtNumero                     = $contrato->getEdtNumero();
            $edtDataAbertura               = $contrato->getEdtDataAbertura()->format('Y-m-d');
            $edtHora                       = $contrato->getEdtHora()->format('h:m:s');
            $edtDataResultado              = $contrato->getEdtDataResultado()->format('Y-m-d h:m:s');
            $edtProposta                   = $contrato->getEdtProposta();
            $edtModalidade                 = $contrato->getEdtModalidade();
            $edtTipo                       = $contrato->getEdtTipo();
            $edtGarantia                   = $contrato->getEdtGarantia();
            $valorAtual                    = $contrato->getEdtValor();
            $edtValor                      = str_replace(",", ".", $valorAtual);
            $edtStatus                     = $contrato->getEdtStatus();
            $edtAnalise                    = $contrato->getEdtAnalise();
            $edtObservacao                 = $contrato->getEdtObservacao();
            $edtAnexo                      = $contrato->getEdtAnexo();
            $edtRepresentante              = $contrato->getRepresentante()->getCodRepresentante();
            $edtCliente                    = $contrato->getClienteLicitacao()->getCodCliente();
            $edtUsuario                    = $contrato->getUsuario()->getId();           
            $edtInstituicao                = $contrato->getInstituicao()->getInst_Id();
            $edtDataCadastro               = $contrato->getEdtDataCadastro()->format('Y-m-d h:m:s');
            $edtDataAlteracao              = $contrato->getEdtDataAlteracao()->format('Y-m-d h:m:s');
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
    /*
        edt_id, edt_numero, edt_dataabertura, edt_hora, edt_dataresultado,  edt_proposta, edt_modalidade, 
edt_tipo, edt_garantia, edt_valor, edt_status, edt_analise, edt_observacao, edt_anexo, 
edt_representante, edt_cliente, edt_usuario, edt_instituicao, edt_datacadastro, edt_dataalteracao
*/
    
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

    public function excluir(Edital $contrato)
    {
        try {
            $edtId = $contrato->getEdtId();

            return $this->delete('edital', "edt_id = $edtId");
        } catch (Exception $e) {

            throw new \Exception("Erro ao deletar", 500);
        }
    }

}
