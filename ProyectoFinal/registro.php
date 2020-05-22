<?php 
$msg="";
//
if(isset($_GET['txtNombre']) && isset($_GET['txtUsuario']) && isset($_GET['txtPwd1']) && isset($_GET['txtPwd2']))
{
    
    if($_GET['txtNombre']!="" && $_GET['txtUsuario']!="" && $_GET['txtPwd1']!=""&& $_GET['txtPwd2']!="")
    {
            if($_GET['txtPwd1']==$_GET['txtPwd2'])
            {
                $nombre=$_GET['txtNombre'];
                $usuario=$_GET['txtUsuario'];
                $pwd=$_GET['txtPwd1'];
                include ("funciones.php");
                $conn=ConectarBD(); //mysqli_connect("localhost","root","","cancerberodb");
                $qry= "insert into usuarios (Nombre, Usuario, Pwd, Rol)
                    values ('$nombre','$usuario','$pwd', 'General')";
                    if(mysqli_query($conn,$qry))
                    {
                       
                        header("location:http://localhost/ProyectoFinal/login.php");
                    }
                    else{
                        if(mysqli_errno($conn)=="1062")
                        {
                            $msg="error". mysqli_errno($conn). "usuario ya existente elige otro";
                        }
                    }
            }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style type="text/css">
	/* Contenedor del login */
   .alerta{
	background-color: blue;
	color: red;
	text-transform: uppercase;
}
#registro {
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
    if(document.getElementById("txtPwd1").value =="")
    {
        alert("la contraseña es obligatoria");
        return false;
    } 
    if(document.getElementById("txtPwd1").value =="") return false;
    if(document.getElementById("txtPwd2").value =="") return false;
    if(document.getElementById("txtNombre").value =="") return false;
    if(document.getElementById("txtUsuario").value =="") return false;
    if(document.getElementById("txtPwd1").value!=document.getElementById("txtPwd2").value) return false;
    else
    return true;
}
</script>
</head>
<body>
<h1>formulario para registrar usuario</h1>
<div id="registro">
         <form action= "registro.php" method="GET" onsubmit="return verificaFRM()">
            <label>Nombre: </label>
            <input type="text" name="txtNombre" id="txtNombre"><br>
            <label>Usuario: </label>
            <input type="text" name="txtUsuario" id="txtUsuario"><br>
            <label>Contraseña: </label>
            <input type="password" name="txtPwd1" id="txtPwd1"><br>
            <label>Contraseña Confirmacion: </label>
         <input type="password" name="txtPwd2" id="txtPwd2"><br><br>
         <input type="submit" value="Registrarme"/><br><br>
			<input type="reset" value="Cancelar">
         </form>
      </div>
      <?php if($msg!="") echo "<p class='alerta'>$msg</p>" ?>
</body>
</html>