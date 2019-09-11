<?php

namespace App\Models\DAO;

use App\Models\Entidades\Marca;

class MarcaDAO extends BaseDAO
{
    public  function listar($id = null) {

        if ($id) {
            $resultado = $this->select(
                "SELECT * FROM marcaFalta WHERE marcaFalta_cod = $id"
            );
            $dado = $resultado->fetch();

            if ($dado) {
               $marca = new Marca();
               $marca->setMarcaCod($dado['marcaFalta_cod']);
               $marca->setMarcaNome($dado['nome_Marca']);
               
                return $marca;
            }
        } else {

            $resultado = $this->select(
                "SELECT * FROM marcaFalta ORDER BY nome_Marca"
            );
            $dados = $resultado->fetchAll();

            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {

                    $marca = new Marca();
               $marca->setMarcaCod($dado['marcaFalta_cod']);
               $marca->setMarcaNome($dado['nome_Marca']);
               
                    $lista[] = $marca;
                }
                return $lista;
            }
        }

        return false;
    }

   /* public  function salvar(Sla $sla)
    {
        try {

            $tempo          =$sla->getTempo();
            $descricao      =$sla->getDescricao();
            $fk_instituicao =$sla->getFk_Instituicao();
            $uniTempo       =$sla->getUniTempo();

            return $this->insert(
                'marcaFalta',
                ":descricao,:unitempo,:tempo",
                [
                    ':descricao' => $descricao,
                    ':tempo' => $tempo,
                    ':unitempo' => $uniTempo,
                    ':fk_idInstituicao' => $fk_instituicao
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public  function atualizar(Sla $sla){
        try {

            $id             =$sla->getId();
            $tempo          =$sla->getTempo();
            $descricao      =$sla->getDescricao();
            $fk_instituicao  =$sla->getFk_Instituicao();
            $uniTempo        =$sla->getUniTempo();

            return $this->update(
                'tbl_sla',
                "descricao = :descricao, fk_idInstituicao = :fk_instituicao, tempo = :tempo, unitempo = :uniTempo",
                [
                    ':id' => $id,
                    ':descricao' => $descricao,
                    ':tempo' => $tempo,
                    ':uniTempo' => $uniTempo,
                    ':fk_instituicao' => $fk_instituicao,
                ],
                "id = :id"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ", 500);
        }
    }

    public function excluir(Sla $sla)
    {
        try {
            $id =$sla->getId();

            return $this->delete('tbl_sla', "id = $id");
        } catch (Exception $e) {

            throw new \Exception("Erro ao deletar", 500);
        }
    }*/
}
