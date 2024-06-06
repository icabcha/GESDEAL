<?php
    //Incluimos el archivo de funciones
    require '../../functions.php';
    //Iniciamos una sesión
    session_start();

    //Verificamos si la sesión es válida
    comprobarInicioSesion();

    //Establecemos la conexión a la base de datos
    $conexion = conexionBD();

    //Verificamos si se ha especificado el tipo de datos, el campo de clave primaria y el ID del registro a eliminar
    if(isset($_GET['type']) && isset($_GET['clavePrimaria']) && isset($_GET['id'])){
        //Guardamos estos datos en variables
        $type = $_GET['type'];
        $clavePrimaria = $_GET['clavePrimaria'];
        $id = $_GET['id'];
        
        //Creamos la sentencia SQL para eliminar el registro
        $eliminar = "DELETE FROM $type WHERE $clavePrimaria = '$id'";

        //Ejecutamos la sentencia SQL anterior
        $resultado = mysqli_query($conexion, $eliminar);
    }

    //Cerramos la conexión
    mysqli_close($conexion);
?>
