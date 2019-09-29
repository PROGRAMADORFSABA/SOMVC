<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\CidadeDAO;
use App\Models\DAO\EstadoDAO;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Cidade;
use App\Models\Validacao\CidadeValidador;
use App\Models\Entidades\Usuario;

class CidadeController extends Controller
{
    public function index()
    {
        $cidadeDAO = new CidadeDAO();

        self::setViewParam('listaCidades', $cidadeDAO->listar());

        $this->render('/cidade/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $usuarioDAO = new UsuarioDAO();
        self::setViewParam('listaUsuarios', $usuarioDAO->listar());

        $estadoDAO = new EstadoDAO();
        self::setViewParam('listaEstados', $estadoDAO->listar());

        $this->render('/cidade/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $cidade = new Cidade();
        $cidade->setProNome($_POST['proNome']);
        $cidade->setProNomeComercial($_POST['proNomeComercial']);
        $cidade->setProEstado($_POST['proEstado']);
        $cidade->setProUsuario($_POST['proUsuario']);
        $cidade->setProUsuario($_POST['proUsuario']);
        $cidade->setProDataAlteracao($_POST['proDataAlteracao']);
        $cidade->setProDataCadastro($_POST['proDataCadastro']);

        Sessao::gravaFormulario($_POST);

        $cidadeValidador = new CidadeValidador();
        $resultadoValidacao = $cidadeValidador->validar($cidade);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/cidade/cadastro');
        }

        $cidadeDAO = new CidadeDAO();

        $cidadeDAO->salvar($cidade);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/cidade');
    }

    public function edicao($params)
    {
        $proCodigo = $params[0];

        $cidadeDAO = new CidadeDAO();
        $cidade = $cidadeDAO->listar($proCodigo);
        
        $usuarioDAO = new UsuarioDAO();
        self::setViewParam('listaUsuarios', $usuarioDAO->listar());

        $estadoDAO = new EstadoDAO();
        self::setViewParam('listaEstados', $estadoDAO->listar());
        if (!$cidade) {
            Sessao::gravaMensagem("Cidade inexistente");
            $this->redirect('/cidade');
        }

        self::setViewParam('produto', $cidade);

        $this->render('/cidade/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar()
    {

        $cidade = new Cidade();
        $cidade->setProCodigo($_POST['proCodigo']);
        $cidade->setProNome($_POST['proNome']);
        $cidade->setProNomeComercial($_POST['proNomeComercial']);
        $cidade->setProEstado($_POST['proEstado']);
        $cidade->setProUsuario($_POST['proUsuario']);
        $cidade->setProUsuario($_POST['proUsuario']);
        $cidade->setProDataAlteracao($_POST['proDataAlteracao']);
        

        Sessao::gravaFormulario($_POST);

        $cidadeValidador = new CidadeValidador();
        $resultadoValidacao = $cidadeValidador->validar($cidade);

        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/cidade/edicao/' . $_POST['proCodigo']);
        }

        $cidadeDAO = new CidadeDAO();

        $cidadeDAO->atualizar($cidade);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/cidade');
    }
    
    public function exclusao($params)
    {
        $proCodigo = $params[0];

        $cidadeDAO = new CidadeDAO();

        $cidade = $cidadeDAO->listar($proCodigo);

        if (!$cidade) {
            Sessao::gravaMensagem("Cidade inexistente");
            $this->redirect('/cidade');
        }

        self::setViewParam('produto', $cidade);

        $this->render('/cidade/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $cidade = new Cidade();
        $cidade->setProCodigo($_POST['proCodigo']);

        $cidadeDAO = new CidadeDAO();

        if (!$cidadeDAO->excluir($cidade)) {
            Sessao::gravaMensagem("Cidade inexistente");
            $this->redirect('/cidade');
        }

        Sessao::gravaMensagem("Cidade excluido com sucesso!");

        $this->redirect('/cidade');
    }

}
