<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Headers: Token, token, Origin, X-Requested-With, Content-Type, Accept");

    $method = $_SERVER['REQUEST_METHOD'];
    include "conectar.php";
    $conexionBD = conectarDB();
    //sleep(1);	
	$JSONData = file_get_contents("php://input");
	$dataObject = json_decode($JSONData);    
    session_start();    
    $conexionBD->set_charset('utf8');

$sql2 = mysqli_query($conexionBD, "UPDATE playadeestacionamiento pe set pe.lugaresLibres = pe.capacidad");

//VIDEO EXPLICATIVO https://www.youtube.com/watch?v=xDxzpVBJ1rY&t

$conexionBD->close();
?>