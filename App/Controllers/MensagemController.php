<?php 

namespace App\Controllers;


class MensagemController extends Controller
{
    public function sucesso()
    { 
        $this->renderLogin('/mensagem/sucesso');
    }
    public function erro()
    { 
        $this->renderLogin('/mensagem/error');
    }
    
}


?>