<?php 
include("funciones.php");
//verificar que exista el idI
if(isset($_GET['idI']) && $_GET['idI']!="")
{
    $conn= ConectarBD();
    $qry= "select Tipo, Imagen, Nombre from imagenes where idImagen=" . $_GET['idI'];
    $rs=mysqli_query($conn,$qry);
    $imagen= mysqli_fetch_array($rs);
    header("Content-type:". $imagen["Tipo"]);
    echo $imagen["Imagen"];
}

?>