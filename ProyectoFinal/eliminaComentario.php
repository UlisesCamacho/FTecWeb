<?php 
session_start();
include("funciones.php");

//verificar que exista el idI
if(isset($_GET['idC']) && $_GET['idC']!="")
{
    if($_SESSION['Rol']=="Administrador") // se procede a eliminar
    {
        $conn=ConectarBD();
        $qry="delete from comentarios where idComentario=" . $_GET['idC'];
        if($rs=mysqli_query($conn,$qry))
        {
            echo "Se elimino el comentario";
        }
    }
    else if(isset($_GET['idC']) && $_GET['idC']!="")
    {
        $conn=ConectarBD();
        $qry="delete from comentarios where idComentario=" . $_GET['idC'];
        if($rs=mysqli_query($conn,$qry))
        {
            echo "Se elimino el comentario";
            header("location:http://localhost/ProyectoFinal/galeria.php");
        }
    }
}
?>