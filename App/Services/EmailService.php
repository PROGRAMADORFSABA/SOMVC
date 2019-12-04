<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\EmailDAO;

use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Pedido;


class EmailService
{
    public function email(Pedido $pedido, $subject)
    {
        $emailDAO = new EmailDAO();
        return $emailDAO->email($pedido, $subject);
       
    }
    public function emailSuporte( $erro)
    {
        $emailDAO = new EmailDAO();
        return $emailDAO->emailSuporte( $erro);
       
    }

    
}