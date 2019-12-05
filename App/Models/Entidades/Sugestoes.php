<?php

namespace App\Models\Entidades;

use DateTime;
class Sugestoes
{
//sug_id, sug_tipo, sug_descricao, sug_status, sug_anexo, sug_datacadastro, sug_dataalteracao ,sug_instituicao, sug_usuario
    private $sugId;
    private $sugTipo;
    private $sugDescricao;
    private $sugStatus;
    private $sugAnexo;
    private $sugDataCadastro;
    private $sugDataAlteracao;
    private $instituicao;
    private $sugusuario;
    
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
        return $this->sugDataCadastro;
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
        return $this->sugDataAlteracao;
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
    public function getSugusuario()
    {
        return $this->sugusuario;
    }

    /**
     * Set the value of sugusuario
     *
     * @return  self
     */ 
    public function setSugusuario(Usuario $sugusuario)
    {
        $this->sugusuario = $sugusuario;

        return $this;
    }
}
