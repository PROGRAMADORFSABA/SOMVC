<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Estado;

class MarcaValidador{

    public function validar(Estado $estado)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($estado->getEstNome()))
        {
            $resultadoValidacao->addErro('marcaNome',"Nome: Este campo não pode ser vazio");
        }
        
        return $resultadoValidacao;
    }
}