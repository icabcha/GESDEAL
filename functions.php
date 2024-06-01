<?php
    //Función para conectarse a la base de datos
    function conexionBD() {
        //Creamos las variables de conexión a MySQL
        $host="localhost";
        $usuario="root";
        $pass="";
        $nom_db = "GESDEAL";

        //Establecemos la conexión con MySQL
        $conexion = mysqli_connect($host, $usuario, $pass);
        //Seleccionamos la base de datos
        mysqli_select_db($conexion, $nom_db);

        if(!$conexion){
            echo "<script>console.log('Fallo en la conexión');</script>";;
        }
        else {
            return $conexion;
        }
    }

    //Función para comprobar que se ha iniciado sesión
    function comprobarInicioSesion() {
        if(!isset($_SESSION["dni"]) && !isset($_SESSION["contraseña"])){
            header('location: login.php');
            exit();
        }
    }
?>