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
    <h1>Listado de pedidos</h1>
    
    <div id="contenedor_paginacion">
        <!--Contenedor para la barra de búsqueda-->
        <div id="contenedor_busqueda"><input type="text" id="barraBusqueda" placeholder="Buscar pedidos..."></div>
        <!--Contenedor para la paginación-->
        <div id="paginacion"></div>
    </div>

    <table id="tabla" data-type="PEDIDOS" data-idField="PEDCOD">
        <!--Encabezado de la tabla-->
        <thead>
            <tr id="fila1">
                <td>Código</td>
                <td>Fecha</td>
                <td>Código de cliente</td>
                <td>Código de empleado</td>
                <td>Operaciones</td>
            </tr>
        </thead>
        <tbody>
            <!--Las filas se irán añadiendo aquí con el código realizado en JavaScript en paginacion.js-->
        </tbody>
    </table>

    <!--Incluimos el archivo JavaScript con las funciones-->
    <script src="../js/functions.js"></script>

    <?php
        //Incluimos el archivo de funciones
        require '../functions.php';
        //Iniciamos una sesión
        session_start();

        //Verificamos si la sesión es válida
        comprobarInicioSesion();
        //Establecemos la conexión a la base de datos
        $conexion = conexionBD();

        //Creamos la sentencia SQL de consulta y la ejecutamos
        $leer = "SELECT * FROM PEDIDOS";
        $registros = mysqli_query($conexion, $leer);

        //Almacenamos los resultados de la consulta anterior en un array
        $pedidos = array();
        while($registro = mysqli_fetch_assoc($registros)){
            $pedidos[] = $registro;
        }

        //Cerramos la conexión
        mysqli_close($conexion);

        //Convertimos los datos obtenidos de PHP a formato JSON para poder utilizarlos fácilmente en JavaScript
        $datos_json = json_encode($pedidos);
    ?>

    <!--Incluimos los datos como un atributo data-* que permite que los datos sean fáciles de acceder y manipular mediante JavaScript-->
    <div id="datos" data='<?php echo $datos_json; ?>'></div>

    <!--Incluimos un enlace para añadir un nuevo pedido-->
    <a href="./operaciones/form_añadir.php?type=pedido"><button class="button">Añadir pedido +</button></a>
</body>
</html>
