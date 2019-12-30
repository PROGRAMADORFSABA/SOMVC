<?php
 namespace App\Models\Entidades;

 use DateTime;

 class ContratoStatus{

    private $stCtrId;
    private $stCtrNome;   
    private $stCtrObservacao;
    private $stCtrDataCadastro;
    private $stCtrDataAlteracao;
    private $stCtrUsuario;
    private $stCtrInstituicao;

                 /**
         * Set the value of stCtrInstituicao
         *
         * @return  self
         */ 
        public function setStCtrInstituicao()
        {
                return $this->stCtrInstituicao;
        }

        public function getStCtrInstituicao($stCtrInstituicao)        {
                $this->stCtrInstituicao = $stCtrInstituicao;
                return $this;
        }
         
         /**
         * Set the value of stCtrObservacao
         *
         * @return  self
         */ 
        public function getStCtrObservacao()
        {
                return $this->stCtrObservacao;
        }

        public function setStCtrObservacao($stCtrObservacao)        {
                $this->stCtrObservacao = $stCtrObservacao;
                return $this;
        }
         /**
         * Set the value of stCtrId
         *
         * @return  self
         */ 
        public function getStCtrId()
        {
                return $this->stCtrId;
        }

        public function setStCtrId($ststCtrId)        {
                $this->stCtrId = $ststCtrId;
                return $this;
        }
        
        /**
         * Set the value of stCtrNome
         *
         * @return  self
         */ 
        public function setStCtrNome($stCtrNome)        {
                $this->stCtrNome = $stCtrNome;
                return $this;
        }
        public function getStCtrNome()
        {
                return $this->stCtrNome;
        }
        
        /**
         * Set the value of stCtrDataAlteracao
         *
         * @return  self
         */ 
       
        public function getStCtrDataAlteracao()
        {
                return new DateTime($this->stCtrDataAlteracao);
        }
        public function setStCtrDataAlteracao($stCtrDataAlteracao)
        {
                $this->stCtrDataAlteracao = $stCtrDataAlteracao;

                return $this;
        }
        /**
         * Set the value of stCtrDataCadastro
         *
         * @return  self
         */ 
        public function getStCtrDataCadastro()
        {
                return new DateTime($this->stCtrDataCadastro);
        }

        public function setStCtrDataCadastro($stCtrDataCadastro)
        {
                $this->stCtrDataCadastro = $stCtrDataCadastro;

                return $this;
        }
       
        /**
         * Set the value of stCtrUsuario
         *
         * @return  self
         */ 

        public function getStCtrUsuario() {
                return $this->stCtrUsuario;
        }
        
        public function setStCtrUsuario(Usuario $stCtrUsuario) {
                $this->stCtrUsuario = $stCtrUsuario;
        }
 }

?>