<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/styles_home.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="img/logo.png"/>
    <meta name="author" content="Irene Cabeza Chacón">
    <title>GESDEAL</title>
</head>
<body>
    <?php
        //Iniciamos una sesión
        session_start();
        //Creamos las variables de conexión a MySQL
        $host="localhost";
        $usuario="root";
        $pass="";
        //Guardamos en la variable $dni el contenido de la variable de sesión $_SESSION["dni"]
        $dni=$_SESSION["dni"];

        //Establecemos la conexión con MySQL
        $conexion=mysqli_connect($host,$usuario,$pass) or die("Error de conexión");

        //Seleccionamos la base de datos
        $seleccionar=mysqli_select_db($conexion,'GESDEAL') or die("Error seleccionando la base de datos");

        //Creamos la sentencia SQL de consulta y la ejecutamos
        $consultar = "SELECT EMPNOM FROM EMPLEADOS WHERE EMPDNI = '$dni'";
        $registro=mysqli_query($conexion,$consultar);
        
        //Guardo el resultado de la consulta anterior
        $nombre=mysqli_fetch_row($registro);
        $nombre_empleado=$nombre[0];
    ?>

    <!--Texto de bienvenida a la página de inicio-->
    <div class="texto_bienvenida">
        <h1>Bienvenido/a a GESDEAL</h1>
        <img id="logo" src="img/logo.png" alt="logo">
        <p>Usted ha iniciado sesión con el usuario de: <b><?php echo $nombre_empleado; ?></b>, cuyo DNI es:
            <b><?php
                echo $dni. ".";
            ?></b>
        </p>
    </div>
</body>
</html>