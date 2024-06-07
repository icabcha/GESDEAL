<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/styles_listados.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="../img/logo.png"/>
    <meta name="author" content="Irene Cabeza Chacón">
    <title>GESDEAL - Avisos</title>
</head>
<body>
    <!--Título principal de la página-->
    <h1>Avisos - Poco Stock</h1>

    <div id="contenedor_paginacion">
        <!--Contenedor para la barra de búsqueda-->
        <div id="contenedor_busqueda"><input type="text" id="barraBusqueda" placeholder="Buscar artículos..."></div>
        <!--Contenedor para la paginación-->
        <div id="paginacion"></div>
    </div>

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
        $leer = "SELECT ARTCOD, ARTNOM, ARTCANT FROM ARTICULOS WHERE ARTCANT <= 25";
        $registros = mysqli_query($conexion, $leer);

        //Almacenamos los resultados de la consulta anterior en un array
        $articulos = array();
        while($articulo = mysqli_fetch_assoc($registros)){
            $articulos[] = $articulo;
        }

        //Cerramos la conexión
        mysqli_close($conexion);
    ?>

    <!--Convertimos los datos PHP a JSON y los asignamos a un atributo data para poder utilizarlos fácilmente en JavaScript-->
    <div id="datos" data='<?php echo json_encode($articulos); ?>'></div>

    <table id="tabla" data-type="AVISOS">
        <!--Encabezado de la tabla-->
        <thead>
            <tr id="fila1">
                <td>Código de artículo</td>
                <td>Nombre de artículo</td>
                <td>Cantidad disponible</td>
            </tr>
        </thead>
        <tbody>
            <?php
                //Mostramos los datos en la tabla
                foreach($articulos as $articulo) {
                    echo '<tr>';
                    echo '<td>' . $articulo['ARTCOD'] . '</td>';
                    echo '<td>' . $articulo['ARTNOM'] . '</td>';
                    echo '<td>' . $articulo['ARTCANT'] . '</td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>
</body>
</html>
