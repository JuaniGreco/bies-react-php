<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "bies-react";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);
//echo "pase la conexion::::  ";

date_default_timezone_set("America/Argentina/Buenos_Aires");

//Definicion de variables recibidas del post

//----------En prueba----------
/*
$IdUsuario = 1;
$HoraActual = date_create();
$HoraActual = '17:01:24';
$FechaActual = '2021-09-21';
*/

/*----------En produccion-----------
/*$IdUsuario= $_POST['idUsuario']; 
$HoraActual = date_create();
$HoraActual = date_format($HoraActual, 'H:i:s');
$FechaActual = date("Y-m-d");*/

//Consulta sql para conseguir un id_estacionamiento

if(isset($_GET["desestacionar"])){
    $data = json_decode(file_get_contents("php://input"));
    $idUsuario=$data->idUsuario;
    $idUsuario=$_GET["idUsuario"];
    /*$idUsuario='34';*/
    $horaActual=date_create();
    $horaActual=date_format($horaActual, 'H:i:s');
    $fechaActual=date("Y-m-d");


$sql = $sql = mysqli_query($conexionBD,"UPDATE `estacionamiento` e
SET e.horaFinEstacionamiento= '$horaActual'
    WHERE
    e.idUsuario = '$idUsuario' and e.fechaEstacionamiento = '$fechaActual' and e.horaFinEstacionamiento is null"); 
echo json_encode(["success"=>1]);
} else {};
exit();


//$resultado = $conn->query($sql);
//header('Content-Type: application/json');
//Verifica si encontro filas en la tabla
//El resultado (resulset) se recorre con el while	
//A cada fila (en este caso es una sola) la carga en un array 
//while ($fila=mysqli_fetch_array($resultado)){
   /* if ($conn->query($sql) === TRUE) {
        $estado = array ('estado' => 'Desestacionado');;
    } else {
        $estado = array ('estado' => 'ERROR');;
    }
*/
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