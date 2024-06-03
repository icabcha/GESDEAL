<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../css/styles_listados.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="../img/logo.png"/>
    <meta name="author" content="Irene Cabeza Chacón">
    <title>GESDEAL</title>
</head>
<body>
    <?php
        require '../../functions.php';
        //Iniciamos una sesión
        session_start();

        comprobarInicioSesion();
        $conexion = conexionBD();

        $type = $_GET['type'];

        $title = '';
        $fields = '';

        switch ($type) {
            case 'articulo':
                $title = 'Añadir Nuevo Artículo';
                $fields = '
                    <label for="nombre">Nombre:</label><br>
                    <input type="text" id="nombre" name="nombre" required><br>
                    <label for="cantidad">Cantidad:</label><br>
                    <input type="number" id="cantidad" name="cantidad" required><br>
                    <label for="precio">Precio de Venta (€):</label><br>
                    <input type="number" step="0.01" id="precio" name="precio" required><br>
                ';
            break;
            case 'proveedor':
                $title = 'Añadir Nuevo Proveedor';
                $fields = '
                    <label for="nif">NIF:</label><br>
                    <input type="text" id="nif" name="nif" required><br>
                    <label for="nombre">Nombre:</label><br>
                    <input type="text" id="nombre" name="nombre" required><br>
                    <label for="direccion">Dirección:</label><br>
                    <input type="text" id="direccion" name="direccion" value="C/" required><br>
                    <label for="telefono">Teléfono:</label><br>
                    <input type="tel" id="telefono" name="telefono" required><br>
                ';
            break;
            case 'cliente':
                $title = 'Añadir Nuevo Cliente';
                $fields = '
                    <label for="dni">DNI:</label><br>
                    <input type="text" id="dni" name="dni" required><br>    
                    <label for="nombre">Nombre:</label><br>
                    <input type="text" id="nombre" name="nombre" required><br>
                    <label for="telefono">Teléfono:</label><br>
                    <input type="tel" id="telefono" name="telefono" required><br>
                    <label for="cp">Código Postal:</label><br>
                    <input type="number" id="cp" name="cp" required><br>
                ';
            break;
            case 'empleado':
                $title = 'Añadir Nuevo Empleado';
                $fields = '
                    <label for="dni">DNI:</label><br>
                    <input type="text" id="dni" name="dni" required><br>    
                    <label for="nombre">Nombre:</label><br>
                    <input type="text" id="nombre" name="nombre" required><br>
                    <label for="telefono">Teléfono:</label><br>
                    <input type="tel" id="telefono" name="telefono" required><br>
                    <label for="sueldo">Sueldo:</label><br>
                    <input type="number" id="sueldo" name="sueldo" required><br>
                    <label for="contraseña">Contraseña:</label><br>
                    <input type="text" id="contraseña" name="contraseña" required><br>
                    <label for="rol">Rol: </label><br>
                    <select name="rol" id="rol">
                        <option value="admin">ADMIN</option>
                        <option value="user">USER</option>
                    </select>
                ';
            break;
            case 'pedido':
                $title = 'Añadir Nuevo Pedido';
                //Creamos las sentencias SQL de consultas y las ejecutamos
                $consultar1 = "SELECT CLICOD FROM CLIENTES";
                $registros1 = mysqli_query($conexion, $consultar1);

                $consultar2 = "SELECT EMPCOD FROM EMPLEADOS";
                $registros2 = mysqli_query($conexion, $consultar2);

                $fields = '
                <label for="seleccionar1">Código de cliente: </label><br>
                <select name="seleccionar1" id="seleccionar1">';
                while ($registro1 = mysqli_fetch_row($registros1)) {
                    $fields .= "<option value='$registro1[0]'>" . $registro1[0] . "</option>";
                }
                $fields .= '</select><br>
                <label for="seleccionar2">Código de empleado: </label><br>
                <select name="seleccionar2" id="seleccionar2">';
                while ($registro2 = mysqli_fetch_row($registros2)) {
                    $fields .= "<option value='$registro2[0]'>" . $registro2[0] . "</option>";
                }
                $fields .= '</select><br>';
            break;
            default:
                echo 'Tipo no válido.';
                exit();
        }
    ?>

    <h1><?php echo $title; ?></h1>
    <div id="contenido"></div>
        <form action="form_añadir.php?type=<?php echo $type; ?>" method="POST">
            <?php echo $fields; ?>
            <input type="submit" value="Añadir <?php echo $type; ?>">
        </form>
        <!-- Botón para volver a los listados -->
        <?php if ($type == 'proveedor'){ ?>
            <a href="../proveedores.php"><button class="button">Volver atrás</button></a>
        <?php }else{ ?>
            <a href="../<?php echo $type; ?>s.php"><button class="button">Volver atrás</button></a>
        <?php } ?>
    </div>
    
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {    
            switch ($type) {
                case 'articulo':
                    //Consulta para obtener el último código de artículo
                    $query = "SELECT ARTCOD FROM ARTICULOS ORDER BY ARTCOD DESC LIMIT 1";
                    $result = mysqli_query($conexion, $query);
                    $row = mysqli_fetch_assoc($result);
                    $ultimo_codigo = $row['ARTCOD'];

                    //Extraemos la parte numérica del código
                    $ultimo_numero = (int)substr($ultimo_codigo, 3);

                    //Incrementamos el número
                    $nuevo_numero = $ultimo_numero + 1;

                    //Generaramos el nuevo código formateado con dos dígitos
                    $nuevo_codigo = 'AR-' . str_pad($nuevo_numero, 2, '0', STR_PAD_LEFT);

                    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
                    $cantidad = mysqli_real_escape_string($conexion, $_POST['cantidad']);
                    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
                    $insertar = "INSERT INTO ARTICULOS (ARTCOD, ARTNOM, ARTCANT, ARTPREVEN) VALUES ('$nuevo_codigo', UPPER('$nombre'), '$cantidad', '$precio')";
                break;
                case 'proveedor':
                    //Consulta para obtener el último código de proveedores
                    $query = "SELECT PROCOD FROM PROVEEDORES ORDER BY PROCOD DESC LIMIT 1";
                    $result = mysqli_query($conexion, $query);
                    $row = mysqli_fetch_assoc($result);
                    $ultimo_codigo = $row['PROCOD'];

                    //Extraemos la parte numérica del código
                    $ultimo_numero = (int)substr($ultimo_codigo, 3);

                    //Incrementamos el número
                    $nuevo_numero = $ultimo_numero + 1;

                    //Generamos el nuevo código formateado con dos dígitos
                    $nuevo_codigo = 'PR-' . str_pad($nuevo_numero, 2, '0', STR_PAD_LEFT);

                    $nif = mysqli_real_escape_string($conexion, $_POST['nif']);
                    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
                    $direccion = mysqli_real_escape_string($conexion, $_POST['direccion']);
                    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
                    $insertar = "INSERT INTO PROVEEDORES (PROCOD, PRONIF, PRONOM, PRODIR, PROTEL) VALUES ('$nuevo_codigo', '$nif', UPPER('$nombre'), UPPER('$direccion'), '$telefono')";
                break;
                case 'cliente':
                    //Consulta para obtener el último código de cliente
                    $query = "SELECT CLICOD FROM CLIENTES ORDER BY CLICOD DESC LIMIT 1";
                    $result = mysqli_query($conexion, $query);
                    $row = mysqli_fetch_assoc($result);
                    $ultimo_codigo = $row['CLICOD'];

                    //Extraemos la parte numérica del código
                    $ultimo_numero = (int)substr($ultimo_codigo, 3);

                    //Incrementamos el número
                    $nuevo_numero = $ultimo_numero + 1;

                    //Generamos el nuevo código formateado con dos dígitos
                    $nuevo_codigo = 'CL-' . str_pad($nuevo_numero, 2, '0', STR_PAD_LEFT);

                    $dni = mysqli_real_escape_string($conexion, $_POST['dni']);
                    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
                    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
                    $cp = mysqli_real_escape_string($conexion, $_POST['cp']);
                    $insertar = "INSERT INTO CLIENTES (CLICOD, CLIDNI, CLINOM, CLITEL, CLICP) VALUES ('$nuevo_codigo', '$dni', UPPER('$nombre'), '$telefono', '$cp')";
                break;
                case 'empleado':
                    //Consulta para obtener el último código de empleado
                    $query = "SELECT EMPCOD FROM EMPLEADOS ORDER BY EMPCOD DESC LIMIT 1";
                    $result = mysqli_query($conexion, $query);
                    $row = mysqli_fetch_assoc($result);
                    $ultimo_codigo = $row['EMPCOD'];

                    //Extraemos la parte numérica del código
                    $ultimo_numero = (int)substr($ultimo_codigo, 3);

                    //Incrementamos el número
                    $nuevo_numero = $ultimo_numero + 1;

                    //Generamos el nuevo código formateado con dos dígitos
                    $nuevo_codigo = 'EM-' . str_pad($nuevo_numero, 2, '0', STR_PAD_LEFT);

                    $dni = mysqli_real_escape_string($conexion, $_POST['dni']);
                    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
                    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
                    $sueldo = mysqli_real_escape_string($conexion, $_POST['sueldo']);
                    $contraseña = mysqli_real_escape_string($conexion, $_POST['contraseña']);
                    $rol = mysqli_real_escape_string($conexion, $_POST['rol']);
                    $insertar = "INSERT INTO EMPLEADOS (EMPCOD, EMPDNI, EMPNOM, EMPTEL, EMPSUE, EMPCON, EMPROL) VALUES ('$nuevo_codigo', '$dni', UPPER('$nombre'), '$telefono', '$sueldo', '$contraseña', '$rol')";
                break;
                case 'pedido':
                    //Consulta para obtener el último código de pedido
                    $query = "SELECT PEDCOD FROM PEDIDOS ORDER BY PEDCOD DESC LIMIT 1";
                    $result = mysqli_query($conexion, $query);
                    $row = mysqli_fetch_assoc($result);
                    $ultimo_codigo = $row['PEDCOD'];

                    //Extraemos la parte numérica del código
                    $ultimo_numero = (int)substr($ultimo_codigo, 3);

                    //Incrementamos el número
                    $nuevo_numero = $ultimo_numero + 1;

                    //Generamos el nuevo código formateado con dos dígitos
                    $nuevo_codigo = 'PE-' . str_pad($nuevo_numero, 2, '0', STR_PAD_LEFT);

                    $clicod = mysqli_real_escape_string($conexion, $_POST['seleccionar1']);
                    $empcod = mysqli_real_escape_string($conexion, $_POST['seleccionar2']);
                    $insertar = "INSERT INTO PEDIDOS (PEDCOD, PEDFEC, CLICOD, EMPCOD) VALUES ('$nuevo_codigo', NOW(),'$clicod', '$empcod')";
                break;
            }

            if (mysqli_query($conexion, $insertar)) {
                echo "Nuevo $type añadido con éxito.";
            } else {
                echo "Error: " . $insertar . "<br>" . mysqli_error($conexion);
            }

            mysqli_close($conexion);

            //Redirigimos de vuelta a la lista correspondiente
            if($type == 'proveedor'){
                header("Location: ../${type}es.php");
            }else{
                header("Location: ../${type}s.php");
            }
            exit();
        }
    ?>
</body>
</html>
