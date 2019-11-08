<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Notificacao;

class NotificacaoValidador{

    public function validar(Notificacao $notificacao)
    {
        $resultadoValidacao = new ResultadoValidacao();

       /* if(empty($notificacao->getCidNome()))
        {
            $resultadoValidacao->addErro('cidNome',"Nome: Cide campo não pode ser vazio");
        }
        if(empty($notificacao->getEstado()))
        {
            $resultadoValidacao->addErro('estado',"UF: Este campo não pode ser vazio");
        }
        */
        return $resultadoValidacao;
    }
}