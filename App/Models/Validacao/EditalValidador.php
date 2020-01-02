<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Edital;

class EditalValidador{

    public function validar(Edital $edital)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($edital->getEdtValor()))
        {
            $resultadoValidacao->addErro('valor',"Valor: O campo não pode ser vazio");
        }
        if(empty($edital->getEdtModalidade()))
        {
            $resultadoValidacao->addErro('modalidade',"Modalidade: Este campo não pode ser vazio");
        }
        if(empty($edital->getEdtTipo()))
        {
            $resultadoValidacao->addErro('tipo',"tipo: Este campo não pode ser vazio");
        }       
        
        return $resultadoValidacao;
    }
}