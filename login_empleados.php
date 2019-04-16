<!DOCTYPE html>
<html>
<head>
	<title>Login empleado</title>
	<link rel = "stylesheet" type = "text/css" href = "style.css" />
</head>
<body>
	<form method="post" action="verifica_login.php">
		<table>
            <tr><td>Nombre</td><td><input type="text" name="nombre"></td></tr>
            <tr><td>Contraseña</td><td><input type="password" name="pass"></td></tr>
		</table>
		<input type="submit" value="Entrar">
	</form>
</body>
</html>