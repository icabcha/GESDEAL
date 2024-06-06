<?php
    ////Incluimos el archivo de funciones
    require '../../functions.php';
    //Iniciamos una sesión
    session_start();

    //Verificamos si la sesión es válida
    comprobarInicioSesion();

    //Establecemos la conexión a la base de datos
    $conexion = conexionBD();

    //Verificamos si se ha especificado el tipo de datos, el campo de clave primaria y el ID del registro a actualizar
    if (isset($_GET['type']) && isset($_GET['clavePrimaria']) && isset($_GET['id'])){
        //Guardamos estos datos en variables
        $type = $_GET['type'];
        $clavePrimaria = $_GET['clavePrimaria'];
        $id = $_GET['id'];

        //Decodificamos el cuerpo de la solicitud para obtener los datos actualizados
        $data = json_decode(file_get_contents('php://input'), true);

        //Creamos un array para almacenar las partes de la cláusula SET de la sentencia SQL
        $valoresActualizar = [];

        //Recorremos los datos actualizados recibidos
        foreach ($data as $campo => $nuevo_valor) {
            //Para cada campo, construimos una parte de la cláusula SET en la forma "campo = 'valor'"
            $valoresActualizar[] = "$campo = '" . mysqli_real_escape_string($conexion, $nuevo_valor) . "'";
        }

        //Unimos todas las partes de la cláusula SET en una cadena separada por comas
        $valoresActualizarFormateado = implode(", ", $valoresActualizar);
        //Creamos la sentencia SQL para actualizar el registro
        $modificar = "UPDATE $type SET $valoresActualizarFormateado WHERE $clavePrimaria = '" . mysqli_real_escape_string($conexion, $id) . "'";

        //Ejecutamos la sentencia SQL anterior
        $resultado = mysqli_query($conexion, $modificar);
    }

    //Cerramos la conexión
    mysqli_close($conexion);
?>