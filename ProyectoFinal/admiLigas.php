<?php 
session_start();
if(!isset($_SESSION['idUsuario']) || $_SESSION['Rol']!='Administrador') header("location:http://localhost/ProyectoFinal/CanCerberoPortada.php");

include ("funciones.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Agregar Liga</h1>
<form method="post" action="admiLigas.php" onsubmit="">
	Nombre de liga: <input type="text" name="txtNombreLiga"><br>
	
	<input type="submit" value="Insertar Liga">
    <input type="reset" value="Cancelar">
    <hr>
</form>
</body>
</html>