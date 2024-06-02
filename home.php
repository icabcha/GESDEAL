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
        require './functions.php';
        //Iniciamos una sesión
        session_start();

        comprobarInicioSesion();
        $conexion = conexionBD();

        //Guardamos en la variable $dni el contenido de la variable de sesión $_SESSION["dni"]
        $dni=$_SESSION["dni"];

        //Creamos la sentencia SQL de consulta y la ejecutamos
        $consultar = "SELECT EMPNOM FROM EMPLEADOS WHERE EMPDNI = '$dni'";
        $registro=mysqli_query($conexion,$consultar);
        
        //Guardo el resultado de la consulta anterior
        $nombre=mysqli_fetch_row($registro);
        $nombre_empleado=$nombre[0];

        //Creamos la sentencia SQL de consulta y la ejecutamos
        $consultar2 = "SELECT EMPROL FROM EMPLEADOS WHERE EMPDNI = '$dni'";
        $registro2=mysqli_query($conexion,$consultar2);

        //Guardo el resultado de la consulta anterior
        $rol=mysqli_fetch_row($registro2);
        $rol_empleado=$rol[0];
    ?>
    <!--Cabecera-->
    <div class="cabecera">
        <!-- Enlace para ir al inicio -->
        <a href="home.php">Inicio <img src="img/home.png" alt="home"></a>
        <!-- Enlace al perfil del usuario -->
        <a href="pages/perfil.php" target="seccion_iframe">Mi Perfil <img src="img/user.png" alt="user"></a>
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
            <?php if ($rol_empleado == 'admin') { ?>
                <li class="list__item">
                    <div class="list__button">
                        <img src="img/empleados.svg" class="list__img">
                        <a href="pages/empleados.php" target="seccion_iframe" class="nav__link">Empleados</a>
                    </div>
                </li>
            <?php } ?>

            <li class="list__item">
                <div class="list__button">
                    <img src="img/articulos.svg" class="list__img">
                    <a href="pages/articulos.php" target="seccion_iframe" class="nav__link">Artículos</a>
                </div>
            </li>

            <li class="list__item">
                <div class="list__button">
                    <img src="img/proveedores.svg" class="list__img">
                    <a href="pages/proveedores.php" target="seccion_iframe" class="nav__link">Proveedores</a>
                </div>
            </li>

            <li class="list__item">
                <div class="list__button">
                    <img src="img/clientes.svg" class="list__img">
                    <a href="pages/clientes.php" target="seccion_iframe" class="nav__link">Clientes</a>
                </div>
            </li>

            <li class="list__item">
                <div class="list__button">
                    <img src="img/pedidos.svg" class="list__img"> 
                    <a href="pages/pedidos.php" target="seccion_iframe" class="nav__link">Pedidos</a>
                </div>
            </li>

            <li class="list__item">
                <div class="list__button">
                    <img src="img/lineadedetalle.svg" class="list__img">
                    <a href="pages/lineadedetalle.php" target="seccion_iframe" class="nav__link">Línea de detalle</a>
                </div>
            </li>

            <li class="list__item">
                <div class="list__button">
                    <img src="img/download2.svg" class="list__img">
                    <a href="pages/suministro.php" target="seccion_iframe" class="nav__link">Suministro</a>
                </div>
            </li>

            <li class="list__item">
                <div class="list__button">
                    <img src="img/notification.svg" class="list__img">
                    <a href="pages/avisos.php" target="seccion_iframe" class="nav__link">Avisos</a>
                </div>
            </li>
        </ul>
    </nav>

    <!--Utilizamos la etiqueta iframe para "crear" una sección en el html que contiene y mostrará otra página html.
    Por defecto aparecerá la página de Inicio (welcome.php) en el iframe-->
    <div class="iframe">
        <iframe src="pages/welcome.php" frameborder="0" name="seccion_iframe"></iframe>
    </div>
</body>
</html>