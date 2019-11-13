<?php

namespace App\Models\Entidades;

class StatusLicitacao
{
    private $faltaStatus_cod;
    private $nomestatus;

    /**
     * Get the value of faltaStatus_cod
     */ 
    public function getFaltaStatus_cod()
    {
        return $this->faltaStatus_cod;
    }

    /**
     * Set the value of faltaStatus_cod
     *
     * @return  self
     */ 
    public function setFaltaStatus_cod($faltaStatus_cod)
    {
        $this->faltaStatus_cod = $faltaStatus_cod;

        return $this;
    }

    /**
     * Get the value of nomestatus
     */ 
    public function getNomestatus()
    {
        return $this->nomestatus;
    }

    /**
     * Set the value of nomestatus
     *
     * @return  self
     */ 
    public function setNomestatus($nomestatus)
    {
        $this->nomestatus = $nomestatus;

        return $this;
    }
}