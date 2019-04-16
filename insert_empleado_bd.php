<!DOCTYPE html>
<html>
<head>
	<title>Información sobre el alta</title>
	<meta charset="utf-8">
</head>
<body>
    <?php  
        $db =  @mysqli_connect('localhost','root','','heladeria');
   
        if ($db) {
            echo 'Conexión realizada correctamente.<br />';
            $nombre=$_POST['name'];
            $dni=$_POST['dni'];
            $pass = md5($_POST['pass']);
            $ingresos = 0.0;

            $sql="SELECT * FROM heladeros WHERE dni LIKE '$dni' LIMIT 1";
            $consulta = mysqli_query($db, $sql);

            if(mysqli_num_rows($consulta) == 0){
                $sql="INSERT INTO heladeros (nombre, dni, ingresos, password) VALUES ('$nombre','$dni','$ingresos','$pass')";
                $consulta=mysqli_query($db, $sql);
                echo $nombre." Ha sido agregado correctamente";
                #añadir otro empleado, volver
            }
            else{
                echo "ERROR -> Empleado: ".$nombre." ya está en la BD";
            }
        };
    ?>

</body>
</html>