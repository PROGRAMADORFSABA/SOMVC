<?php

namespace App\Models\Entidades;

use DateTime;

class Transportadora extends Endereco
{
    private $traId;
    private $traRazaoSocial;
    private $traNomeFantasia;
    private $traCnpj;
    private $traIE;
    private $traEmail;
    private $traContato;
    private $traTelefone;
    private $traCelular;
    private $traObservacao;
    private $traStatus;
    private $traPessoa;
    private $traDataCadastro;
    private $traDataAlteracao;
    private $traUsuario;
    private $traInstituicao;

    /**
     * Get the value of traId
     */ 
    public function getTraId()
    {
        return $this->traId;
    }

    /**
     * Set the value of traId
     *
     * @return  self
     */ 
    public function setTraId($traId)
    {
        $this->traId = $traId;

        return $this;
    }

    /**
     * Get the value of traRazaoSocial
     */ 
    public function getTraRazaoSocial()
    {
        return $this->traRazaoSocial;
    }

    /**
     * Set the value of traRazaoSocial
     *
     * @return  self
     */ 
    public function setTraRazaoSocial($traRazaoSocial)
    {
        $this->traRazaoSocial = $traRazaoSocial;

        return $this;
    }

    /**
     * Get the value of traNomeFantasia
     */ 
    public function getTraNomeFantasia()
    {
        return $this->traNomeFantasia;
    }

    /**
     * Set the value of traNomeFantasia
     *
     * @return  self
     */ 
    public function setTraNomeFantasia($traNomeFantasia)
    {
        $this->traNomeFantasia = $traNomeFantasia;

        return $this;
    }

    /**
     * Get the value of traCnpj
     */ 
    public function getTraCnpj()
    {
        return $this->traCnpj;
    }

    /**
     * Set the value of traCnpj
     *
     * @return  self
     */ 
    public function setTraCnpj($traCnpj)
    {
        $this->traCnpj = $traCnpj;

        return $this;
    }

    /**
     * Get the value of traIE
     */ 
    public function getTraIE()
    {
        return $this->traIE;
    }

    /**
     * Set the value of traIE
     *
     * @return  self
     */ 
    public function setTraIE($traIE)
    {
        $this->traIE = $traIE;

        return $this;
    }

    /**
     * Get the value of traEmail
     */ 
    public function getTraEmail()
    {
        return $this->traEmail;
    }

    /**
     * Set the value of traEmail
     *
     * @return  self
     */ 
    public function setTraEmail($traEmail)
    {
        $this->traEmail = $traEmail;

        return $this;
    }

    /**
     * Get the value of traContato
     */ 
    public function getTraContato()
    {
        return $this->traContato;
    }

    /**
     * Set the value of traContato
     *
     * @return  self
     */ 
    public function setTraContato($traContato)
    {
        $this->traContato = $traContato;

        return $this;
    }

    /**
     * Get the value of traTelefone
     */ 
    public function getTraTelefone()
    {
        return $this->traTelefone;
    }

    /**
     * Set the value of traTelefone
     *
     * @return  self
     */ 
    public function setTraTelefone($traTelefone)
    {
        $this->traTelefone = $traTelefone;

        return $this;
    }

    /**
     * Get the value of traCelular
     */ 
    public function getTraCelular()
    {
        return $this->traCelular;
    }

    /**
     * Set the value of traCelular
     *
     * @return  self
     */ 
    public function setTraCelular($traCelular)
    {
        $this->traCelular = $traCelular;

        return $this;
    }

    /**
     * Get the value of traObservacao
     */ 
    public function getTraObservacao()
    {
        return $this->traObservacao;
    }

    /**
     * Set the value of traObservacao
     *
     * @return  self
     */ 
    public function setTraObservacao($traObservacao)
    {
        $this->traObservacao = $traObservacao;

        return $this;
    }

    /**
     * Get the value of traDataCadastro
     */ 
    public function getTraDataCadastro()
    {
        return new DateTime($this->traDataCadastro);
    }

    /**
     * Set the value of traDataCadastro
     *
     * @return  self
     */ 
    public function setTraDataCadastro($traDataCadastro)
    {
        $this->traDataCadastro = $traDataCadastro;

        return $this;
    }

    /**
     * Get the value of traDataAlteracao
     */ 
    public function getTraDataAlteracao()
    {
        return new DateTime($this->traDataAlteracao);
    }

    /**
     * Set the value of traDataAlteracao
     *
     * @return  self
     */ 
    public function setTraDataAlteracao($traDataAlteracao)
    {
        $this->traDataAlteracao = $traDataAlteracao;

        return $this;
    }

     /**
     * Get the value of traInstituicao
     */ 
    public function getTraInstituicao()
    {
        return $this->traInstituicao;
    }

    /**
     * Set the value of traInstituicao
     *
     * @return  self
     */ 
    public function setTraInstituicao( Instituicao $traInstituicao)
    {
        $this->traInstituicao = $traInstituicao;

        return $this;
    }

    /**
     * Get the value of traUsuario
     */ 
    public function getTraUsuario()
    {
        return $this->traUsuario;
    }

    /**
     * Set the value of traUsuario
     *
     * @return  self
     */ 
    public function setTraUsuario(Usuario $traUsuario)
    {
        $this->traUsuario = $traUsuario;

        return $this;
    }


    /**
     * Get the value of traStatus
     */ 
    public function getTraStatus()
    {
        return $this->traStatus;
    }

    /**
     * Set the value of traStatus
     *
     * @return  self
     */ 
    public function setTraStatus($traStatus)
    {
        $this->traStatus = $traStatus;

        return $this;
    }

    /**
     * Get the value of traPessoa
     */ 
    public function getTraPessoa()
    {
        return $this->traPessoa;
    }

    /**
     * Set the value of traPessoa
     *
     * @return  self
     */ 
    public function setTraPessoa($traPessoa)
    {
        $this->traPessoa = $traPessoa;

        return $this;
    }
}