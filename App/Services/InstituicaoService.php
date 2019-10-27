<?php

namespace App\Services;

use App\Lib\Sessao;
use App\Lib\Transacao;
use App\Lib\Exportar;

use App\Models\DAO\InstituicaoDAO;



use App\Models\Validacao\InstituicaoValidador;
use App\Models\Validacao\ResultadoValidacao;
use App\Models\Entidades\Instituicao;


class InstituicaoService
{
    public function listar($id = null)
    {
        
        $instituicaoDAO = new InstituicaoDAO();
        return $instituicaoDAO->listar($id);
    }

    
}