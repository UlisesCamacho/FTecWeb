<?php 
session_start();
require("funciones.php");
if(!isset($_SESSION['idUsuario'])) header("location:http://localhost/ProyectoFinal/CanCerberoPortada.php");
//validacion del formulario
if(isset($_GET['txtPwdActual']) && isset($_GET['txtPwdNuevo']) && isset($_GET['txtPwdConfirmacion']))
{
    if($_GET['txtPwdActual']!="" && $_GET['txtPwdNuevo']!="" && $_GET['txtPwdConfirmacion']!="")
    {
            if($_GET['txtPwdNuevo']==$_GET['txtPwdConfirmacion'])
            {
                $conn=ConectarBD();
                $qry="update usuarios set Pwd='". $_GET['txtPwdNuevo']."'
                     where idUsuario='".$_SESSION['idUsuario']."' and
                     Pwd='".$_GET['txtPwdActual']."'";
                     mysqli_query($conn,$qry);
                     header("location:http://localhost/ProyectoFinal/perfil.php");
            }

    }



}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    border-bottom: 2px solid black;
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
	</style>
<script type="text/javascript">
function verificaFRM()
{
    if(document.getElementById("txtPwdActual").value =="")
    {
        alert("la contraseña actual deber ser proporcionada");
        return false;
    } 
    if(document.getElementById("txtPwdNuevo").value =="") return false;
    if(document.getElementById("txtPwdConfirmacion").value =="") return false;
    if(document.getElementById("txtPwdNuevo").value!=document.getElementById("txtPwdConfirmacion").value) return false;
    else
    return true;
}

</script>
</head>
<body>
<div class="tituloPagina"><h2>Cambiar Contraseña</h2></div>
<div id="login">
<form action= "cambiarPWD.php" method="GET" onsubmit="return VerificaFRM()">
            <label>Password Actual: </label>
            <input type="password" id="txtPwdActual" name="txtPwdActual"><br>
            <label>Password Nuevo: </label>
            <input type="password" id="txtPwdNuevo" name="txtPwdNuevo"><br>
            <label>Password Confirmacion: </label>
            <input type="password" id="txtPwdConfirmacion" name="txtPwdConfirmacion"><br><br><br>
         <input type="submit" value="Enviar"/><br><br>
			<input type="reset" value="Cancelar">

</form>
<a href="perfil.php">Regresar</a>.
</div>
</body>
</html>
