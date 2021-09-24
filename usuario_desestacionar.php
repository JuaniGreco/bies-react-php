<?php

//Permite el acceso desde cualquier origen
header('Access-Control-Allow-Origin: *');

//Conexion a la base de datos MySql
include "conectar.php";
$conn = conectarDB();
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set("America/Argentina/Buenos_Aires");

//Definicion de variables recibidas del post

//----------En prueba----------
/*
$IdUsuario = 1;
$HoraActual = date_create();
$HoraActual = '17:01:24';
$FechaActual = '2021-09-21';
*/

//----------En produccion-----------
$IdUsuario= $_POST['idUsuario']; 
$HoraActual = date_create();
$HoraActual = date_format($HoraActual, 'H:i:s');
$FechaActual = date("Y-m-d");

//Consulta sql para conseguir un id_estacionamiento

$sql = "UPDATE `estacionamiento` e
SET e.horaFinEstacionamiento= '$HoraActual'
    WHERE
    e.idUsuario = '$IdUsuario' and e.fechaEstacionamiento = '$FechaActual' and e.horaFinEstacionamiento is null"; 

//$resultado = $conn->query($sql);


header('Content-Type: application/json');
//Verifica si encontro filas en la tabla
//El resultado (resulset) se recorre con el while	
//A cada fila (en este caso es una sola) la carga en un array 
//while ($fila=mysqli_fetch_array($resultado)){
    if ($conn->query($sql) === TRUE) {
        $estado = array ('estado' => 'Desestacionado');;
    } else {
        $estado = array ('estado' => 'ERROR');;
    }

//echo ($IdEstacionamiento);

/*if ($HoraActual < "22:01:00") {
    $sql="UPDATE ESTACIONAMIENTO e
            SET e.horaFinEstacionamiento = '$HoraActual'
            WHERE (e.idEstacionamiento = $IdEstacionamiento)";
            
} else {};
*/


//Arma la cabecera "json"
header('Content-Type: application/json');

echo json_encode($estado, JSON_FORCE_OBJECT);

//cierra la conexion
$conn->close();

?>