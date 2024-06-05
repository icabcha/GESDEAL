<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/styles_listados.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="../img/logo.png"/>
    <meta name="author" content="Irene Cabeza Chacón">
    <title>GESDEAL</title>
</head>
<body>
    <!--Título principal de la página-->
    <h1>Línea de detalle</h1>

    <?php
        //Incluimos el archivo de funciones
        require '../functions.php';
        //Iniciamos una sesión
        session_start();

        //Verificamos si la sesión es válida
        comprobarInicioSesion();
        //Establecemos la conexión a la base de datos
        $conexion = conexionBD();
        
        //Declaramos una variable llamada $valor vacía
        $valor="";
 
        //Creamos la sentencia SQL de consulta y la ejecutamos
        $leer="SELECT * FROM LINEADEDETALLE;";
        $registros=mysqli_query($conexion,$leer);    
    ?>

        <?php
            //Recorremos todos los resultados de la consulta anterior
            while($registro=mysqli_fetch_row($registros)){
                //Si el primer campo de la consulta coincide con el valor de la variable $valor, se hará todo lo que contiene el 'if'
                //si no se hará todo lo que contiene el 'else'
                if($registro[0]==$valor){
                    ?>
                    <!--Se crea una fila en una tabla ya existente con los resultados de la consulta-->
                    <table class="ldd--row">
                        <tr>
                            <td class="ldd--col"><?php echo $registro[0]; ?></td>
                            <td class="ldd--col"><?php echo $registro[1]; ?></td>
                            <td class="ldd--col"><?php echo $registro[2]; ?></td>
                        </tr>
                    </table>
                    <?php
                    //El contenido de la variable $valor será el de $registro[0]
                    $valor=$registro[0];
                }else{
                    ?>
                    <!--Se crea una tabla con una cabecera y con los resultados de la consulta-->
                    <table class="ldd">
                        <tr id="fila1">
                            <td class="ldd--col">Código de pedido</td>
                            <td class="ldd--col">Código de artículo</td>
                            <td class="ldd--col">Cantidad</td>
                        </tr>
                        <tr>
                            <td class="ldd--col"><?php echo $registro[0]; ?></td>
                            <td class="ldd--col"><?php echo $registro[1]; ?></td>
                            <td class="ldd--col"><?php echo $registro[2]; ?></td>
                        </tr>
                    </table>
                <?php
                $valor=$registro[0];
                }
            }
            //Esto es para que aparezca una tabla para cada pedido y queden diferenciados
        ?>
</body>
</html>