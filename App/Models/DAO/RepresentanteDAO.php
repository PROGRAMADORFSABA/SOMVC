<?php 

namespace App\Models\DAO;

use App\Models\Entidades\Representante;


class RepresentanteDAO extends BaseDAO
{
    public function listarRepresentante($codRepresentante = null)
    {
        if($codRepresentante)
        {
            $resultado = $this->select(
                "SELECT * FROM caddRepresentante WHERE codRepresentante = $codRepresentante"
            );

            return $resultado->fetchObject(Representante::class);
        }else
        {
            $resultado = $this->select(
                "SELECT * FROM cadRepresentante"
            );
            return $resultado->fetchAll(\PDO::FETCH_CLASS. Representante::class);
        }
        return false;
    }

    public function salvarRepresentante(Representante $representante)
    {
        try
        {
            $nomeRepresentante     = $representante->getNomeRepresentante();
            return $this->insert(
                'cadRepresentante',
                ":nomeRepresentante",
                [
                    ':nomeRepresentante'=>$nomeRepresentante
                ]
            );
        }catch (\Exception $e){
            throw new \Exception("Erro na gravação dos dados !", 500);
        }
    }

    public function atualizarRepresentante(Representante $representante)
    {
        try
        {
            $codRepresentante       = $representante->getCodRepresentante();
            $nomeRepresentante      = $representante->getNomeRepresentante();
            $statusRepresentante    = $representante->getStatusRepresentante();

            return $this->update(
                'cadRepresentante',
                "nomeRepresentante = :nomeRepresentante , statusRepresentante = :statusRepresentante",
                [
                    ':codRepresentante'     =>$codRepresentante,
                    ':nomeRepresentante'    =>$nomeRepresentante,
                    ':statusRepresentante'  =>$statusRepresentante
                ],
                "codRepresentante = :codRepresentante"
            );
        }catch (\Exception $e){
            throw new \Exception("Erro ao gravar dados", 500);
        }
    }

    public function excluirRepresentante(Representante $representante)
    {
        try
        {
            $codRepresentante = $representante->getCodRepresentante();

            return $this->delete('cadRepresentante', "codRepresentante = $codRepresentante");
        }catch (\Exception $e){
            throw new \Exception("erro ao gravar dados", 500);
        }
    }
}




?>