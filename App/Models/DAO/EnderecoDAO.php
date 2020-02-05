<?php 

namespace App\Models\DAO;

use App\Models\Entidades\Endereco;
use App\Models\Entidades\enderecoCleinte;

class EnderecoDAO extends BaseDAO
{
    public function getById($codEndereco)
    {
        $resultado = $this->select(
            "SELECT codEndereco, logradouro FROM codCliente WHERE codCliente = $codEndereco"
        );

        return $resultado->fetchObject(CodCliente::class);
    }

    public function listarEndereco()
    {
        $resultado = $this->select(
            'SELECT codEndereco, logradouro FROM codCliente'
        );
        return $resultado->fetchAll(\PDO::FETCH_CLASS, CodCliente::class);
    }
    public  function salvar(Endereco $endereco)
    {
        try {
            $longradouro        = $endereco->getEndLongradouro();
            $numero             = $endereco->getEndNumero();
            $bairro             = $endereco->getEndBairro();
            $complemento        = $endereco->getEndComplemento();
            $pontoreferencia    = $endereco->getEndPontoReferencia();
            $cep                = $endereco->getEndCep();
            $datacadastro       = $endereco->getEndDataCadastro();
            $dataalteracao      = $endereco->getEndDataAlteracao();
            $cidade             = $endereco->getEndCidade()->getCidId();
            $pessoa             = $endereco->getEndPessoa();        
            
        return $this->insert(
            'endereco',
           ":end_longradouro,
            :end_numero,
            :end_bairro,
            :end_complemento,
            :end_pontoreferencia,
            :end_cep,
            :end_datacadastro,
            :end_dataalteracao,
            :end_cidade,
            :end_pessoa",
            [
                ':end_longradouro'      => $longradouro,
                ':end_numero'           => $numero,
                ':end_bairro'           => $bairro,
                ':end_complemento'      => $complemento,
                ':end_pontoreferencia'  => $pontoreferencia,
                ':end_cep'              => $cep,
                ':end_datacadastro'     =>  date('Y-m-d H:i:s'),
                ':end_dataalteracao'    =>  date('Y-m-d H:i:s'),
                ':end_cidade'           => $cidade,
                ':end_pessoa'           => $pessoa
            ]
        );

        } catch (\Exception $e) {
            //var_dump($e);
            throw new \Exception("Erro na gravação de dados. " . $e, 500);
    }
}
public function alterar(Endereco $endereco)
{        
    try {      
            $longradouro        = $endereco->getEndLongradouro();
            $numero             = $endereco->getEndNumero();
            $bairro             = $endereco->getEndBairro();
            $complemento        = $endereco->getEndComplemento();
            $pontoreferencia    = $endereco->getEndPontoReferencia();
            $cep                = $endereco->getEndCep();
            $cidade             = $endereco->getEndCidade()->getCidId();
            $pessoa             = $endereco->getEndPessoa();       
        
        return $this->update(
            'endereco',
               "end_longradouro        =:longradouro,
                end_numero             =:numero,
                end_bairro             =:bairro,
                end_complemento        =:complemento,
                end_pontoreferencia    =:pontoreferencia,
                end_cep                =:cep,
                end_dataalteracao      =:dataalteracao,
                end_cidade             =:cidade",
            [
                ':pessoa'           => $pessoa,
                ':longradouro'      => $longradouro,
                ':numero'           => $numero,
                ':bairro'           => $bairro,
                ':complemento'      => $complemento,
                ':pontoreferencia'  => $pontoreferencia,
                ':cep'              => $cep,
                ':dataalteracao'    => date('Y-m-d H:i:s'),
                ':cidade'           => $cidade,
            ],
            "end_pessoa = :pessoa"
        );          
    } catch (\Exception $e) {
        throw new \Exception("Erro na gravação de dados. ".$e, 500);
    }
}
    public function excluir(Endereco $endereco)
    {
        
        try {
            $codPessoa = $endereco->getEndPessoa();

            return $this->delete('endereco', "end_pessoa = $codPessoa");
        } catch (Exception $e) {

            throw new \Exception("Erro ao excluir cadastro! ", 500);
        }
        

    }
}

?>