<!DOCTYPE html>
<html>
<head>
    <title>Seguimiento de pedido</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css" />
	<meta charset="utf-8">
</head>
<body>

    
    <form action='ver_estado_pedido.php' method=post>

        Telefono <input type="number" name="tel">
        Cliente <input type="text" name="cliente">


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
        if(verifica_entrada()){

            $cliente = $_POST["cliente"]; 
            $tel = $_POST["tel"];
            
            $sql = "SELECT id FROM pedido WHERE nombre_cliente LIKE '$cliente' AND telefono LIKE '$tel'";
            $consulta = mysqli_query($db, $sql);
    
            if(!$consulta || mysqli_num_rows($consulta) != 0){
                $i = 1;
                while ($fila = $consulta->fetch_array()) {
                    echo "Este es su pedido: ".$i."</br>";
                    muestraPedido($db, $fila["id"]);
                    echo "</br>";
                    $i++;        
                }
                echo "</table>";
            }
            else{
                echo "Lo sentimos, no hemos encontrado tu pedio</br>";
            }
            }
        }
        
        ?>
</body>
</html>



<?php
    #----------------------------------------------FUNCTIONS------------------------------------------
  

    function muestraPedido($db, $id_pedido){
       
        $sql = "SELECT id, nombre, precio, calorias FROM ingredientes i JOIN items_pedido p ON i.id = p.id_ingrediente WHERE p.id_pedido = '$id_pedido'";
        $consulta = mysqli_query($db, $sql);
        if(!$consulta || mysqli_num_rows($consulta) != 0){
            
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
        return $aux;
    }

?>