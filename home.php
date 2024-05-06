<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/logo.png"/>
    <link href="css/styles_home.css" rel="stylesheet" type="text/css">
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
    <!--Cabecera-->
    <div class="cabecera">
        <!-- Enlace para ir al inicio -->
        <a href="home.php">Inicio <img src="img/home.png" alt="home"></a>
        <!-- Enlace al perfil del usuario -->
        <a href="perfil.php">Mi Perfil <img src="img/user.png" alt="user"></a>
        <!-- Enlace para hacer Log out -->
        <a href="logout.php">Cerrar sesión <img src="img/exit.png" alt="exit"></a>
    </div>

    <!--Creamos con la etiqueta nav una sección de la página que proporcionará enlaces de navegación-->
    <nav class="nav">
        <!--En esta sección hay una lista no ordenada de elementos-->
        <ul class="list">
            <!--Para las distintas clases de la lista, he utilizado BEM que es una metodología de nomenclatura
            para definir las clases de forma más ordenada para así no perderme a la hora de realizar el html y el css, ya que es 
            bastante largo-->
        </ul>
    </nav>

    
    <!--Utilizamos la etiqueta iframe para "crear" una sección en el html que contiene y mostrará otra página html.
    Por defecto aparecerá la página de Inicio en el iframe-->
    <div class="iframe">
        <iframe src="welcome.php" frameborder="0" name="seccion_iframe"></iframe>
    </div>
</body>
</html>