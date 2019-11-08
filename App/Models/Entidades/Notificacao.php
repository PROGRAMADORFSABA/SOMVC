<?php

namespace App\Models\Entidades;

 use DateTime;
 class Notificacao{
/*ntf_cod,
     ntf_numero,
     ntf_licitacao,
     ntf_pedido,
     ntf_status,
     ntf_garantia,
     ntf_trocamarca,
     ntf_valor,
     ntf_anexo,
     ntf_prazodefesa,
     ntf_dataalteracao,
     ntf_datacadastro,
     ntf_clientelicitacao,
     ntf_usuario

     
     ntf_numero, ntf_licitacao,     ntf_pedido,     ntf_status,     ntf_garantia,     ntf_trocamarca,
     ntf_valor,     ntf_anexo,     ntf_prazodefesa,     ntf_clientelicitacao,     ntf_usuario,
     ntf_representante,    ntf_dataalteracao,    ntf_datacadastro
     */
    private $ntf_cod;
    private $ntf_numero;
    private $ntf_licitacao;
    private $ntf_pedido;
    private $ntf_status;
    private $ntf_garantia;
    private $ntf_trocamarca;
    private $ntf_valor;
    private $ntf_anexo;
    private $ntf_prazodefesa;
    private $ntf_dataalteracao;
    private $ntf_datacadastro;
    private $ntf_clientelicitacao;
    private $ntf_usuario;
    private $ntf_edital;
    private $ntf_representante;
    private $ntf_codclientelicitacao;
    private $ntf_codusuario;
    private $ntf_codrepresentante;

    /**
     * Get the value of ntf_cod
     */ 
    public function getNtf_cod()
    {
        return $this->ntf_cod;
    }

    /**
     * Set the value of ntf_cod
     *
     * @return  self
     */ 
    public function setNtf_cod($ntf_cod)
    {
        $this->ntf_cod = $ntf_cod;

        return $this;
    }

    /**
     * Get the value of ntf_numero
     */ 
    public function getNtf_numero()
    {
        return $this->ntf_numero;
    }

    /**
     * Set the value of ntf_numero
     *
     * @return  self
     */ 
    public function setNtf_numero($ntf_numero)
    {
        $this->ntf_numero = $ntf_numero;

        return $this;
    }

    /**
     * Get the value of ntf_licitacao
     */ 
    public function getNtf_licitacao()
    {
        return $this->ntf_licitacao;
    }

    /**
     * Set the value of ntf_licitacao
     *
     * @return  self
     */ 
    public function setNtf_licitacao($ntf_licitacao)
    {
        $this->ntf_licitacao = $ntf_licitacao;

        return $this;
    }

    /**
     * Get the value of ntf_pedido
     */ 
    public function getNtf_pedido()
    {
        return $this->ntf_pedido;
    }

    /**
     * Set the value of ntf_pedido
     *
     * @return  self
     */ 
    public function setNtf_pedido($ntf_pedido)
    {
        $this->ntf_pedido = $ntf_pedido;

        return $this;
    }

    /**
     * Get the value of ntf_status
     */ 
    public function getNtf_status()
    {
        return $this->ntf_status;
    }

    /**
     * Set the value of ntf_status
     *
     * @return  self
     */ 
    public function setNtf_status($ntf_status)
    {
        $this->ntf_status = $ntf_status;

        return $this;
    }

    /**
     * Get the value of ntf_garantia
     */ 
    public function getNtf_garantia()
    {
        return $this->ntf_garantia;
    }

    /**
     * Set the value of ntf_garantia
     *
     * @return  self
     */ 
    public function setNtf_garantia($ntf_garantia)
    {
        $this->ntf_garantia = $ntf_garantia;

        return $this;
    }

    /**
     * Get the value of ntf_trocamarca
     */ 
    public function getNtf_trocamarca()
    {
        return $this->ntf_trocamarca;
    }

    /**
     * Set the value of ntf_trocamarca
     *
     * @return  self
     */ 
    public function setNtf_trocamarca($ntf_trocamarca)
    {
        $this->ntf_trocamarca = $ntf_trocamarca;

        return $this;
    }

    /**
     * Get the value of ntf_valor
     */ 
    public function getNtf_valor()
    {
        return $this->ntf_valor;
    }

    /**
     * Set the value of ntf_valor
     *
     * @return  self
     */ 
    public function setNtf_valor($ntf_valor)
    {
        $this->ntf_valor = $ntf_valor;

        return $this;
    }

    /**
     * Get the value of ntf_anexo
     */ 
    public function getNtf_anexo()
    {
        return $this->ntf_anexo;
    }

    /**
     * Set the value of ntf_anexo
     *
     * @return  self
     */ 
    public function setNtf_anexo($ntf_anexo)
    {
        $this->ntf_anexo = $ntf_anexo;

        return $this;
    }

    /**
     * Get the value of ntf_prazodefesa
     */ 
    public function getNtf_prazodefesa()
    {
        return $this->ntf_prazodefesa;
    }

    /**
     * Set the value of ntf_prazodefesa
     *
     * @return  self
     */ 
    public function setNtf_prazodefesa($ntf_prazodefesa)
    {
        $this->ntf_prazodefesa = $ntf_prazodefesa;

        return $this;
    }

    /**
     * Get the value of ntf_dataalteracao
     */ 
    public function getNtf_dataalteracao()
    {
        return new DateTime($this->ntf_dataalteracao);
    }

    /**
     * Set the value of ntf_dataalteracao
     *
     * @return  self
     */ 
    public function setNtf_dataalteracao($ntf_dataalteracao)
    {
        $this->ntf_dataalteracao = $ntf_dataalteracao;

        return $this;
    }

    /**
     * Get the value of ntf_datacadastro
     */ 
    public function getNtf_datacadastro()
    {
        return new DateTime($this->ntf_datacadastro);
    }

    /**
     * Set the value of ntf_datacadastro
     *
     * @return  self
     */ 
    public function setNtf_datacadastro($ntf_datacadastro)
    {
        $this->ntf_datacadastro = $ntf_datacadastro;

        return $this;
    }

    /**
     * Get the value of ntf_clientelicitacao
     */ 
    public function getNtf_clientelicitacao()
    {
        return $this->ntf_clientelicitacao;
    }

    /**
     * Set the value of ntf_clientelicitacao
     *
     * @return  self
     */ 
    public function setNtf_clientelicitacao(ClienteLicitacao $ntf_clientelicitacao)
    {
        $this->ntf_clientelicitacao = $ntf_clientelicitacao;

        return $this;
    }

    /**
     * Get the value of ntf_usuario
     */ 
    public function getNtf_usuario()
    {
        return $this->ntf_usuario;
    }

    /**
     * Set the value of ntf_usuario
     *
     * @return  self
     */ 
    public function setNtf_usuario(Usuario $ntf_usuario)
    {
        $this->ntf_usuario = $ntf_usuario;

        return $this;
    }

    /**
     * Get the value of ntf_codclientelicitacao
     */ 
    public function getNtf_codclientelicitacao()
    {
        return $this->ntf_codclientelicitacao;
    }

    /**
     * Set the value of ntf_codclientelicitacao
     *
     * @return  self
     */ 
    public function setNtf_codclientelicitacao($ntf_codclientelicitacao)
    {
        $this->ntf_codclientelicitacao = $ntf_codclientelicitacao;

        return $this;
    }

    /**
     * Get the value of ntf_codusuario
     */ 
    public function getNtf_codusuario()
    {
        return $this->ntf_codusuario;
    }

    /**
     * Set the value of ntf_codusuario
     *
     * @return  self
     */ 
    public function setNtf_codusuario($ntf_codusuario)
    {
        $this->ntf_codusuario = $ntf_codusuario;

        return $this;
    }

    /**
     * Get the value of ntf_codrepresentante
     */ 
    public function getNtf_codrepresentante()
    {
        return $this->ntf_codrepresentante;
    }

    /**
     * Set the value of ntf_codrepresentante
     *
     * @return  self
     */ 
    public function setNtf_codrepresentante($ntf_codrepresentante)
    {
        $this->ntf_codrepresentante = $ntf_codrepresentante;

        return $this;
    }

    /**
     * Get the value of ntf_representante
     */ 
    public function getNtf_representante()
    {
        return $this->ntf_representante;
    }

    /**
     * Set the value of ntf_representante
     *
     * @return  self
     */ 
    public function setNtf_representante(Representante $ntf_representante)
    {
        $this->ntf_representante = $ntf_representante;

        return $this;
    }

    /**
     * Get the value of ntf_edital
     */ 
    public function getNtf_edital()
    {
        return $this->ntf_edital;
    }

    /**
     * Set the value of ntf_edital
     *
     * @return  self
     */ 
    public function setNtf_edital(Edital $ntf_edital)
    {
        $this->ntf_edital = $ntf_edital;

        return $this;
    }
}