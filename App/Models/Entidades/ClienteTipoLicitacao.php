<?php


namespace App\Models\Entidades;

use DateTime;

class ClienteTipoLicitacao
{

    private $codTipoCliente;
    private $tpcDescricao;
    private $tpcStatus;
    private $tpcDataCadastro;
    private $tpcDataAlteracao;
    
    public function getTipoCliente()   {
        return $this->tipoCliente;
    }
    
    /**
     * @return mixed
     */
    public function getCodCliente()
    {
        return $this->codCliente;
    }

   
    public function getTpcDataCadastro()
    {
        return new DateTime($this->tpcDataCadastro);
    }

    /**
     * @param mixed $dataCadastro
     */
    public function setTpcDataCadastro($tpcDataCadastro)
    {
        $this->tpcDataCadastro = $tpcDataCadastro;
    }
    
    public function getTpcDataAlteracao()
    {
        return new DateTime($this->tpcDataAlteracao);
    }

    /**
     * @param mixed $dataAlteracao
     */
    public function setTpcDataAlteracao($tpcDataAlteracao)
    {
        $this->tpcDataAlteracao = $tpcDataAlteracao;
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
     * Get the value of sugusuario
     */ 
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of sugusuario
     *
     * @return  self
     */ 
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }


    /**
     * Get the value of tpcDescricao
     */ 
    public function getTpcDescricao()
    {
        return $this->tpcDescricao;
    }

    /**
     * Set the value of tpcDescricao
     *
     * @return  self
     */ 
    public function setTpcDescricao($tpcDescricao)
    {
        $this->tpcDescricao = $tpcDescricao;

        return $this;
    }

    /**
     * Get the value of tpcStatus
     */ 
    public function getTpcStatus()
    {
        return $this->tpcStatus;
    }

    /**
     * Set the value of tpcStatus
     *
     * @return  self
     */ 
    public function setTpcStatus($tpcStatus)
    {
        $this->tpcStatus = $tpcStatus;

        return $this;
    }

    /**
     * Get the value of codTipoCliente
     */ 
    public function getCodTipoCliente()
    {
        return $this->codTipoCliente;
    }

    /**
     * Set the value of codTipoCliente
     *
     * @return  self
     */ 
    public function setCodTipoCliente($codTipoCliente)
    {
        $this->codTipoCliente = $codTipoCliente;

        return $this;
    }
}