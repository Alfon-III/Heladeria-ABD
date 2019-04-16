<!DOCTYPE html>
<html>
<head>
    <title>Insertar productos</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css" />
	<meta charset="utf-8">
</head>
<body>
    <?php  
        $db =  @mysqli_connect('localhost','root','','heladeria');
   
        if ($db) {
            echo 'Conexión realizada correctamente.<br />';
            $nombre=$_POST['name'];
            $price=$_POST['price'];
            $desc=$_POST['desc'];
            $cls=$_POST['cls'];

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