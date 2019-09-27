<?php
    
    
    namespace App\Models\Entidades;
    
    use DateTime;
    
    class Estado
    {
        private $estId;
        private $estNome;        
        private $dataCadastro;
        
        /**
         * @return mixed
         */
        public function getEstId()
        {
            return $this->estId;
        }
    
        /**
         * @param mixed $estId
         */
        public function setEstId($estId)
        {
            $this->estId = $estId;
        }
    
        /**
         * @return mixed
         */
        public function getEstNome()
        {
            return $this->estNome;
        }
    
        /**
         * @param mixed $estNome
         */
        public function setEstNome($estNome)
        {
            $this->estNome = $estNome;
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