<?php

namespace App\Models\DAO;

use App\Models\Entidades\Cidade;

class CidadeDAO extends BaseDAO
{
    public  function listar($cidId = null)
    {
        
            $SQL = " SELECT * 
                FROM cidade c
                INNER JOIN estado e ON e.estid = cidestado 
                INNER JOIN usuarios u ON u.id = cidusuario ";
            if($id) 
            {    
                $SQL.= " WHERE c.cidid = $cidId";
            }         
            
            $resultado = $this->select($SQL);
            
            $dados = $resultado->fetchAll();

                $lista = [];
                foreach ($dados as $dado) {

                    $cidade = new Cidade();
                    $cidade->setCidId($dado['cidid']);
                    $cidade->setCidNome($dado['cidnome']);
                    $cidade->setCidEstado($dado['cidestado']);
                    $cidade->setCidDataAlteracao($dado['ciddataalteracao']);
                    $cidade->setCidDataCadastro($dado['ciddataaldastro']);
                    $cidade->getEstado()->setEstId($dado['estid']);
                    $cidade->getEstado()->setEstNome($dado['estnome']);
                    $cidade->getEstado()->setEstUf($dado['estuf']);
                    $cidade->getUsuario()->setId($dado['id']);
                    $cidade->getUsuario()->setNome($dado['nome']);

                    $lista[] = $cidade;
                }
                return $lista;        
    }
    
    public function listarPorCidade($cidNome = null)
    {
        if($cidNome)
        {
            $resultado = $this->select(
                "SELECT * 
                FROM cidade c
                INNER JOIN estado e ON e.estid = cidestado 
                INNER JOIN usuarios u ON u.id = cidusuario WHERE c. = $cidNome"
            );
        }
        return $resultado->fetchAll(\PDO::FETCH_CLASS, Cidade::class);
    }

    public  function salvar(Cidade $cidade)
    {
        try {

            $proNome           = $cidade->getCidNome();
            $proNomeComercial          = $cidade->getCidEstado();
            $proUsuario          = $cidade->getProUsuario();
            $proEstado          = $cidade->getProEstado();
            $proUsuario          = $cidade->getProUsuario();
            $date     = $cidade->getCidDataAlteracao();
            $date1     = $cidade->getCidDataCadastro();
            $proDataCadastro =   date_format($date1, 'Y-m-d H:i:s');
            $proDataAlteracao =   date_format($date, 'Y-m-d H:i:s');

            return $this->insert(
                'Cidade',
                ":proNome,:proNomeComercial,:proUsuario,:proEstado,:proUsuario,:proDataAlteracao,:proDataCadastro",
                [
                    ':proNome' => $proNome,
                    ':proNomeComercial' => $proNomeComercial,
                    ':proUsuario' => $proUsuario,
                    ':proEstado' => $proEstado,
                    ':proUsuario' => $proUsuario,
                    ':proDataAlteracao' => $proDataAlteracao,
                    ':proDataCadastro' => $proDataCadastro
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. " . $e, 500);
        }
    }

    public  function listaPorNome(Cidade $cidade)
    {       
        $resultado = $this->select(
            "SELECT * FROM cidade WHERE cidnome 
             like '%".$cidade->getCidNome()."%' LIMIT 0,6 "
        );        
        return $resultado->fetchAll(\PDO::FETCH_ASSOC);        
    }

    public  function atualizar(Cidade $cidade)
    {
        try {
            
            $proCodigo         = $cidade->getCidId();
            $proNome           = $cidade->getCidNome();
            $proNomeComercial          = $cidade->getCidEstado();
            $proUsuario          = $cidade->getProUsuario();
            $proEstado          = $cidade->getProEstado();
            $proUsuario          = $cidade->getProUsuario();
            $date               = $cidade->getCidDataAlteracao();
            $proDataAlteracao =   date_format($date, 'Y-m-d H:i:s');

            return $this->update(
                'Cidade',
                "proNome = :proNome, proNomeComercial = :proNomeComercial, proUsuario = :proUsuario, proEstado = :proEstado, proUsuario = :proUsuario, proDataAlteracao = :proDataAlteracao",
                [
                    ':proCodigo' => $proCodigo,
                    ':proNome' => $proNome,
                    ':proNomeComercial' => $proNomeComercial,
                    ':proUsuario' => $proUsuario,
                    ':proEstado' => $proEstado,
                    ':proUsuario' => $proUsuario,
                    ':proDataAlteracao' => $proDataAlteracao,                    
                ],
                "proCodigo = :proCodigo"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

    public function excluir(Cidade $cidade)
    {
        try {
            $proCodigo = $cidade->getCidId();

            return $this->delete('Cidade', "proCodigo = $proCodigo");
        } catch (Exception $e) {

            throw new \Exception("Erro ao deletar", 500);
        }
    }

}
