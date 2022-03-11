<?php
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header("Access-Control-Allow-Headers: Token, token, Origin, X-Requested-With, Content-Type, Accept");
    include "resetearLugaresLibres.php";
    
    $servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "bies-react";
    $conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);
    