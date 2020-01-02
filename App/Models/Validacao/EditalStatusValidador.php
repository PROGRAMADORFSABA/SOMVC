<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\EditalStatus;

class EditalStatusValidador{

    public function validar(EditalStatus $editalStatus)
    {
        $resultadoValidacao = new ResultadoValidacao();

       if(empty($editalStatus->getStEdtNome()))
        {
            $resultadoValidacao->addErro('nome',"Nome: Status campo não pode ser vazio");
        }
            
        return $resultadoValidacao;
    }
}