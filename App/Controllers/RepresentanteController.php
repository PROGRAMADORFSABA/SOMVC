<?php 


namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\RepresentanteDAO;
use App\Models\Entidades\Representante;
use App\Services\RepresentanteService;


class RepresentanteController extends Controller
{
    public function index($params)
    {
       $representanteId = $params[0];
        $representanteService = new RepresentanteService();

        self::setViewParam('listarRepresentantes,' ,$representanteService->listar($representanteId));

        $this->render('/representante/index');

        Sessao::limpaMensagem();
    }

    public function cadastroRepresentante()
    {
        
    }
}

?>