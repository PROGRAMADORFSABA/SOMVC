<?php
    
    
    namespace App\Lib;
    
    
    class Transacao
    {
    
        public function beginTransaction()
        {
            return Conexao::getConnection()->beginTransaction();
        }
    
        public function commit()
        {
            return Conexao::getConnection()->commit();
        }
    
        public function rollBack()
        {
            return Conexao::getConnection()->rollBack();
        }
    
    }