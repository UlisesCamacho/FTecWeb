<?php
session_start();
include ("funciones.php");
if(isset($_REQUEST['idI']) && $_REQUEST['idI']!="") //verificar el id usario solo elimine sus imagenes correspondientes get por request
{
    $conn= ConectarBD();
    //$qry= "select Descripcion, Fecha, Imagen, Nombre, Tipo, Titulo from imagenes where idImagen=" .$_GET['idI'];
    $qry="select i.idUsuario, i.Descripcion, i.Fecha, i.Imagen, i.Nombre, i.Tipo, i.Titulo, u.Usuario from imagenes as i
    inner join usuarios as u on i.idUsuario = u.idUsuario where idImagen=".$_REQUEST['idI'];
    $rs=mysqli_query($conn,$qry);
    $imagen= mysqli_fetch_array($rs);

    //verificar si tenemos que hacer el alta del comentario
    if(isset($_REQUEST['txtComentario']) && $_REQUEST['txtComentario']!="")
    {
        $qry= "Insert into comentarios (Comentario, idImagen, idUsuario, Fecha) 
            value ('". $_REQUEST['txtComentario'] . "', ". $_REQUEST['idI'].", ". $_SESSION["idUsuario"].",
            '". fechaSvr()."')";
            $rs=mysqli_query($conn,$qry);
    }
   
}
else
{
    header("location: http://localhost/ProyectoFinal/CanCerberoPortada.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
    body{
background: url("fondoComentario.jpg") no-repeat center center fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
color: white;
}
    </style>
</head>
<body>
    <?php 
        echo "<h1>".$imagen["Titulo"] ."</h1>";

    ?>
<p class="descripcion">[<?php echo $imagen["Fecha"]; ?>] - <?php echo $imagen["Nombre"]; ?><br>
Autor: <?php echo $imagen["Usuario"]; ?> 

<br>Descripcion de la imagen: <?php echo $imagen["Descripcion"]; ?></p>
<img src="imagen.php?idI=<?php echo $_REQUEST['idI']; ?>" alt="Imagen">

<h2>Comentarios de la imagen</h2>
<?php 
    if(isset($_SESSION['idUsuario']))
    {
?>
<form method="POST" action="muestraImagen.php">
Comenta:<br> <textarea name="txtComentario"></textarea><br>
<input type="hidden" name= "idI" value="<?php echo $_REQUEST['idI']; ?>">"
<input type="submit" value="Comentar">
<input type="reset" value="Cancelar">
<hr>
</form>
<?php 
    
        $qry="Select * from comentarios where idImagen=" . $_REQUEST['idI'] . " order by Fecha DESC" ;
        $rs = mysqli_query($conn,$qry);

    if(mysqli_num_rows($rs)>0)
    {  
        while($comentario = mysqli_fetch_array($rs))
        {
            echo $comentario["Fecha"]. "<br>";
            echo $comentario["Comentario"]."<br>";

            if($_SESSION['Rol']=="Administrador") 
            echo "<a href='eliminaComentario.php?idC=".$comentario["idComentario"]."'>Eliminar comentario </a><br>"; 
            else if($_SESSION['idUsuario']== $comentario["idUsuario"]) 
                echo "<br><a href='eliminaComentario.php?idC=". $comentario["idComentario"]."'>Eliminar comentario </a><br>";
            
            "<br>" . $comentario["Comentario"] . "<br><br>";
        }
    }
    else
        echo "Por el momento no existen comentarios de la imagen";
    }
    else{
        echo "autenticate para comentar";
    }
    ?>
</body>
</html>