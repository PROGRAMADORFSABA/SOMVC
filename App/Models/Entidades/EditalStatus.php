<?php
 namespace App\Models\Entidades;

 use DateTime;

 class EditalStatus{

    private $stEdtId;
    private $stEdtNome;   
    private $stEdtObservacao;
    private $stEdtDataCadastro;
    private $stEdtDataAlteracao;
    private $stEdtUsuario;
    private $stEdtInstituicao;

                 /**
         * Set the value of stEdtInstituicao
         *
         * @return  self
         */ 
        public function setStEdtInstituicao()
        {
                return $this->stEdtInstituicao;
        }

        public function getStEdtInstituicao($stEdtInstituicao)        {
                $this->stEdtInstituicao = $stEdtInstituicao;
                return $this;
        }
         /**
         * Set the value of edtValor
         *
         * @return  self
         */ 
         /**
         * Set the value of stEdtObservacao
         *
         * @return  self
         */ 
        public function getStEdtObservacao()
        {
                return $this->stEdtObservacao;
        }

        public function setStEdtObservacao($stEdtObservacao)        {
                $this->stEdtObservacao = $stEdtObservacao;
                return $this;
        }
         /**
         * Set the value of stEdtId
         *
         * @return  self
         */ 
        public function getStEdtId()
        {
                return $this->stEdtId;
        }

        public function setStEdtId($ststEdtId)        {
                $this->stEdtId = $ststEdtId;
                return $this;
        }
        
        /**
         * Set the value of stEdtNome
         *
         * @return  self
         */ 
        public function setStEdtNome($stEdtNome)        {
                $this->stEdtNome = $stEdtNome;
                return $this;
        }
        public function getStEdtNome()
        {
                return $this->stEdtNome;
        }
        
        /**
         * Set the value of stEdtDataAlteracao
         *
         * @return  self
         */ 
       
        public function getStEdtDataAlteracao()
        {
                return new DateTime($this->stEdtDataAlteracao);
        }
        public function setStEdtDataAlteracao($stEdtDataAlteracao)
        {
                $this->stEdtDataAlteracao = $stEdtDataAlteracao;

                return $this;
        }
        /**
         * Set the value of stEdtDataCadastro
         *
         * @return  self
         */ 
        public function getStEdtDataCadastro()
        {
                return new DateTime($this->stEdtDataCadastro);
        }

        public function setStEdtDataCadastro($stEdtDataCadastro)
        {
                $this->stEdtDataCadastro = $stEdtDataCadastro;

                return $this;
        }
        
        /**
         * Set the value of stEdtUsuario
         *
         * @return  self
         */ 

        public function getStEdtUsuario() {
                return $this->stEdtUsuario;
        }
        
        public function setStEdtUsuario(Usuario $stEdtUsuario) {
                $this->stEdtUsuario = $stEdtUsuario;
        }
 }

?>