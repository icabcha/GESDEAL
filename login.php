<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="img/logo.png"/>
    <meta name="author" content="Irene Cabeza Chacón">
    <title>GESDEAL</title>
</head>
<body>
    <?php
        //Si hemos pulsado en el botón del formulario, se hará todo lo que contiene el 'if'
        if(isset($_POST['submit'])){
            //Iniciamos una sesión
            session_start();
            //Creamos las variables de conexión a MySQL
            $host="localhost";
            $usuario="root";
            $pass="";
    
            //Establecemos la conexión con MySQL
            $conexion=mysqli_connect($host,$usuario,$pass) or die("Error de conexión");
            
            //Seleccionamos la base de datos
            $seleccionar=mysqli_select_db($conexion,'GESDEAL') or die("Error seleccionando la base de datos");
            
            //Recogemos en variables los valores introducidos en el formulario
            $dni=$_REQUEST['dni'];
            $password=$_REQUEST['contraseña'];

            //Creo una variable de sesión con el DNI y una variable $encontrado con valor FALSE
            $_SESSION["dni"]=$dni;
            $encontrado=FALSE;

            //Creamos la sentencia SQL de consulta y la ejecutamos
            $comprobar="SELECT EMPDNI,EMPCON FROM EMPLEADOS";
            $registro1=mysqli_query($conexion,$comprobar);
    
            //Recorremos todos los resultados de la consulta anterior, si hay coincidencias cambiará el valor de la variable $encontrado
            while($registros=mysqli_fetch_row($registro1)){
                if($registros[0]==$dni && $registros[1]==$password){
                    $encontrado=TRUE;
                }
            }   
            
            /*Si la variable $encontrado es igual a TRUE, se nos redirigirá a la página de inicio,
            si no aparecerá un mensaje de error y podremos volver a intentarlo rellenando de nuevo el formulario*/
            if($encontrado==TRUE){
                header('location:home.php');   
            }else{
                ?>
                <img id="img_error" src="img/error.png" alt="error">
                <p id="error">Los datos introducidos no son correctos, inténtelo de nuevo</p>
                <?php
            }
        }

    ?>
    <!--Formulario para iniciar sesión-->
    <p><img src="img/login.png" alt="Logo"></p>
    <div class="formulario">
        <form action="" method="POST">
            <p><label for="dni">DNI:</label></p>
            <p><input type="text" name="dni" required/></p>   
      
            <p><label for="contraseña">Contraseña:</label></p>
            <p><input type="password" name="contraseña" required/></p>             
      
            <button class="button" type="submit" name="submit"><span>Iniciar sesión</span></button>
        </form>
    </div>
</body>
</html>