<?php
session_start();
require("funciones.php");
if(!isset($_SESSION['idUsuario']))header("location:http://localhost/Sistema/portada.php");

$conn = ConectarBD();
if(isset($_GET['txtNombreLiga']))
{
    if($_GET['txtNombreLiga']!="")
    {
            $qry = "UPDATE ligas SET nombreLiga='". $_GET['txtNombreLiga'] . "' WHERE idLiga=". $_GET['idL'];
            $rs = mysqli_query($conn, $qry);
            header("location:http://localhost/ProyectoFinal/admi.php");
    }
}
if(isset($_GET['idL']) && $_GET['idL']!= "")
{
    $qry = "SELECT nombreLiga FROM ligas WHERE idLiga = ". $_GET['idL'];
    $rs = mysqli_query($conn, $qry);
    $datos = mysqli_fetch_array($rs);
}
?>

<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Untitled 1</title>
<link href="baseAdmi.css" rel="stylesheet" type="text/css" />
    <link href="great.css" rel="stylesheet" type="text/css"  media="screen and (min-width: 981px)" />
    <link href="medium.css" rel="stylesheet" type="text/css" media="screen and (min-width: 481px) and (max-width: 980px)" />
    <link href="mini.css" rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" />
    <style type="text/css">
.tituloFormulario
{
    margin-top: 20px;
    width: 95%;
	margin: auto;
    overflow: hidden;
    height: 40px;
    border-bottom: 2px solid black;
    text-align: center;
    font-size: 30px;
}
.regreso{
    width: 95%;
	margin: auto;
    overflow: hidden;
    height: 40px;
    border-top: 2px solid black;
    text-align: center;
    font-size: 30px;
}
	/* Contenedor del login */

#login {
   background-color: black;
   border-radius: 8px;
   box-shadow: 3px 3px 10px 0px rgba(50, 50, 50, 0.75);
   -moz-box-shadow: 3px 3px 10px 0px rgba(50, 50, 50, 0.75);
   -webkit-box-shadow: 3px 3px 10px 0px rgba(50, 50, 50, 0.75);
   margin-left: auto;
   margin-right: auto;
   margin-top: 5%;
   max-width: 40em;
   padding-bottom: 10px;
   padding-top: 10px;
   margin-bottom: 3%;
   
}


/* Etiquetas del formulario */

label {
   color: white;
   display: block;
   margin-bottom: 20px;
   margin-left: 1.2em;
   font-size: 20px;
}

/* Campos del formulario */

input[type="text"],
input[type="password"] {
   border: none;
   display: block;
   font-size: 2em;
   height: 2em;
   text-align: center;
   width: 90%;
   margin-left: auto;
   margin-right: auto;
}

/* Botón */

input[type="submit"] {
   background-color: #a6a0f8;
   border: none;
   border-radius: 6px;
   color: black;
   display: block;
   font-size: 2em;
   height: 2em;
   margin-left: auto;
   margin-right: auto;
   margin-top: -10px;
   text-align: center;
   width: 430px;
}

input[type="submit"]:hover {
   cursor: pointer;
   background-color: gray;
   opacity: 1;
   color: white;
}
input[type="reset"] {
   background-color: #a6a0f8;
   border: none;
   border-radius: 6px;
   color: black;
   display: block;
   font-size: 2em;
   height: 2em;
   margin-left: auto;
   margin-right: auto;
   margin-top: -10px;
   text-align: center;
   width: 430px;
}

input[type="reset"]:hover {
   cursor: pointer;
   background-color: gray;
   opacity: 1;
   color: white;
}
	</style>
<script type="text/javascript">

function verificaFRM()
{
	if(document.getElementById("txtNombreLiga").value == "")
	{ 
		alert("debe de ser proporcionado");
		return false;
	}
	if(document.getElementById("txtNombreLiga").value =="") return false;
   	else
	return true;
}
</script>
</head>

<body>

<div class="tituloFormulario">Formulario Ligas
 </div>

<div id="login">
<form method="get" action="modificaRegistroLiga.php" onsubmit="return verificaFRM()">
<input type="hidden" name="idL" value="<?php echo $_GET['idL']?>">
   <label>Nombre Liga:</label>  
   <input type="text" id='txtNombreLiga'name="txtNombreLiga" value="<?php echo $datos["nombreLiga"]?>"><br><br>
<input type="submit" value="Modificar" ><br><br>
<input type="reset" value="Cancelar"><br>
</div>
<div class="regreso"><a href="admiLigas.php">Regresar</a></div>

</form>
</body>

</html>
