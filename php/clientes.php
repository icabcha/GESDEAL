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
    <h1>Listado de clientes</h1>
    
    <div id="contenedor_paginacion">
        <div id="paginacion"></div>
    </div>

    <table id="tabla">
        <thead>
            <tr id="fila1">
                <td>Código</td>
                <td>DNI</td>
                <td>Nombre</td>
                <td>Teléfono</td>
                <td>Código Postal</td>
                <td>Operaciones</td>
            </tr>
        </thead>
        <tbody>
            <!--Las filas se irán añadiendo aquí con el código realizado en JavaScript en paginacion.js-->
        </tbody>
    </table>
  
    <script src="../js/paginacion.js"></script>

    <?php
        //Creamos las variables de conexión a MySQL
        $host = "localhost";
        $usuario = "root";
        $pass = "";

        //Establecemos la conexión con MySQL
        $conexion = mysqli_connect($host, $usuario, $pass) or die("Error de conexión");
       
        //Seleccionamos la base de datos
        mysqli_select_db($conexion, "GESDEAL") or die("Error seleccionando la base de datos");
        
        //Creamos la sentencia SQL de consulta y la ejecutamos
        $leer = "SELECT * FROM CLIENTES";
        $registros = mysqli_query($conexion, $leer);

        $clientes = array();
        while($registro = mysqli_fetch_assoc($registros)){
            $clientes[] = $registro;
        }

        //Cerramos la conexión
        mysqli_close($conexion);

        //Convertimos los datos obtenidos de PHP a formato JSON para poder utilizarlos fácilmente en JavaScript
        $datos_json = json_encode($clientes);
    ?>

    <!--Incluimos los datos como un atributo data-*-->
    <div id="datos" data='<?php echo $datos_json; ?>'></div>

    <button class="button">Añadir cliente +</button>
</body>
</html>
