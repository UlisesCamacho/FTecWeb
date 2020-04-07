<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Untitled 1</title>
</head>

<body>
<?php
if(isset($_POST['txtNombre']) && isset($_POST['txtPassword'])) // que las variables exitan
{
	if($_POST['txtNombre']!="" && $_POST['txtPassword']!="")//tenga valores
	{
		$nombre=$_POST['txtNombre'];
		$pasword=$_POST['txtPassword'];
		echo "Bienvenida de la pagina<br>$nombre";
	}
	else
	{
		echo "El usario y contraseña son obligatorios";
	}
}
else
{
	echo "Para usar esta pagina debes usar <a href='Login.html'>Login.php</a>";
}
?>
</body>

</html>
