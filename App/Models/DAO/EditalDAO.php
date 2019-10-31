<?php

namespace App\Models\DAO;

use App\Models\Entidades\Edital;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Representante;
use App\Models\Entidades\ClienteLicitacao;
/*
edt_id, edt_numero, edt_dataabertura, edt_hora, edt_dataresultado,  edt_proposta, edt_modalidade, 
edt_tipo, edt_garantia, edt_valor, edt_tatus, edt_analise, edt_observacao, edt_anexo, 
edt_representante, edt_cliente, edt_usuario, edt_instituicao, edt_datacadastro, edt_dataalteracao
*/
class EditalDAO extends BaseDAO
{
    public  function listar($edtId = null)
    {        
        $SQL = " SELECT * 
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
                $edital = new Edital();
                $edital->setEdtId($dado['edt_id']);;
                $edital->setEdtNumero($dado['edt_numero']);
                $edital->setEdtDataAbertura($dado['edt_dataabertura']);
                $edital->setEdtHora($dado['edt_hora']);
                $edital->setEdtDataResultado($dado['edt_dataresultado']);
                $edital->setEdtProposta($dado['edt_proposta']);
                $edital->setEdtModalidade($dado['edt_modalidade']);
                $edital->setEdtTipo($dado['edt_tipo']);
                $edital->setEdtGarantia($dado['edt_garantia']);
                $edital->setEdtValor(number_format($dado['edt_valor'], 2, ',', '.'));
                $edital->setEdtStatus($dado['edt_status']);
                $edital->setEdtAnalise($dado['edt_analise']);
                $edital->setEdtObservacao($dado['edt_observacao']);
                $edital->setEdtAnexo($dado['edt_anexo']);
                $edital->setEdtDataAlteracao($dado['edt_dataabertura']);
                $edital->setEdtDataCadastro($dado['edt_datacadastro']);
                $edital->setEdtDataAlteracao($dado['edt_dataalteracao']);
                $edital->setRepresentante(new Representante());
                $edital->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
                $edital->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
                $edital->setClienteLicitacao(new ClienteLicitacao());
                $edital->getClienteLicitacao()->setCodCliente($dado['licitacaoCliente_cod']);
                $edital->getClienteLicitacao()->setNomeFantasia($dado['nomefantasia']);
                $edital->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);
                $edital->getClienteLicitacao()->setCnpj($dado['CNPJ']);
                $edital->getClienteLicitacao()->setTrocaMarca($dado['trocamarca']);
                $edital->setInstituicao(new Instituicao());
                $edital->getInstituicao()->setInst_Id($dado['inst_id']);                    
                $edital->getInstituicao()->setInst_Nome($dado['inst_nome']);                    
                $edital->setUsuario(new Usuario());
                $edital->getUsuario()->setId($dado['id']);
                $edital->getUsuario()->setNome($dado['nome']);
                
                $lista[] = $edital;
            }
            return $lista;        
                
    }
    public  function listarDinamico(Edital $edital)
    {     
        
        $codCliente         = $edital->getEdtCliente();      
        $codEdital          = $edital->getEdtId();
        $proposta           = $edital->getEdtProposta();
        $numeroLicitacao    = $edital->getEdtNumero();
        $status             = $edital->getEdtStatus();
        $modalidade         = $edital->getEdtModalidade();

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
                $edital = new Edital();
                $edital->setEdtId($dado['edt_id']);;
                $edital->setEdtNumero($dado['edt_numero']);
                $edital->setEdtDataAbertura($dado['edt_dataabertura']);
                $edital->setEdtHora($dado['edt_hora']);
                $edital->setEdtDataResultado($dado['edt_dataresultado']);
                $edital->setEdtProposta($dado['edt_proposta']);
                $edital->setEdtModalidade($dado['edt_modalidade']);
                $edital->setEdtTipo($dado['edt_tipo']);
                $edital->setEdtGarantia($dado['edt_garantia']);
                $edital->setEdtValor(number_format($dado['edt_valor'], 2, ',', '.'));
                $edital->setEdtStatus($dado['edt_status']);
                $edital->setEdtAnalise($dado['edt_analise']);
                $edital->setEdtObservacao($dado['edt_observacao']);
                $edital->setEdtAnexo($dado['edt_anexo']);
                $edital->setEdtDataAlteracao($dado['edt_dataabertura']);
                $edital->setEdtDataCadastro($dado['edt_datacadastro']);
                $edital->setEdtDataAlteracao($dado['edt_dataalteracao']);
                $edital->setRepresentante(new Representante());
                $edital->getRepresentante()->setCodRepresentante($dado['codRepresentante']);
                $edital->getRepresentante()->setNomeRepresentante($dado['nomeRepresentante']);
                $edital->setClienteLicitacao(new ClienteLicitacao());
                $edital->getClienteLicitacao()->setCodCliente($dado['licitacaoCliente_cod']);
                $edital->getClienteLicitacao()->setNomeFantasia($dado['nomefantasia']);
                $edital->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);
                $edital->getClienteLicitacao()->setCnpj($dado['CNPJ']);
                $edital->getClienteLicitacao()->setTrocaMarca($dado['trocamarca']);
                $edital->setInstituicao(new Instituicao());
                $edital->getInstituicao()->setInst_Id($dado['inst_id']);                    
                $edital->getInstituicao()->setInst_Nome($dado['inst_nome']);                    
                $edital->setUsuario(new Usuario());
                $edital->getUsuario()->setId($dado['id']);
                $edital->getUsuario()->setNome($dado['nome']);
                
                $lista[] = $edital;
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

    public  function salvar(Edital $edital)
    {
      
        try {
            $edtNumero                     = $edital->getEdtNumero();
            $edtDataAbertura               = $edital->getEdtDataAbertura()->format('Y-m-d');
            $edtHora                       = $edital->getEdtHora()->format('h:m:s');
            $edtDataResultado              = $edital->getEdtDataResultado()->format('Y-m-d h:m:s');
            $edtProposta                   = $edital->getEdtProposta();
            $edtModalidade                 = $edital->getEdtModalidade();
            $edtTipo                       = $edital->getEdtTipo();
            $edtGarantia                   = $edital->getEdtGarantia();
            $valorAtual                    = $edital->getEdtValor();
            $edtValor                      = str_replace(",", ".", $valorAtual);
            $edtStatus                     = $edital->getEdtStatus();
            $edtAnalise                    = $edital->getEdtAnalise();
            $edtObservacao                 = $edital->getEdtObservacao();
            $edtAnexo                      = $edital->getEdtAnexo();
            $edtRepresentante              = $edital->getRepresentante()->getCodRepresentante();
            $edtCliente                    = $edital->getClienteLicitacao()->getCodCliente();
            $edtUsuario                    = $edital->getUsuario()->getId();           
            $edtInstituicao                = $edital->getInstituicao()->getInst_Id();
            $edtDataCadastro               = $edital->getEdtDataCadastro()->format('Y-m-d h:m:s');
            $edtDataAlteracao              = $edital->getEdtDataAlteracao()->format('Y-m-d h:m:s');
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
    public function editalPorClienteRazaoSocial(ClienteLicitacao $clienteLicitacao)
    {
        $resultado = $this->select(
            " SELECT * 
            FROM edital edt
            INNER JOIN cadRepresentante r ON r.codRepresentante = edt.edt_representante
            INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = edt.edt_cliente
            INNER JOIN instituicao i ON i.inst_id = edt.edt_instituicao
            INNER JOIN usuarios u ON u.id = edt.edt_usuario 
            WHERE c.razaosocial
                        LIKE '%".$clienteLicitacao->getRazaoSocial()."%' ORDER BY edt.edt_numero LIMIT 0,6"
        );
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }
    /*public  function listaPorNome(Edital $edital)
    {       
        $resultado = $this->select(
            "SELECT * FROM cidade WHERE cidnome 
             like '%".$edital->getCidNome()."%' LIMIT 0,6 "
        );        
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);        
    }*/

    public  function atualizar(Edital $edital)
    {
        try {
            
            $edtId                         = $edital->getEdtId();
            $edtNumero                     = $edital->getEdtNumero();
            $edtDataAbertura               = $edital->getEdtDataAbertura()->format('Y-m-d');
            $edtHora                       = $edital->getEdtHora()->format('h:m:s');
            $edtDataResultado              = $edital->getEdtDataResultado()->format('Y-m-d h:m:s');
            $edtProposta                   = $edital->getEdtProposta();
            $edtModalidade                 = $edital->getEdtModalidade();
            $edtTipo                       = $edital->getEdtTipo();
            $edtGarantia                   = $edital->getEdtGarantia();
            $valorAtual                    = $edital->getEdtValor();
            $edtValor                      = str_replace(",", ".", $valorAtual);
            $edtStatus                     = $edital->getEdtStatus();
            $edtAnalise                    = $edital->getEdtAnalise();
            $edtObservacao                 = $edital->getEdtObservacao();
            $edtAnexo                      = $edital->getEdtAnexo();
            $edtRepresentante              = $edital->getRepresentante()->getCodRepresentante();
            $edtCliente                    = $edital->getClienteLicitacao()->getCodCliente();
            $edtUsuario                    = $edital->getUsuario()->getId();           
            $edtInstituicao                = $edital->getInstituicao()->getInst_Id();
            $edtDataCadastro               = $edital->getEdtDataCadastro()->format('Y-m-d h:m:s');
            $edtDataAlteracao              = $edital->getEdtDataAlteracao()->format('Y-m-d h:m:s');
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

    public function excluir(Edital $edital)
    {
        try {
            $edtId = $edital->getEdtId();

            return $this->delete('edital', "edt_id = $edtId");
        } catch (Exception $e) {

            throw new \Exception("Erro ao deletar", 500);
        }
    }

}
