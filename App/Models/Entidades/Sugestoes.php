<?php

namespace App\Models\Entidades;

use DateTime;
class Sugestoes
{
//sug_id, sug_tipo, sug_descricao, sug_status, sug_anexo, sug_datacadastro, sug_dataalteracao ,sug_instituicao, sug_usuario
    private $sugId;
    private $sugTipo;
    private $sugAssunto;
    private $sugDescricao;
    private $sugStatus;
    private $sugAnexo;
    private $sugDataCadastro;
    private $sugDataAlteracao;
    private $instituicao;
    private $codInstituicao;
    private $usuario;
    private $codUsuario;
    
    
    /**
     * Get the value of sugId
     */ 
    public function getSugId()
    {
        return $this->sugId;
    }

    /**
     * Set the value of sugId
     *
     * @return  self
     */ 
    public function setSugId($sugId)
    {
        $this->sugId = $sugId;

        return $this;
    }

    /**
     * Get the value of sugTipo
     */ 
    public function getSugTipo()
    {
        return $this->sugTipo;
    }

    /**
     * Set the value of sugTipo
     *
     * @return  self
     */ 
    public function setSugTipo($sugTipo)
    {
        $this->sugTipo = $sugTipo;

        return $this;
    }

    /**
     * Get the value of sugDescricao
     */ 
    public function getSugDescricao()
    {
        return $this->sugDescricao;
    }

    /**
     * Set the value of sugDescricao
     *
     * @return  self
     */ 
    public function setSugDescricao($sugDescricao)
    {
        $this->sugDescricao = $sugDescricao;

        return $this;
    }

    /**
     * Get the value of sugStatus
     */ 
    public function getSugStatus()
    {
        return $this->sugStatus;
    }

    /**
     * Set the value of sugStatus
     *
     * @return  self
     */ 
    public function setSugStatus($sugStatus)
    {
        $this->sugStatus = $sugStatus;

        return $this;
    }

    /**
     * Get the value of sugAnexo
     */ 
    public function getSugAnexo()
    {
        return $this->sugAnexo;
    }

    /**
     * Set the value of sugAnexo
     *
     * @return  self
     */ 
    public function setSugAnexo($sugAnexo)
    {
        $this->sugAnexo = $sugAnexo;

        return $this;
    }

    /**
     * Get the value of sugDataCadastro
     */ 
    public function getSugDataCadastro()
    {
        return new DateTime($this->sugDataCadastro);        
    }

    /**
     * Set the value of sugDataCadastro
     *
     * @return  self
     */ 
    public function setSugDataCadastro($sugDataCadastro)
    {
        $this->sugDataCadastro = $sugDataCadastro;

        return $this;
    }

    /**
     * Get the value of sugDataAlteracao
     */ 
    public function getSugDataAlteracao()
    {
        return new DateTime($this->sugDataAlteracao);
    }

    /**
     * Set the value of sugDataAlteracao
     *
     * @return  self
     */ 
    public function setSugDataAlteracao($sugDataAlteracao)
    {
        $this->sugDataAlteracao = $sugDataAlteracao;

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
     * Get the value of codUsuario
     */ 
    public function getCodUsuario()
    {
        return $this->codUsuario;
    }

    /**
     * Set the value of codUsuario
     *
     * @return  self
     */ 
    public function setCodUsuario($codUsuario)
    {
        $this->codUsuario = $codUsuario;

        return $this;
    }

    /**
     * Get the value of codInstituicao
     */ 
    public function getCodInstituicao()
    {
        return $this->codInstituicao;
    }

    /**
     * Set the value of codInstituicao
     *
     * @return  self
     */ 
    public function setCodInstituicao($codInstituicao)
    {
        $this->codInstituicao = $codInstituicao;

        return $this;
    }

    /**
     * Get the value of sugAssunto
     */ 
    public function getSugAssunto()
    {
        return $this->sugAssunto;
    }

    /**
     * Set the value of sugAssunto
     *
     * @return  self
     */ 
    public function setSugAssunto($sugAssunto)
    {
        $this->sugAssunto = $sugAssunto;

        return $this;
    }
}
