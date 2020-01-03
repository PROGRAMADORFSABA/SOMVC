<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\EmailDAO;

use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Sugestoes;
use App\Models\Entidades\Pedido;
use App\Models\Entidades\Edital;
use App\Models\Entidades\Notificacao;
use App\Models\Entidades\Usuario;

class EmailService
{
    public function email(Pedido $pedido, $email, $subject)
    {
        $emailDAO = new EmailDAO();
        return $emailDAO->email($pedido, $email, $subject);
       
    }
    public function emailUsuario(Usuario $usuario, $email, $subject)
    {
        $emailDAO = new EmailDAO();
        return $emailDAO->emailUsuario($usuario, $email, $subject);
       
    }
    
    public function emailEdital(Edital $edital, $email, $subject)
    {
        $emailDAO = new EmailDAO();
        return $emailDAO->emailEdital($edital, $email, $subject);
       
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
    public function emailSuporte( $erro, $tela)
    {
        $emailDAO = new EmailDAO();
        return $emailDAO->emailSuporte( $erro,$tela);
       
    }

    
}