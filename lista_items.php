<!DOCTYPE html>
<html>
<head>
    <title>Lista Items</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css" />
	<meta charset="utf-8">
</head>
<body>
    <p>
    
    <form action='lista_items.php' method=post>
        <select name="lista">
            <option value="precio">Precio</option>
            <option value="nombre">Nombre</option>
            <option value="calorias">Calorias</option>
        </select>
        Item: <input type="text" name="item">
        <input type="submit" value="Buscar">
    </form>


    <table>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cal</th>
        </tr>
        <?php
            #POR DEFECTO ORDENA POR ID
             if( !(isset($_POST["lista"])) ) {
                $myvalue = 'id';
             }
             else{
                $myvalue=$_POST["lista"];
             }
            
             if(isset($_POST["item"])) {
               
                $buscar = $_POST["item"];
             }else{
                $buscar = "";
             }
             

            
            $db =  @mysqli_connect('localhost','root','','heladeria');
            if($db-> connect_error){
                die("Conexion a la BD fallida".$db-> connect_error);
            }
            $sql = "SELECT id, nombre, precio, calorias from ingredientes WHERE nombre LIKE CONCAT('%', '$buscar', '%') ORDER BY $myvalue";
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
            else{
                echo "No hay resultados";
            }
        ?>
    </table>
        </p>
</body>
</html>