<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Untitled 1</title>
</head>

<body>
<?php
$nombre="ulises";
$pass="1234";
$msg="";
if(isset($_GET['txtNombre']) && isset($_GET['txtPassword'])) // que las variables exitan
{
	if($_GET['txtNombre']!="" && $_GET['txtPassword']!="") // tenga valores
	{
		if($_GET['txtNombre']==$nombre && $_GET['txtPassword']==$pass)// los valores son correctos
		{
			$_SESSION['usuario']=$_GET['txtNombre'];
			header("location:http://localhost/TecWeb/inicio.php");
			//$msg="Los datos son correctos bienvenido al sitema"; // header()
		}
		else // los valores son incorrectos
		$msg="Los datos proporcionados (nombre y contraseña) no son correctos";
		
	}
	else
		$msg="Ambos datos (nombre y contraseña) son requeridos";
}

?>
<form method="get" action="Login.php">
	Usuario: <input name="txtNombre"  type="text" placeholder="Anota tu usuario"><br>
	Password: <input name="txtPassword"  type="password"><br>
	<input type="submit" name="btnAuntentica" value="Autenticar">
	<input type="reset" value="Cancelar">
</form>
<?php
if($msg!="") echo "<p>$msg</p>";
?>
</body>

</html>
