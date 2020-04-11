<?php 
session_start();
if(!isset($_SESSION['idUsuario'])) header("location:http://localhost/Ejemplos/Sistema/login.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Sistema de control de imagenes</h1> 
</body>
</html>