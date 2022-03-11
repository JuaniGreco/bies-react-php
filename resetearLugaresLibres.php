<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Headers: Token, token, Origin, X-Requested-With, Content-Type, Accept");

$servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "bies-react";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);

$sql2 = mysqli_query($conexionBD, "UPDATE playadeestacionamiento pe set pe.lugaresLibres = pe.capacidad");

//VIDEO EXPLICATIVO https://www.youtube.com/watch?v=xDxzpVBJ1rY&t

$conexionBD->close();
?>