<?php
session_start();
if(!isset($_SESSION['idUsuario'])) header("location:http://localhost/Sistema/Login.php");

include ("funciones.php");

//conectar a la BD
$conn = ConectarBD();
$msg="";

if(isset($_POST['txtTitulo']) && $_POST['txtTitulo']!="")   // validar el envio del formulario.
{
	if(!empty($_FILES['imagen']['tmp_name'])) //validar que el archivo se cargó del lado del servidor
	{
		//tomar el archivo de la carpeta temporales y entonces guardarlo en la BD.
		$nombre=$_FILES['imagen']['name'];
		$tipo=$_FILES['imagen']['type'];
		$nombreTemporal=$_FILES['imagen']['tmp_name'];
		$tamanio=$_FILES['imagen']['size'];
		$titulo=$_POST['txtTitulo'];
		$descripcion=$_POST['txtDescripcion'];
		$fecha=$_POST['txtFecha'];
		$idUsuario=$_SESSION['idUsuario'];

		//recuperar el contenido del archivo(imagen)
		$fp=fopen($nombreTemporal,"r");
		$contenido=fread($fp,$tamanio);
		fclose($fp);

		$contenido=addslashes($contenido);

		$qry="insert into imagenes (Nombre, Tipo, Imagen, idUsuario, Titulo, Descripcion, Fecha)
				values ('$nombre','$tipo','$contenido','$idUsuario','$titulo','$descripcion','$fecha')";

		if(mysqli_query($conn,$qry))
			header("location:http://localhost/Sistema/portada.php");
		else
		{
			$msg="No se ha podido insertar la imagen en la BD . el error es:" . mysqli_error($conn);
		}
			


	}
}

?>
<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Untitled 1</title>
<style type="text/css">
.alerta{
	background-color: blue;
	color: red;
	text-transform: uppercase;
}
</style>
</head>

<body>
<h1>Agregar imagen</h1>
<form method="post" action="agregaImagen.php" enctype="multipart/form-data">
	Titulo: <input type="text" name="txtTitulo"><br>
	Archivo: <input type="file" name="imagen"><br>
	Descripción: <textarea name="txtDescripcion"></textarea><br>
	Fecha: <input type="date" name="txtFecha"><br>
	<?php if($msg!="") echo "<p class='alerta'>$msg</p>" ?>
	<input type="submit" value="Cargar la imagen">
	<input type="reset" value="Cancelar">
</form>
<a href="portada.php">Regresar</a> a portada.
</body>

</html>
