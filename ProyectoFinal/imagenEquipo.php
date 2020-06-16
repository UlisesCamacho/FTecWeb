<?php 
include("funciones.php");
//verificar que exista el idI
if(isset($_GET['idE']) && $_GET['idE']!="")
{
    $conn= ConectarBD();
    $qry= "select Tipo, imagenEquipo from equipos where idEquipo=" . $_GET['idE'];
    $rs=mysqli_query($conn,$qry);
    $imagen= mysqli_fetch_array($rs);
    header("Content-type:". $imagen["Tipo"]);
    echo $imagen["imagenEquipo"];
}

?>