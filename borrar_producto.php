<!DOCTYPE html>
<html>
<head>
    <title>Borrar producto</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css" />
	<meta charset="utf-8">
</head>
<body>

     <form action='borrar_producto.php' method=post>
        ID_Item: <input type="text" name="id">
        <input type="submit" value="Buscar">
    </form>

    <?php  
        $db =  @mysqli_connect('localhost','root','','heladeria');
   
        if ($db) {
            echo 'Conexión realizada correctamente.<br />';
            $nombre=$_POST['id'];

            $sql="SELECT * FROM ingredientes WHERE nombre LIKE '$nombre' LIMIT 1";
            $consulta = mysqli_query($db, $sql);

            if(mysqli_num_rows($consulta) == 0){
                $sql="INSERT INTO ingredientes (nombre, precio, descripcion, calorias) VALUES ('$nombre','$price','$desc','$cls')";
                $consulta=mysqli_query($db, $sql);
                echo "Ingrediente ".$nombre." agregado correctamente";
            }
            else{
                echo "ERROR -> Ingrediente: ".$nombre." ya está en la BD";
            }
        };
    ?>

</body>
</html>