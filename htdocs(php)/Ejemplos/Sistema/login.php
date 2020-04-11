<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
$msg="";
if(isset($_GET['txtNombre']) && isset($_GET['txtPassword']))
{
    if($_GET['txtNombre']!="" && $_GET['txtPassword']!="")
    {
        //conexion con el servidor de BD, la especifiacion de BD
        $conn=mysqli_connect("localhost","root","","tecweb20192020");
        $consulta="select idUsuario from usuarios where Usuario='" . $_GET['txtNombre'] . "'and Pwd='".$_GET['txtPassword']."'";
        
        $rs=mysqli_query($conn,$consulta); //evalua en la bd la consulta
        
        if(mysqli_num_rows($rs)>0) // evaluar si se encontro coincidencia en la BD
        {
            $usr=mysqli_fetch_array($rs);
            $_SESSION['idUsuario']= $usr['idUsuario'];
            header("location:http://localhost/Ejemplos/Sistema/portada.php");
        }
        else //los valores son incorrectos
        $msg="Los datos proporcionados (nombre y contraseña) no son correctos";
    }
    else
        $msg = "Ambos datos (nombre y contraseña) son requeridos";
}
?>
<form method="get" action="login.php">
    Usuario: <input name="txtNombre" type="text" placeholder="Anota tu usario"><br>
    Password: <input name="txtPassword" type="password"><br>
    <input type="submit" value="Autenticar">
    <input type="reset" value="Cancelar">
</form>
<?php 
if($msg!="") echo "<p>$msg</p>";
?>
</body>
</html>