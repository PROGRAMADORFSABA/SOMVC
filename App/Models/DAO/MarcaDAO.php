<?php

namespace App\Models\DAO;

use App\Models\Entidades\Marca;

class MarcaDAO extends BaseDAO
{
    public  function listar($codMarca = null)
    {

        if ($codMarca) {
            $resultado = $this->select(
                "SELECT * FROM marcaFalta WHERE marcaFalta_cod = $codMarca "
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
                "SELECT * FROM marcaFalta ORDER BY nome_Marca " 
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
    

     public  function salvar(Marca $marca)
    {
        try {

            $marcaNome          =$marca->getMarcaNome();

            return $this->insert(
                'marcaFalta',
                ":nome_Marca ",
                [
                    ':nome_Marca' => $marcaNome
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

    public  function atualizar(Marca $marca){
        try {

            $marcaCod             =$marca->getMarcaCod();
            $marcaNome             =$marca->getMarcaNome();

            return $this->update(
                'marcaFalta',
                "nome_Marca = :marcaNome",
                [
                    ':marcaCod' => $marcaCod,
                    ':marcaNome' => $marcaNome,
                ],
                "marcaFalta_cod = :marcaCod"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

    public function excluir(Marca $marca)
    {
        try {
            $marcaCod =$marca->getMarcaCod();

            return $this->delete('marcaFalta', "marcaFalta_cod = $marcaCod");
        } catch (Exception $e) {

            throw new \Exception("Erro ao deletar. ".$e, 500);
        }
    }
}
