<?php

namespace App\Models\DAO;

use App\Models\Entidades\ClienteLicitacao;
use App\Models\Entidades\Produto;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;

class ClienteLicitacaoDAO extends  BaseDAO
{

    public  function listar($codCliente = null)
    {
        if ($codCliente) {
            $resultado = $this->select(
                
                
                "SELECT * FROM clienteLicitacao WHERE licitacaoCliente_cod = $codCliente"
            );
            $dado = $resultado->fetch();
            
            if ($dado) {
                $clienteLicitacao = new ClienteLicitacao();
                $clienteLicitacao->setCodCliente($dado['licitacaoCliente_cod']);
                $clienteLicitacao->setRazaoSocial($dado['razaosocial']);
                $clienteLicitacao->setNomeFantasia($dado['nomefantasia']);
                $clienteLicitacao->setCnpj($dado['CNPJ']);
                $clienteLicitacao->setTrocaMarca($dado['trocamarca']);
                $clienteLicitacao->setTipoCliente($dado['tipo']);
                // $clienteLicitacao->setDataCadastro($dado['dataCadastro']);                             
                return $clienteLicitacao;
            }
            //var_dump($clienteLicitacao);
        } else {

            $resultado = $this->select(
                ' SELECT * FROM clienteLicitacao ORDER BY razaosocial '
            );
            $dados = $resultado->fetchAll();

            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {

                    $clienteLicitacao = new ClienteLicitacao();
                    $clienteLicitacao->setCodCliente($dado['licitacaoCliente_cod']);
                    $clienteLicitacao->setRazaoSocial($dado['razaosocial']);
                    $clienteLicitacao->setNomeFantasia($dado['nomefantasia']);
                    $clienteLicitacao->setCnpj($dado['CNPJ']);
                    $clienteLicitacao->setTrocaMarca($dado['trocamarca']);
                    $clienteLicitacao->setTipoCliente($dado['tipo']);
                    // $clienteLicitacao->setDataCadastro($dado['dataCadastro']);

                    $lista[] = $clienteLicitacao;
                }
                return $lista;
            }
        }
        return false;
    }
    public  function listaClientesPedido()
    {
            $resultado = $this->select(
                ' SELECT distinct(c.razaosocial), c.licitacaoCliente_cod,c.tipo, c.nomefantasia,c.CNPJ              
                FROM  clienteLicitacao AS c
                 INNER JOIN controlePedido AS con on c.licitacaoCliente_cod = con.codCliente ORDER BY c.razaosocial '
            );
            $dados = $resultado->fetchAll();

            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {

                    $clienteLicitacao = new ClienteLicitacao();
                    $clienteLicitacao->setCodCliente($dado['licitacaoCliente_cod']);
                    $clienteLicitacao->setRazaoSocial($dado['razaosocial']);
                    $clienteLicitacao->setNomeFantasia($dado['nomefantasia']);
                    $clienteLicitacao->setCnpj($dado['CNPJ']);
                    $clienteLicitacao->setTrocaMarca($dado['trocamarca']);
                    $clienteLicitacao->setTipoCliente($dado['tipo']);
                    // $clienteLicitacao->setDataCadastro($dado['dataCadastro']);

                    $lista[] = $clienteLicitacao;
                }
                return $lista;
            }        
    }
    
    public function listarClienteLicitacao(ClienteLicitacao $clienteLicitacao)
    {
        $resultado = $this->select(
            "SELECT FC.faltaCliente_cod,
                    CL.nomefantasia as cliente,
                    P.ProCodigo,
                    P.ProNome,
                    F.nomefantasia,
                    P.ProMarca,
                    FC.proposta,
                    FC.AFM,
                    FC.observacao,
                    FC.dataFalta
                    
                FROM faltaCliente FC
     
     INNER JOIN faltaporcliente FPC on FPC.FK_ID_FALTACLIENTE = FC.faltaCliente_cod
     INNER JOIN clienteLicitacao CL on CL.licitacaoCliente_cod = FC.fk_cliente
     INNER JOIN Produto P on P.ProCodigo = FPC.FK_IDPRODUTO
     INNER JOIN fornecedor F on F.fornecedor_cod = P.ProFornecedor

     "
        );

        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function listarporCliente($clienteLicitacao = null)
    {
        if($clienteLicitacao)
        {
            $resultado = $this->select(
                "SELECT * FROM faltaporcliente fp INNER JOIN clienteLicitacao cl  ON fp.FK_ID_FALTACLIENTE = cl.licitacaoCliente_cod WHERE FK_ID_FALTACLIENTE = $clienteLicitacao"
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS, ClienteLicitacao::class);
        }
        
    }
    public  function listaClienteLicitacao2()
    {
        $resultado = $this->select(
            'SELECT * FROM cliente c INNER JOIN tipoCliente tp ON tp.codTipoCliente = c.idTipoCliente'
        );

        $dataSetclienteLicitacaos = $resultado->fetchAll();

        if ($dataSetclienteLicitacaos) {

            $listaClienteLicitacao2 = [];

            foreach ($dataSetclienteLicitacaos as $dataSetclienteLicitacao) {

                $clienteLicitacao = new ClienteLicitacao();
                $clienteLicitacao->setCodCliente($dataSetclienteLicitacao['idCliente']);
                $clienteLicitacao->setRazaoSocial($dataSetclienteLicitacao['nome']);
                $clienteLicitacao->setNomeFantasia($dataSetclienteLicitacao['nomeFantasia']);
                $clienteLicitacao->getTipoCliente()->setNomeTipo($dataSetclienteLicitacao['nomeTipo']);

                $listaClienteLicitacao2[] = $clienteLicitacao;
            }
            return $listaClienteLicitacao2;
        }

        return false;
    }

    public function listaClienteLicitacao($idCliente = null)
    {
        
        if ($idCliente) {

            $resultado = $this->select(
                "SELECT * FROM clienteLicitacao  WHERE licitacaoCliente_cod = $idCliente"
               // "SELECT * FROM cliente c INNER JOIN tipoCliente tp ON tp.codTipoCliente = c.tipoCliente WHERE c.idTipoCliente = $idCliente"
            );

            return $resultado->fetchObject(ClienteLicitacao::class);
        } else {
            $resultado = $this->select(
                "SELECT * FROM clienteLicitacao "
                //'SELECT * FROM cliente c INNER JOIN tipoCliente tp ON tp.codTipoCliente = c.idTipoCliente '
            );
            return  $resultado->fetchAll(\PDO::FETCH_CLASS, ClienteLicitacao::class);
        }

        return false;
    }
    public function listaTipoClienteLicitacao(ClienteLicitacao $clienteLicitacao)
    {
        $descricao = null;
        $codTipo = null;

        $SQL = "SELECT * FROM clienteTipo ORDER BY tpc_descricao" ;
                
                $where = Array();
                if( $codTipo ){ $where[] = " tpc_id = {$codTipo}"; }
                if( $descricao ){ $where[] = " tpc_descricao LIKE '%{$descricao}%' "; }
                
                if( sizeof( $where ) ){
                    $SQL .= ' WHERE '.implode( ' AND ',$where );
                   }else {
                     //  $SQL .= " WHERE tpc_status  not in  ('INATIVO') ";
                   }
            $resultado = $this->select($SQL);
            $dados = $resultado->fetchAll();

        if ($dados) {
            $lista = [];
            foreach ($dados as $dado) {
                $clienteLicitacao = new ClienteLicitacao();
                $clienteLicitacao->setTpcId($dado['tpc_id']);
                $clienteLicitacao->setTpcDescricao($dado['tpc_descricao']);
               /* $clienteLicitacao->setTpcDescricao($dado['tpc_status']);
                $clienteLicitacao->setTpcDescricao($dado['tpc_datacadastro']);
                $clienteLicitacao->setTpcDescricao($dado['tpc_dataalteracao']);
                $clienteLicitacao->setTpcDescricao($dado['tpc_intituicao']);
                $clienteLicitacao->setTpcDescricao($dado['tpc_usuario']);
                $clienteLicitacao->setInstituicao(new Instituicao());
                $clienteLicitacao->getInstituicao()->setInst_Id($dado['inst_id']);
                $clienteLicitacao->getInstituicao()->setInst_Codigo($dado['inst_codigo']);
                $clienteLicitacao->getInstituicao()->setInst_Nome($dado['inst_nome']);
                $clienteLicitacao->setUsuario(new Usuario());
                $clienteLicitacao->getUsuario()->setId($dado['id']);
                $clienteLicitacao->getUsuario()->setNome($dado['nome']);
                $clienteLicitacao->getUsuario()->setEmail($dado['email']);
                */
                $lista[] = $clienteLicitacao;
            }
            return $lista;
        }

        return false;
    }
    public function listarTeste($idCliente = null)
    {
        $SQL = "SELECT * FROM clienteLicitacao ";
        if($idCliente){
            $SQL.= " WHERE licitacaoCliente_cod = $idCliente";
        }
            $resultado = $this->select($SQL);
            
            $dados = $resultado->fetchAll();            
                $lista = [];

                foreach ($dados as $dado) {
                    
                $clienteLicitacao = new ClienteLicitacao();
                
                $clienteLicitacao->setCodCliente($dado['clienteLicitacao_cod']);
                $clienteLicitacao->setRazaoSocial($dado['razaosocial']);
                //date_format($date, 'Y-m-d H:i:s');
                $clienteLicitacao->setNomeFantasia($dado['nomefantasia']);
                             
                    $lista[] = $clienteLicitacao;
                }                
                return $lista;
    }
    public function salvar(ClienteLicitacao $clienteLicitacao)
    {
        try {
            $razaoSocial    = $clienteLicitacao->getRazaoSocial();
            $nomeFantasia   = $clienteLicitacao->getNomeFantasia();
            $cnpj           = $clienteLicitacao->getCnpj();
            $trocaMarca     = $clienteLicitacao->getTrocaMarca();
            $tipoCliente    = $clienteLicitacao->getTipoCliente();

            return $this->insert(
                'clienteLicitacao',
                ":razaosocial, :nomefantasia, :cnpj, :trocamarca, :tipo",
                [
                    ":razaosocial"      => $razaoSocial,
                    ":nomefantasia"     => $nomeFantasia,
                    ":cnpj"             => $cnpj,
                    ":trocamarca"       => $trocaMarca,
                    ":tipo"             => $tipoCliente
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados:" . $e->getMessage(), 500);
        }
    }

    public function atualizar(ClienteLicitacao $clienteLicitacao)
    {
        try {
            var_dump($clienteLicitacao);
            $codCliente     = $clienteLicitacao->getCodCliente();
            $razaoSocial    = $clienteLicitacao->getRazaoSocial();
            $nomeFantasia   = $clienteLicitacao->getNomeFantasia();
            $cnpj           = $clienteLicitacao->getCnpj();
            $trocaMarca     = $clienteLicitacao->getTrocaMarca();
            $tipoCliente    = $clienteLicitacao->getTipoCliente();

//echo " cod ".$codCliente." razao ".$razaoSocial." nome ".$nomeFantasia." cnpj ".$cnpj." marca ".$trocaMarca;
            return $this->update(
                'clienteLicitacao',
                "  razaoSocial=:razaoSocial, nomeFantasia=:nomeFantasia, cnpj=:cnpj, trocaMarca=:trocaMarca, tipo=:tipoCliente ",
                [
                    ':codCliente'       => $codCliente,
                    ':razaoSocial'      => $razaoSocial,
                    ':nomeFantasia'     => $nomeFantasia,
                    ':cnpj'             => $cnpj,
                    ':trocaMarca'       => $trocaMarca,
                    ':tipoCliente'       => $tipoCliente,
                ],
                "licitacaoCliente_cod = :codCliente"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao gravar dados " . $e->getMessage(), 500);
        }
    }

    public function excluir(ClienteLicitacao $clienteLicitacao)
    {
        try {

            $codCliente = $clienteLicitacao->getCodCliente();

            return $this->delete('clienteLicitacao', ":licitacaoCliente_cod = $codCliente");
        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar" . $e->getMessage(), 500);
        }
    }
    
    
    public function listarPorRazaoSocial(ClienteLicitacao $clienteLicitacao)
    {
        $resultado = $this->select(
            "SELECT * FROM clienteLicitacao WHERE razaosocial
                        LIKE '%".$clienteLicitacao->getRazaoSocial()."%' ORDER BY razaosocial LIMIT 0,6"
        );
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);
    }
 
}
