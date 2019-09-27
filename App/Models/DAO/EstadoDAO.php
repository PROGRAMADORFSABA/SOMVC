<?php

namespace App\Models\DAO;

use App\Models\Entidades\Estado;

class EstadoDAO extends BaseDAO
{
    public  function listar($estId = null)
    {

        if ($estId) {
            $resultado = $this->select(
                "SELECT * FROM estado WHERE estid = $estId "
            );
            $dado = $resultado->fetch();

            if ($dado) {
                $est = new Estado();
                $est->setEstId($dado['estid']);
                $est->setEstNome($dado['estnome']);

                return $est;
            }
        } else {
            $resultado = $this->select(
                "SELECT * FROM estado ORDER BY estnome " 
            );
            $dados = $resultado->fetchAll();

            if ($dados) {

                $lista = [];

                foreach ($dados as $dado) {

                    $est = new Estado();
                    $est->setEstId($dado['estid']);
                    $est->setEstNome($dado['estnome']);

                    $lista[] = $est;
                }
                return $lista;
            }
        }

        return false;
    }
    

     public  function salvar(Marca $est)
    {
        try {

            $estNome          =$est->getEstNome();

            return $this->insert(
                'estado',
                ":estnome ",
                [
                    ':estnome' => $estNome
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

    public  function atualizar(Marca $est){
        try {

            $estId             =$est->getEstId();
            $estNome             =$est->getEstNome();

            return $this->update(
                'estado',
                "estnome = :estNome",
                [
                    ':estId' => $estId,
                    ':estNome' => $estNome,
                ],
                "estid = :estId"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados. ".$e, 500);
        }
    }

    public function excluir(Marca $est)
    {
        try {
            $estId =$est->getEstId();

            return $this->delete('estado', "estid = $estId");
        } catch (Exception $e) {

            throw new \Exception("Erro ao deletar. ".$e, 500);
        }
    }
}
