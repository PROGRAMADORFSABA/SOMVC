<?php
 namespace App\Models\Entidades;

 use DateTime;

 class Contrato{
/*
ctr_id, ctr_numero, ctr_datainicio,  ctr_datavencimento, ctr_valor, ctr_status, ctr_observacao, ctr_anexo, ctr_clientelicitacao, ctr_usuario, 
ctr_prazopagamento, ctr_prazopagamento, ctr_instituicao, ctr_datacadastro, ctr_dataalteracao
*/
    private $ctrId;
    private $ctrNumero;    
    private $ctrDataInicio;
    private $ctrDataVencimento;     
    private $ctrValor;
    private $ctrStatus;
    private $ctrObservacao;
    private $ctrAnexo;
    private $ctrDataCadastro;
    private $ctrDataAlteracao;
    private $usuario;
    private $instituicao;
    private $edital;
    private $ctrInstituicao;
    private $ctrPrazoEntrega;
    private $ctrPrazoPagamento; 
    private $clienteLicitacao;
    private $ctrCliente;
    
         /**
         * Set the value of ctrPrazoEntrega
         *
         * @return  self
         */ 
        public function getCtrPrazoEntrega()
        {
                return $this->ctrPrazoEntrega;
        }

        public function setCtrPrazoEntrega($ctrPrazoEntrega)        {
                $this->ctrPrazoEntrega = $ctrPrazoEntrega;
                return $this;
        }
         /**
         * Set the value of ctrPrazoPagamento
         *
         * @return  self
         */ 
        public function getCtrPrazoPagamento()
        {
                return $this->ctrPrazoPagamento;
        }

        public function setCtrPrazoPagamento($ctrPrazoPagamento)        {
                $this->ctrPrazoPagamento = $ctrPrazoPagamento;
                return $this;
        }
         /**
         * Set the value of ctrId
         *
         * @return  self
         */ 
        public function getCtrId()
        {
                return $this->ctrId;
        }

        public function setCtrId($ctrId)        {
                $this->ctrId = $ctrId;
                return $this;
        }
        
        /**
         * Set the value of ctrNumero
         *
         * @return  self
         */ 
        public function setCtrNumero($ctrNumero)        {
                $this->ctrNumero = $ctrNumero;
                return $this;
        }
        public function getCtrNumero()
        {
                return $this->ctrNumero;
        }
         /**
         * Set the value of ctrCliente
         *
         * @return  self
         */ 
        public function getCtrClienteLicitacao()
        {
                return $this->ctrClienteLicitacao;
        }

        public function setCtrClienteLicitacao($ctrClienteLicitacao)   {
                $this->CtrclienteLicitacao = $ctrClienteLicitacao;
                return $this;
        }
         /**
         * Set the value of ctrInstituicao
         *
         * @return  self
         */ 
        public function getCtrInstituicao()
        {
                return $this->ctrInstituicao;
        }

        public function setCtrInstituicao($ctrInstituicao)        {
                $this->ctrInstituicao = $ctrInstituicao;
                return $this;
        }
         /**
         * Set the value of ctrValor
         *
         * @return  self
         */ 
        public function getCtrValor()
        {
                return $this->ctrValor;
        }

        public function setCtrValor($ctrValor)        {
                $this->ctrValor = $ctrValor;
                return $this;
        }
         
         /**
         * Set the value of ctrObservacao
         *
         * @return  self
         */ 
        public function getCtrObservacao()
        {
                return $this->ctrObservacao;
        }

        public function setCtrObservacao($ctrObservacao)        {
                $this->ctrObservacao = $ctrObservacao;
                return $this;
        }
         /**
         * Set the value of ctrAnexo
         *
         * @return  self
         */ 
        public function getCtrAnexo()
        {
                return $this->ctrAnexo;
        }

        public function setCtrAnexo($ctrAnexo)        {
                $this->ctrAnexo = $ctrAnexo;
                return $this;
        }        
        
         /**
         * Set the value of ctrStatus
         *
         * @return  self
         */ 
        public function getCtrStatus()
        {
                return $this->ctrStatus;
        }

        public function setCtrStatus($ctrStatus)        {
                $this->ctrStatus = $ctrStatus;
                return $this;
        }
        
        
        /**
         * Set the value of ctrDataAlteracao
         *
         * @return  self
         */ 
       
        public function getCtrDataAlteracao()
        {
                return new DateTime($this->ctrDataAlteracao);
        }
        public function setCtrDataAlteracao($ctrDataAlteracao)
        {
                $this->ctrDataAlteracao = $ctrDataAlteracao;

                return $this;
        }
        /**
         * Set the value of ctrDataCadastro
         *
         * @return  self
         */ 
        public function getCtrDataCadastro()
        {
                return new DateTime($this->ctrDataCadastro);
        }

        public function setCtrDataCadastro($ctrDataCadastro)
        {
                $this->ctrDataCadastro = $ctrDataCadastro;

                return $this;
        }
        /**
         * Set the value of ctrDataInicio
         *
         * @return  self
         */ 
        public function getCtrDataInicio()
        {
                return new DateTime($this->ctrDataInicio);
        }

        public function setCtrDataInicio($ctrDataInicio)
        {
                $this->ctrDataInicio = $ctrDataInicio;

                return $this;
        }
        
        /**
         * Set the value of Instituicao
         *
         * @return  self
         */ 
         public function getInstituicao() {
            return $this->instituicao;
        }
    
        public function setInstituicao(Instituicao $instituicao) {
            $this->instituicao = $instituicao;
        }
        /**
         * Set the value of ClienteLicitacao
         *
         * @return  self
         */ 
        public function getClienteLicitacao() {
                return $this->clienteLicitacao;
        }
        
        public function setClienteLicitacao(ClienteLicitacao $clienteLicitacao) {
                $this->clienteLicitacao = $clienteLicitacao;
        }
        /**
         * Set the value of Usuario
         *
         * @return  self
         */ 

        public function getUsuario() {
                return $this->usuario;
        }
        
        public function setUsuario(Usuario $usuario) {
                $this->usuario = $usuario;
        }
        /**
         * Set the value of Edital
         *
         * @return  self
         */ 

        public function getEdital() {
                return $this->edital;
        }
        
        public function setEdital(Edital $edital) {
                $this->edital = $edital;
        }
 }

?>