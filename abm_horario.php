<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "bies-react";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);

function obtenerNumeroDia($nombreDelDia){
    if($nombreDelDia === "DOMINGO"){
        return 0;
    }else if($nombreDelDia === "LUNES"){
        return 1;
    } else if($nombreDelDia === "MARTES"){
        return 2;
    } else if($nombreDelDia === "MIERCOLES"){
        return 3;
    } else if($nombreDelDia === "JUEVES"){
        return 4;
    } else if($nombreDelDia === "VIERNES"){
        return 5;
    } else {
        return 6;
    };
}

// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_GET["consultar"])){
    $sqlEstacionamientoHorario = mysqli_query($conexionBD,"SELECT ph.idHorario, ph.idPlayaDeEstacionamiento, pe.nombrePlayaDeEstacionamiento as 'nombrePlayaDeEstacionamiento', ph.nombreDia, ph.horaInicio, ph.horaFin FROM `playadeestacionamientohorario` ph LEFT JOIN playadeestacionamiento pe on pe.idPlayaDeEstacionamiento = ph.idPlayaDeEstacionamiento WHERE idHorario=".$_GET["consultar"]);
    if(mysqli_num_rows($sqlEstacionamientoHorario) > 0){
        $estacionamientoHorario = mysqli_fetch_all($sqlEstacionamientoHorario,MYSQLI_ASSOC);
        echo json_encode($estacionamientoHorario);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["borrar"])){
    $sqlEstacionamientoHorario = mysqli_query($conexionBD,"DELETE FROM playadeestacionamientohorario WHERE idHorario=".$_GET["borrar"]);
    if($sqlEstacionamientoHorario){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//Inserta un nuevo registro y recepciona en método post los datos de nombre y correo
if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    
    $idPlayaDeEstacionamiento = $data ->idPlayaDeEstacionamiento;
    $nombreDia=$data->nombreDia;
    $horaInicio=$data->horaInicio;
    $horaFin=$data->horaFin;
    $nombreDia = strtoupper($nombreDia);
    $diaSemana = obtenerNumeroDia($nombreDia);

    // if($nombreDia === "DOMINGO"){
    //     $diaSemana = 0;
    // }else if($nombreDia === "LUNES"){
    //     $diaSemana = 1;
    // } else if($nombreDia === "MARTES"){
    //     $diaSemana = 2;
    // } else if($nombreDia === "MIERCOLES"){
    //     $diaSemana = 3;
    // } else if($nombreDia === "JUEVES"){
    //     $diaSemana = 4;
    // } else if($nombreDia === "VIERNES"){
    //     $diaSemana = 5;
    // } else {
    //     $diaSemana = 6;
    // };

        if(($idPlayaDeEstacionamiento!="")&&($diaSemana!="")&&($horaInicio!="")&&($horaFin!="")&&($nombreDia!="")){            
            $sqlEstacionamientoHorario = mysqli_query($conexionBD,"INSERT INTO playadeestacionamientohorario(idPlayaDeEstacionamiento, diaSemana, horaInicio, horaFin, nombreDia) VALUES ('$idPlayaDeEstacionamiento',
            '$diaSemana', '$horaInicio', '$horaFin', '$nombreDia')");
            echo json_encode(["success"=>1]);
        }
    exit();
}
// Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
if(isset($_GET["actualizar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $idHorario=(isset($data->idHorario))?$data->idHorario:$_GET["actualizar"];
    $idPlayaDeEstacionamiento=$data->idPlayaDeEstacionamiento;
    $horaInicio=$data->horaInicio;
    $horaFin = $data->horaFin;
    $nombreDia = $data->nombreDia;
    $nombreDia = strtoupper($nombreDia);
    $diaSemana = obtenerNumeroDia($nombreDia);

    $sqlEstacionamientoHorario = mysqli_query($conexionBD,"UPDATE playadeestacionamientohorario SET diaSemana= '$diaSemana', horaInicio = '$horaInicio', horaFin = '$horaFin', nombreDia = '$nombreDia' WHERE idHorario='$idHorario'");
    echo json_encode(["success"=>1]);
    exit();
}
// Consulta todos los registros de la tabla
$sqlEstacionamientoHorario = mysqli_query($conexionBD,"SELECT ph.idHorario, pe.nombrePlayaDeEstacionamiento as 'nombrePlayaDeEstacionamiento', ph.nombreDia, ph.horaInicio, ph.horaFin FROM `playadeestacionamientohorario` ph LEFT JOIN playadeestacionamiento pe on pe.idPlayaDeEstacionamiento = ph.idPlayaDeEstacionamiento");
if(mysqli_num_rows($sqlEstacionamientoHorario) > 0){
    $estacionamientoHorario = mysqli_fetch_all($sqlEstacionamientoHorario,MYSQLI_ASSOC);
    echo json_encode($estacionamientoHorario);
}
else{ echo json_encode([["success"=>0]]); }


?>