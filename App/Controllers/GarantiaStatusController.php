<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\Entidades\Cidade;
use App\Models\Entidades\Transportadora;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Instituicao;
use App\Models\Entidades\Endereco;

use App\Models\Validacao\TransportadoraValidador;
use App\Services\TransportadoraServices;
use App\Services\EmailService;
use App\Services\InstituicaoService;
use App\Services\UsuarioService;
use App\Services\CidadeService;

class GarantiaStatusController extends Controller
{
    public function index()
    {
        $this->render('/garantiastatus/index');    
    }
    
    public function cadastro()
    {
        $this->render('/garantiastatus/cadastro');    

    }

}