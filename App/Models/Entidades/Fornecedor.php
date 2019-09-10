<?php
    
    
    namespace App\Models\Entidades;
    
    use DateTime;
    
    class Fornecedor
    {
        private $fornecedor_cod;
        private $razaoSocial;
        private $nomeFantasia;
        private $cnpj;
        private $dataCadastro;
    
        /**
         * @return mixed
         */
        public function getFornecedor_Cod()
        {
            return $this->fornecedor_cod;
        }
    
        /**
         * @param mixed $fornecedor_cod
         */
        public function setFornecedor_Cod($fornecedor_cod)
        {
            $this->fornecedor_cod = $fornecedor_cod;
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