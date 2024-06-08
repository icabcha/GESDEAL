<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/logo.png"/>
    <link href="css/styles_login.css" rel="stylesheet" type="text/css">
    <meta name="author" content="Irene Cabeza Chacón">
    <script src="./js/foco.js"></script>
    <title>GESDEAL</title>
</head>
<body onload="ponerFoco()">
    <?php
        //Definimos las variables para la conexión a la base de datos
        $host = "localhost";
        $usuario = "root";
        $pass = "";

        //Establecemos la conexión a la base de datos
        $conexion = mysqli_connect($host, $usuario, $pass) or die("Error de conexión");

        //Comprobamos si existe la base de datos GESDEAL
        $existe_bd = mysqli_query($conexion, "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'GESDEAL'");;

        //Con mysqli_num_rows($existe_bd) == 0 verificamos si la consulta SQL anterior no devuelve ningún resultado
        //Si no existe la base de datos, la creamos y la seleccionamos
        if (!$existe_bd || mysqli_num_rows($existe_bd) == 0) {
            require 'sql/crear_bd.php';
            require 'sql/triggers.php';
            mysqli_select_db($conexion, "GESDEAL") or die("Error seleccionando la base de datos después de crearla");
        } else {
            //Si existe la base de datos, la seleccionamos
            mysqli_select_db($conexion, "GESDEAL") or die("Error seleccionando la base de datos");
        }

        //Si se ha enviado el formulario de login, se inicia una sesión
        if (isset($_POST['submit'])) {
            session_start();

            //Guardamos en variables los datos del formulario
            $dni = $_REQUEST['dni'];
            $password = $_REQUEST['contraseña'];

            //Guardamos el dni en la variable de sesión
            $_SESSION["dni"] = $dni;
            //Iniciamos una variable 'encontrado' a FALSE
            $encontrado = FALSE;

            //Comprobamos las credenciales en la tabla EMPLEADOS
            $comprobar = "SELECT EMPDNI, EMPCON FROM EMPLEADOS";
            $registro1 = mysqli_query($conexion, $comprobar);

            while ($registros = mysqli_fetch_row($registro1)) {
                if ($registros[0] == $dni && $registros[1] == $password) {
                    $encontrado = TRUE;
                }
            }

            /*Si la variable $encontrado es igual a TRUE, se nos redirigirá a la página de inicio, si no aparecerá un mensaje de error y podremos volver 
            a intentarlo rellenando de nuevo el formulario*/
            if ($encontrado == TRUE) {
                header('Location: home.php');
                exit();
            } else {
                ?>
                <img id="img_error" src="img/error.png" alt="error">
                <p id="error">Los datos introducidos no son correctos, inténtelo de nuevo</p>
                <?php
            }
        }
    ?>
    <!--Formulario para iniciar sesión-->
    <p><img src="img/logo.png" alt="Logo"></p>
    <div class="formulario">
        <form action="" method="POST">
            <p><label for="dni">DNI:</label></p>
            <p><input type="text" name="dni" id="dni" required/></p>   
            <p><label for="contraseña">Contraseña:</label></p>
            <p><input type="password" name="contraseña" id="contraseña" required/></p>             
            <button class="button" type="submit" name="submit"><span>Iniciar sesión</span></button>
        </form>
    </div>
</body>
</html>