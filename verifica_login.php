<!DOCTYPE html>
<html>
<head>
    <title>Información sobre el alta</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css" />
	<meta charset="utf-8">
</head>
<body>
    <?php  
        $db =  @mysqli_connect('localhost','root','','heladeria');
        if (!$db){
            die("Database db Failed" . mysqli_error($db));
        }
        else{
        if (isset($_POST['nombre']) and isset($_POST['pass'])){
            $usuario = $_POST['nombre'];
            $pass = md5($_POST['pass']);
        
            $sql="SELECT * FROM heladeros WHERE nombre='$usuario' AND password='$pass'";
            $sql_admin="SELECT * FROM administrador WHERE nombre='$usuario' AND password='$pass'";
            $consulta=mysqli_query($db, $sql);
            $consulta_admin =mysqli_query($db, $sql_admin);

			if (mysqli_num_rows($consulta)>0){
                
                echo "Hola ".$usuario;

            }
            else if (mysqli_num_rows($consulta_admin)>0) {
                echo "Bienvenido administrador";
                ?>
                <html>
                <head>
                </head>

                <body>
                    <div class="header">	
                            <span id="inicio">
                                <a href="insert_item.php">Insertar Ingrediente</a> |
                                <a href="insert_empleado.php">Añadir empleado</a> |
                            </span>
                    </div>
                </body>
                </html>
                <?php
                
                #insertar productos
                #insertar empleado
                #eliminar productos
                #eliminar empleados
                #   
            }
            else{
               echo "Contraseña incorrecta";
               
            }
        }




        }
    ?>

</body>
</html>