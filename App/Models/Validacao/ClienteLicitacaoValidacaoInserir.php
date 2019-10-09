<?php
    
    
    namespace App\Models\Validacao;
    
    
    use App\Models\Entidades\ClienteLicitacao;

    class ClienteLicitacaoValidacaoInserir
    {
        public function validar(ClienteLicitacao $clienteLicitacao)
        {
            $clienteLicitacaoDAO = new ClienteLicitacao();
            $resultadoValidacao = new ResultadoValidacao();
            
            if(empty($clienteLicitacao->getRazaoSocial()))
            {
                $resultadoValidacao->addErro('razaosocial', "<b>Razão Socail</b> Este campo não vazio");
            }
            
            if(empty($clienteLicitacao->getNomeFantasia()))
            {
                $resultadoValidacao->addErro('nomefantasia', "<b>Nome Fantasia</b> Este campo não pode ser vazio");
            }
            
            if(empty($clienteLicitacao->getCnpj()))
            {
                $resultadoValidacao->addErro('cnpj',"<b>CNPJ</b> Este campo não pode ser vazio");
            }
            
            if(empty($clienteLicitacao->getTipoCliente()))
            {
                $resultadoValidacao->addErro('tipocliente',"<b>Tipo Cliente</b> Este campo não pode ser vazio");
            }
        }
    }