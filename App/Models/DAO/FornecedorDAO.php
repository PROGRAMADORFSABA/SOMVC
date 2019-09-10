<?php

namespace App\Models\DAO;

use App\Models\Entidades\Fornecedor;

class FornecedorDAO extends BaseDAO
    {
    public function listar($codFornecedor)
        {
            if(isset($codFornecedor))
            {
                $resultado = $this->select(
                    "SELECT * FROM fornecedor WHERE forbecedor_cod = $codFornecedor"
                );
            }else
                {
                    $resultado = $this->select(
                        'SELECT * FROM fornecedor'
                    );
                }
            return $resultado->fetchAll(\PDO::FETCH_CLASS, Fornecedor::class);
        }
}
