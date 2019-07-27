<?php

namespace App\Controllers;

use App\Lib\Sessao;

abstract class Controller{
    
    protected $app;
    private $viewVar;

    public function __construct($app)
    {
        $this->setViewParam('nameController',$app->getControllerName());
        $this->setViewParam('nameAction',$app->getAction());
    }

    public function render($view){              
        session_start();         //A seção deve ser iniciada em todas as páginas
        if (!isset($_SESSION['andre'])) {                //Verifica se há seções
            
                session_destroy();                        //Destroi a seção por segurança
                $this->redirect('/login');   
                // header("Location: ../index.php");
                exit;        //Redireciona o visitante para login        
        }
        
        $registro = $_SESSION['registro'];
        $limite = $_SESSION['limite'];
        
        if($registro){
         $segundos = time()- $registro;
        }
       
        if($segundos>$limite){
         session_destroy();
         $this->redirect('/login');   
         //header("Location: ../index.php");
        } else{
         $_SESSION['registro'] = time();
        }
      //  $andre = date('Y-m-d-H:i:s');;

      $viewVar   = $this->getViewVar();
      $Sessao    = Sessao::class;

        require_once PATH . '/App/Views/layouts/header.php';
        require_once PATH . '/App/Views/layouts/menu.php';
        require_once PATH . '/App/Views/' . $view . '.php';
        require_once PATH . '/App/Views/layouts/footer.php';
    }

    public function renderLogin($view)
    {
        
        $viewVar    = $this->getViewVar();
        $Sessao     = Sessao::class;

        require_once PATH . '/App/Views/layouts/header.php';
        require_once PATH . '/App/Views/' . $view . '.php';
        require_once PATH . '/App/Views/layouts/footer.php';

    }

    public function redirect($view)
    {
        header('Location: http://' . APP_HOST . $view);
        exit;
    }

    public function getViewVar()
    {
        return $this->viewVar;
    }

    public function setViewParam($varName, $varValue)
    {
        if ($varName != "" && $varValue != "") {
            $this->viewVar[$varName] = $varValue;
        }
    }

}