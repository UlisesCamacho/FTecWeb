<?php
session_start(); 
include("funciones.php");
$msg="";
if(!isset($_SESSION['idUsuario']))header("location:http://localhost/ProyectoFinal/CanCerberoPortada.php");
//verificar que exista el idI
else{
    if(isset($_GET['idA']) && $_GET['idA']!="") //verificar el id usario solo elimine sus imagenes correspondientes
    {
        $conn= ConectarBD();
        $qry= "DELETE FROM amonestaciones WHERE idAmonestacion=" . $_GET['idA'];
        if($rs=mysqli_query($conn,$qry))
        {
            $msg="Se elimino correctamente";
            
        }
        else{
           $msg="problemas al eliminar";
        }
        
        //$imagen= mysqli_fetch_array($rs);
        //header("Content-type:". $imagen["Tipo"]);
        //echo $imagen["Imagen"];
    }
    
}
?>

<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Untitled 1</title>
<script type="text/javascript">
	alert(" Eliminado exitosamente");
	window.location.href='admiAmonestaciones.php';
</script>
<style type="text/css">
.alerta{
	background-color: blue;
	color: red;
	text-transform: uppercase;
}
</style>
</head>

<body>

	<?php if($msg!="") echo "<p class='alerta'>$msg</p>" ?>
	
</body>

</html>
