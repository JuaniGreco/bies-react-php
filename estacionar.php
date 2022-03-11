<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "bies-react";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);
date_default_timezone_set("America/Argentina/Buenos_Aires");

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

    /*$idUsuario = 34;
    date_default_timezone_set("America/Argentina/Buenos_Aires");
    $horaActual = date_create();
    $horaActual = date_format($horaActual, 'H:i:s');
    $fechaActual = date("Y-m-d");
    $idPlayaDeEstacionamiento = '1';
    $diaSemana = date('w');*/
    if(isset($_GET["estacionar"])){
        $data = json_decode(file_get_contents("php://input"));
        $idUsuario=$data->idUsuario;
        /*$idUsuario='34';*/
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $horaActual=date_create();
        $horaActual=date_format($horaActual, 'H:i:s');
        $fechaActual=date("Y-m-d");
        $idPlayaDeEstacionamiento=$data->idPlayaDeEstacionamiento;
        $idPlayaDeEstacionamiento=$_GET["estacionar"];
        $idUsuario=$_GET["idUsuario"];
        /*$idPlayaDeEstacionamiento='1';*/
        $diaSemana=date('w');
        //error_log ($idUsuario, 3, 'D:\Escritorio\linea48.txt');
        error_log($fechaActual, 3, 'D:\fechaActual.txt');
        $sql2 = mysqli_query($conexionBD, "SELECT * FROM estacionamiento e WHERE e.idUsuario = $idUsuario and e.fechaEstacionamiento = '$fechaActual' and e.horaFinEstacionamiento is null");
        $resultado2 = mysqli_num_rows($sql2);

        if ($resultado2 == 0) {
        //if (($horaActual > "00:00:00") and ($horaActual < "23:59:59")) {
            $sql = mysqli_query($conexionBD,"INSERT INTO `estacionamiento`(`idUsuario`, `idPlayaDeEstacionamiento`, `idPlayaDeEstacionamientoHorario`, `fechaEstacionamiento`, 
                `horaInicioEstacionamiento`) 
                VALUES ($idUsuario, $idPlayaDeEstacionamiento, (SELECT playadeestacionamientohorario.idHorario
                FROM `playadeestacionamientohorario` 
                WHERE '$horaActual' BETWEEN playadeestacionamientohorario.horaInicio and playadeestacionamientohorario.horaFin 
                and playadeestacionamientohorario.diaSemana = $diaSemana and playadeestacionamientohorario.idPlayaDeEstacionamiento = $idPlayaDeEstacionamiento),
                '$fechaActual', '$horaActual')");
            
            //RESTO UNO A LA CAPACIDAD DE LUGARES LIBRES
            $sql2= mysqli_query ($conexionBD, "UPDATE `playadeestacionamiento` SET `lugaresLibres` = lugaresLibres - 1 WHERE idPlayaDeEstacionamiento = $idPlayaDeEstacionamiento");
            
                echo json_encode(["success"=>1]);
        } else {// puede traer error, manda 0 al front
                echo json_encode(["success"=>0]);
        };
        exit();
    }

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



/*
error_log ($idUsuario, 3, 'D:\ID.txt');
error_log ($horaActual, 3, 'D:\hora.txt');
error_log ($fechaActual, 3, 'D:\fecha.txt');
error_log ($diaSemana, 3, 'D:\dia.txt');
error_log($idPlayaDeEstacionamiento, 3, 'D:\idPlaya.txt');
*/


/*header('Content-Type: application/json');
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
$conn->close();*/
?>
