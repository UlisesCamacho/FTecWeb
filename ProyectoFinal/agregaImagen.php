<?php
session_start();
if(!isset($_SESSION['idUsuario'])) header("location:http://localhost/ProyectoFinal/login.php");

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
     // $idPartido=0;
		//recuperar el contenido del archivo(imagen)
		$fp=fopen($nombreTemporal,"r");
		$contenido=fread($fp,$tamanio);
		fclose($fp);

		$contenido=addslashes($contenido);

		$qry="insert into imagenes (Nombre, Tipo, Imagen, idUsuario, Titulo, Descripcion, Fecha, idPartido)
				values ('$nombre','$tipo','$contenido','$idUsuario','$titulo','$descripcion','$fecha','1')";

		if(mysqli_query($conn,$qry))
			header("location:http://localhost/ProyectoFinal/galeria.php");
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

	/* Contenedor del login */
   .tituloPagina{
    width: 95%;
    margin: auto;
    margin-top: 0.5%;
    overflow: hidden;
    height: 80px;
    font-size: 20px;
    text-align: center;
    border-bottom: 2px solid white;
    color: white;
}

#login {
   background-color: black;
   border-radius: 8px;
   box-shadow: 3px 3px 10px 0px rgba(50, 50, 50, 0.75);
   -moz-box-shadow: 3px 3px 10px 0px rgba(50, 50, 50, 0.75);
   -webkit-box-shadow: 3px 3px 10px 0px rgba(50, 50, 50, 0.75);
   margin-left: auto;
   margin-right: auto;
   margin-top: 10%;
   max-width: 30em;
   padding-bottom: 10px;
   padding-top: 10px;
   color: white;
}

/* Etiquetas del formulario */

label {
   color: white;
   display: block;
   margin-bottom: 6px;
   margin-left: 1.2em;
}

/* Campos del formulario */

input[type="text"],
input[type="password"] {
   border: none;
   border-radius: 6px;
   display: block;
   font-size: 1em;
   height: 2em;
   text-align: center;
   width: 90%;
   margin-left: auto;
   margin-right: auto;
}

/* Botón */

input[type="submit"] {
   background-color: white;
   border: none;
   border-radius: 6px;
   color: black;
   display: block;
   font-size: 1em;
   height: 2em;
   margin-left: auto;
   margin-right: auto;
   margin-top: -10px;
   text-align: center;
   width: 220px;
}

input[type="submit"]:hover {
   cursor: pointer;
   background-color: gray;
   opacity: 1;
   color: white;
}
input[type="reset"] {
   background-color: white;
   border: none;
   border-radius: 6px;
   color: black;
   display: block;
   font-size: 1em;
   height: 2em;
   margin-left: auto;
   margin-right: auto;
   margin-top: -10px;
   text-align: center;
   width: 220px;
}

input[type="reset"]:hover {
   cursor: pointer;
   background-color: gray;
   opacity: 1;
   color: white;
}
.regreso{
   margin:auto;
   text-align: center;
}
.regreso a{
   margin:auto;
    width: 95%;
	 color: white;
    overflow: hidden;
    height: 40px;
    text-align: center;
    font-size: 30px;
    text-decoration: none;
}
body{
background: url("agregaImg.jpg") no-repeat center center fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
}
</style>
</head>

<body>
<div class="tituloPagina"><h2>Agrega Imagen </h2></div>
<div id="login">
<form method="post" action="agregaImagen.php" enctype="multipart/form-data">
<label>TItulo:</label> <input type="text" name="txtTitulo"><br>
<label>Archivo:</label>	 <input type="file" name="imagen"><br>
<label>Descripción:</label>	 <textarea name="txtDescripcion"></textarea><br><br>
<label>Fecha:</label> <input type="date" name="txtFecha"><br><br><br>
	<?php if($msg!="") echo "<p class='alerta'>$msg</p>" ?>
	<input type="submit" value="Cargar la imagen"><br><br>
	<input type="reset" value="Cancelar">
</form>
</div>
<br>
<br>
<div class="regreso"><a href="CanCerberoPortada.php">Regresar</a></div>
</body>

</html>
