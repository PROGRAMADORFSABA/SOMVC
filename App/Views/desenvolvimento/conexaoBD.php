<?php  

        $servidor = filter_input(INPUT_POST, 'servidor', FILTER_SANITIZE_STRING);
        $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
        $dbname = filter_input(INPUT_POST, 'dbname', FILTER_SANITIZE_STRING);

        //Criar a conexao com BD
        $conn = mysqli_connect($servidor,$usuario,$senha,$dbname);
       
        include_once("exporteBDSQL.php");

        header("Location: exporteBD.php");
        //header("Location: http://" . APP_HOST ."/exporteBD.php");
        
       