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
        //Incluimos el archivo de funciones
        require '../../functions.php';
        //Iniciamos una sesión
        session_start();

        //Verificamos si la sesión es válida
        comprobarInicioSesion();
        //Establecemos la conexión a la base de datos
        $conexion = conexionBD();

        //Guardamos el parámetro 'type' pasado por GET en la variable con el mismo nombre
        $type = $_GET['type'];

        //Inicializamos las variables para el título y los campos del formulario
        $title = '';
        $fields = '';

        //Según el parámetro 'type' tendremos un formulario u otro
        switch ($type) {
            //Formulario para añadir un nuevo artículo
            case 'articulo':
                $title = 'Nuevo artículo';
                //Campos para el formulario de nuevo artículo
                $fields = '
                    <table class="tabla_añadir">
                        <tr>
                            <td><label for="nombre">Nombre:</label></td>
                            <td><input type="text" id="nombre" name="nombre" required></td>
                        </tr>
                        <tr>
                            <td><label for="cantidad">Cantidad:</label></td>
                            <td><input type="number" id="cantidad" name="cantidad" required></td>
                        </tr>
                        <tr>
                            <td><label for="precio">Precio de Venta (€):</label></td>
                            <td><input type="number" step="0.01" id="precio" name="precio" required></td>
                        </tr>
                    </table>
                ';
            break;
            //Formulario para añadir un nuevo proveedor
            case 'proveedor':
                $title = 'Nuevo proveedor';
                //Campos para el formulario de nuevo proveedor
                $fields = '
                    <table class="tabla_añadir">
                        <tr>
                            <td><label for="nif">NIF:</label></td>
                            <td><input type="text" id="nif" name="nif" required></td>
                        </tr>
                        <tr>
                            <td><label for="nombre">Nombre:</label></td>
                            <td><input type="text" id="nombre" name="nombre" required></td>
                        </tr>
                        <tr>
                            <td><label for="direccion">Dirección:</label></td>
                            <td><input type="text" id="direccion" name="direccion" value="C/" required></td>
                        </tr>
                        <tr>
                            <td><label for="telefono">Teléfono:</label></td>
                            <td><input type="tel" id="telefono" name="telefono" required></td>
                        </tr>
                    </table>
                ';
            break;
            //Formulario para añadir un nuevo cliente
            case 'cliente':
                $title = 'Nuevo cliente';
                //Campos para el formulario de nuevo cliente
                $fields = '
                    <table class="tabla_añadir">
                        <tr>
                            <td><label for="dni">DNI:</label></td>
                            <td><input type="text" id="dni" name="dni" required> </td>
                        </tr>
                        <tr>
                            <td><label for="nombre">Nombre:</label></td>
                            <td><input type="text" id="nombre" name="nombre" required></td>
                        </tr>
                        <tr>
                            <td><label for="telefono">Teléfono:</label></td>
                            <td><input type="tel" id="telefono" name="telefono" required></td>
                        </tr>
                        <tr>
                            <td><label for="cp">Código Postal:</label></td>
                            <td><input type="number" id="cp" name="cp" required></td>
                        </tr>
                    </table>
                ';
            break;
            //Formulario para añadir un nuevo empleado
            case 'empleado':
                $title = 'Nuevo empleado';
                //Campos para el formulario de nuevo empleado
                $fields = '
                    <table class="tabla_añadir">
                        <tr>
                            <td><label for="dni">DNI:</label></td>
                            <td><input type="text" id="dni" name="dni" required></td>
                        </tr>
                        <tr>
                            <td><label for="nombre">Nombre:</label></td>
                            <td><input type="text" id="nombre" name="nombre" required></td>
                        </tr>
                        <tr>
                            <td><label for="telefono">Teléfono:</label></td>
                            <td><input type="tel" id="telefono" name="telefono" required></td>
                        </tr>
                        <tr>
                            <td><label for="sueldo">Sueldo:</label></td>
                            <td><input type="number" id="sueldo" name="sueldo" required></td>
                        </tr>
                        <tr>
                            <td><label for="contraseña">Contraseña:</label></td>
                            <td><input type="text" id="contraseña" name="contraseña" required></td>
                        </tr>
                        <tr>
                            <td><label for="rol">Rol: </label></td>
                            <td><select name="rol" id="rol">
                            <option value="admin">ADMIN</option>
                            <option value="user">USER</option>
                        </select></td>
                        </tr>
                    </table>
                ';
            break;
            //Formulario para añadir un nuevo pedido
            case 'pedido':
                $title = 'Nuevo pedido';
                //Creamos las sentencias SQL de consultas y las ejecutamos
                $consultar1 = "SELECT CLICOD FROM CLIENTES";
                $registros1 = mysqli_query($conexion, $consultar1);

                $consultar2 = "SELECT EMPCOD FROM EMPLEADOS";
                $registros2 = mysqli_query($conexion, $consultar2);

                $consultar3 = "SELECT ARTCOD FROM ARTICULOS";
                $registros3 = mysqli_query($conexion, $consultar3);

                //Campos para el formulario de nuevo pedido
                $fields = '
                    <table class="tabla_añadir">
                        <tr>
                            <td class="label"><label for="seleccionar1">Código de cliente: </label></td>
                            <td>
                            <select name="seleccionar1" id="seleccionar1">';
                                while ($registro1 = mysqli_fetch_row($registros1)) {
                                    $fields .= "<option value='$registro1[0]'>" . $registro1[0] . "</option>";
                                }
                                $fields .= '</select>
                            </td>
                        </tr>
                        <tr>
                            <td class="label"><label for="seleccionar2">Código de empleado: </label></td>
                            <td>
                            <select name="seleccionar2" id="seleccionar2">';
                                while ($registro2 = mysqli_fetch_row($registros2)) {
                                $fields .= "<option value='$registro2[0]'>" . $registro2[0] . "</option>";
                                }
                            $fields .= '</select>
                            </td>
                        </tr>
                        <tr>
                            <td class="label"><label for="seleccionar3">Código de artículo: </label></td>
                            <td>
                            <select name="seleccionar3" id="seleccionar3">';
                                while ($registro3 = mysqli_fetch_row($registros3)) {
                                $fields .= "<option value='$registro3[0]'>" . $registro3[0] . "</option>";
                                }
                            $fields .= '</select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="cantidad">Cantidad:</label></td>
                            <td><input type="number" id="cantidad" name="cantidad" required></td>
                        </tr>
                    </table>
                ';
            break;
            default:
                //Si la variable 'type' tiene otro valor se mostrará el siguiente mensaje
                echo 'Tipo no válido.';
                exit();
        }
    ?>

    <!--Título de la página del formulario-->
    <h1><?php echo $title; ?></h1>

    <div id="contenido">
         <!--Formulario para añadir un nuevo elemento-->
        <form action="form_añadir.php?type=<?php echo $type; ?>" method="POST">
            <?php echo $fields; ?>
            <!--Botón para enviar el formulario-->
            <input type="submit" value="Añadir <?php echo $type; ?>">
        </form>

        <!--Botón para volver a los listados-->
        <?php if ($type == 'proveedor'){ ?>
            <a href="../proveedores.php"><button class="button_volver">Volver atrás</button></a>
        <?php }else{ ?>
            <a href="../<?php echo $type; ?>s.php"><button class="button_volver">Volver atrás</button></a>
        <?php } ?>
    </div>
    
    <?php
        //Se ejecutará lo que está dentro del if si enviamos el formulario de adición de elementos
        if ($_SERVER["REQUEST_METHOD"] == "POST") {    
            //Según el parámetro 'type' se ejecutará una sentencia SQL u otra
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

                    //Guardamos en variables lo que el usuario ha enviado en el formulario obviando los caracteres especiales
                    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
                    $cantidad = mysqli_real_escape_string($conexion, $_POST['cantidad']);
                    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
                    //Creamos la sentencia SQL de inserción
                    $insertar = "INSERT INTO ARTICULOS (ARTCOD, ARTNOM, ARTCANT, ARTPREVEN) VALUES ('$nuevo_codigo', UPPER('$nombre'), '$cantidad', '$precio')";
                    
                    //Ejecutamos la sentencia de insertar
                    mysqli_query($conexion, $insertar);                
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

                    //Guardamos en variables lo que el usuario ha enviado en el formulario obviando los caracteres especiales
                    $nif = mysqli_real_escape_string($conexion, $_POST['nif']);
                    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
                    $direccion = mysqli_real_escape_string($conexion, $_POST['direccion']);
                    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
                    //Creamos la sentencia SQL de inserción
                    $insertar = "INSERT INTO PROVEEDORES (PROCOD, PRONIF, PRONOM, PRODIR, PROTEL) VALUES ('$nuevo_codigo', '$nif', UPPER('$nombre'), UPPER('$direccion'), '$telefono')";
                    
                    //Ejecutamos la sentencia de insertar
                    mysqli_query($conexion, $insertar);                
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

                    //Guardamos en variables lo que el usuario ha enviado en el formulario obviando los caracteres especiales
                    $dni = mysqli_real_escape_string($conexion, $_POST['dni']);
                    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
                    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
                    $cp = mysqli_real_escape_string($conexion, $_POST['cp']);
                    //Creamos la sentencia SQL de inserción
                    $insertar = "INSERT INTO CLIENTES (CLICOD, CLIDNI, CLINOM, CLITEL, CLICP) VALUES ('$nuevo_codigo', '$dni', UPPER('$nombre'), '$telefono', '$cp')";
                    
                    //Ejecutamos la sentencia de insertar
                    mysqli_query($conexion, $insertar);
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

                    //Guardamos en variables lo que el usuario ha enviado en el formulario obviando los caracteres especiales
                    $dni = mysqli_real_escape_string($conexion, $_POST['dni']);
                    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
                    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
                    $sueldo = mysqli_real_escape_string($conexion, $_POST['sueldo']);
                    $contraseña = mysqli_real_escape_string($conexion, $_POST['contraseña']);
                    $rol = mysqli_real_escape_string($conexion, $_POST['rol']);
                    //Creamos la sentencia SQL de inserción
                    $insertar = "INSERT INTO EMPLEADOS (EMPCOD, EMPDNI, EMPNOM, EMPTEL, EMPSUE, EMPCON, EMPROL) VALUES ('$nuevo_codigo', '$dni', UPPER('$nombre'), '$telefono', '$sueldo', '$contraseña', '$rol')";

                    //Ejecutamos la sentencia de insertar
                    mysqli_query($conexion, $insertar);
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

                    //Guardamos en variables lo que el usuario ha enviado en el formulario obviando los caracteres especiales
                    $clicod = mysqli_real_escape_string($conexion, $_POST['seleccionar1']);
                    $empcod = mysqli_real_escape_string($conexion, $_POST['seleccionar2']);
                    $artcod = mysqli_real_escape_string($conexion, $_POST['seleccionar3']);
                    $cantidad = mysqli_real_escape_string($conexion, $_POST['cantidad']);
                    //Creamos la sentencia SQL de inserción
                    $insertar = "INSERT INTO PEDIDOS (PEDCOD, PEDFEC, CLICOD, EMPCOD) VALUES ('$nuevo_codigo', NOW(),'$clicod', '$empcod')";

                    //Ejecutamos la sentencia de insertar
                    mysqli_query($conexion, $insertar);

                    //Creamos la sentencia SQL de inserción en la tabla LINEADEDETALLE 
                    $insertar2 = "INSERT INTO LINEADEDETALLE (pedcod, artcod, cantidad) VALUES ('$nuevo_codigo', '$artcod', '$cantidad')";

                    //Ejecutamos la sentencia de insertar
                    mysqli_query($conexion, $insertar2);
                break;
            }

            //Cerramos la conexión
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
