<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../img/logo.png"/>
    <meta name="author" content="Irene Cabeza Chacón">
    <title>GESDEAL - Triggers</title>
</head>
<body>
    <?php
        //Creamos las variables de conexión a MySQL
        $host="localhost";
        $usuario="root";
        $pass="";
 
        //Establecemos la conexión con MySQL
        $conexion=mysqli_connect($host,$usuario,$pass) or die("Error de conexión");

        $crear="CREATE DATABASE IF NOT EXISTS GESDEAL";
        $creada=mysqli_query($conexion,$crear);

        if($creada){
            echo "La base de datos GESDEAL se ha creado correctamente <br>";
        }else{
            echo "La base de datos GESDEAL no se ha creado <br>";
        }

        //Seleccionamos la base de datos
        mysqli_select_db($conexion,"GESDEAL") or die("Error seleccionando la base de datos");

        //Creamos la sentencia SQL del trigger y la ejecutamos
        //Este trigger insertará una fila en la tabla línea de detalle cuando se inserte un pedido
        $trigger1="CREATE OR REPLACE TRIGGER LDD_AI 
        AFTER INSERT ON PEDIDOS
        FOR EACH ROW
    	INSERT INTO LINEADEDETALLE
        SELECT NEW.PEDCOD,A.ARTCOD,ABS(FLOOR(RAND()*(1-10)))
        FROM ARTICULOS A
	    ORDER BY RAND() LIMIT 1";
        
        if(mysqli_query($conexion, $trigger1)){
            echo "Se ha ejecutado correctamente el primer trigger. <br>";
        }else{
            echo "Error ejecutando el primer trigger. <br>"; 
        }

        //Creamos la sentencia SQL del trigger y la ejecutamos
        //Este trigger insertará una fila en la tabla suministrar cuando se inserte un artículo
        $trigger2="CREATE OR REPLACE TRIGGER SUMINISTRAR_AI
        AFTER INSERT ON ARTICULOS
        FOR EACH ROW
        INSERT INTO SUMINISTRAR
        SELECT P.PROCOD,NEW.ARTCOD,NOW(),(NEW.ARTPREVEN)/1.3,NEW.ARTCANT
        FROM PROVEEDORES P
        ORDER BY RAND() LIMIT 1";
        
        if(mysqli_query($conexion, $trigger2)){
            echo "Se ha ejecutado correctamente el segundo trigger. <br>";
        }else{
            echo "Error ejecutando el segundo trigger. <br>"; 
        }


        //Creamos la sentencia SQL del trigger y la ejecutamos
        //Este trigger actualizará el precio de compra de un artículo en la tabla suministrar cuando se actualice el precio de venta 
        //de un artículo en la tabla artículos
        $trigger3="CREATE OR REPLACE TRIGGER SUMINISTRAR_AU_PREVEN
        AFTER UPDATE ON ARTICULOS
        FOR EACH ROW
        UPDATE SUMINISTRAR
        SET PRECIOCOMPRA=(NEW.ARTPREVEN)/1.3
        WHERE ARTCOD LIKE OLD.ARTCOD";
        
        if(mysqli_query($conexion, $trigger3)){
            echo "Se ha ejecutado correctamente el tercer trigger. <br>";
        }else{
            echo "Error ejecutando el tercer trigger. <br>"; 
        }

        //Creamos la sentencia SQL del trigger y la ejecutamos
        //Este trigger insertará una fila en la tabla suministrar cuando se actualice la cantidad de un artículo y la nueva cantidad
        //sea mayor que la cantidad que tenía el artículo antes de ser actualizado
        $trigger4="CREATE OR REPLACE TRIGGER SUMINISTRAR_AU_CANT
        AFTER UPDATE ON ARTICULOS
        FOR EACH ROW
        IF OLD.ARTCANT < NEW.ARTCANT THEN
        INSERT INTO SUMINISTRAR
        SELECT P.PROCOD,OLD.ARTCOD,NOW(),(NEW.ARTPREVEN)/1.3,(NEW.ARTCANT)-(OLD.ARTCANT)
        FROM PROVEEDORES P
        ORDER BY RAND() LIMIT 1;
        END IF";
        
        if(mysqli_query($conexion, $trigger4)){
            echo "Se ha ejecutado correctamente el cuarto trigger. <br>";
        }else{
            echo "Error ejecutando el cuarto trigger. <br>"; 
        }

        //Creamos la sentencia SQL del trigger y la ejecutamos
        //Este trigger actualizará la tabla artículos cuando se realice un pedido. Disminuirá la cantidad del artículo de la tabla
        //artículos, de aquel que se haya vendido dentro del pedido
        $trigger5="CREATE OR REPLACE TRIGGER ARTICULOS_AI
        AFTER INSERT ON PEDIDOS
        FOR EACH ROW
        UPDATE ARTICULOS
        SET ARTCANT=(ARTCANT)-(SELECT CANTIDAD
                                FROM LINEADEDETALLE
                                WHERE PEDCOD LIKE NEW.PEDCOD)
        WHERE ARTCOD=(SELECT ARTCOD
                        FROM LINEADEDETALLE
                        WHERE PEDCOD LIKE NEW.PEDCOD)";
        
        if(mysqli_query($conexion, $trigger5)){
            echo "Se ha ejecutado correctamente el quinto trigger. <br>";
        }else{
            echo "Error ejecutando el quinto trigger. <br>"; 
        }

    ?>
</body>
</html>