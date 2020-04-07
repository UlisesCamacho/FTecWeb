<?php
session_start();
session_destroy();
//$_SESSION['nombre']="";
header("location:http://localhost/TecWeb/Login.php");
?>
