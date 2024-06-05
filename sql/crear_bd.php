<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../img/logo.png"/>
    <meta name="author" content="Irene Cabeza Chacón">
    <title>GESDEAL - Crear BD</title>
</head>
<body>
    <?php
        //Creamos las variables de conexión a MySQL
        $host="localhost";
        $usuario="root";
        $pass="";
 
        //Establecemos la conexión con MySQL
        $conexion=mysqli_connect($host,$usuario,$pass) or die("Error de conexión");

        //Creamos la base de datos GESDEAL si no existe
        $crear="CREATE DATABASE IF NOT EXISTS GESDEAL";
        $creada=mysqli_query($conexion,$crear);

        //Comprobamos si la base de datos está creada
        if(!$creada){
            echo "La base de datos GESDEAL no se ha creado <br>";
        }

        //Seleccionamos la base de datos
        mysqli_select_db($conexion,"GESDEAL") or die("Error seleccionando la base de datos");

        //Creamos la tabla empleados y la ejecutamos
        $tabla1="CREATE TABLE IF NOT EXISTS EMPLEADOS(
            EMPCOD VARCHAR(5),
            EMPDNI VARCHAR(9) NOT NULL UNIQUE,
            EMPNOM VARCHAR(50) NOT NULL,
            EMPTEL INT(9) NOT NULL UNIQUE,
            EMPSUE DOUBLE(6,2) NOT NULL,
            EMPCON VARCHAR(10) NOT NULL,
            EMPROL ENUM('admin', 'user') NOT NULL DEFAULT 'user',
            CONSTRAINT PK_EMP PRIMARY KEY (EMPCOD)
        )";
        mysqli_query($conexion, $tabla1) or die("Error creando la tabla empleados");

        //Creamos la sentencia SQL de inserción y la ejecutamos
        $insertar1="INSERT INTO EMPLEADOS VALUES
        ('EM-01', '75968938C', 'LEO CASAL', 681349905, 993.00, 'leo38', 'admin'),
        ('EM-02', '34032135F', 'ROSA REAL', 655419803, 1020.00, 'rosa35', 'user'),
        ('EM-03', '98765432A', 'CARLOS FILA', 600410321, 1003.20, 'carlos32', 'user'),
        ('EM-04', '64887102L', 'DAVID REY', 660378112, 1304.75, 'david02', 'user')";
        mysqli_query($conexion, $insertar1) or die("Error insertando datos en la tabla empleados");

        //Creamos la tabla artículos y la ejecutamos
        $tabla2="CREATE TABLE IF NOT EXISTS ARTICULOS(
            ARTCOD VARCHAR(5),
            ARTNOM VARCHAR(20) NOT NULL UNIQUE,
            ARTCANT INT(3) NOT NULL,
            ARTPREVEN DOUBLE(6,2) NOT NULL,
            CONSTRAINT PK_ART PRIMARY KEY (ARTCOD)    
        )";
        mysqli_query($conexion, $tabla2) or die("Error creando la tabla artículos");

        //Creamos la sentencia SQL de inserción y la ejecutamos
        $insertar2="INSERT INTO ARTICULOS VALUES
        ('AR-01', 'LIBRETA', 51, 2.56),
        ('AR-02', 'SACAPUNTAS', 40, 1.20),
        ('AR-03', 'GRAPAS', 60, 2.00),
        ('AR-04', 'BOLÍGRAFO', 100, 1.70),
        ('AR-05', 'LÁPIZ', 100, 1.35),
        ('AR-06', 'FOLIOS', 40, 4.60),
        ('AR-07', 'CELO', 22, 2.75),
        ('AR-08', 'GRAPADORA', 18, 5.10),
        ('AR-09', 'TIPPEX', 25, 2.80),
        ('AR-10', 'AGENDA', 16, 8.95),
        ('AR-11', 'MOCHILA', 15, 30.00),
        ('AR-12', 'CLIPS', 45, 1.95),
        ('AR-13', 'TIJERAS', 24, 4.10),
        ('AR-14', 'PEGAMENTO', 30, 2.15),
        ('AR-15', 'PORTAMINAS', 15, 2.30),
        ('AR-16', 'MINAS', 15, 0.95)";
        mysqli_query($conexion, $insertar2) or die("Error insertando datos en la tabla artículos");

        //Creamos la tabla proveedores y la ejecutamos
        $tabla3="CREATE TABLE IF NOT EXISTS PROVEEDORES(
            PROCOD VARCHAR(5),
            PRONIF VARCHAR(9) NOT NULL UNIQUE,
            PRONOM VARCHAR(50) NOT NULL,
            PRODIR VARCHAR(50) NOT NULL,
            PROTEL INT(9) NOT NULL UNIQUE,
            CONSTRAINT PK_PRO PRIMARY KEY (PROCOD)
        )";
        mysqli_query($conexion, $tabla3) or die("Error creando la tabla proveedores");

        //Creamos la sentencia SQL de inserción y la ejecutamos
        $insertar3="INSERT INTO PROVEEDORES VALUES
        ('PR-01', 'A25128901', 'NIC', 'C/PEDRERAS 7', 666985110),
        ('PR-02', 'B28873109', 'LERON', 'C/PRIM 29', 689600114),
        ('PR-03', 'A23412013', 'PERLA', 'C/PALMA 14', 633891800),
        ('PR-04', 'L84796122', 'JELO', 'C/MADRID 1', 674038476),
        ('PR-05', 'R51847955', 'MENTRI', 'C/GERANIO 8', 635547108),
        ('PR-06', 'H20415479', 'NESPLA', 'C/DOCTORADO 65', 632200874),
        ('PR-07', 'D48159782', 'CEBO', 'C/ARROYO 47', 641882473),
        ('PR-08', 'S64551274', 'KESDE', 'C/VIZCONDE 32', 669101167),
        ('PR-09', 'C84966813', 'FRUSTI', 'C/AMOR 12', 666314780),
        ('PR-10', 'T97120687', 'POLEDO', 'C/SAN JUSTO 9', 607412385)";
        mysqli_query($conexion, $insertar3) or die("Error insertando datos en la tabla proveedores");

        //Creamos la tabla clientes y la ejecutamos
        $tabla4="CREATE TABLE IF NOT EXISTS CLIENTES(
            CLICOD VARCHAR(5),
            CLIDNI VARCHAR(9) NOT NULL UNIQUE,
            CLINOM VARCHAR(50) NOT NULL,
            CLITEL INT(9) NOT NULL UNIQUE,
            CLICP INT(5) NOT NULL,
            CONSTRAINT PK_CLI PRIMARY KEY (CLICOD)
        )";
        mysqli_query($conexion, $tabla4) or die("Error creando la tabla clientes");

        //Creamos la sentencia SQL de inserción y la ejecutamos
        $insertar4="INSERT INTO CLIENTES VALUES
        ('CL-01', '84783126P', 'PEDRO LEAL', 645220988, 11300),
        ('CL-02', '36621007M', 'FERNANDO SOLER', 647130884, 11310)";
        mysqli_query($conexion, $insertar4) or die("Error insertando datos en la tabla clientes");

        //Creamos la tabla pedidos y la ejecutamos
        $tabla5="CREATE TABLE IF NOT EXISTS PEDIDOS(
            PEDCOD VARCHAR(5),
            PEDFEC DATE NOT NULL,
            CLICOD VARCHAR(5),
            EMPCOD VARCHAR(5),
            CONSTRAINT PK_PED PRIMARY KEY (PEDCOD),
            CONSTRAINT FK_PEDCLI FOREIGN KEY (CLICOD) REFERENCES CLIENTES(CLICOD) ON DELETE SET NULL ON UPDATE CASCADE,
            CONSTRAINT FK_ARTEMP FOREIGN KEY (EMPCOD) REFERENCES EMPLEADOS(EMPCOD) ON DELETE SET NULL ON UPDATE CASCADE
        )";
        mysqli_query($conexion, $tabla5) or die("Error creando la tabla pedidos");

        //Creamos la sentencia SQL de inserción y la ejecutamos
        $insertar5="INSERT INTO PEDIDOS VALUES
        ('PE-01', '2024-05-08', 'CL-01', 'EM-04'),
        ('PE-02', '2024-05-08', 'CL-02', 'EM-02'),
        ('PE-03', '2024-05-09', 'CL-01', 'EM-03')";
        mysqli_query($conexion, $insertar5) or die("Error insertando datos en la tabla pedidos");

        //Creamos la tabla suministrar y la ejecutamos
        $tabla6="CREATE TABLE IF NOT EXISTS SUMINISTRAR(
            PROCOD VARCHAR(5),
            ARTCOD VARCHAR(5),
            FECHA DATE NOT NULL,
            PRECIOCOMPRA DOUBLE(6,2) NOT NULL,
            CANTIDAD INT(3) NOT NULL,
            CONSTRAINT PK_SUM PRIMARY KEY (PROCOD,ARTCOD,FECHA),
            CONSTRAINT FK_SUMPRO FOREIGN KEY (PROCOD) REFERENCES PROVEEDORES(PROCOD) ON UPDATE CASCADE,
            CONSTRAINT FK_SUMART FOREIGN KEY (ARTCOD) REFERENCES ARTICULOS(ARTCOD) ON DELETE CASCADE ON UPDATE CASCADE
        )";
        mysqli_query($conexion, $tabla6) or die("Error creando la tabla suministrar");

        //Creamos la sentencia SQL de inserción y la ejecutamos
        $insertar6="INSERT INTO SUMINISTRAR VALUES
        ('PR-01', 'AR-01', '2024-05-02', 1.80, 51),
        ('PR-01', 'AR-04', '2024-05-12', 1.31, 100),
        ('PR-02', 'AR-14', '2024-05-20', 1.65, 30),
        ('PR-03', 'AR-13', '2024-05-11', 3.15, 24),
        ('PR-04', 'AR-08', '2024-03-08', 3.92, 18),
        ('PR-05', 'AR-03', '2024-05-02', 1.54, 60),
        ('PR-05', 'AR-07', '2024-05-26', 2.12, 22),
        ('PR-05', 'AR-16', '2024-05-26', 0.73, 15),
        ('PR-06', 'AR-09', '2024-05-16', 2.15, 25),
        ('PR-06', 'AR-15', '2024-04-21', 1.77, 15),
        ('PR-07', 'AR-12', '2024-05-23', 1.50, 45),
        ('PR-08', 'AR-06', '2024-04-27', 3.54, 40),
        ('PR-09', 'AR-02', '2024-05-03', 0.92, 40),
        ('PR-09', 'AR-11', '2024-03-07', 23.08, 15),
        ('PR-10', 'AR-05', '2024-04-19', 1.04, 100),
        ('PR-10', 'AR-10', '2024-03-25', 6.88, 16)";
        mysqli_query($conexion, $insertar6) or die("Error insertando datos en la tabla suministar");

        //Creamos la tabla linea de detalle y la ejecutamos
        $tabla7="CREATE TABLE IF NOT EXISTS LINEADEDETALLE(
            PEDCOD VARCHAR(5),
            ARTCOD VARCHAR(5),
            CANTIDAD INT(3) NOT NULL,
            CONSTRAINT PK_LIN PRIMARY KEY (PEDCOD,ARTCOD),
            CONSTRAINT FK_LINPED FOREIGN KEY (PEDCOD) REFERENCES PEDIDOS(PEDCOD) ON DELETE CASCADE ON UPDATE CASCADE,
            CONSTRAINT FK_LINART FOREIGN KEY (ARTCOD) REFERENCES ARTICULOS(ARTCOD) ON DELETE CASCADE ON UPDATE CASCADE
        )";
        mysqli_query($conexion, $tabla7) or die("Error creando la tabla línea de detalle");

        //Creamos la sentencia SQL de inserción y la ejecutamos
        $insertar7="INSERT INTO LINEADEDETALLE VALUES
        ('PE-01', 'AR-05', 5),
        ('PE-02', 'AR-11', 1),
        ('PE-03', 'AR-07', 2)";
        mysqli_query($conexion, $insertar7) or die("Error insertando datos en la tabla línea de detalle");
    ?>
</body>
</html>