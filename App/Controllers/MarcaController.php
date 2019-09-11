<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\MarcaDAO;
use App\Models\Entidades\Marca;
use App\Models\Validacao\MarcaValidador;

class MarcaController extends Controller
{
    public function index()
    {
        $marcaDAO = new MarcaDAO();

        self::setViewParam('listaMarcas',$marcaDAO->listar());      

        $this->render('/marca/index');

        Sessao::limpaMensagem();
    }

    public function cadastro()
    {
        $this->render('/marca/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar() {
        $marca = new Marca();
        $marca->setNomeFantasia($_POST['nomeFantasia']);
        $marca->setRazaoSocial($_POST['razaoSocial']);
        $marca->setCnpj($_POST['cnpj']);

        Sessao::gravaFormulario($_POST);

        $marcaValidador = new MarcaValidador();
        $resultadoValidacao = $marcaValidador->validar($marca);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/marca/cadastro');
        }

        $marcaDAO = new MarcaDAO();

        $marcaDAO->salvar($marca);
        
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/marca');
      
    }
    
    public function edicao($params){
        $codmarca = $params[0];

        $marcaDAO = new marcaDAO();

        $marca = $marcaDAO->listar($codmarca);

        if(!$marca){
            Sessao::gravaMensagem("marca inexistente");
            $this->redirect('/marca');
        }

        self::setViewParam('marca',$marca);

        $this->render('/marca/editar');

        Sessao::limpaMensagem();

    }

    public function atualizar()   {

        $marca = new marca();
        $marca->setCodmarca($_POST['codmarca']);
        $marca->setNomeFantasiaFantasia($_POST['nomeFantasia']);
        $marca->setRazaoSocial($_POST['razaoSocial']);
        $marca->setCnpj($_POST['cnpj']);
        
        Sessao::gravaFormulario($_POST);

        $marcaValidador = new marcaValidador();
        $resultadoValidacao = $marcaValidador->validar($marca);

        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/marca/edicao/'.$_POST['codmarca']);
        }

        $marcaDAO = new marcaDAO();

        $marcaDAO->atualizar($marca);

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        $this->redirect('/marca');

    }
    
    public function exclusao($params)
    {
        $codmarca = $params[0];

        $marcaDAO = new marcaDAO();

        $marca = $marcaDAO->listar($codmarca);

        if(!$marca){
            Sessao::gravaMensagem("marca inexistente");
            $this->redirect('/marca');
        }

        self::setViewParam('marca',$marca);

        $this->render('/marca/exclusao');

        Sessao::limpaMensagem();

    }

    public function excluir()
    {
        $marca = new marca();
        $marca->setCodmarca($_POST['codmarca']);

        $marcaDAO = new marcaDAO();

        if(!$marcaDAO->excluir($marca)){
            Sessao::gravaMensagem("marca inexistente");
            $this->redirect('/marca');
        }

        Sessao::gravaMensagem("marca excluido com sucesso!");

        $this->redirect('/marca');

    }
}