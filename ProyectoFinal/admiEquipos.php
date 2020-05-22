<?php 
session_start();
if(!isset($_SESSION['idUsuario']) || $_SESSION['Rol']!='Administrador') header("location:http://localhost/ProyectoFinal/CanCerberoPortada.php");

include ("funciones.php");
$msg="";
//
if(isset($_POST['txtNombreEquipo']))
{
    
    if($_POST['txtNombreEquipo']!="")
    {
            
                $nombreEquipo=$_POST['txtNombreEquipo'];
                $conn=ConectarBD();
                $qry= "insert into equipos (Nombre)
                    values ('$nombreEquipo')";
                    if(mysqli_query($conn,$qry))
                    {
                       
                        header("location:http://localhost/ProyectoFinal/admiEquipos.php");
                    }
                    else{
                        if(mysqli_errno($conn)=="1062")
                        {
                            $msg="error". mysqli_errno($conn). "Nombre de Equipo ya existe";
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
    <title>Document</title>
    <style type="text/css">
.alerta{
	background-color: blue;
	color: red;
	text-transform: uppercase;
}
</style>
<script type="text/javascript">
function verificaFRM()
{
    if(document.getElementById("txtNombreEquipo").value =="")
    {
        alert("El nombre es obligatorio");
        return false;
    } 
    if(document.getElementById("txtNombreEquipo").value =="") return false;
    else
    return true;
}
</script>
</head>
<body>
<h1>Agregar Equipo</h1>
<form method="post" action="admiEquipos.php" onsubmit="verificaFRM()">
	Nombre Equipo: <input type="text" name="txtNombreEquipo" id="txtNombreEquipo"><br>
	<?php if($msg!="") echo "<p class='alerta'>$msg</p>" ?>
	<input type="submit" value="Subir Equipo">
    <input type="reset" value="Cancelar">
</form>
<a href="admi.php">Regresar</a>.
<hr>
<h2>EQUIPOS</h2>
    <table>
        <tr>
        <td>id Equipo</td>
        <td>Nombre Equipo</td>
        </tr>
    <?php 
    $conn=ConectarBD();
    $sql= "SELECT * from equipos";
    $rs=mysqli_query($conn,$sql);
    while($mostrar=mysqli_fetch_array($rs)){
    ?>
    <tr>
    <td><?php echo $mostrar['idEquipo'] ?></td>
        <td><?php echo $mostrar['nombre'] ?></td>
    </tr>
    <?php 
    }//while
    ?>
    </table>
</body>
</html>