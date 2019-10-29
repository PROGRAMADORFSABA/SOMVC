<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Contrato;

class ContratoValidador{

    public function validar(Contrato $contrato)
    {
        $resultadoValidacao = new ResultadoValidacao();

       /* if(empty($contrato->getCidNome()))
        {
            $resultadoValidacao->addErro('cidNome',"Nome: Cide campo não pode ser vazio");
        }
        if(empty($contrato->getEstado()))
        {
            $resultadoValidacao->addErro('estado',"UF: Este campo não pode ser vazio");
        }
        */
        return $resultadoValidacao;
    }
}