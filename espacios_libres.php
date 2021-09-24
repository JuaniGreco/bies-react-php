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

//--------En producción--------
$FechaActual = date("Y-m-d");

//--------En prueba--------
//$FechaActual = '2021-09-21';


$sql = "SELECT pe.nombrePlayaDeEstacionamiento,  ((pe.capacidad) -
(select count(e.idEstacionamiento)
from estacionamiento e
WHERE e.fechaEstacionamiento = '$FechaActual' and e.horaFinEstacionamiento is null and pe.idPlayaDeEstacionamiento = e.idPlayaDeEstacionamiento)) as disponibilidad
from playadeestacionamiento pe
order by pe.nombrePlayaDeEstacionamiento";




// Porcentaje Estacionamiento 1
/*$sql="SELECT ph.idHorario, pe.idPlayaDeEstacionamiento, pe.nombrePlayaDeEstacionamiento, pe.ubicacion, pe.capacidad, count(e.idEstacionamiento) as ocupado, (count(e.idEstacionamiento) / pe.capacidad * 100) as porcentaje_ocupado
from playadeestacionamiento pe
left join playadeestacionamientohorario ph on (pe.idPlayaDeEstacionamiento = ph.idPlayaDeEstacionamiento)
left join ESTACIONAMIENTO e on (ph.idHorario = e.idPlayaDeEstacionamientoHorario) and (e.fechaEstacionamiento = current_date) and (e.horaFinEstacionamiento is null)
where '$HoraActual' between ph.horaInicio and ph.horaFin
and ph.diaSemana = '$diaSemana'
group by ph.idHorario, pe.idPlayaDeEstacionamiento, pe.nombrePlayaDeEstacionamiento, pe.ubicacion, pe.capacidad";
*/

// EN PRODUCCION
/*$sql ="SELECT pe.nombrePlayaDeEstacionamiento, count(e.idEstacionamiento), (count(e.idEstacionamiento) / pe.capacidad * 100) as porcentaje_ocupado
from estacionamiento e
left join playadeestacionamiento pe on (e.idPlayaDeEstacionamiento = pe.idPlayaDeEstacionamiento)
where e.horaFinEstacionamiento is null and e.fechaEstacionamiento = '$FechaActual'";*/

//En prueba
/*
$sql ="SELECT pe.nombrePlayaDeEstacionamiento, count(e.idEstacionamiento), (count(e.idEstacionamiento) / pe.capacidad * 100) as porcentaje_ocupado
from estacionamiento e
left join playadeestacionamiento pe on (e.idPlayaDeEstacionamiento = pe.idPlayaDeEstacionamiento)
where e.horaFinEstacionamiento is null and e.fechaEstacionamiento = '2021-09-17'"; */


//Ejecuta la consulta
$resultado = $conn->query($sql);
//echo ("pase la ejecucion");

//Arma la cabecera "json"
header('Content-Type: application/json');

//Verifica si encontro filas en la tabla
if ($resultado->num_rows > 0) {
//El resultado (resulset) se recorre con el while	
//A cada fila (en este caso es una sola) la carga en un array 


/*
    while ($fila=mysqli_fetch_array($resultado)){
        $usuario = array ('estacionamiento' => $fila['nombrePlayaDeEstacionamiento'], 'disponibilidad'=> $fila['disponibilidad']);
    }
} else {
//Si no existe crea el array con todos valores vacios	
    $usuario = array ('idUsuario'=>'');
}	
*/

while($contador=$resultado->fetch_assoc()){
    $sqlArray["Info"][] = $contador;
}
}

//Codifica y retorna en formato json el array
echo json_encode($sqlArray, JSON_FORCE_OBJECT); 

//cierra la conexion
$conn->close();

?>