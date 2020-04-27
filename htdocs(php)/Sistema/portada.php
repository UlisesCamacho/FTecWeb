<?php
session_start();
//if(!isset($_SESSION['idUsuario'])) header("location:http://localhost/20192020-2/sistema/login.php");


?><!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Untitled 1</title>
</head>

<body>
<h1>Sistema de control de imágenes</h1>
<?php
if(!isset($_SESSION['idUsuario']))
{
	echo "No estas autenticado. <a href='regitrate.php'>Registrate en el sistema</a> o  <a href='Login.php'>autentítcate</a>";
}
else
{
 echo "Hola: " . $_SESSION['NombreUsuario'] . " [<a href='salir.php'>salir del sistema</a>]";
}

?>
<hr>
<h2>Las últimas imágenes guardadas en sistema</h2>
<?php
if(isset($_SESSION['idUsuario']))
{
	echo "<p><a href='agregaImagen.php'>Cargar imagen</a></p>";
}

//conectar a la BD
$conn = mysqli_connect("localhost","root","","tecweb20192020");
//$qry = "select idImagen, Nombre, idUsuario, Titulo, Fecha from imagenes";
$qry = "select i.idImagen, i.Nombre as nombreImagen, u.idUsuario as idU, u.Nombre as nombreUsuario, i.Fecha
		from imagenes as i inner join usuarios as u on i.idUsuario = u.idUsuario";
$resultado = mysqli_query($conn,$qry);
if(mysqli_num_rows($resultado)>0)   //si hay imagenes en la BD
{
	$i=1;
	while($registro = mysqli_fetch_array($resultado))
	{
		//echo $i . " - " . $registro["Fecha"] . " - " . $registro["Nombre"] . " - " . $registro["Titulo"] . "<br>";
		echo "<img width = '100px' src = 'imagen.php?idI=" . $registro["idImagen"] . "'><br>
		$i - [" . $registro["Fecha"] . "] - " . $registro["nombreImagen"] . 
		" <a href = 'eliminarImagen.php?idI=" . $registro["idImagen"] . "'>Eliminar Imagen</a><br>";
		$i++;	
	}
}
else
{
	echo "No hay imágenes guardadas en la BD";
}


?>
</body>

</html>
