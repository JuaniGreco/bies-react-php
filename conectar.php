<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Content-Type: text/html; charset=utf-8");
$method = $_SERVER['REQUEST_METHOD'];

function conectarDB(){
    /*
    $servidor = "localhost";
    $usuario = "root";
    $password = "";
    $bd = "bies-react";
    $conexionBD = mysqli_connect($servidor, $usuario, $password,$bd);
    */

    $servidor = "localhost";
    $usuario = "id18437891_root";
    $password = "9A+!NvyJr7Cv[d8{";
    $bd = "id18437891_biesreact";
    $conexionBD = mysqli_connect($servidor, $usuario, $password,$bd);

    
        if($conexionBD){
            echo "";
        }else{
            echo 'Ha sucedido un error inesperado en la conexion de la base de datos';
        }

    return $conexionBD;
}
?>