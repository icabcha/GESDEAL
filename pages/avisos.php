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
    <h1>Avisos - Poco Stock</h1>
    <?php
        require '../functions.php';
        // Iniciamos una sesión
        session_start();

        comprobarInicioSesion();
        $conexion = conexionBD();

        // Creamos la sentencia SQL de consulta y la ejecutamos
        $leer = "SELECT ARTCOD, ARTNOM, ARTCANT FROM ARTICULOS WHERE ARTCANT <= 25";
        $registros = mysqli_query($conexion, $leer);

        // Convertir los datos PHP en un array
        $articulos = array();
        while($articulo = mysqli_fetch_assoc($registros)){
            $articulos[] = $articulo;
        }

        // Cerramos la conexión
        mysqli_close($conexion);
    ?>

    <!-- Convertir los datos PHP a JSON y asignarlos a un atributo data -->
    <div id="datos" data='<?php echo json_encode($articulos); ?>' style="display: none;"></div>

    <!-- La tabla de datos -->
    <table id="tabla">
        <thead>
            <tr id="fila1">
                <td>Código del artículo</td>
                <td>Nombre del artículo</td>
                <td>Cantidad disponible</td>
            </tr>
        </thead>
        <tbody>
            <?php
                // Mostrar los datos PHP en la tabla
                foreach($articulos as $articulo) {
                    echo '<tr>';
                    echo '<td>' . $articulo['ARTCOD'] . '</td>';
                    echo '<td>' . $articulo['ARTNOM'] . '</td>';
                    echo '<td id="col3">' . $articulo['ARTCANT'] . '</td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>
</body>
</html>
