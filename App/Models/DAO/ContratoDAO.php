<?php

namespace App\Models\DAO;

use App\Models\Entidades\Contrato;
use App\Models\Entidades\Edital;
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
$contrato->setCtrNumero($dado['ctr_numero']);
$contrato->setCtrDataInicio($dado['ctr_datainicio']);
$contrato->setCtrDataVencimento($dado['ctr_datavencimento']);            
$contrato->setCtrValor(number_format($dado['ctr_valor'], 2, ',', '.'));
$contrato->setCtrStatus($dado['ctr_status']);
$contrato->setCtrObservacao($dado['ctr_observacao']);
$contrato->setCtrAnexo($dado['ctr_anexo']);
$contrato->setCtrPrazoEntrega($dado['ctr_prazoentrega']);
$contrato->setCtrPrazoPagamento($dado['ctr_prazopagamento']);
$contrato->setCtrUsuario($dado['ctr_usuario']);
$contrato->setCtrInstituicao($dado['ctr_instituicao']);
$contrato->setCtrDataCadastro($dado['ctr_datacadastro']);
$contrato->setCtrDataAlteracao($dado['ctr_dataalteracao']);
$contrato->setEdital(new Edital());
$contrato->getEdital()->setEdtId($dado['edt_id']);;
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
    public  function listarDinamico(Contrato $contrato)
    {     
        
        $codCliente         = $contrato->getCtrCliente();      
        $codContrato        = $contrato->getCtrId();
        /*$proposta           = $contrato->getEdital()->getEdtProposta();
        $numeroLicitacao    = $contrato->getEdital()->getEdtNumero();
        $status             = $contrato->getCtrStatus();
        $modalidade         = $contrato->getEdital()->getEdtModalidade();

        if ($codContrato && $numeroLicitacao && $status && $proposta && $codCliente && $modalidade) {
            $WHERE = "  WHERE edt.edt_id = $codContrato AND edt_proposta = '". $proposta ."'  AND edt.edt_status = '" . $status . "' AND edt.edt_modalidade = '" . $modalidade . "' AND edt.edt_numero = '" . $numeroLicitacao . "'";
        } elseif ($codContrato && $numeroLicitacao && $proposta && $modalidade) {
            $WHERE = "  WHERE edt.edt_id = $codContrato AND edt.edt_proposta = '". $proposta . "' AND edt.edt_modalidade = '" . $modalidade . "'  AND edt.edt_numero = '" . $numeroLicitacao . "'";
        } elseif ($codContrato && $status && $proposta && $modalidade) {
            $WHERE = "  WHERE edt.edt_id = $codContrato AND edt.edt_proposta = '". $proposta . "' AND edt.edt_modalidade = '" . $modalidade ."'  AND edt.edt_status = '" . $status . "'";
        } elseif ($codContrato && $numeroLicitacao && $modalidade) {
            $WHERE = "  WHERE edt.edt_id = $codContrato  AND edt.edt_numero = '" .  $numeroLicitacao . "' AND edt.edt_modalidade = '" . $modalidade .   "'";
        } elseif ($codContrato && $proposta) {
            $WHERE = "  WHERE edt.edt_id = $codContrato AND edt.edt_proposta = '". $proposta ."' ";
        } elseif ($codContrato) {
            $WHERE = "  WHERE edt.edt_id = $codContrato ";
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
        }   */
        $WHERE = "";
        $SQL = " SELECT * 
		FROM contrato ctr
		INNER JOIN edital edt ON edt.edt_id = ctr.ctr_edital
		INNER JOIN cadRepresentante r ON r.codRepresentante = edt.edt_representante
        INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = edt.edt_cliente
        INNER JOIN instituicao i ON i.inst_id = edt.edt_instituicao
		INNER JOIN usuarios u ON u.id = edt.edt_usuario $WHERE ";                 
            
            $resultado = $this->select($SQL);
            $dados = $resultado->fetchAll();
            $lista = [];
            foreach ($dados as $dado) {                
                $contrato = new Contrato();
                $contrato->setCtrId($dado['ctr_id']);
                $contrato->setCtrNumero($dado['ctr_numero']);
                $contrato->setCtrDataInicio($dado['ctr_datainicio']);
                $contrato->setCtrDataVencimento($dado['ctr_datavencimento']);            
                $contrato->setCtrValor(number_format($dado['ctr_valor'], 2, ',', '.'));
                $contrato->setCtrStatus($dado['ctr_status']);
                $contrato->setCtrObservacao($dado['ctr_observacao']);
                $contrato->setCtrAnexo($dado['ctr_anexo']);
                $contrato->setCtrPrazoEntrega($dado['ctr_prazoentrega']);
                $contrato->setCtrPrazoPagamento($dado['ctr_prazopagamento']);
                $contrato->setCtrUsuario($dado['ctr_usuario']);
                $contrato->setCtrInstituicao($dado['ctr_instituicao']);
                $contrato->setCtrDataCadastro($dado['ctr_datacadastro']);
                $contrato->setCtrDataAlteracao($dado['ctr_dataalteracao']);
                $contrato->setEdital(new Edital());
                $contrato->getEdital()->setEdtId($dado['edt_id']);;
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
                $contrato->getEdital()->setRepresentante(new Representante());               
                $contrato->getEdital()->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
                $contrato->getEdital()->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
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
    
   /* public function listarPorContrato($edtNome = null)
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
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Contrato::class);
    }*/

    public  function salvar(Contrato $contrato)
    {
      
        try {
            $ctrNumero                     = $contrato->getCtrNumero();
            $ctrDataInicio                 = $contrato->getCtrDataInicio()->format('Y-m-d');
            $ctrDataVencimento             = $contrato->getCtrDataVencimento()->format('Y-m-d');
            $valorAtual                    = $contrato->getCtrValor();
            $ctrValor                      = str_replace(",", ".", $valorAtual);
            $ctrStatus                     = $contrato->getCtrStatus();
            $ctrObservacao                 = $contrato->getCtrObservacao();
            $ctrAnexo                      = $contrato->getCtrAnexo();
            $ctrClienteLicitacao           = $contrato->getClienteLicitacao()->getCodCliente();
            $ctrUsuario                    = $contrato->getUsuario()->getId();           
            $ctrRepresentante              = $contrato->getRepresentante()->getCodRepresentante();           
            $ctrEdital                     = $contrato->getEdital()->getEdtId();           
            $ctrPrazoEntrega               = $contrato->getCtrPrazoEntrega();
            $ctrPrazoPagamento             = $contrato->getCtrPrazoPagamento();
            $ctrInstituicao                = $contrato->getInstituicao()->getInst_Id();
            $ctrDataCadastro               = $contrato->getCtrDataCadastro()->format('Y-m-d h:m:s');
            $ctrDataAlteracao              = $contrato->getCtrDataAlteracao()->format('Y-m-d h:m:s');
            
            $nomeanexo = date('Y-m-d-h:m:s');
            if (!$_FILES['anexo']['name'] == "") {
                $validextensions = array("jpeg", "jpg", "png", "PNG", "JPG", "JPEG", "pdf", "PDF", "docx");
                $temporary = explode(".", $_FILES["anexo"]["name"]);
                $file_extension = end($temporary);
                $ctrAnexo = md5($nomeanexo) . "." . $file_extension;
                //var_dump($file_extension);
                if (in_array($file_extension, $validextensions)) {
                    $sourcePath = $_FILES['anexo']['tmp_name'];
                    $targetPath = "public/assets/media/anexos/" . md5($nomeanexo) . "." . $file_extension;
                    move_uploaded_file($sourcePath, $targetPath); // Move arquivo                    
                }
            } else {
                $ctrAnexo = "sem_anexo1.png";
            }
            /*
            ctr_id, ctr_numero, ctr_datainicio,  ctr_datavencimento, ctr_valor, ctr_status, ctr_observacao, ctr_anexo, ctr_clientelicitacao, ctr_usuario, 
            ctr_prazoentrega, ctr_prazopagamento, ctr_instituicao, ctr_edital, ctr_datacadastro, ctr_dataalteracao
            */          
            return $this->insert(
                'contrato',
                ":ctr_numero, :ctr_datainicio, :ctr_datavencimento, :ctr_valor, :ctr_status, :ctr_observacao, :ctr_anexo, :ctr_clientelicitacao, :ctr_usuario, 
                :ctr_prazoentrega, :ctr_prazopagamento, :ctr_instituicao, :ctr_datacadastro, :ctr_dataalteracao, :ctr_representante, :ctr_edital",
                [
                    ':ctr_numero' => $ctrNumero,
                    ':ctr_datainicio' => $ctrDataInicio,
                    ':ctr_datavencimento' => $ctrDataVencimento,
                    ':ctr_valor' => $ctrValor,
                    ':ctr_status' => $ctrStatus,
                    ':ctr_observacao' => $ctrObservacao,
                    ':ctr_anexo' => $ctrAnexo,
                    ':ctr_clientelicitacao' => $ctrClienteLicitacao,
                    ':ctr_usuario' => $ctrUsuario,
                    ':ctr_prazoentrega' => $ctrPrazoEntrega,
                    ':ctr_prazopagamento' => $ctrPrazoPagamento,
                    ':ctr_instituicao' => $ctrInstituicao,
                    ':ctr_datacadastro' => $ctrDataCadastro,
                    ':ctr_dataalteracao' => $ctrDataAlteracao,
                    ':ctr_representante' => $ctrRepresentante,
                    ':ctr_datacadastro' => $ctrDataCadastro,
                    ':ctr_edital' => $ctrEdital,
                    ':ctr_dataalteracao' =>$ctrDataAlteracao
                    ]
                ); 
            } catch (\Exception $e) {        
                throw new \Exception("Erro na gravação de dados. " . $e, 500);
            }
    }
        
    /*public  function listaPorNome(Contrato $contrato)
    {       
        $resultado = $this->select(
            "SELECT * FROM cidade WHERE cidnome 
             like '%".$contrato->getCidNome()."%' LIMIT 0,6 "
        );        
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);        
    }*/

    public  function atualizar(Contrato $contrato)
    {
       /* try {
            
            $edtId                         = $contrato->getCtrId();
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
    
           /* );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }*/
    }

    public function excluir(Contrato $contrato)
    {
        try {
            $edtId = $contrato->getEdtId();

            return $this->delete('edital', "edt_id = $edtId");
        } catch (Exception $e) {

            throw new \Exception("Erro ao deletar", 500);
        }
    }

}
