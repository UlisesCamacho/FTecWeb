<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<style type="text/css">
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
background: url("editaimg.jpg") no-repeat center center fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
}
	</style>
</head>
<?php 
$msg="";

if(isset($_GET['txtNombre']) && isset($_GET['txtPassword'])) //que las variables existan
{
	if($_GET['txtNombre']!="" && $_GET['txtPassword']!="") //tengan valores
	{
	
      //conexion con el servidor de BD, la especificacion de BD
      include ("funciones.php");
	 	$conn =ConectarBD(); //mysqli_connect("localhost", "root", "", "cancerberodb");
	 	$consulta = "select idUsuario, Rol, Nombre from usuarios where Usuario='". $_GET['txtNombre'] ."' and Pwd='".$_GET['txtPassword']."'";
	 	
	 	$rs = mysqli_query($conn, $consulta);  //evalua en la BD la consulta 
		 	
		if(mysqli_num_rows($rs)>0) //evaluar si se encontró coincidencia en la BD
		 {
		 	$usr = mysqli_fetch_array($rs);
		 	$_SESSION['idUsuario'] = $usr["idUsuario"];
			$_SESSION['NombreUsuario'] = $usr["Nombre"];
			$_SESSION['Rol']= $usr["Rol"];
			header("location:http://localhost/ProyectoFinal/CanCerberoPortada.php");
		 }
		else //los valores son incorrectos
		 $msg = "Los datos proporcionados (nombre y contraseña) no son correctos";
	}
	else
		$msg = "Ambos datos (nombre y contraseña) son requeridos";
}
?>
<body>
<div class="tituloPagina"><h2>Login</h2></div>
<div id="login">
         <form action= "login.php" method="GET">
            <label>Usuario: </label>
            <input type="text" name="txtNombre"/><br>
            <label>Contraseña: </label>
         <input type="password" name="txtPassword"/><br><br>
         <input type="submit" value="Enviar"/><br><br>
			<input type="reset" value="Cancelar">
			
			
         </form>

      </div>
</form>
<?php
if($msg!="") echo "<p>$msg</p>";
?>
<br>
<br>
<div class="regreso"><a href="CanCerberoPortada.php">Regresar</a></div>
</body>
</html>

