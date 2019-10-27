<?php 

namespace App\Models\DAO;

use App\Models\Entidades\Login;
use App\Models\Entidades\Instituicao;

class LoginDAO extends BaseDAO
{
    public function salvarLogin(Login $login)
    {
        try
        {
            $nomeLogin      = $login->getNomeLogin();
            $emailLogin     = $login->getEmailLogin();

            return $this->insert(
                'login',
                ":nomeLogin, :emailLogin",
                [
                    ':nomeLogin'=>$nomeLogin,
                    ':emailLogin'=>$emailLogin
                ]
            );
        }catch (\Exception $e){
            throw new \Exception("Erro ao fazer cadastro de login", 500);
        }
    }

    
    public function autenticar($email, $Password) {
           
        if (!$email =="" && !$Password =="") {
            $pwd = sha1($Password);
            echo $pwd1;
            $resultado = $this->select(
                //" SELECT * FROM usuario WHERE email ='" . $email."' AND senha ='" . $Password."'"
                
                "SELECT * FROM usuarios AS u INNER JOIN instituicao AS i on i.inst_codigo = u.fk_idInstituicao where u.email ='" . $email . "' AND u.senha ='" . $pwd . "'"
            );
            $dado = $resultado->fetch();
            if ($dado) {               
                $login = new Login();
                $login->setInstituicao(new Instituicao());
                $login->setCodUsuario($dado['id']);
                $login->setEmailLogin($dado['email']);
                $login->setNomeLogin($dado['nome']);
                $login->setPassoword($dado['senha']);
                $login->setFk_Instituicao($dado['fk_idInstituicao']);
                $login->getInstituicao()->setInst_Id($dado['inst_id']);   
                
                return $login;      
            }           
        }   
            return false;
    }
    
    
           

}
