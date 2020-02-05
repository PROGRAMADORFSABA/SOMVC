<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\Transportadora;

class TransportadoraValidador{

    public function validar(Transportadora $transportadora)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($transportadora->getTraRazaoSocial()))
        {
            $resultadoValidacao->addErro('razaosocial',"razao social: Este campo não pode ser vazio<br>");
        }               
        if(empty($transportadora->getTraCnpj()))
        {
            $resultadoValidacao->addErro('cnpj',"cnpj: Este campo não pode ser vazio<br>");
        }               
        if(empty($transportadora->getTraUsuario()))
        {
            $resultadoValidacao->addErro('usuario',"usuario: Este campo não pode ser vazio<br>");
        }                               
        if(empty($transportadora->getEndCidade()))
        {
            $resultadoValidacao->addErro('cidade',"cidade: Este campo não pode ser vazio<br>");
        }                               
        if(empty($transportadora->getTraInstituicao()))
        {
            $resultadoValidacao->addErro('instituicao',"instituicao: Este campo não pode ser vazio<br>");
        }                               

        return $resultadoValidacao;
    }
}