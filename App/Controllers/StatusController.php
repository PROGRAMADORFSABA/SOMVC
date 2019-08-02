<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\StatusDAO;
use App\Models\Entidades\Status;
use App\Models\Validacao\StatusValidador;

class StatusController extends Controller
{
    public function index()
    {
        $statusDAO = new StatusDAO();
       
        self::setViewParam('listaStatus', $statusDAO->listar());


        $this->render('/status/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $this->render('/sla/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $sla = new Sla();
        $sla->setDescricao($_POST['descricao']);
        $sla->setTempo($_POST['tempo']);
        $sla->setUniTempo($_POST['uniTempo']);
        $sla->setFk_Instituicao($_POST['fk_instituicao']);

        Sessao::gravaFormulario($_POST);

        $slaValidador = new SlaValidador();
        $resultadoValidacao = $slaValidador->validar($sla);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/sla/cadastro');
        }

        $slaDAO = new SlaDAO();

        $slaDAO->salvar($sla);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/sla');
    }

    public function edicao($params)
    {
        $id = $params[0];

        $slaDAO = new SlaDAO();

        $sla = $slaDAO->listar($id);

        if (!$sla) {
            Sessao::gravaMensagem("Sla inexistente");
            $this->redirect('/sla');
        }

        self::setViewParam('Sla', $sla);

        $this->render('/sla/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar()
    {

        $sla = new Sla();
        $sla->setId($_POST['id']);
        $sla->setDescricao($_POST['descricao']);
        $sla->setTempo($_POST['tempo']);
        $sla->setUniTempo($_POST['uniTempo']);
        $sla->setFk_Instituicao($_POST['fk_instituicao']);

        Sessao::gravaFormulario($_POST);

        $slaValidador = new SlaValidador();
        $resultadoValidacao = $slaValidador->validar($sla);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/Sla/edicao/' . $_POST['id']);
        }

        $slaDAO = new SlaDAO();

        $slaDAO->atualizar($sla);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/sla');
    }

    public function exclusao($params)
    {
        $id = $params[0];

        $slaDAO = new SlaDAO();

        $sla = $slaDAO->listar($id);

        if (!$sla) {
            Sessao::gravaMensagem("Sla inexistente");
            $this->redirect('/sla');
        }

        self::setViewParam('Sla', $sla);

        $this->render('/sla/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $sla = new Sla();
        $sla->setId($_POST['id']);

        $slaDAO = new SlaDAO();

        if (!$slaDAO->excluir($sla)) {
            Sessao::gravaMensagem("Sla inexistente");
            $this->redirect('/sla');
        }

        Sessao::gravaMensagem("Sla excluido com sucesso!");

        $this->redirect('/sla');
    }
}
