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
// datos a compara del lado del servidor
$nombre="Ulises";
$password="1234";
$msg=""; 
if(isset($_GET['txtNombre']) && isset($_GET['txtPassword'])) //que las variables existan
{
    if($_GET['txtNombre']!="" && $_GET['txtPassword']!="") //tengan valores
    {
        if($_GET['txtNombre']==$nombre && $_GET['txtPassword']==$password) // los valores son correctos
       // $msg="Los datos proporcionados son correctos, bienvenido al sistema";
        { 
            $_SESSION['usuario']=$_GET['txtNombre'];
            header("location:http://localhost/Ejemplos/inicio.php"); 
       
        }
       else // los valores son incorrectos
        $msg="Los datos proporcionados (nombre y contraseña) no son correctos";
    }
    else
    $msg="Ambos datos (nombre y contraseña) son requeridos";
}

?>
<form method="GET" action="login.php">
    Usuario: <input name="txtNombre" type="text" placeholder="Anota tu usuario"><br>
    Password: <input name="txtPassword" type="password"><br>
    <input type="submit" value="Autenticar">
    <input type="reset" value="Cancelar">
</form>
<?php 
if($msg!="") echo "<p>$msg</p>";
?>    
</body>
</html>