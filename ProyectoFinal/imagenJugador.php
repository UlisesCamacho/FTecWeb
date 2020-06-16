<?php 
include("funciones.php");
//verificar que exista el idI
if(isset($_GET['idJ']) && $_GET['idJ']!="")
{
    $conn= ConectarBD();
    $qry= "select Tipo, imagenJugador from jugadores where idJugador=" . $_GET['idJ'];
    $rs=mysqli_query($conn,$qry);
    $imagen= mysqli_fetch_array($rs);
    header("Content-type:". $imagen["Tipo"]);
    echo $imagen["imagenJugador"];
}

?>