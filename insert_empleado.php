<!DOCTYPE html>
<html>
<head>
	<title>Nuevo empleado</title>
</head>
<body>
	<form method="post" action="insert_empleado_bd.php">
		<table>
			<tr><td>Nombre:</td><td> <input type="text" name="name"></td></tr>
			<tr><td>DNI:</td><td> <input type="text" name="dni"></td></tr>
			<tr><td>Contraseña</td><td><input type="password" name="pass"></td></tr>
		</table>
		<input type="submit" value="Añadir">
	</form>
</body>
</html>