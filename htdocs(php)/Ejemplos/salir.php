<?php 
session_start();
session_destroy(); //quita todo
header("location:http://localhost/Ejemplos/login.php");
//$_SESSION['nombre']="";
?>