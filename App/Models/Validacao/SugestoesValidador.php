<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\Sugestoes;

class SugestoesValidador{
//sug_id, sug_tipo, sug_descricao, sug_status, sug_anexo, sug_datacadastro, sug_dataalteracao ,sug_instituicao, sug_usuario
    public function validar(Sugestoes $sugestoes)
    {
        $resultadoValidacao = new ResultadoValidacao();

        if(empty($sugestoes->getSugTipo()))
        {
            $resultadoValidacao->addErro('sugTipo',"Tipo da Sugestao: Este campo não pode ser vazio");
        }               
        if(empty($sugestoes->getSugDescricao()))
        {
            $resultadoValidacao->addErro('sugDescricao',"Descricao da Sugestao: Este campo não pode ser vazio");
        }               
        if(empty($sugestoes->getSugStatus()))
        {
            $resultadoValidacao->addErro('sugStatus',"Status de Sugestao: Este campo não pode ser vazio");
        }                               

        return $resultadoValidacao;
    }
}