<!DOCTYPE html>
<html>
<head>
	<title>Formulario nuevo item</title>
</head>
<body>
	<form method="post" action="insert_bd.php">
		<table>
			<tr><td>Nombre del Producto :</td><td> <input type="text" name="name"></td></tr>
			<tr><td>Precio :</td><td> <input type="number" step=0.01 name="price"></td></tr>
			<tr><td>Descripcion :</td><td> <input type="text" name="desc"></td></tr>
			<tr><td>Calorias :</td><td>  <input type="number" name="cls"></td></tr>
		</table>
		<input type="submit" value="Enviar">
	</form>
</body>
</html>