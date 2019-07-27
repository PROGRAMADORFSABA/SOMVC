<?php

namespace App\Models\DAO;

use App\Models\Entidades\Fornecedor;

class FornecedorDAO extends BaseDAO
{
    public  function listar($codFornecedor = null)
    {

        if ($codFornecedor) {
            $resultado = $this->select(
                "SELECT * FROM fornecedor WHERE codFornecedor = $codFornecedor"
            );
            $dado = $resultado->fetch();

            if ($dado) {
                $fornecedor = new Fornecedor();
                $fornecedor->setCodFornecedor($dado['codFornecedor']);
                $fornecedor->setRazaoSocial($dado['razaoSocial']);
                $fornecedor->setNomeFantasia($dado['nomeFantasia']);
                $fornecedor->setCnpj($dado['cnpj']);
                $fornecedor->setDataCadastro($dado['dataCadastro']);

                return $fornecedor;
            }
        } else {

            $resultado = $this->select(
                "SELECT * FROM fornecedor ORDER BY razaoSocial"
            );
            $dados = $resultado->fetchAll();

            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {

                    $fornecedor = new Fornecedor();
                    $fornecedor->setCodFornecedor($dado['codFornecedor']);
                    $fornecedor->setRazaoSocial($dado['razaoSocial']);
                    $fornecedor->setNomeFantasia($dado['nomeFantasia']);
                    $fornecedor->setCnpj($dado['cnpj']);
                    $fornecedor->setDataCadastro($dado['dataCadastro']);

                    $lista[] = $fornecedor;
                }
                return $lista;
            }
            /*
        $resultado = $this->select(
            "SELECT * FROM fornecedor ORDER BY razaoSocial"
        );
*/
        }

        return false;
    }
    public  function qtde()
    {
        $resultado = $this->select(
            "SELECT COUNT(*) FROM fornecedor"            
        );
        $fornecedor = $resultado->fetch();

        return $fornecedor;

        if ($fornecedor) {

            return $fornecedor;
        }

        return false;
    }
    public  function qtde1()
    {
        $resultado = $this->select(
            // "SELECT COUNT(*) FROM fornecedor"
            "SELECT R.codFornecedor,R.razaoSocial, R.qtdePedidos FROM (
                SELECT DISTINCT f.razaoSocial, f.codFornecedor,
                (SELECT COUNT(p.nome) AS qtde
                FROM produto AS p 
                WHERE f.codFornecedor = p.fornecedor_id
                ) as qtdePedidos
                FROM fornecedor as f ) AS R
                WHERE R.qtdePedidos > 0
                 ORDER BY R.qtdePedidos DESC"
        );
        $dados = $resultado->fetchAll();

        /*if ($dados) {

            $lista = [];

            foreach ($dados as $dado) {

                $fornecedor = new Fornecedor();
                //  $fornecedor->setCodFornecedor($dado['codFornecedor']);
                $fornecedor->setCodFornecedor($dado['qtdePedidos']);
                $fornecedor->setRazaoSocial($dado['razaoSocial']);
                //  $fornecedor->setNomeFantasia($dado['nomeFantasia']);
                //  $fornecedor->setCnpj($dado['cnpj']);
                $fornecedor->$dado['qtdePedidos'];

                $lista[] = $fornecedor;
            }
            return $lista;
            
    }*/
        return $dados;
       // return false;
    }


    public  function salvar(Fornecedor $fornecedor)
    {
        try {

            $nomeFantasia   = $fornecedor->getNomeFantasia();
            $razaoSocial    = $fornecedor->getRazaoSocial();
            $cnpj           = $fornecedor->getCnpj();

            return $this->insert(
                'fornecedor',
                ":razaoSocial,:nomeFantasia,:cnpj",
                [
                    ':razaoSocial' => $razaoSocial,
                    ':nomeFantasia' => $nomeFantasia,
                    ':cnpj' => $cnpj
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public  function atualizar(Fornecedor $fornecedor)
    {
        try {

            $codFornecedor  = $fornecedor->getCodFornecedor();
            $nomeFantasia   = $fornecedor->getNomeFantasia();
            $razaoSocial    = $fornecedor->getRazaoSocial();
            $cnpj           = $fornecedor->getCnpj();

            return $this->update(
                'fornecedor',
                "razaoSocial = :razaoSocial, nomeFantasia = :nomeFantasia, cnpj = :cnpj",
                [
                    ':codFornecedor' => $codFornecedor,
                    ':razaoSocial' => $nomeFantasia,
                    ':nomeFantasia' => $razaoSocial,
                    ':cnpj' => $cnpj,
                ],
                "codFornecedor = :codFornecedor"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function excluir(Fornecedor $fornecedor)
    {
        try {
            $codFornecedor = $fornecedor->getCodFornecedor();

            return $this->delete('fornecedor', "codFornecedor = $codFornecedor");
        } catch (Exception $e) {

            throw new \Exception("Erro ao deletar", 500);
        }
    }
}
