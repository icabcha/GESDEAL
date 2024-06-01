<?php
//Incluimos el archivo de funciones y comenzamos la sesión
require '../functions.php';
session_start();

//Función para comprobar si el inicio de sesión es válido
comprobarInicioSesion();

//Establecemos la conexión a la base de datos
$conexion = conexionBD();

//Verificamos si se ha especificado el tipo de datos, el campo de clave primaria y el ID del registro a eliminar
if(isset($_GET['type']) && isset($_GET['idField']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $idField = $_GET['idField'];
    $id = $_GET['id'];
    
    //Creamos la sentencia SQL para eliminar el registro
    $eliminar = "DELETE FROM $type WHERE $idField = '$id'";

    //Ejecutamos la sentencia SQL
    $resultado = mysqli_query($conexion, $eliminar);
}

//Cerramos la conexión a la base de datos
mysqli_close($conexion);
?>
