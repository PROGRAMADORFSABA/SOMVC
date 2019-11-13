<?php
    
    
    namespace App\Models\Entidades;
    
    use App\Models\Entidades\ClienteLicitacao;
    use App\Models\Entidades\StatusLicitacao;
    use App\Models\Entidades\Fornecedor;
    use DateTime;
    
    
    class PedidoFalta
    {
        private $faltaCliente_cod;
        private $proposta;
        private $AFM;
        private $observacao;
        private $dataFalta;
        private $fk_produto;
        private $fk_cliente;
        private $fk_marca;
        private $fk_status;
        private $fkproduto;



   
        /**
         * @return mixed
         */
        public function getFaltaClienteCod()
        {
            return $this->faltaCliente_cod;
        }
    
        /**
         * @param mixed $faltaCliente_cod
         */
        public function setFaltaClienteCod($faltaCliente_cod): void
        {
            $this->faltaCliente_cod = $faltaCliente_cod;
        }
    
        /**
         * @return mixed
         */
        public function getProposta()
        {
            return $this->proposta;
        }
    
        /**
         * @param mixed $proposta
         */
        public function setProposta($proposta): void
        {
            $this->proposta = $proposta;
        }
    
        /**
         * @return mixed
         */
        public function getAFM()
        {
            return $this->AFM;
        }
    
        /**
         * @param mixed $AFM
         */
        public function setAFM($AFM): void
        {
            $this->AFM = $AFM;
        }
    
        /**
         * @return mixed
         */
        public function getObservacao()
        {
            return $this->observacao;
        }
    
        /**
         * @param mixed $observacao
         */
        public function setObservacao($observacao): void
        {
            $this->observacao = $observacao;
        }
    
        /**
         * @return mixed
         * @throws \Exception
         */
        public function getDataFalta()
        {
            return new DateTime($this->dataFalta);
        }
    
        /**
         * @param mixed $dataFalta
         */
        public function setDataFalta($dataFalta): void
        {
            $this->dataFalta = $dataFalta;
        }
    
        /**
         * @return mixed
         */
        public function getFkCliente(): ClienteLicitacao
        {
            return $this->fk_cliente;
        }
    
        /**
         * @param mixed $fk_cliente
         */
        public function setFkCliente(ClienteLicitacao $fk_cliente): void
        {
            $this->fk_cliente = $fk_cliente;
        }

        public function getFkProduto(): Produto
        {
            return $this->fkproduto;
        }

        public function setFkProduto(Produto $fkproduto): void
        {
            $this->fkproduto = $fkproduto;
        }
    
    
        /**
         * @return mixed
         */
        public function getFk_Produto() : array
        {
            return $this->fk_produto;
        }
    
        /**
         * @param mixed $fk_produto
         */
        public function setFk_Produto(array $fk_produto)
        {
            $this->fk_produto = $fk_produto;
        }
    
        /**
         * @return mixed
         */
        public function getFkMarca() : Fornecedor
        {
            return $this->fk_marca;
        }
    
        /**
         * @param mixed $fk_marca
         */
        public function setFkMarca(Fornecedor $fk_marca): void
        {
            $this->fk_marca = $fk_marca;
        }
    
        /**
         * @return mixed
         */
        public function getFkStatus() : StatusLicitacao
        {
            return $this->fk_status;
        }
    
        /**
         * @param mixed $fk_status
         */
        public function setFkStatus(StatusLicitacao $fk_status): void
        {
            $this->fk_status = $fk_status;
        }

        
        
    }