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

//----------En produccion----------
$Id = $_POST['idUsuario'];


//----------En prueba----------
//$Id = 1;


date_default_timezone_set("America/Argentina/Buenos_Aires");
$FechaActual = date("Y-m-d");

//Consulta sql para agregar un usuario, asigna dni como nombre y dni. El id se autogenera
if ($Id != 0){
$sql="SELECT es.*, pe.nombrePlayaDeEstacionamiento, pe.ubicacion
FROM ESTACIONAMIENTO es 
LEFT JOIN playadeestacionamiento pe ON (es.idPlayaDeEstacionamiento = pe.idPlayaDeEstacionamiento)
WHERE es.idUsuario = '$Id' AND es.fechaEstacionamiento = '$FechaActual' AND es.horaFinEstacionamiento IS null";
//Ejecuta la consulta
$resultado = $conn->query($sql);

//Arma la cabecera "json"
header('Content-Type: application/json');

//Verifica si encontro filas en la tabla
if ($resultado->num_rows > 0) {
//El resultado (resulset) se recorre con el while	
//A cada fila (en este caso es una sola) la carga en un array 
    while ($fila=mysqli_fetch_array($resultado)){
        $usuario = array ('estado' => 'Estacionado');
    }
} else {
        //Si no existe crea el array con todos valores vacios	
        $usuario = array ('estado'=>'Desestacionado');
        }

//MODIFICAR IDUSUARIO POR ESTADO
}


//Codifica y retorna en formato json el array
echo json_encode($usuario, JSON_FORCE_OBJECT); 

//cierra la conexion
$conn->close();

?>