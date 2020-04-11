<?php 
session_start();
if(!isset($_SESSION['usuario'])) header("location:http://localhost/Ejemplos/login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
Los datos proporcionados son correctos, bienvenido al sistema
<br>
<?php 
echo "Bienvenido " . $_SESSION['usuario'];
echo "<br>";
?>

<a href="salir.php">Salir de sistema</a>
</body>
</html>