<?php  

        $servidor = filter_input(INPUT_POST, 'servidor', FILTER_SANITIZE_STRING);
        $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
        $dbname = filter_input(INPUT_POST, 'dbname', FILTER_SANITIZE_STRING);

        //Criar a conexao com BD
        $conn = mysqli_connect($servidor,$usuario,$senha,$dbname);
       if ($conn) {           
           // include_once("exporteBDSQL.php");
    
            header('Location:' .APP_HOST.'/Desenvolvimento/exporteBD.php');
            //header("Location: http://" . APP_HOST ."/exporteBD.php");
        } else {
            echo " nao foi possivel estabelecer a conexao!";
            //header("Location: exporteBD.php");
            header('Location: ' . APP_HOST . '/Desenvolvimento/exporteBD');   
        }
        header("Location:" . APP_HOST . "desenvolvimento/exporteBD.php");
       echo " teste redirect ";
    
        
       