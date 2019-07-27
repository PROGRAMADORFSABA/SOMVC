<?php


namespace App\Models\Entidades;

use DateTime;

class ClienteLicitacao
{

    private $idCliente;
    private $nome;
    private $nomeFantasia;
    private $dataCadastro;
    private $tipoCliente;
    private $idTipoCliente;
    
    
    public  function  __construct()
    {
        $this->tipoCliente = new TipoCliente();
    }

    /**
     * @return TipoCliente
     */

    public function getTipoCliente()   {
        return $this->tipoCliente;
    }
    
    /**
     * @return mixed
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * @param mixed $idCliente
     */
    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;
    }
    
    public function  getTipoCliente_cod()
    {
        return $this->TipoCliente_cod();
    }
    
    public function setTipoCliente_cod($TipoCliente_cod)
    {
        $this->$TipoCliente_cod = $TipoCliente_cod;
    }


    public function  getIdTipoCliente()
    {
        return $this->IdTipoCliente();
    }
    
    public function setIdTipoCliente($IdTipoCliente)
    {
        $this->$IdTipoCliente = $IdTipoCliente;
    }
    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getNomeFantasia()
    {
        return $this->nomeFantasia;
    }

    /**
     * @param mixed $nomeFantasia
     */
    public function setNomeFantasia($nomeFantasia)
    {
        $this->nomeFantasia = $nomeFantasia;
    }

    /**
     * @return mixed DateTime
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
    
   
    
    
    
}