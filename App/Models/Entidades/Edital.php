<?php
 namespace App\Models\Entidades;

 use DateTime;

 class Edital{
/*
edt_id, edt_numero, edt_dataabertura, edt_hora, edt_dataresultado,  edt_proposta, edt_modalidade, 
edt_tipo, edt_garantia, edt_valor, edt_tatus, edt_analise, edt_observacao, edt_anexo, 
edt_representante, edt_cliente, edt_usuario, edt_instituicao, edt_datacadastro, edt_dataalteracao
*/
    private $edtId;
    private $edtNumero;    
    private $edtDataAbertura;
    private $edtHora;
    private $edtDataResultado;
    private $edtProposta;
    private $edtModalidade;
    private $edtTipo;
    private $edtGarantia;
    private $edtValor;
    private $edtStatus;
    private $edtAnalise;
    private $edtObservacao;
    private $edtAnexo;
    private $edtDataCadastro;
    private $edtDataAlteracao;
    private $usuario;
    private $instituicao;
    private $edtInstituicao;
    private $representante;
    private $clienteLicitacao;
    private $edtCliente;

         /**
         * Set the value of edtCliente
         *
         * @return  self
         */ 
        public function getEdtCliente()
        {
                return $this->edtCliente;
        }

        public function setEdtCliente($edtCliente)        {
                $this->edtCliente = $edtCliente;
                return $this;
        }
         /**
         * Set the value of edtInstituicao
         *
         * @return  self
         */ 
        public function getEdtInstituicao()
        {
                return $this->edtInstituicao;
        }

        public function setEdtInstituicao($edtInstituicao)        {
                $this->edtInstituicao = $edtInstituicao;
                return $this;
        }
         /**
         * Set the value of edtValor
         *
         * @return  self
         */ 
        public function getEdtValor()
        {
                return $this->edtValor;
        }

        public function setEdtValor($edtValor)        {
                $this->edtValor = $edtValor;
                return $this;
        }
         /**
         * Set the value of edtAnalise
         *
         * @return  self
         */ 
        public function getEdtAnalise()
        {
                return $this->edtAnalise;
        }

        public function setEdtAnalise($edtAnalise)        {
                $this->edtAnalise = $edtAnalise;
                return $this;
        }
         /**
         * Set the value of edtObservacao
         *
         * @return  self
         */ 
        public function getEdtObservacao()
        {
                return $this->edtObservacao;
        }

        public function setEdtObservacao($edtObservacao)        {
                $this->edtObservacao = $edtObservacao;
                return $this;
        }
         /**
         * Set the value of edtAnexo
         *
         * @return  self
         */ 
        public function getEdtAnexo()
        {
                return $this->edtAnexo;
        }

        public function setEdtAnexo($edtAnexo)        {
                $this->edtAnexo = $edtAnexo;
                return $this;
        }
         /**
         * Set the value of edtModalidade
         *
         * @return  self
         */ 
        public function getEdtModalidade()
        {
                return $this->edtModalidade;
        }

        public function setEdtModalidade($edtModalidade)        {
                $this->edtModalidade = $edtModalidade;
                return $this;
        }
         /**
         * Set the value of edtTipo
         *
         * @return  self
         */ 
        public function getEdtTipo()
        {
                return $this->edtTipo;
        }

        public function setEdtTipo($edtTipo)        {
                $this->edtTipo = $edtTipo;
                return $this;
        }
         /**
         * Set the value of edtGarantia
         *
         * @return  self
         */ 
        public function getEdtGarantia()
        {
                return $this->edtGarantia;
        }

        public function setEdtGarantia($edtGarantia)        {
                $this->edtGarantia = $edtGarantia;
                return $this;
        }
         /**
         * Set the value of edtStatus
         *
         * @return  self
         */ 
        public function getEdtStatus()
        {
                return $this->edtStatus;
        }

        public function setEdtStatus($edtStatus)        {
                $this->edtStatus = $edtStatus;
                return $this;
        }
         /**
         * Set the value of edtProposta
         *
         * @return  self
         */ 
        public function getEdtProposta()
        {
                return $this->edtProposta;
        }

        public function setEdtProposta($edtProposta)        {
                $this->edtProposta = $edtProposta;
                return $this;
        }
         /**
         * Set the value of edtId
         *
         * @return  self
         */ 
        public function getEdtId()
        {
                return $this->edtId;
        }

        public function setEdtId($edtId)        {
                $this->edtId = $edtId;
                return $this;
        }
        
        /**
         * Set the value of edtNumero
         *
         * @return  self
         */ 
        public function setEdtNumero($edtNumero)        {
                $this->edtNumero = $edtNumero;
                return $this;
        }
        public function getEdtNumero()
        {
                return $this->edtNumero;
        }
        
        /**
         * Set the value of edtDataAlteracao
         *
         * @return  self
         */ 
       
        public function getEdtDataAlteracao()
        {
                return new DateTime($this->edtDataAlteracao);
        }
        public function setEdtDataAlteracao($edtDataAlteracao)
        {
                $this->edtDataAlteracao = $edtDataAlteracao;

                return $this;
        }
        /**
         * Set the value of edtDataCadastro
         *
         * @return  self
         */ 
        public function getEdtDataCadastro()
        {
                return new DateTime($this->edtDataCadastro);
        }

        public function setEdtDataCadastro($edtDataCadastro)
        {
                $this->edtDataCadastro = $edtDataCadastro;

                return $this;
        }
        /**
         * Set the value of edtDataAbertura
         *
         * @return  self
         */ 
        public function getEdtDataAbertura()
        {
                return new DateTime($this->edtDataAbertura);
        }

        public function setEdtDataAbertura($edtDataAbertura)
        {
                $this->edtDataAbertura = $edtDataAbertura;

                return $this;
        }
        /**
         * Set the value of edtDataResultado
         *
         * @return  self
         */ 
        public function getEdtDataResultado()
        {
                return new DateTime($this->edtDataResultado);
        }

        public function setEdtDataResultado($edtDataResultado)
        {
                $this->edtDataResultado = $edtDataResultado;

                return $this;
        }
        /**
         * Set the value of edtHora
         *
         * @return  self
         */ 
        public function getEdtHora()
        {
                return new DateTime($this->edtHora);
        }

        public function setEdtHora($edtHora)
        {
                $this->edtHora = $edtHora;

                return $this;
        }
        /**
         * Set the value of Representante
         *
         * @return  self
         */ 

        public function getRepresentante() {
            return $this->representante;
        }
    
        public function setRepresentante(Representante $representante) {
            $this->representante = $representante;
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
 }

?>