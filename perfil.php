<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/logo.png"/>
    <link href="css/styles_perfil.css" rel="stylesheet" type="text/css">
    <meta name="author" content="Irene Cabeza Chacón">
    <script src="./js/password.js"></script>
    <title>GESDEAL - Perfil</title>
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
        $consultar = "SELECT * FROM EMPLEADOS WHERE EMPDNI = '$dni'";
        $registros=mysqli_query($conexion,$consultar);

        while($registro=mysqli_fetch_row($registros)){
            $codigo = $registro[0];
            $dni = $registro[1];
            $nombre = $registro[2];
            $telefono = $registro[3];
            $pass = $registro[5];
        }
        
    ?>

    <h1>Gestión de mi perfil</h1>

    <div>
        <img src="img/user-profile.png" id="img-user" alt="user-profile">
    </div>

    <form action="perfil.php" method="POST">
        <label for="codigo">Código:</label>
        <input type="text" id="codigo" name="codigo" value="<?php echo $codigo; ?>" readonly><br>
        
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" value="<?php echo $dni; ?>"><br>
        
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>"><br>
        
        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono" value="<?php echo $telefono; ?>"><br>

        <label for="pass">Contraseña:</label>
        <input type="password" id="pass" name="pass" value="<?php echo $pass; ?>">
        <img src="img/eye-blocked.png" class="show-pass" onclick="togglePassword()" alt="Mostrar contraseña">
        <img src="img/eye.png" class="hide-pass" onclick="togglePassword()" alt="Ocultar contraseña" style="display: none;"><br>

        <input type="submit" value="Guardar" name="Guardar">
    </form>

    <?php
        //Si hemos pulsado en el botón "Guardar", se hará todo lo que contiene el 'if'
        if(isset($_POST["Guardar"])){
            //Recogemos en variables los valores introducidos en el formulario
            $codigo=$_REQUEST["codigo"]; 
            $dni=$_REQUEST["dni"];
            $nombre=$_REQUEST["nombre"];
            $telefono=$_REQUEST["telefono"];
            $contraseña=$_REQUEST["pass"];
        
            //Si existen las variables se hará todo lo que contiene el 'if'
            if(isset($codigo) && isset($dni) && isset($nombre) && isset($telefono) && isset($contraseña)){
                //Creamos la sentencia SQL de actualización/modificación
                $actualizar="UPDATE EMPLEADOS SET EMPDNI='$dni' AND EMPNOM='$nombre' AND EMPTEL='$telefono' AND EMPCON='$contraseña' WHERE EMPCOD='$codigo'";

                //Si no da fallos a la hora de ejecutar la sentencia anterior, se hará todo lo que contiene el 'if', si no se hará todo lo que
                //contiene el 'else'
                if(mysqli_query($conexion,$actualizar)){
                    ?>
                        <img id="img_exito" src="img/tick.png" alt="exito">
                        <p id="exito">Su perfil se ha guardado correctamente.</p>
                    <?php
                }else{
                    ?>
                    <img id="img_error" src="img/error.png" alt="error">
                    <p id="error">Los datos introducidos no son correctos, inténtelo de nuevo.</p>
                    <?php
                }            
            }
        }
    ?>
</body>
</html>