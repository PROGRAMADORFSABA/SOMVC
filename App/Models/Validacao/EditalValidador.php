<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Edital;

class EditalValidador{

    public function validar(Edital $edital)
    {
        $resultadoValidacao = new ResultadoValidacao();

       /* if(empty($edital->getCidNome()))
        {
            $resultadoValidacao->addErro('cidNome',"Nome: Cide campo não pode ser vazio");
        }
        if(empty($edital->getEstado()))
        {
            $resultadoValidacao->addErro('estado',"UF: Este campo não pode ser vazio");
        }
        */
        return $resultadoValidacao;
    }
}