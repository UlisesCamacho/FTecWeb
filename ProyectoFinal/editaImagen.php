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
<h1>Formulario para cambiar detalles de la imagen</h1>
<form method="get" action="editaImagen.php" onsubmit="return verificaFRM()">
<input type="hidden" name="idI" value="<?php echo $_GET['idI']?>">
    Titulo: <input type="text" id='txtTitulo'name="txtTitulo" value="<?php echo $datos["Titulo"]?>"><br>
    Descripcion: <textarea id='txtDescripcion' name="txtDescripcion"><?php echo $datos["Descripcion"]?></textarea><br>
<input type="submit" value="Aceptar" >
<input type="reset" value="Cancelar"><br>
<a href="CanCerberoPortada.php">Regresar</a> a la portada.
</form>
</body>

</html>