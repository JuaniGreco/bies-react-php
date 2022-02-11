<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
//$servidor = "localhost"; $usuario = "root"; $contrasenia = "wAcR7(XgzFuCRwn%"; $nombreBaseDatos = "id18437891_biesreact";
//$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);

include "conectar.php";
$conexionBD = conectarDB();
if ($conexionBD->connect_error) {
	die("Connection failed: " . $conexionBD->connect_error);
}



// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_GET["consultar"])){
    $sqlEstacionamientoHorario = mysqli_query($conexionBD,"SELECT * FROM playadeestacionamientohorario WHERE idHorario=".$_GET["consultar"]);
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
    $diaSemana=$data->diaSemana;
    $horaInicio=$data->horaInicio;
    $horaFin=$data->horaFin;

        if(($idPlayaDeEstacionamiento!="")&&($diaSemana!="")&&($horaInicio!="")&&($horaFin!="")){            
            $sqlEstacionamientoHorario = mysqli_query($conexionBD,"INSERT INTO playadeestacionamientohorario(idPlayaDeEstacionamiento, diaSemana, horaInicio, horaFin) VALUES ('$idPlayaDeEstacionamiento',
            '$diaSemana', '$horaInicio', '$horaFin')");
            echo json_encode(["success"=>1]);
        }
    exit();
}
// Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
if(isset($_GET["actualizar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $idHorario=(isset($data->idHorario))?$data->idHorario:$_GET["actualizar"];
    $idPlayaDeEstacionamiento=$data->idPlayaDeEstacionamiento;
    $diaSemana = $data->diaSemana;
    $horaInicio=$data->horaInicio;
    $horaFin = $data->horaFin;
    
    $sqlEstacionamientoHorario = mysqli_query($conexionBD,"UPDATE playadeestacionamientohorario SET diaSemana= '$diaSemana', horaInicio = '$horaInicio', horaFin = '$horaFin' WHERE idHorario='$idHorario'");
    echo json_encode(["success"=>1]);
    exit();
}
// Consulta todos los registros de la tabla empleados
$sqlEstacionamientoHorario = mysqli_query($conexionBD,"SELECT * FROM playadeestacionamientohorario ");
if(mysqli_num_rows($sqlEstacionamientoHorario) > 0){
    $estacionamientoHorario = mysqli_fetch_all($sqlEstacionamientoHorario,MYSQLI_ASSOC);
    echo json_encode($estacionamientoHorario);
}
else{ echo json_encode([["success"=>0]]); }


?>