<?php

namespace App\Models\Entidades;

use DateTime;

class Produto
{
    private $ProCodigo;
    private $ProNome;
    private $ProNomeComercial;
    private $ProDataCadastro;
    private $ProDataAlteracao;
    
    private $ProUsuario;
    private $ProFornecedor;
    private $ProMarca;
    private $marca;
    private $fornecedor;
    private $usuario;
    /*
ProCodigo - ProNome - ProNomeComercial - ProUsuario - ProMarca - ProFornecedor - ProDataCadastro - ProDataAlteracao
    */
    public function __construct(){
        $this->marca = new Marca();       
        $this->fornecedor = new Fornecedor();
        $this->usuario = new Usuario();
    }
    public function getMarca()
    {
        return $this->marca;
    }
    public function getFornecedor()
    {
        return $this->fornecedor;
    }
    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getProCodigo()
    {
        return $this->ProCodigo;
    }

    public function setProCodigo($roCodigo)
    {
        $this->roCodigo = $roCodigo;
    }

    public function getProNome()
    {
        return $this->ProNome;
    }

    public function setProNome($ProNome)
    {
        $this->ProNome = $ProNome;
    }
    
    public function getProNomeComercial()
    {
        return $this->ProNomeComercial;
    }

    public function setProNomeComercial($ProNomeComercial)
    {
        $this->ProNomeComercial = $ProNomeComercial;
    }
    
    public function getProDataCadastro()
    {
        return new DateTime($this->ProDataCadastro);
    }

    public function setProDataCadastro($ProDataCadastro)
    {
        $this->ProDataCadastro = $ProDataCadastro;
    }

    public function getProDataAlteracao()
    {
        return new DateTime($this->ProDataAlteracao);
    }

    public function setProDataAlteracao($ProDataAlteracao)
    {
        $this->ProDataAlteracao = $ProDataAlteracao;
    }

    /**
     * Get the value of ProUsuario
     */ 
    public function getProUsuario()
    {
        return $this->ProUsuario;
    }

    /**
     * Set the value of ProUsuario
     *
     * @return  self
     */ 
    public function setProUsuario($ProUsuario)
    {
        $this->ProUsuario = $ProUsuario;

        return $this;
    }

    /**
     * Get the value of ProFornecedor
     */ 
    public function getProFornecedor()
    {
        return $this->ProFornecedor;
    }

    /**
     * Set the value of ProFornecedor
     *
     * @return  self
     */ 
    public function setProFornecedor($ProFornecedor)
    {
        $this->ProFornecedor = $ProFornecedor;

        return $this;
    }

    /**
     * Get the value of ProMarca
     */ 
    public function getProMarca()
    {
        return $this->ProMarca;
    }

    /**
     * Set the value of ProMarca
     *
     * @return  self
     */ 
    public function setProMarca($ProMarca)
    {
        $this->ProMarca = $ProMarca;

        return $this;
    }
}