<!DOCTYPE html>
<html>
<head>
    <title>Lista Items</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css" />
	<meta charset="utf-8">
</head>
<body>

    
    <form action='hacer_pedido.php' method=post>

        Telefono <input type="number" name="tel">
        Cliente <input type="text" name="cliente">

        <br> <br> Introduzca hasta un máximo de 10 productos por pedido.

        <table>
            <tr>
                <th>Producto 1: </th>
                <th><input type="text" name="item[]"></th>
            </tr>
            <tr>
                <th>Producto 2: </th>
                <th><input type="text" name="item[]"></th> 
            </tr>
            <tr>
                <th>Producto 3: </th>
                <th><input type="text" name="item[]"></th> 
            </tr>
            <tr>
                <th>Producto 4: </th>
                <th><input type="text" name="item[]"></th> 
            </tr>
            <tr>
                <th>Producto 5: </th>
                <th><input type="text" name="item[]"></th> 
            </tr>
            <tr>
                <th>Producto 6: </th>
                <th><input type="text" name="item[]"></th> 
            </tr>
            <tr>
                <th>Producto 7: </th>
                <th><input type="text" name="item[]"></th> 
            </tr>
            <tr>
                <th>Producto 8: </th>
                <th><input type="text" name="item[]"></th> 
            </tr>
            <tr>
                <th>Producto 9: </th>
                <th><input type="text" name="item[]"></th> 
            </tr>
            <tr>
                <th>Producto 10: </th>
                <th><input type="text" name="item[]"></th>
            </tr>
            
        </table>

        <input type="submit" value="Nuevo pedido">
    </form>



    <table>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cal</th>
        </tr>

    <?php


        #Conexion bd
        $db =  @mysqli_connect('localhost','root','','heladeria');
        if($db-> connect_error){
            die("Conexion a la BD fallida".$db-> connect_error);
        }
        else{
        #Obtencion de datos
        if(verifica_entrada() && verifica_items($db)){# hay mas de un item y el cliente ha puesto su nombre y telefono

            $id_pedido = crea_pedido($db);
            echo "ID pedido: ".$id_pedido;


            foreach( $_POST['item'] as $item_aux){#Para cada item

                if($item_aux != null && busca_item($db, $item_aux)){#Si existe y no es null
                    $id_item = get_item_id($db, $item_aux);
                    $sql="INSERT INTO items_pedido (id_ingrediente, id_pedido) VALUES ('$id_item', '$id_pedido')";
                    $consulta=mysqli_query($db, $sql);
                }

            }


            muestraPedido($db, $id_pedido);
            }
        }
        
        ?>
</body>
</html>



<?php
    #----------------------------------------------FUNCTIONS------------------------------------------
    function busca_item($db = "", $item){

        $found = FALSE;

        $sql = "SELECT nombre from ingredientes WHERE nombre LIKE CONCAT('%', '$item', '%')";
        $consulta = mysqli_query($db, $sql);

        if(!$consulta || mysqli_num_rows($consulta) == 1){
            $fila = $consulta->fetch_array();
            $found = TRUE;
        }
        else if (!$consulta || mysqli_num_rows($consulta) > 1){
            echo "Has puesto: ".$item."quizá hays querido decir: "."</br>";
            while ($fila = $consulta->fetch_array()) {
                echo    $fila["nombre"].", ";
            }
        }
        else{
            echo "Producto no encontrado"."</br>";
        }
        return $found;
    }

    function get_item_id($db = "", $item){
        $sql = "SELECT id, nombre from ingredientes WHERE nombre LIKE CONCAT('%', '$item', '%')";
        $consulta = mysqli_query($db, $sql);
        $fila = mysqli_fetch_assoc($consulta);

        return $fila["id"];

    }

    function crea_pedido($db){

       
        $tel = $_POST["tel"];
        $cliente = $_POST["cliente"];

        $sql="INSERT INTO pedido (nombre_cliente, telefono) VALUES ('$cliente', '$tel')";
        $consulta=mysqli_query($db, $sql);
        $id = mysqli_insert_id($db);#devuelve el id que acabo de introducir
        
        return $id;
    }

    function muestraPedido($db, $id_pedido){
       
        $sql = "SELECT id, nombre, precio, calorias FROM ingredientes i JOIN items_pedido p ON i.id = p.id_ingrediente WHERE p.id_pedido = '$id_pedido'";
        $consulta = mysqli_query($db, $sql);
        if(!$consulta || mysqli_num_rows($consulta) != 0){
            echo "Numero de items encontrados:" .mysqli_num_rows($consulta);
            while ($fila = $consulta->fetch_array()) {
                echo    "<tr><td>".$fila["id"].
                        "</td><td>".$fila["nombre"].
                        "</td><td>".$fila["precio"].
                        "</td><td>".$fila["calorias"]."</td></tr>";
            }
            echo "</table>";
        }

    }

    function verifica_entrada(){#Verifico que los parámetros de entrada estén completos
        $aux=TRUE;  

        if (!(isset($_POST["tel"])) || !(isset($_POST["cliente"]))){
           $aux = FALSE;
           echo "Error -> Campo telefono o nombre sin rellenar"."</br>";
        }

        $i = 0;
        foreach( $_POST['item'] as $item){
            if($item != null){
                $i = $i + 1;
            }
        }
        if($i == 0){
            $aux = FALSE;
            echo "Error -> Se requiere de al menos un item"."</br>";
        }
        

        return $aux;
    }

    function verifica_items($db){
        $aux = TRUE;
        foreach( $_POST['item'] as $item_aux){#Para cada item del pedido

            if($item_aux != null && !busca_item($db, $item_aux) ){#Con campo relleno y valor en la tabla de productos
                $aux = FALSE;
                
            }
        }
        
        return $aux;
    }
?>