<?php 

namespace App\Models\Entidades;

use DateTime;

class Pedido{

    private $codControle;
    private $dataCadastro;
    private $numeroLicitacao;
    private $numeroAF;
    private $valorPedido;
    private $codStatus;
    private $codCliente;
    private $anexo;
    private $observacao;
    private $codRepresentante;
    private $fk_instituicao;
    private $dataFechamento;
    private $dataAlteracao;
    private $somaPedido;
    private $status;
    private $cliente;
    private $usuario;
    private $representante;
    private $instituicao;
    private $clienteLicitacao;  
       
    /**
     * @return mixed
     */
    public function getCodControle()
    {
        return $this->codControle;
    }

    /**
     * @param mixed $codControle
     */
    public function setCodControle($codControle)
    {
        $this->codControle = $codControle;
    }

    /**
     * @return mixed
     */
    public function getNumeroLicitacao()
    {
        return $this->numeroLicitacao;
    }

    /**
     * @param mixed $numeroLicitacao
     */
    public function setNumeroLicitacao($numeroLicitacao)
    {
        $this->numeroLicitacao = $numeroLicitacao;
    }

    /**
     * @return mixed
     */
    public function getNumeroAF()
    {
        return $this->numeroAF;
    }

    /**
     * @param mixed $numeroAF
     */
    public function setNumeroAF($numeroAF)
    {
        $this->numeroAF = $numeroAF;
    }

    /**
     * @return mixed
     */
    public function getValorPedido()
    {
        return $this->valorPedido;
    }

    /**
     * @param mixed $valorPedido
     */
    public function setValorPedido($valorPedido)
    {
        $this->valorPedido = $valorPedido;
    }
    /**
     * @param mixed $valorPedido
     */
    public function setSomaPedido($somaPedido)
    {
        $this->somaPedido = $somaPedido;
    }
    public function getSomaPedido()
    {
        return $this->somaPedido;
    }

    /**
     * @return mixed
     */
    public function getAnexo()
    {
        return $this->anexo;
    }

    /**
     * @param mixed $anexo
     */
    public function setAnexo($anexo)
    {
        $this->anexo = $anexo;
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


    /**
     * Get the value of dataAlteracao
     */ 
    public function getDataAlteracao()
    {
        return $this->dataAlteracao;
    }

    /**
     * Set the value of dataAlteracao
     *
     * @return  self
     */ 
    public function setDataAlteracao($dataAlteracao)
    {
        $this->dataAlteracao = $dataAlteracao;

        return $this;
    }

    /**
     * Get the value of dataFechamento
     */ 
    public function getDataFechamento()
    {
        return $this->dataFechamento;
    }

    /**
     * Set the value of dataFechamento
     *
     * @return  self
     */ 
    public function setDataFechamento($dataFechamento)
    {
        $this->dataFechamento = $dataFechamento;

        return $this;
    }

    /**
     * Get the value of codStatus
     */ 
    public function getCodStatus()
    {
        return $this->codStatus;
    }

    /**
     * Set the value of codStatus
     *
     * @return  self
     */ 
    public function setCodStatus($codStatus)
    {
        $this->codStatus = $codStatus;

        return $this;
    }

    /**
     * Get the value of cliente
     */ 
    public function getCliente()
    {
        return $this->cliente;
    }
    
    

    /**
     * Get the value of codCliente
     */ 
    public function getCodCliente()
    {
        return $this->codCliente;
    }

    /**
     * Set the value of codCliente
     *
     * @return  self
     */ 
    public function setCodCliente($codCliente)
    {
        $this->codCliente = $codCliente;

        return $this;
    }

    /**
     * Get the value of observacao
     */ 
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * Set the value of observacao
     *
     * @return  self
     */ 
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * Get the value of fk_instituicao
     */ 
    public function getFk_instituicao()
    {
        return $this->fk_instituicao;
    }

    /**
     * Set the value of fk_instituicao
     *
     * @return  self
     */ 
    public function setFk_instituicao($fk_instituicao)
    {
        $this->fk_instituicao = $fk_instituicao;

        return $this;
    }
     /**
     * Get the value of clienteLicitacao
     */ 
    public function getClienteLicitacao()
    {
        return $this->clienteLicitacao;
    }

    /**
     * Set the value of clienteLicitacao
     *
     * @return  self
     */ 
    public function setClienteLicitacao(ClienteLicitacao $clienteLicitacao)
    {
        $this->clienteLicitacao = $clienteLicitacao;

        return $this;
    }
     /**
     * Get the value of Representante
     */ 
    public function getRepresentante()
    {
        return $this->representante;
    }

    /**
     * Set the value of representante
     *
     * @return  self
     */ 
    public function setRepresentante(Representante $representante)
    {
        $this->representante = $representante;

        return $this;
    }
     /**
     * Get the value of instituicao
     */ 
    public function getInstituicao()
    {
        return $this->instituicao;
    }

    /**
     * Set the value of instituicao
     *
     * @return  self
     */ 
    public function setInstituicao(Instituicao $instituicao)
    {
        $this->instituicao = $instituicao;

        return $this;
    }
     /**
     * Get the value of usuario
     */ 
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */ 
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }
     /**
     * Get the value of staus
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */ 
    public function setStatus(Status $status)
    {
        $this->status = $status;

        return $this;
    }


}