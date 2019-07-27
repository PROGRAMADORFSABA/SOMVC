<?php 

namespace App\Models\Entidades;

use DateTime;

class Pedido
{
    private $codPedido;
    private $licitacao;
    private $pedido;
    private $valorPedido;
    private $anexo;
    private $dataCadastro;
    private $alteracaoCadastro;
    private $codCliente;

    public function __construct()
    {
        $this->codCliente = new CodCliente();
    }

    /**
     * @return mixed
     */
    public function getCodPedido()
    {
        return $this->codPedido;
    }

    /**
     * @param mixed $codPedido
     */
    public function setCodPedido($codPedido)
    {
        $this->codPedido = $codPedido;
    }

    /**
     * @return mixed
     */
    public function getLicitacao()
    {
        return $this->licitacao;
    }

    /**
     * @param mixed $licitacao
     */
    public function setLicitacao($licitacao)
    {
        $this->licitacao = $licitacao;
    }

    /**
     * @return mixed
     */
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * @param mixed $pedido
     */
    public function setPedido($pedido)
    {
        $this->pedido = $pedido;
    }

    /**
     * @return mixed
     */
    public function getValorPedido()
    {
        return $this->valorPedido;
    }

    /**
     * @param mixed $valorPedido
     */
    public function setValorPedido($valorPedido)
    {
        $this->valorPedido = $valorPedido;
    }

    /**
     * @return mixed
     */
    public function getAnexo()
    {
        return $this->anexo;
    }

    /**
     * @param mixed $anexo
     */
    public function setAnexo($anexo)
    {
        $this->anexo = $anexo;
    }

    /**
     * @return mixed
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

    /**
     * @return mixed
     */
    public function getAlteracaoCadastro()
    {
        return $this->alteracaoCadastro;
    }

    /**
     * @param mixed $alteracaoCadastro
     */
    public function setAlteracaoCadastro($alteracaoCadastro)
    {
        $this->alteracaoCadastro = $alteracaoCadastro;
    }


}