<?php
session_start();
if(!isset($_SESSION['usuario'])) header("location:http://localhost/TecWeb/Login.php");
?>

<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Untitled 1</title>
</head>

<body>
Los datos proporcionados son correctos
</body>
<a href="salir.php">Salir de sistema</a>
</html>
