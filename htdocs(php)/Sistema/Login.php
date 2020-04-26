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
//datos a comparar
//$nombre = "igar";
//$pass = "1234";
$msg="";

if(isset($_GET['txtNombre']) && isset($_GET['txtPassword'])) //que las variables existan
{
	if($_GET['txtNombre']!="" && $_GET['txtPassword']!="") //tengan valores
	{
	
		//conexion con el servidor de BD, la especificacion de BD
	 	$conn = mysqli_connect("localhost", "root", "", "tecweb20192020");
	 	$consulta = "select idUsuario, Nombre from usuarios where Usuario='". $_GET['txtNombre'] ."' and Pwd='".$_GET['txtPassword']."'";
	 	
	 	$rs = mysqli_query($conn, $consulta);  //evalua en la BD la consulta 
		 	
		if(mysqli_num_rows($rs)>0) //evaluar si se encontró coincidencia en la BD
		 {
		 	$usr = mysqli_fetch_array($rs);
		 	$_SESSION['idUsuario'] = $usr["idUsuario"];
		 	$_SESSION['NombreUsuario'] = $usr["Nombre"];
			header("location:http://localhost/Sistema/portada.php");
		 }
		else //los valores son incorrectos
		 $msg = "Los datos proporcionados (nombre y contraseña) no son correctos";
	}
	else
		$msg = "Ambos datos (nombre y contraseña) son requeridos";
}
?>
<form method="get" action="login.php">
	Usuario: <input name="txtNombre" type="text" placeholder="Anota tu usuario"><br>
	Password: <input name="txtPassword" type="password"><br>
	<input type="submit" value="Autenticar">
	<input type="reset" value="Cancelar">
</form>
<?php
if($msg!="") echo "<p>$msg</p>";
?>
</body>

</html>
