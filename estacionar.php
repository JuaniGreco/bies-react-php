<?php

//Permite el acceso desde cualquier origen
header('Access-Control-Allow-Origin: *');

//Conexion a la base de datos MySql
include "conectar.php";
$conn = conectarDB();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "pase la conexion::::  ";


//Definicion de variables recibidas del post

//--------En produccion-------

/* $idUsuario= $_POST['Id_Usuario']; 
date_default_timezone_set("America/Argentina/Buenos_Aires");
$horaActual = date_create();
$horaActual = date_format($horaActual, 'H:i:s');
$fechaActual = date("Y-m-d");
$idPlayaDeEstacionamiento = $_POST['idPlayaEstacionamiento'];
$idEstacionamientoHorario = $_POST('idHorario');
$idPlayaDeEstacionamientoHorario = $_POST('idPlayaEstacionamientoHorario');*/


//---------En prueba----------

$idUsuario = 3;
date_default_timezone_set("America/Argentina/Buenos_Aires");
$horaActual = date_create();
$horaActual = date_format($horaActual, 'H:i:s');
$fechaActual = date("Y-m-d");
$idPlayaDeEstacionamiento = '1';
$diaSemana = date('w');




//error_log ($idPlayaDeEstacionamientoHorario, 3, 'D:\ID.txt');
//Consulta sql para estacionar un vehiculo EN EL ESTACIONAMIENTO CON ID = 1;


if (($horaActual > "00:00:00") and ($horaActual < "23:59:59")) {
        $sql = "INSERT INTO `estacionamiento`(`idUsuario`, `idPlayaDeEstacionamiento`, `idPlayaDeEstacionamientoHorario`, `fechaEstacionamiento`, 
        `horaInicioEstacionamiento`) 
        VALUES ($idUsuario, $idPlayaDeEstacionamiento, (SELECT playadeestacionamientohorario.idHorario
        FROM `playadeestacionamientohorario` 
        WHERE '$horaActual' BETWEEN playadeestacionamientohorario.horaInicio and playadeestacionamientohorario.horaFin 
        and playadeestacionamientohorario.diaSemana = $diaSemana and playadeestacionamientohorario.idPlayaDeEstacionamiento = $idPlayaDeEstacionamiento),
        '$fechaActual', '$horaActual')";
} else {
};


/*
error_log ($idUsuario, 3, 'D:\ID.txt');
error_log ($horaActual, 3, 'D:\hora.txt');
error_log ($fechaActual, 3, 'D:\fecha.txt');
error_log ($diaSemana, 3, 'D:\dia.txt');
error_log($idPlayaDeEstacionamiento, 3, 'D:\idPlaya.txt');
*/


header('Content-Type: application/json');
//Ejecuta la consulta
if ($resultado = $conn->query($sql)) {
    echo json_encode('Ok', JSON_FORCE_OBJECT);
} else {
    echo json_encode('ERROR', JSON_FORCE_OBJECT);
}
//echo ("pase la ejecucion");

//Arma la cabecera "json"
header('Content-Type: application/json');

//Verifica si encontro filas en la tabla
//if ($resultado->num_rows > 0) {
//El resultado (resulset) se recorre con el while	
//A cada fila (en este caso es una sola) la carga en un array 
//    while ($fila=mysqli_fetch_array($resultado)){
//    $usuario = array ('Id_usuario' => $fila['ID_USUARIO']);
//    }
//} else {
//Si no existe crea el array con todos valores vacios	
//    $usuario = array ('Id_usuario'=>'');
//}	

//Codifica y retorna en formato json el array

//cierra la conexion
$conn->close();
