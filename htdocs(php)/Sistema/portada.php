<?php
session_star();
//if(!isset($_SESSION['idUsuario'])) header("location:http://localhost/TecWeb/Sistema/Login.php");
?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Untitled 1</title>
</head>

<body>
<h1>Sistema de control de imagenes</h1>
<?php
if(!isset($_SESSION['idUsuario']))
{
	echo "no estas autenticado. <a href='registrate.php'></a> Registrate en el sitema o <a href='Login.php'>autenticate</a>";
	
}
else
{
	echo "Hola: " . $_SESSION['NombreUsuario']. " [<a href='salir.php'>salir del sistema</a>]"; //checar salida
}
?>
<hr>
<h2>Las ultimas imagenes guardadas en sistema</h2>

<?php
//conecatarnos a la base de datos
$conn=mysqli_connect("localhots","root","","tecweb20192020");
$qry="select idImagen, Nombre, idUsuario, Titulo, Fecha from imagenes";
$resultado=mysqli_query($conn,$qry);
if(mysqli_num_rows($resultado)>0) // si hay imagenes en la BD
{
	$i=1;
	while($registro= mysqli_fetch_arry($resultado))
	{
		echo $i . "-" . $registro["Fecha"] . "-" . $registro["Nombre"] . "-" . $registro["Titulo"] . "<br>";
		$i++;
	}	
}
else
{
 	echo "No hay imagenes guardadas en la BD";
}
?>
</body>

</html>
