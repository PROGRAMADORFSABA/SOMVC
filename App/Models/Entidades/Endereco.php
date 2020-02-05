<?php 

namespace App\Models\Entidades;

use DateTime;

abstract class Endereco
{

    private $endId;
    private $endLongradouro;
    private $endNumero;
    private $endBairro;
    private $endComplemento;
    private $endPontoReferencia;
    private $endCep;
    private $endDataCadastro;
    private $endDataAlteracao;
    private $endCidade;
    private $endPessoa;
    private $estado;
    private $enderecoCliente;


/*
    public function __construct()
    {
        $this->enderecoCliente = new EnderecoCliente();
    }
*/

    /**
     * Get the value of endId
     */ 
    public function getEndId()
    {
        return $this->endId;
    }

    /**
     * Set the value of endId
     *
     * @return  self
     */ 
    public function setEndId($endId)
    {
        $this->endId = $endId;

        return $this;
    }

    /**
     * Get the value of endLongradouro
     */ 
    public function getEndLongradouro()
    {
        return $this->endLongradouro;
    }

    /**
     * Set the value of endLongradouro
     *
     * @return  self
     */ 
    public function setEndLongradouro($endLongradouro)
    {
        $this->endLongradouro = $endLongradouro;

        return $this;
    }

    /**
     * Get the value of endNumero
     */ 
    public function getEndNumero()
    {
        return $this->endNumero;
    }

    /**
     * Set the value of endNumero
     *
     * @return  self
     */ 
    public function setEndNumero($endNumero)
    {
        $this->endNumero = $endNumero;

        return $this;
    }

    /**
     * Get the value of endCep
     */ 
    public function getEndCep()
    {
        return $this->endCep;
    }

    /**
     * Set the value of endCep
     *
     * @return  self
     */ 
    public function setEndCep($endCep)
    {
        $this->endCep = $endCep;

        return $this;
    }

    /**
     * Get the value of endCidade
     */ 
    public function getEndCidade()
    {
        return $this->endCidade;
    }

    /**
     * Set the value of endCidade
     *
     * @return  self
     */ 
    public function setEndCidade(Cidade $endCidade)
    {
        $this->endCidade = $endCidade;

        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of enderecoCliente
     */ 
    public function getEnderecoCliente()
    {
        return $this->enderecoCliente;
    }

    /**
     * Get the value of endBairro
     */ 
    public function getEndBairro()
    {
        return $this->endBairro;
    }

    /**
     * Set the value of endBairro
     *
     * @return  self
     */ 
    public function setEndBairro($endBairro)
    {
        $this->endBairro = $endBairro;

        return $this;
    }

    /**
     * Get the value of endDataCadastro
     */ 
    public function getEndDataCadastro()
    {
        return new DateTime($this->endDataCadastro);
    }

    /**
     * Set the value of endDataCadastro
     *
     * @return  self
     */ 
    public function setEndDataCadastro($endDataCadastro)
    {
        $this->endDataCadastro = $endDataCadastro;

        return $this;
    }

    /**
     * Get the value of endDataAlteracao
     */ 
    public function getEndDataAlteracao()
    {
        return new DateTime($this->endDataAlteracao);
    }

    /**
     * Set the value of endDataAlteracao
     *
     * @return  self
     */ 
    public function setEndDataAlteracao($endDataAlteracao)
    {
        $this->endDataAlteracao = $endDataAlteracao;

        return $this;
    }

    /**
     * Get the value of endComplemento
     */ 
    public function getEndComplemento()
    {
        return $this->endComplemento;
    }

    /**
     * Set the value of endComplemento
     *
     * @return  self
     */ 
    public function setEndComplemento($endComplemento)
    {
        $this->endComplemento = $endComplemento;

        return $this;
    }

    /**
     * Get the value of endPontoReferencia
     */ 
    public function getEndPontoReferencia()
    {
        return $this->endPontoReferencia;
    }

    /**
     * Set the value of endPontoReferencia
     *
     * @return  self
     */ 
    public function setEndPontoReferencia($endPontoReferencia)
    {
        $this->endPontoReferencia = $endPontoReferencia;

        return $this;
    }

    /**
     * Get the value of endPessoa
     */ 
    public function getEndPessoa()
    {
        return $this->endPessoa;
    }

    /**
     * Set the value of endPessoa
     *
     * @return  self
     */ 
    public function setEndPessoa($endPessoa)
    {
        $this->endPessoa = $endPessoa;

        return $this;
    }
}



?>