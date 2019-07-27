<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Fornecedor;

class FornecedorValidador{

    public function validar(Fornecedor $fornecedor)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($fornecedor->getRazaoSocial()))
        {
            $resultadoValidacao->addErro('razaoSocial',"Razao Social: Este campo não pode ser vazio");
        }
        
        if(empty($fornecedor->getCnpj()))
        {
            $resultadoValidacao->addErro('cnpj',"CNPJ: Este campo não pode ser vazio");
        }


        return $resultadoValidacao;
    }
}