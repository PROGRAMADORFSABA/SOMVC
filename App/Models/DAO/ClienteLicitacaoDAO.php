<?php

namespace App\Models\DAO;

use App\Models\Entidades\ClienteLicitacao;
use App\Models\Entidades\Produto;

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
                // $clienteLicitacao->setDataCadastro($dado['dataCadastro']);                             
                return $clienteLicitacao;
            }
            //var_dump($clienteLicitacao);
        } else {

            $resultado = $this->select(
                ' SELECT * FROM clienteLicitacao '
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
                    // $clienteLicitacao->setDataCadastro($dado['dataCadastro']);

                    $lista[] = $clienteLicitacao;
                }
                return $lista;
            }
        }
        return false;
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
                $clienteLicitacao->setIdCliente($dataSetclienteLicitacao['idCliente']);
                $clienteLicitacao->setNome($dataSetclienteLicitacao['nome']);
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
            $cnpj   = $clienteLicitacao->getCnpj();
            $trocaMarca     = $clienteLicitacao->getTrocaMarca();

            return $this->insert(
                'clienteLicitacao',
                ":razaosocial, :nomefantasia, :cnpj, :trocamarca",
                [
                    ":razaosocial"      => $razaoSocial,
                    ":nomeFantasia"     => $nomeFantasia,
                    ":cnpj"     => $cnpj,
                    ":trocamarca"       => $trocaMarca
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados:" . $e->getMessage(), 500);
        }
    }

    public function atualizar(ClienteLicitacao $clienteLicitacao)
    {
        try {

            $codCliente     = $clienteLicitacao->getCodCliente();
            $razaoSocial    = $clienteLicitacao->getRazaoSocial();
            $nomeFantasia   = $clienteLicitacao->getNomeFantasia();
            $cnpj           = $clienteLicitacao->getCnpj();
            $trocaMarca     = $clienteLicitacao->getTrocaMarca();

//echo " cod ".$codCliente." razao ".$razaoSocial." nome ".$nomeFantasia." cnpj ".$cnpj." marca ".$trocaMarca;
            return $this->update(
                'clienteLicitacao',
                "  razaoSocial=:razaoSocial, nomeFantasia=:nomeFantasia, cnpj=:cnpj, trocaMarca=:trocaMarca ",
                [
                    ':codCliente'       => $codCliente,
                    ':razaoSocial'      => $razaoSocial,
                    ':nomeFantasia'     => $nomeFantasia,
                    ':cnpj'             => $cnpj,
                    ':trocaMarca'       => $trocaMarca,
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
