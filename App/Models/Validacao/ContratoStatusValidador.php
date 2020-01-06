<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\ContratoStatus;

class ContratoStatusValidador{

    public function validar(ContratoStatus $contratoStatus)
    {
        $resultadoValidacao = new ResultadoValidacao();

       if(empty($contratoStatus->getStCtrNome()))
        {
            $resultadoValidacao->addErro('nome',"Nome: Status campo não pode ser vazio");
        }
            
        return $resultadoValidacao;
    }
}