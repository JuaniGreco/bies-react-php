<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "bies-react";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);



//---------En prueba----------
$idUsuario = 3;
$HoraActual = date_create();
$HoraActual = '11:30:20';
$FechaActual = date("Y-m-d");
$idPlayaDeEstacionamiento = '12';
$diaSemana = date('w');

//if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    
    /*$HoraActual=$data-> date_create();
    $HoraActual=$data-> date_format($HoraActual, 'H:i:s');
    $FechaActual=$data-> date("Y-m-d");
    $idPlayaDeEstacionamiento=$data-> idPlayaDeEstacionamiento;
    $idEstacionamientoHorario=$data-> idEstacionamientoHorario;
    $idPlayaDeEstacionamientoHorario=$data-> idPlayaDeEstacionamientoHorario;*/

   

    if (($HoraActual > "00:00:00") and ($HoraActual < "23:59:59")) {
        $sql = mysqli_query($conexionBD,"INSERT INTO `estacionamiento`(`idUsuario`, `idPlayaDeEstacionamiento`, `idPlayaDeEstacionamientoHorario`, `fechaEstacionamiento`, 
        `horaInicioEstacionamiento`) 
        VALUES ($idUsuario, $idPlayaDeEstacionamiento, '(SELECT playadeestacionamientohorario.idHorario
        FROM `playadeestacionamientohorario` 
        WHERE '$HoraActual' BETWEEN playadeestacionamientohorario.horaInicio and playadeestacionamientohorario.horaFin 
        and playadeestacionamientohorario.diaSemana = $diaSemana and playadeestacionamientohorario.idPlayaDeEstacionamiento = $idPlayaDeEstacionamiento)',
        '$FechaActual', '$HoraActual'"); 

        echo json_encode(["success"=>1]);
    }
   
    exit();
//}



