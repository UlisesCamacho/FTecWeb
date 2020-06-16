<?php
session_start();
require("Funciones.php");
if(!isset($_SESSION['idUsuario']))header("location:http://localhost/ProyectoFinal/CanCerberoPortada.php");

$conn = ConectarBD();
if(isset($_GET['txtTitulo']) && isset($_GET['txtDescripcion']))
{
    if($_GET['txtTitulo']!= "" && $_GET['txtDescripcion']!= "")
    {
            $qry = "UPDATE imagenes SET Titulo='". $_GET['txtTitulo'] . "', Descripcion='".$_GET['txtDescripcion']."' WHERE idImagen=". $_GET['idI'];
            $rs = mysqli_query($conn, $qry);
            header("location:http://localhost/ProyectoFinal/galeria.php");
    }
}
if(isset($_GET['idI']) && $_GET['idI']!= "")
{
    $qry = "SELECT Titulo, Descripcion FROM imagenes WHERE idImagen = ". $_GET['idI'];
    $rs = mysqli_query($conn, $qry);
    $datos = mysqli_fetch_array($rs);
}
?>

<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Untitled 1</title>
<style type="text/css">
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
   max-width: 20em;
   padding-bottom: 10px;
   padding-top: 10px;
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
background: url("futlogin.jpg") no-repeat center center fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
color: white;
}
form{
    color:white;
}
#txtDescripcion{
   margin-left: 10px;
   width: 220px;
}
</style>
<script type="text/javascript">
function verificaFRM()
{
	if(document.getElementById("txtTitulo").value == "")
	{ 
		alert("Título en imagen debe ser proporcionado");
		return false;
	}
	if(document.getElementById("txtTitulo").value =="") return false;
	if(document.getElementById("txtDescripcion").value =="") return false;
   	else
	return true;
}
</script>
</head>

<body>

<div class="tituloPagina"><h2>cambiar detalles de la imagen</h2></div>
<div id="login">
<form method="get" action="editaImagen.php" onsubmit="return verificaFRM()">
<input type="hidden" name="idI" value="<?php echo $_GET['idI']?>">
 <label>Titulo:</label>    <input type="text" id='txtTitulo'name="txtTitulo" value="<?php echo $datos["Titulo"]?>"><br>
<label>Descripcion:</label>  <textarea class="textDescripcion" id='txtDescripcion' name="txtDescripcion"><?php echo $datos["Descripcion"]?></textarea><br>
<br>
<br>
<input type="submit" value="Aceptar" >
<br>
<br>
<input type="reset" value="Cancelar"><br>

</form>
</div>
<br>
<br>
<div class="regreso"><a href="galeria.php">Regresar</a></div>
</body>

</html>