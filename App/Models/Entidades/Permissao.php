<?php

namespace App\Models\Entidades;

use DateTime;
class Permissao
{
private $perCodigo;
private $perTela;
private $perGrupo;
private $perIncluir;
private $perExcluir;
private $perAlterar;
private $perPesquisar;
private $perRelatorio;
private $perImprimir;
private $perVisualisar;
private $perDataCadastro;
private $perDataAlteracao;
private $usuario;
private $instituicao;

    /**
 * Get the value of perCodigo
 */ 
public function getPerCodigo()
{
return $this->perCodigo;
}

/**
 * Set the value of perCodigo
 *
 * @return  self
 */ 
public function setPerCodigo($perCodigo)
{
$this->perCodigo = $perCodigo;

return $this;
}

/**
 * Get the value of perTela
 */ 
public function getPerTela()
{
return $this->perTela;
}

/**
 * Set the value of perTela
 *
 * @return  self
 */ 
public function setPerTela($perTela)
{
$this->perTela = $perTela;

return $this;
}

/**
 * Get the value of perGrupo
 */ 
public function getPerGrupo()
{
return $this->perGrupo;
}

/**
 * Set the value of perGrupo
 *
 * @return  self
 */ 
public function setPerGrupo($perGrupo)
{
$this->perGrupo = $perGrupo;

return $this;
}

/**
 * Get the value of perIncluir
 */ 
public function getPerIncluir()
{
return $this->perIncluir;
}

/**
 * Set the value of perIncluir
 *
 * @return  self
 */ 
public function setPerIncluir($perIncluir)
{
$this->perIncluir = $perIncluir;

return $this;
}

/**
 * Get the value of perExcluir
 */ 
public function getPerExcluir()
{
return $this->perExcluir;
}

/**
 * Set the value of perExcluir
 *
 * @return  self
 */ 
public function setPerExcluir($perExcluir)
{
$this->perExcluir = $perExcluir;

return $this;
}

/**
 * Get the value of perAlterar
 */ 
public function getPerAlterar()
{
return $this->perAlterar;
}

/**
 * Set the value of perAlterar
 *
 * @return  self
 */ 
public function setPerAlterar($perAlterar)
{
$this->perAlterar = $perAlterar;

return $this;
}

/**
 * Get the value of perPesquisar
 */ 
public function getPerPesquisar()
{
return $this->perPesquisar;
}

/**
 * Set the value of perPesquisar
 *
 * @return  self
 */ 
public function setPerPesquisar($perPesquisar)
{
$this->perPesquisar = $perPesquisar;

return $this;
}

/**
 * Get the value of perRelatorio
 */ 
public function getPerRelatorio()
{
return $this->perRelatorio;
}

/**
 * Set the value of perRelatorio
 *
 * @return  self
 */ 
public function setPerRelatorio($perRelatorio)
{
$this->perRelatorio = $perRelatorio;

return $this;
}

/**
 * Get the value of perImprimir
 */ 
public function getPerImprimir()
{
return $this->perImprimir;
}

/**
 * Set the value of perImprimir
 *
 * @return  self
 */ 
public function setPerImprimir($perImprimir)
{
$this->perImprimir = $perImprimir;

return $this;
}

/**
 * Get the value of perVisualisar
 */ 
public function getPerVisualisar()
{
return $this->perVisualisar;
}

/**
 * Set the value of perVisualisar
 *
 * @return  self
 */ 
public function setPerVisualisar($perVisualisar)
{
$this->perVisualisar = $perVisualisar;

return $this;
}
   
    /**
     * Get the value of perDataCadastro
     */ 
    public function getPerDataCadastro()
    {
        return new DateTime($this->perDataCadastro);        
    }

    /**
     * Set the value of perDataCadastro
     *
     * @return  self
     */ 
    public function setPerDataCadastro($perDataCadastro)
    {
        $this->perDataCadastro = $perDataCadastro;

        return $this;
    }

    /**
     * Get the value of perDataAlteracao
     */ 
    public function getPerDataAlteracao()
    {
        return new DateTime($this->perDataAlteracao);
    }

    /**
     * Set the value of perDataAlteracao
     *
     * @return  self
     */ 
    public function setPerDataAlteracao($perDataAlteracao)
    {
        $this->perDataAlteracao = $perDataAlteracao;

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
     * Get the value of perusuario
     */ 
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of perusuario
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


}
