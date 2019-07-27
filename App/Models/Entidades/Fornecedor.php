<?php
    
    
    namespace App\Models\Entidades;
    
    use DateTime;
    
    class Fornecedor
    {
        private $codFornecedor;
        private $razaoSocial;
        private $nomeFantasia;
        private $cnpj;
        private $dataCadastro;
    
        /**
         * @return mixed
         */
        public function getCodFornecedor()
        {
            return $this->codFornecedor;
        }
    
        /**
         * @param mixed $codFornecedor
         */
        public function setCodFornecedor($codFornecedor)
        {
            $this->codFornecedor = $codFornecedor;
        }
    
        /**
         * @return mixed
         */
        public function getRazaoSocial()
        {
            return $this->razaoSocial;
        }
    
        /**
         * @param mixed $razaoSocial
         */
        public function setRazaoSocial($razaoSocial)
        {
            $this->razaoSocial = $razaoSocial;
        }
    
        /**
         * @return mixed
         */
        public function getNomeFantasia()
        {
            return $this->nomeFantasia;
        }
    
        /**
         * @param mixed $nomeFantasia
         */
        public function setNomeFantasia($nomeFantasia)
        {
            $this->nomeFantasia = $nomeFantasia;
        }
    
        /**
         * @return mixed
         */
        public function getCnpj()
        {
            return $this->cnpj;
        }
    
        /**
         * @param mixed $cnpj
         */
        public function setCnpj($cnpj)
        {
            $this->cnpj = $cnpj;
        }
    
        /**
         * @return mixed
         * @throws \Exception
         */
        public function getDataCadastro()
        {
            return new DateTime($this->dataCadastro);
        }
    
        /**
         * @param mixed $dataCadastro
         */
        public function setDataCadastro($dataCadastro)
        {
            $this->dataCadastro = $dataCadastro;
        }
        
    }