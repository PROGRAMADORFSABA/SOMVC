<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\EmailDAO;

use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Sugestoes;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\Notificacao;


class EmailService
{
    public function email(Pedido $pedido, $subject)
    {
        $emailDAO = new EmailDAO();
        return $emailDAO->email($pedido, $subject);
       
    }
    public function emailSugestoes(Sugestoes $sugestoes, $subject)
    {    
        $emailDAO = new EmailDAO();
        return $emailDAO->emailSugestoes($sugestoes, $subject);
       
    }
    public function emailNotificacao(Notificacao $notificacao, $subject)
    {    
        $emailDAO = new EmailDAO();
        return $emailDAO->emailNotificacao($notificacao, $subject);
       
    }
    public function emailSuporte( $erro)
    {
        $emailDAO = new EmailDAO();
        return $emailDAO->emailSuporte( $erro);
       
    }

    
}