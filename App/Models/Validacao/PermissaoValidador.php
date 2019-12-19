<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Permissao;

class PermissaoValidador{

    public function validar(Permissao $permissao)
    {
        $resultadoValidacao = new ResultadoValidacao();

       /*$resultadoValidacao = new ResultadoValidacao();

        if(empty($sugestoes->getSugTipo()))
        {
            $resultadoValidacao->addErro('tipo',"Tipo da Sugestao: Este campo não pode ser vazio");
        }               
        if(empty($sugestoes->getSugDescricao()))
        {
            $resultadoValidacao->addErro('descricao',"Descricao da Sugestao: Este campo não pode ser vazio");
        }               
        if(empty($sugestoes->getSugStatus()))
        {
            $resultadoValidacao->addErro('status',"Status de Sugestao: Este campo não pode ser vazio");
        }                               

        */
        return $resultadoValidacao;
    }
}