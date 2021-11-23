<?php
include "conectar.php";
//Permite el acceso desde cualquier origen
header('Access-Control-Allow-Origin: *');

//Conexion a la base de datos MySql

$conn = conectarDB();
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

//Definicion de variables recibidas del post

//En produccion.......
$Dni= $_POST['Dni'];
$Nombre= $_POST['Nombre'];
$Password= $_POST['Clave'];
$Email= $_POST['Email'];


//En prueba......
/*$Dni = 1234565;
$Nombre = "Juani Greco 3";
$Password = "prueba";
$Email = 'prueba@prueba.com'; */

$Clave = password_hash($Password, PASSWORD_DEFAULT);
//Consulta sql para agregar un usuario, asigna dni como nombre y dni. El id se autogenera
$sql="INSERT INTO `usuarios`(`nombre`, `dni`, `clave`, `email`) VALUES ('$Nombre','$Dni','$Clave','$Email')";

//Ejecuta la consulta
$resultado = $conn->query($sql);

//Arma la cabecera "json"
header('Content-Type: application/json');

//Verifica si modifico la fila en la tabla
if ($resultado) {
//Si obtuvo true retorna "ok" al cliente y el "id" del nuevo usuario
    $id = mysqli_insert_id($conn);
    $usuario = array ('estadoUsuario' => 'ok', 'idUsuarioNuevo' => $id);
} else {
//Si obtuvo false retorna "" al cliente
    $usuario = array ('idUsuario' => '', 'idUsuarioNuevo' => '0');
}	

//Codifica y retorna en formato json el array
echo json_encode($usuario, JSON_FORCE_OBJECT); 

//cierra la conexion
$conn->close();
?>