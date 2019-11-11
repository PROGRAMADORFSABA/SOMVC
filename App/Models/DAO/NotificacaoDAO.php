<?php

namespace App\Models\DAO;

use App\Models\Entidades\Notificacao;
use App\Models\Entidades\Edital;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Representante;
use App\Models\Entidades\ClienteLicitacao;

class NotificacaoDAO extends BaseDAO
{
    public  function listar(Notificacao $notificacao)
    {             
        $codCliente         = $notificacao->getNtf_codclientelicitacao();     
        $codNotificacao     = $notificacao->getNtf_Cod();
        $proposta           = $notificacao->getNtf_Cod();
        $numeroLicitacao    = $notificacao->getNtf_Numero();
        $status             = $notificacao->getNtf_Status();
        $modalidade         = $notificacao->getNtf_Codusuario();
        $representante      = $notificacao->getNtf_Codrepresentante();

        $SQL = " SELECT * FROM notificacao ntf
        INNER JOIN clientelicitacao c ON c.licitacaoCliente_cod = ntf.ntf_clientelicitacao
        INNER JOIN usuarios u ON u.id = ntf.ntf_usuario  ";                 
             $where = Array();
             if( $codCliente ){ $where[] = " ntf.ntf_clientelicitacao = {$codCliente}"; }
             if( $codNotificacao ){ $where[] = " ntf.ntf_id = {$codNotificacao}"; }
             if( $proposta ){ $where[] = " ntf.ntf_numero = '{$proposta}'"; }
             if( $status ){ $where[] = " ntf.ntf_status = '{$status}'"; }
             if( $representante ){ $where[] = " ntf.ntf_usuario = {$representante}"; }
             if( $modalidade ){ $where[] = " ntf.ntf_numero = '{$modalidade}'"; }
             if( $numeroLicitacao ){ $where[] = " ntf.ntf_numero = '{$numeroLicitacao}'"; }   
          
          if( sizeof( $where ) )
          $SQL .= ' WHERE '.implode( ' AND ',$where );
          $resultado = $this->select($SQL);
         
          $dados = $resultado->fetchAll();
          $lista = [];
          foreach ($dados as $dado) { 
            
            $notificacao = new Notificacao();
        $notificacao->setNtf_cod($dado['ntf_cod']);
        $notificacao->setNtf_numero($dado['ntf_numero']);
        $notificacao->setClienteLicitacao(new ClienteLicitacao());
        $notificacao->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);
        $notificacao->getClienteLicitacao()->setNomeFantasia($dado['nomefantasia']);      
            
            $lista[] = $notificacao;
        }
        return $lista;
      //    return $resultado->fetchAll(\PDO::FETCH_CLASS, Notificacao::class);   
                
    }
    public  function listarRepresentanteContrato($notificacaoId = null)
    {        
        $SQL = " SELECT distinct(r.codRepresentante), r.codRepresentante, r.nomeRepresentante
		FROM contrato ctr
		INNER JOIN edital edt ON edt.edt_id = ctr.ctr_edital
		INNER JOIN cadRepresentante r ON r.codRepresentante = ctr.ctr_representante
        INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = ctr.ctr_clientelicitacao
        INNER JOIN instituicao i ON i.inst_id = ctr.ctr_instituicao
		INNER JOIN usuarios u ON u.id = ctr.ctr_usuario";
            if($notificacaoId) 
            {    
                $SQL.= " WHERE ctr.ctr_id = $notificacaoId";
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
        $contrato->setnotificacaoId($dado['ctr_id']);
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
    public  function listarClienteContrato($notificacaoId = null)
    {        
        $SQL = " SELECT distinct(c.razaosocial), c.licitacaoCliente_cod, c.nomefantasia
		FROM contrato ctr
		INNER JOIN edital edt ON edt.edt_id = ctr.ctr_edital
		INNER JOIN cadRepresentante r ON r.codRepresentante = ctr.ctr_representante
        INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = ctr.ctr_clientelicitacao
        INNER JOIN instituicao i ON i.inst_id = ctr.ctr_instituicao
		INNER JOIN usuarios u ON u.id = ctr.ctr_usuario";
            if($notificacaoId) 
            {    
                $SQL.= " WHERE ctr.ctr_id = $notificacaoId";
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
        $contrato->setnotificacaoId($dado['ctr_id']);
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
    public  function listarPorEdital($notificacaoId = null)
    {        
        $SQL = " SELECT * FROM contrato ";
            if($notificacaoId) 
            {    
                $SQL.= " WHERE ctr_edital = $notificacaoId";
            }         
            
            $resultado = $this->select($SQL);
            $dados = $resultado->fetchAll();
            $lista = [];
            foreach ($dados as $dado) {  
               
        $contrato = new Contrato();
        $contrato->setnotificacaoId($dado['ctr_id']);
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

                $lista[] = $contrato;
            }
            return $lista;        
                
    }
    public  function listarDinamico(Notificacao $notificacao)
    {   
        $codCliente         = $notificacao->getNtf_codclientelicitacao();     
        $codNotificacao     = $notificacao->getNtf_Cod();        
        $proposta           = $notificacao->getNtf_pedido();
        $numeroLicitacao    = $notificacao->getNtf_Numero();
        $status             = $notificacao->getNtf_Status();
        $modalidade         = $notificacao->getNtf_Codusuario();
        $representante      = $notificacao->getNtf_codrepresentante();

        $SQL = " SELECT * FROM notificacao ntf
        INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = ntf.ntf_clientelicitacao
        INNER JOIN usuarios u ON u.id = ntf.ntf_usuario
        INNER JOIN edital e on e.edt_id = ntf.ntf_edital
        INNER JOIN instituicao i on i.inst_id = ntf.ntf_instituicao
        INNER JOIN cadRepresentante r ON r.codRepresentante = ntf.ntf_representante ";                 
             $where = Array();
             if( $codCliente ){ $where[] = " ntf.ntf_clientelicitacao = {$codCliente}"; }
             if( $codNotificacao ){ $where[] = " ntf.ntf_cod = {$codNotificacao}"; }
             if( $proposta ){ $where[] = " ntf.ntf_numero = '{$proposta}'"; }
             if( $status ){ $where[] = " ntf.ntf_status = '{$status}'"; }
             if( $representante ){ $where[] = " ntf.ntf_usuario = {$representante}"; }
             if( $modalidade ){ $where[] = " ntf.ntf_numero = '{$modalidade}'"; }
             if( $numeroLicitacao ){ $where[] = " ntf.ntf_numero = '{$numeroLicitacao}'"; }   
          
          if( sizeof( $where ) )
          $SQL .= ' WHERE '.implode( ' AND ',$where );
          $resultado = $this->select($SQL);
          $dados = $resultado->fetchAll();
          $lista = [];
          foreach ($dados as $dado) { 
            
        $notificacao = new Notificacao();
        $notificacao->setNtf_cod($dado['ntf_cod']);
        $notificacao->setNtf_numero($dado['ntf_numero']);        
        $notificacao->setNtf_pedido($dado['ntf_pedido']);        
        $notificacao->setNtf_status($dado['ntf_status']);
        $notificacao->setNtf_garantia($dado['ntf_garantia']);
        $notificacao->setNtf_trocamarca($dado['ntf_trocamarca']);
        $notificacao->setNtf_prazodefesa($dado['ntf_prazodefesa']);
        $notificacao->setNtf_observacao($dado['ntf_observacao']);
        $notificacao->setNtf_valor(number_format($dado['ntf_valor'], 2, ',', '.'));
        $notificacao->setClienteLicitacao(new ClienteLicitacao());
        $notificacao->getClienteLicitacao()->setCodCliente($dado['licitacaoCliente_cod']);
        $notificacao->getClienteLicitacao()->setRazaoSocial($dado['razaosocial']);
        $notificacao->getClienteLicitacao()->setNomeFantasia($dado['nomefantasia']);      
        $notificacao->getClienteLicitacao()->setTipoCliente($dado['tipo']);      
        $notificacao->setEdital(new Edital());
        $notificacao->getEdital()->setEdtId($dado['edt_id']);
        $notificacao->getEdital()->setEdtNumero($dado['edt_numero']);
        $notificacao->setNtf_representante(new Representante());
        $notificacao->getNtf_representante()->setCodRepresentante($dado['codRepresentante']);
        $notificacao->getNtf_representante()->setNomeRepresentante($dado['nomeRepresentante']);
        $notificacao->setNtf_usuario(new Usuario());
        $notificacao->getNtf_usuario()->setId($dado['id']);
        $notificacao->getNtf_usuario()->setNome($dado['nome']);
        $notificacao->getNtf_usuario()->setEmail($dado['email']);
        $notificacao->setNtf_instituicao(new Instituicao());
        $notificacao->getNtf_instituicao()->setInst_Id($dado['inst_id']);
        
        $lista[] = $notificacao;
    }
        return $lista;
    }
    /*
    public function autoCompleteContratoClienteRazaoSocial(ClienteLicitacao $clienteLicitacao)
    {
        $resultado = $this->select(
            " SELECT * 
            FROM contrato ctr
            INNER JOIN edital edt ON edt.edt_id = ctr.ctr_edital
            INNER JOIN cadRepresentante r ON r.codRepresentante = ctr.ctr_representante
            INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = ctr.ctr_clientelicitacao
            INNER JOIN instituicao i ON i.inst_id = ctr.ctr_instituicao
            INNER JOIN usuarios u ON u.id = ctr.ctr_usuario 
            WHERE c.razaosocial
            LIKE '%".$clienteLicitacao->getRazaoSocial()."%' ORDER BY edt.edt_numero LIMIT 0,6"
        );
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function autoCompleteNumeroContratoCodCliente(Edital $edital, ClienteLicitacao $clienteLicitacao)
    {
        $resultado = $this->select(
            " SELECT * 
            FROM contrato ctr
            INNER JOIN edital edt ON edt.edt_id = ctr.ctr_edital
            INNER JOIN cadRepresentante r ON r.codRepresentante = ctr.ctr_representante
            INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = ctr.ctr_clientelicitacao
            INNER JOIN instituicao i ON i.inst_id = ctr.ctr_instituicao
            INNER JOIN usuarios u ON u.id = ctr.ctr_usuario
            WHERE edt.edt_numero
            LIKE '%".$edital->getEdtNumero()."%' AND c.licitacaoCliente_cod = ".$clienteLicitacao->getCodCliente()." ORDER BY edt.edt_numero LIMIT 0,6"
        );
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function autoCompleteEditalClienteRazaoSocial(ClienteLicitacao $clienteLicitacao)
    {
        $resultado = $this->select(
            " SELECT edt.edt_id, c.licitacaoCliente_cod, edt.edt_numero,c.razaosocial,c.nomefantasia
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
    
    public function autoCompleteNumeroEditalCodCliente(Edital $edital, ClienteLicitacao $clienteLicitacao)
    {
        $resultado = $this->select(
            " SELECT edt.edt_id, c.licitacaoCliente_cod, edt.edt_numero,c.razaosocial,c.nomefantasia
            FROM edital edt
            INNER JOIN cadRepresentante r ON r.codRepresentante = edt.edt_representante
            INNER JOIN clienteLicitacao c ON c.licitacaoCliente_cod = edt.edt_cliente
            INNER JOIN instituicao i ON i.inst_id = edt.edt_instituicao
            INNER JOIN usuarios u ON u.id = edt.edt_usuario 
            WHERE edt.edt_numero
            LIKE '%".$edital->getEdtNumero()."%' AND c.licitacaoCliente_cod = ".$clienteLicitacao->getCodCliente()." ORDER BY edt.edt_numero LIMIT 0,6"
        );
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }
    
   */

    public  function salvar(Notificacao $notificacao)
    {     
        try {
            $ntfNumero                     = $notificacao->getNtf_numero();
            $ntfEdital                     = $notificacao->getEdital()->getEdtId();
            $ntfPedido                     = $notificacao->getNtf_pedido();
            $ntfStatus                     = $notificacao->getNtf_status();
            $ntfGarantia                   = $notificacao->getNtf_garantia();
            $ntfTrocaMarca                 = $notificacao->getNtf_trocamarca();
            $ntfValor                      = $notificacao->getNtf_valor();
            $ntfAnexo                      = $notificacao->getNtf_anexo();
            $ntfPrazoDefesa                = $notificacao->getNtf_prazodefesa();
            $ntfClienteLicitacao           = $notificacao->getClienteLicitacao()->getCodCliente();
            $ntfUsuario                    = $notificacao->getNtf_usuario()->getId();          
            $ntfRepresentante              = $notificacao->getNtf_representante()->getCodRepresentante();           
            $ntfDataAlteracao              = $notificacao->getNtf_dataalteracao()->format('Y-m-d h:m:s');
            $ntfDataCadastro               = $notificacao->getNtf_datacadastro()->format('Y-m-d h:m:s');
            $ntfDataRecebimento            = $notificacao->getNtf_datarecebimento()->format('Y-m-d h:m:s');
            $ntfObservacao                 = $notificacao->getNtf_observacao();
            $ntfInstituicao                = $notificacao->getNtf_instituicao()->getInst_Id();
           
            /*
                ntf_numero, ntf_licitacao,     ntf_pedido,     ntf_status,     ntf_garantia,     ntf_trocamarca,
                ntf_valor,     ntf_anexo,     ntf_prazodefesa,     ntf_clientelicitacao,     ntf_usuario,
                ntf_representante,    ntf_dataalteracao,    ntf_datacadastro  
            */      
            $nomeanexo = date('Y-m-d-h:m:s');
            if (!$_FILES['anexo']['name'] == "") {
                $validextensions = array("jpeg", "jpg", "png", "PNG", "JPG", "JPEG", "pdf", "PDF", "docx");
                $temporary = explode(".", $_FILES["anexo"]["name"]);
                $file_extension = end($temporary);
                $ntfAnexo = md5($nomeanexo) . "." . $file_extension;

                if (in_array($file_extension, $validextensions)) {
                    $sourcePath = $_FILES['anexo']['tmp_name'];
                    $targetPath = "public/assets/media/anexos/" . md5($nomeanexo) . "." . $file_extension;
                    move_uploaded_file($sourcePath, $targetPath); // Move arquivo                    
                }
            } else {
                if($ntfAnexo == ""){
                    $ntfAnexo = "sem_anexo1.png";
                    }
            } 
            
            return $this->insert(
                'notificacao',
                ":ntf_numero, :ntf_edital, :ntf_pedido, :ntf_status, :ntf_garantia, :ntf_trocamarca, :ntf_valor, :ntf_anexo, :ntf_prazodefesa, 
                :ntf_clientelicitacao, :ntf_usuario, :ntf_representante, :ntf_dataalteracao, :ntf_datacadastro, :ntf_datarecebimento, :ntf_instituicao, :ntf_observacao",
                [
                    ':ntf_numero' => $ntfNumero,
                    ':ntf_edital' => $ntfEdital,
                    ':ntf_pedido' => $ntfPedido,
                    ':ntf_status' => $ntfStatus,
                    ':ntf_garantia' => $ntfGarantia,
                    ':ntf_trocamarca' => $ntfTrocaMarca,
                    ':ntf_valor' => $ntfValor,
                    ':ntf_anexo' => $ntfAnexo,
                    ':ntf_prazodefesa' => $ntfPrazoDefesa,
                    ':ntf_clientelicitacao' => $ntfClienteLicitacao,
                    ':ntf_usuario' => $ntfUsuario,
                    ':ntf_representante' => $ntfRepresentante,
                    ':ntf_dataalteracao' => $ntfDataAlteracao,
                    ':ntf_datacadastro' => $ntfDataCadastro,
                    ':ntf_datarecebimento' => $ntfDataRecebimento,
                    ':ntf_instituicao' => $ntfInstituicao,
                    ':ntf_observacao' => $ntfObservacao
                    ]
                ); 
            } catch (\Exception $e) {        
                throw new \Exception("Erro na gravação de dados. " . $e, 500);
            }
    }
        
    

    public  function atualizar(Notificacao $notificacao)
    {
        try {                  
            $notificacaoId                 = $notificacao->getNtf_cod();
            $ntfNumero                     = $notificacao->getNtf_numero();
            $ntfEdital                     = $notificacao->getEdital()->getEdtId();
            $ntfPedido                     = $notificacao->getNtf_pedido();
            $ntfStatus                     = $notificacao->getNtf_status();
            $ntfGarantia                   = $notificacao->getNtf_garantia();
            $ntfTrocaMarca                 = $notificacao->getNtf_trocamarca();
            $ntfValor                      = $notificacao->getNtf_valor();
            $ntfAnexo                      = $notificacao->getNtf_anexo();
            $ntfPrazoDefesa                = $notificacao->getNtf_prazodefesa();
            $ntfClienteLicitacao           = $notificacao->getClienteLicitacao()->getCodCliente();
            $ntfUsuario                    = $notificacao->getNtf_usuario()->getId();          
            $ntfRepresentante              = $notificacao->getNtf_representante()->getCodRepresentante();           
            $ntfDataAlteracao              = $notificacao->getNtf_dataalteracao()->format('Y-m-d h:m:s');
            $ntfDataRecebimento            = $notificacao->getNtf_datarecebimento()->format('Y-m-d h:m:s');
            $ntfObservacao                 = $notificacao->getNtf_observacao();
            $ntfInstituicao                = $notificacao->getNtf_instituicao()->getInst_Id();                 
            $nomeanexo = date('Y-m-d-h:m:s');
         
            if (!$_FILES['anexo']['name'] == "") {
                $validextensions = array("jpeg", "jpg", "png", "PNG", "JPG", "JPEG", "pdf", "PDF", "docx");
                $temporary = explode(".", $_FILES["anexo"]["name"]);
                $file_extension = end($temporary);
                $ntfAnexo = md5($nomeanexo) . "." . $file_extension;

                if (in_array($file_extension, $validextensions)) {
                    $sourcePath = $_FILES['anexo']['tmp_name'];
                    $targetPath = "public/assets/media/anexos/" . md5($nomeanexo) . "." . $file_extension;
                    move_uploaded_file($sourcePath, $targetPath); // Move arquivo                    
                }
            } else {
                if($ntfAnexo == ""){
                    $ntfAnexo = "sem_anexo1.png";
                    }
            } 
                   
            return $this->update(
                'notificacao',               
            "   ntf_numero = :ntfNumero, 
                ntf_edital = :ntfEdital, 
                ntf_pedido = :ntfPedido, 
                ntf_status = :ntfStatus, 
                ntf_garantia = :ntfGarantia, 
                ntf_trocamarca = :ntfTrocaMarca, 
                ntf_valor = :ntfValor, 
                ntf_anexo = :ntfAnexo, 
                ntf_prazodefesa = :ntfPrazoDefesa, 
                ntf_clientelicitacao = :ntfClienteLicitacao,
                ntf_usuario = :ntfUsuario, 
                ntf_representante = :ntfRepresentante,
                ntf_dataalteracao = :ntfDataAlteracao,
                ntf_datarecebimento = :ntfDataRecebimento, 
                ntf_instituicao = :ntfInstituicao, 
                ntf_observacao = :ntfObservacao ",
                 [
                    ':notificacaoId'        => $notificacaoId,
                    ':ntfNumero'            => $ntfNumero,
                    ':ntfEdital'            => $ntfEdital,
                    ':ntfPedido'            => $ntfPedido,
                    ':ntfStatus'            => $ntfStatus,
                    ':ntfGarantia'          => $ntfGarantia,
                    ':ntfTrocaMarca'        => $ntfTrocaMarca,
                    ':ntfValor'             => $ntfValor,
                    ':ntfAnexo'             => $ntfAnexo,
                    ':ntfPrazoDefesa'       => $ntfPrazoDefesa,
                    ':ntfClienteLicitacao'  => $ntfClienteLicitacao,
                    ':ntfUsuario'           => $ntfUsuario,
                    ':ntfRepresentante'     => $ntfRepresentante,
                    ':ntfDataAlteracao'     => $ntfDataAlteracao,                    
                    ':ntfDataRecebimento'   => $ntfDataRecebimento,
                    ':ntfInstituicao'       => $ntfInstituicao,
                    ':ntfObservacao'        => $ntfObservacao,
                ],
                " ntf_cod = :notificacaoId"
                );  
        } catch (\Exception $e) {
           // var_dump($e);
            throw new \Exception("Erro na gravação de dados. ", 500);
        }
    }

    public function excluir(Notificacao $notificacao)
    {
        try {
            $notificacaoId = $notificacao->getnotificacaoId();

            return $this->delete('notificacao', "ntf_id = $notificacaoId");
        } catch (Exception $e) {

            throw new \Exception("Erro ao deletar", 500);
        }
    }
}
