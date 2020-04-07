<?php
session_star();
if(!isset($_SESSION['idUsuario'])) header("location:http://localhost/TecWeb/Sistema/Login.php");
include ("funciones.php");
// conectar a la BD
$conn=ConectarBD();
if(isset($_POST['txtTitulo'])&& $_POST['txtTitulo']!="") // validar el envio del formulario
{
	if(!empty($_FILES['imagen']['tmp_name'])) //validar que el archivo se cargo del lado del servidor.
	{
		//tomar el archivo de la carpeta temporales y entonces guardarlo en la BD.
	}
}
?>

<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Untitled 1</title>
</head>

<body>
<h1>AgregaImagen</h1>
<form method="post" action="agregaImagen.php" enctype="multipart/form-data">
	Titulo: <input type="text" name="txtTitulo"><br>
	Archivo: <input type="file" name="imagen"><br>
	Descripcion: <textarea name="txtDescripcion"></textarea>
	Fecha: <input type="date" name="txtFecha"><br>
	<input type="submit" value="Cargar la imagen">
	<input type="reset" value="Cancelar">

</form>
<a href="portada.php">Regresar</a> a portada.
</body>

</html>
