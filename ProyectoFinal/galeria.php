<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/83b0530ef8.js"></script>
	<title>Document</title>
	<link href="base.css" rel="stylesheet" type="text/css" />
    <link href="great.css" rel="stylesheet" type="text/css"  media="screen and (min-width: 981px)" />
    <link href="medium.css" rel="stylesheet" type="text/css" media="screen and (min-width: 481px) and (max-width: 980px)" />
    <link href="mini.css" rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" />
</head>
<body>
<div class="encabezado">
        <div class="logo">
            <div class="logoImagen">
                <a href="#"><img class="imagenLogo" src="logoCancerberoPagina.jpg">
                </a>
            </div>
        </div>
        
                 <div id='lrrsb'>
                 <?php 
            if(!isset($_SESSION['idUsuario']))
            {
                echo "<div class='lr display-great display-medium'><a href='login.php' >login</a>/<a href='registro.php'>registrer</a></div>";
                echo "<div class='lr display-mini'><a href='login.php' >L</a><strong>/</strong><a href='registro.php'>R</a></div>";
            }
            else
            {
                echo "<div class='lr display-great display-medium'><a href='perfil.php' ><i class='fas fa-user'></i>". ' ' . $_SESSION['NombreUsuario'] ."</a></div>";
                echo "<div class='lr display-mini'><a href='perfil.php' ><i class='fas fa-user'></i>". ' ' . $_SESSION['NombreUsuario'] ."</a></div>";
                 
            }
?>
                    
               <div id="rs">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-instagram-square"></i></a>
                    <a href="#"><i class="fab fa-telegram-plane"></i></a>			
            
                </div>
              
            <div class="display-great">
                        <form method="get" action="https://www.google.com/search" target="_blank">
                            <input type="search" name="q" placeholder="Término a buscar" autofocus required>
                            <input type="submit" > <i class="fas fa-search"></i>
                        </form> 
           </div>
          
        </div>
        
        
    </div>
    
    <div class="menuHeader">
        <div class="menu_bar">
            <a href="#" class="bt-menu"><i class="fas fa-bars"></i> Menu</a>
        </div>
        <nav>
            <ul>
               
               
						<li><a href="#">Perfil</a></li>
                        <li><a href="ligas.php">Ligas</a></li>
                        <li><a href="calendario.php">Calendario</a></li> 
                        <li><a href="tablas.php">Tablas</a></li>
                        <li><a href="galeria.php">Galeria</a></li>
                        <li><a href="acercade.php">Acerca de</a></li>
                        
                     
                        <?php 
                         if(!isset($_SESSION['idUsuario']))
                         {
                            echo "<li><a href='#'>Contacto</a></li>";   
                         }
                         else
                         {
                            $aux=$_SESSION['Rol'];
                            if($aux=="Administrador")
                            {
                                echo "<li><a href='admi.php'>Admi</a></li>"; 
                            }
                            else{
                                echo "<li><a href='#'>Contacto</a></li>";
                            }
                         }
                         
                           
                        ?>
                    
              
            </ul>
        </nav>

    </div>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="menu.js"></script>

<h1>Galeria</h1>
<hr>
<h2>Ultimas Imagenes</h2>
<?php 
//echo "<p><a href='agregaImagen.php'>Cargar imagen</a></p>";
include ("funciones.php");
$conn = ConectarBD(); //mysqli_connect("localhost","root","","cancerberodb");
$qry = "select idImagen, Nombre, idUsuario, Titulo, Fecha from imagenes";
//$qry = "select i.idImagen, i.Nombre as nombreImagen, u.idUsuario as idU, u.Nombre as nombreUsuario, i.Fecha
//from imagenes as i inner join usuarios as u on i.idUsuario=u.idUsuario AND i.idUsuario='".$_SESSION['idUsuario']."'";
$resultado = mysqli_query($conn,$qry);

if(mysqli_num_rows($resultado)>0)   //si hay imagenes en la BD
{
	$i=1;
	while($registro = mysqli_fetch_array($resultado))
	{
		//echo $i . " - " . $registro["Fecha"] . " - " . $registro["Nombre"] . " - " . $registro["Titulo"] . "<br>";
		echo "<a href='muestraImagen.php?idI=".$registro["idImagen"]."'><img width = '100px' src = 'imagen.php?idI=" . $registro["idImagen"] . "'></a>
		FECHA: [" . $registro["Fecha"] . "] - Nombre: " . $registro["Nombre"] ."";  
		$i++;	
	}
}
	else
	{
		echo "No hay imágenes guardadas en la BD";
	}

//conectar a la BD
?>
<hr>

<?php 
if(isset($_SESSION['idUsuario']))
{
    echo "<h3>Mis Imagenes</h3>";
    echo "<p><a href='agregaImagen.php'>Cargar imagen</a></p>";
$qry = "select i.idImagen, i.Nombre as nombreImagen, u.idUsuario as idU, u.Nombre as nombreUsuario, i.Fecha
from imagenes as i inner join usuarios as u on i.idUsuario=u.idUsuario AND i.idUsuario='".$_SESSION['idUsuario']."'";
$resultado = mysqli_query($conn,$qry);
if(mysqli_num_rows($resultado)>0)   //si hay imagenes en la BD
{
	$i=1;
	while($registro = mysqli_fetch_array($resultado))
	{
		//echo $i . " - " . $registro["Fecha"] . " - " . $registro["Nombre"] . " - " . $registro["Titulo"] . "<br>";
		echo "<a href='muestraImagen.php?idI=".$registro["idImagen"]."'><img width = '100px' src = 'imagen.php?idI=" . $registro["idImagen"] . "'></a>
		<br>$i - [" . $registro["Fecha"] . "] - " . $registro["nombreImagen"] . 
		" <a href = 'eliminaImagen.php?idI=" . $registro["idImagen"] . "'>Eliminar Imagen</a><br> 
		<a href='editaImagen.php?idI=" . $registro["idImagen"] . "'>Modificar Imagen</a><br>";
		$i++;	
	}
}
	else
	{
		echo "no tienes imagenes porfavor registrate o inicia sesion";
	}
}
?>
</body>
</html>