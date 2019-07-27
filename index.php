<?php

use App\App;
use App\Lib\Erro;

session_start();
/*
if (!isset($_SESSION['usuarioID'])) {                //Verifica se há seções
    session_destroy();                        //Destroi a seção por segurança
    header("Location: SOMVC/login.php");   
    exit;        //Redireciona o visitante para login
}
*/
error_reporting(E_ALL & ~E_NOTICE);

require_once("vendor/autoload.php");

try {
    $app = new App();
    $app->run();
}catch (\Exception $e){
    $oError = new Erro($e);
    $oError->render();
}


$registro = $_SESSION['registro'];
$limite = $_SESSION['limite'];

if($registro){
 $segundos = time()- $registro;
}

if($segundos>$limite){
 session_destroy();
 header("Location: ../index.php");
} else{
 $_SESSION['registro'] = time();
}
$andre = date('Y-m-d-H:i:s');