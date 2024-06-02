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
    <h1>Listado de proveedores</h1>
    
    <div id="contenedor_paginacion">
        <div id="paginacion"></div>
    </div>

    <table id="tabla" data-type="PROVEEDORES" data-idField="PROCOD">
        <thead>
            <tr id="fila1">
                <td>Código</td>
                <td>NIF</td>
                <td>Nombre</td>
                <td>Dirección</td>
                <td>Teléfono</td>
                <td>Operaciones</td>
            </tr>
        </thead>
        <tbody>
            <!-- Las filas se irán añadiendo aquí con el código realizado en JavaScript en paginacion.js -->
        </tbody>
    </table>

    <script src="../js/paginacion.js"></script>

    <?php
        require '../functions.php';
        //Iniciamos una sesión
        session_start();

        comprobarInicioSesion();
        $conexion = conexionBD();
        
        //Creamos la sentencia SQL de consulta y la ejecutamos
        $leer = "SELECT * FROM PROVEEDORES";
        $registros = mysqli_query($conexion, $leer);

        $proveedores = array();
        while($registro = mysqli_fetch_assoc($registros)){
            $proveedores[] = $registro;
        }

        //Cerramos la conexión
        mysqli_close($conexion);

        //Convertimos los datos obtenidos de PHP a formato JSON para poder utilizarlos fácilmente en JavaScript
        $datos_json = json_encode($proveedores);
    ?>
        
    <!--Incluimos los datos como un atributo data-*-->
    <div id="datos" data='<?php echo $datos_json; ?>'></div>

    <a href="./operaciones/form_añadir.php?type=proveedor"><button class="button">Añadir proveedor +</button></a>
</body>
</html>
