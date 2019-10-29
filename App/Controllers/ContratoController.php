<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\Validacao\ContratoValidador;
use App\Models\Entidades\Contrato;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Edital;
use App\Models\Entidades\Representante;
use App\Models\Entidades\ClienteLicitacao;
use App\Services\ContratoService;
use App\Services\ClienteLicitacaoService;
use App\Services\UsuarioService;
use App\Services\EditalService;
use App\Services\RepresentanteService;

class ContratoController extends Controller
{
    public function index($params)
    {
        $contratoId = $params[0];
        $contratoService = new ContratoService();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $representanteService = new RepresentanteService();
        $contrato = new Contrato();

        //self::setViewParam('listaEditais', $contratoService->listar($contratoId));
        
        self::setViewParam('listaClientes', $clienteLicitacaoService->listar());
        self::setViewParam('listarRepresentantes', $representanteService->listar());
        
       if($_POST){
           $contrato->setCtrId($_POST['codigo']);        
           /*$contrato->setEdtProposta($_POST['proposta']);        
           $contrato->setEdtNumero($_POST['numeroLicitacao']);              
           $contrato->setEdtModalidade($_POST['modalidade']);        
           $contrato->setEdtStatus($_POST['status']);        
           $contrato->setEdtTipo($_POST['tipo']);  */
           $contrato->setEdtCliente($_POST['codCliente']);
           //var_dump(  $contrato->setEdtProposta($_POST['proposta']));
        }
        
        self::setViewParam('listaContratos', $contratoService->listarDinamico($contrato));
        $this->render('/contrato/index');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();

    }



    public function autoComplete($params)
    {
        $contrato = new Contrato();
        $contrato->CidNome($params[0]);        
        $contratoService = new ContratoService();
        $busca = $contratoService->autoComplete($contrato);
        
        echo $busca;
    }

    public function cadastro()
    {
        
        $representanteService = new RepresentanteService();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $contrato = new Contrato();

        if(Sessao::existeFormulario()) { 
     
        $clienteId = Sessao::retornaValorFormulario('cliente');
        $clienteLicitacao = $clienteLicitacaoService->listar($clienteId)[0];
        $contrato->setClienteLicitacao($clienteLicitacao);
       
        $representanteId = Sessao::retornaValorFormulario('representante');
        $representante = $representanteService->listar($representanteId)[0];
        $contrato->getEdital()->setRepresentante($representante);
        }else{    
        self::setViewParam('listarRepresentantes', $representanteService->listar());                 
            $contrato->setClienteLicitacao(new ClienteLicitacao());
            $contrato->setRepresentante(new Representante());
        }
        $this->setViewParam('contrato',$contrato);        
        $this->render('/contrato/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar()
    {
        $clienteLicitacaoService  = new ClienteLicitacaoService();        
        $usuarioService = new UsuarioService();        
        $representanteService = new RepresentanteService();        
        $instituicaoService = new InstituicaoService();        
        $clienteLicitacao         = $clienteLicitacaoService->listar($_POST['cliente']);
        $usuario        = $usuarioService->listar($_POST['ctrUsuario']);
        $instituicao     =   $instituicaoService->listar($_POST['fk_instituicao']);
        $representante    = $representanteService->listar($_POST['representante'])[0];
 /*
ctr_id, ctr_numero, ctr_datainicio,  ctr_datavencimento, ctr_valor, ctr_status, ctr_observacao, ctr_anexo, ctr_clientelicitacao, ctr_usuario, 
ctr_prazoentrega, ctr_prazopagamento, ctr_instituicao, ctr_datacadastro, ctr_dataalteracao
*/
        $contrato = new Contrato();
        $contrato->setCtrNumero($_POST['numeroContrato']);        
        $contrato->setCtrDataInicio($_POST['dataInicio']);        
        $contrato->setCtrDataVencimento($_POST['dataVencimento']);        
        $contrato->setCtrValor($_POST['valor']);        
        $contrato->setCtrStatus($_POST['status']);        
        $contrato->setCtrObservacao($_POST['observacao']);        
        $contrato->setCtrAnexo($_POST['anexo']);        
        $contrato->setCtrNumero($_POST['numeroLicitacao']);        
        $contrato->setCtrPrazoPagamento($_POST['prazoPagamento']);        
        $contrato->setCtrPrazoEntrega($_POST['prazoEntrega']);             
        $contrato->setCtrDataAlteracao($_POST['dataCadastro']);        
        $contrato->setCtrDataCadastro($_POST['dataCadastro']);        
        $contrato->setCtrGarantia($_POST['garantia']);        
        $contrato->setCtrAnalise($_POST['analise']);        
        $contrato->setClienteLicitacao($clienteLicitacao);
        $contrato->setInstituicao($instituicao);
        $contrato->setRepresentante($representante);
        $contrato->setUsuario($usuario);

        Sessao::gravaFormulario($_POST);

        $contratoValidador    = new ContratoValidador();
        $resultadoValidacao = $contratoValidador->validar($contrato);

        if ($resultadoValidacao->getErros()) {
           $this->redirect('/contrato/cadastro');
        }

        $contratoService = new EditalService();
    
       if($contratoService->salvar($contrato)){
            $this->redirect('/  contrato');
        }else{
            $this->redirect('/  contrato/cadastro');
        }

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function edicao($params)
    {
        $contratoId = $params[0];
        $representanteService = new RepresentanteService();
        $clienteLicitacaoService = new ClienteLicitacaoService();
        $contrato = new Edital();
        
        if(Sessao::existeFormulario()) { 
            $clienteId = Sessao::retornaValorFormulario('cliente');
            $clienteLicitacao = $clienteLicitacaoService->listar($clienteId)[0];
            $contrato->setClienteLicitacao($clienteLicitacao);
            
            $representanteId = Sessao::retornaValorFormulario('codRepresentante');
            $representante = $representanteService->listar($representanteId)[0];
            $contrato->setRepresentante($representante);
            
        }else{                       
            self::setViewParam('listarRepresentantes', $representanteService->listar());            
            $contratoService = new EditalService();
            $contrato = $contratoService->listar($contratoId)[0]; 
        }        
        if (!$contrato) {
            Sessao::gravaMensagem("Cadastro inexistente");
            $this->redirect('/  contrato');
        }
            
       $this->setViewParam('    contrato', $contrato);
       
        $this->render('/    contrato/editar');

        Sessao::limpaMensagem();
    }

    public function atualizar()
    {       
        $contrato = new Edital();

        $clienteLicitacaoService  = new ClienteLicitacaoService();        
        $usuarioService = new UsuarioService();        
        $representanteService = new RepresentanteService();        
        $instituicaoService = new InstituicaoService();        
        $clienteLicitacao         = $clienteLicitacaoService->listar($_POST['cliente']);
        $usuario        = $usuarioService->listar($_POST['edtUsuario']);
        $instituicao     =   $instituicaoService->listar($_POST['fk_instituicao']);
        $representante    = $representanteService->listar($_POST['representante'])[0];

        $contrato = new Edital();
        $contrato->setEdtId($_POST['codigo']);        
        $contrato->setEdtProposta($_POST['proposta']);        
        $contrato->setEdtNumero($_POST['numeroLicitacao']);        
        $contrato->setEdtValor($_POST['valor']);        
        $contrato->setEdtModalidade($_POST['modalidade']);        
        $contrato->setEdtStatus($_POST['status']);        
        $contrato->setEdtTipo($_POST['tipo']);        
        $contrato->setEdtHora($_POST['hora']);        
        $contrato->setEdtDataAlteracao($_POST['dataAbertura']);        
        $contrato->setEdtDataCadastro($_POST['dataCadastro']);        
        $contrato->setEdtDataAlteracao($_POST['dataAlteracao']);        
        $contrato->setEdtDataResultado($_POST['dataResultado']);        
        $contrato->setEdtGarantia($_POST['garantia']);        
        $contrato->setEdtAnalise($_POST['analise']); 
        $anexo =  $_POST['anexo'];
        if($anexo == ""){
            $contrato->setEdtAnexo($_POST['anexoAlt']);                    
        } else{
            $contrato->setEdtAnexo($_POST['anexo']);        
        }
        $contrato->setEdtObservacao($_POST['observacao']);        
        $contrato->setClienteLicitacao($clienteLicitacao);
        $contrato->setInstituicao($instituicao);
        $contrato->setRepresentante($representante);
        $contrato->setUsuario($usuario);

        Sessao::gravaFormulario($_POST);

        $contratoService = new EditalService();
    
        $contratoValidador = new EditalValidador();
        $resultadoValidacao = $contratoValidador->validar($contrato);
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            Sessao::gravaMensagem("erro na atualizacao");
            Sessao::gravaFormulario($_POST);
           $this->redirect('/   contrato/edicao/' . $_POST['codigo']);
        }
        
         if ($contratoService->Editar($contrato)) {
            $this->redirect('/  contrato');
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaErro();
           
        }else{
            Sessao::gravaFormulario($_POST);            
            Sessao::gravaMensagem("erro na atualizacao");
          $this->redirect('/    contrato/edicao/' . $_POST['codigo']);
        }

    }
    
    public function exclusao($params)
    {
        $cidId = $params[0];

        $contratoService = new EditalService();

        $contrato = $contratoService->listar($cidId)[0];

        if (!$contrato) {
        Sessao::gravaMensagem("Edital inexistente");
            $this->redirect('/  contrato');
        }

        self::setViewParam('    contrato', $contrato);

        $this->render('/    contrato/exclusao');

        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $contrato = new Edital();
        $contrato->setEdtId($_POST['codigo']);

        $contratoService= new EditalService();

        if (!$contratoService->excluir($contrato)) {
            Sessao::gravaMensagem("Edital inexistente");
            $this->redirect('/  contrato/exclusao'.$contrato->getEdtId());
        }

        Sessao::gravaMensagem("Edital excluido com sucesso!");

        $this->redirect('/  contrato');
    }

}
