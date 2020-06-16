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
    <style type="text/css">
    .tituloPagina{
    width: 95%;
    margin: auto;
    margin-top: 0.5%;
    overflow: hidden;
    height: 80px;
    font-size: 20px;
    text-align: center;
    border-bottom: 2px solid black;
    color: black;
}
.contenedor{
    margin: auto;
    text-align: center;
    text-decoration: none;
}
.contenedor a{
    text-decoration: none;
    color: black;
    font-family: Arial, Helvetica, sans-serif;
}
body{
background: url("fondogaleria.jpg") no-repeat center center fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
}

#main-container{
    margin: auto;
	
	width: 600px;
    
}

table{
	background-color: gray;
	text-align: right;
    text-align: left;
	border-collapse: collapse;
	width: 85%;
}

th, td{
	padding: 1px;
}

thead{
    background-color: #2d572c;
	border-bottom: solid 5px green;
	color: white;
}

tr:nth-child(even){
	background-color: #ddd;
}

tr:hover td{
	
	color: white;
}
.equipoFiltrol{
    height: 20px;
    width: 20px;
    
}
label{
    font-size: 10px;
    color:black;
    font-family: Arial, Helvetica, sans-serif;
}


    </style>
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
               
               
                        <li><a href="CanCerberoPortada.php">Inicio</a></li>
                        <li><a href="ligas.php">Ligas</a></li>
                        <li><a href="calendario.php">Calendario</a></li> 
                        <li><a href="tablas.php">Tablas</a></li>
                        <li><a href="galeria.php">Galeria</a></li>
                        <li><a href="acercade.php">Acerca de</a></li>
                        
                     
                        <?php 
                         if(!isset($_SESSION['idUsuario']))
                         {
                            echo "<li><a href='contacto.php'>Contacto</a></li>";   
                         }
                         else
                         {
                            $aux=$_SESSION['Rol'];
                            if($aux=="Administrador")
                            {
                                echo "<li><a href='admi.php'>Admi</a></li>"; 
                            }
                            else{
                                echo "<li><a href='contacto.php'>Contacto</a></li>";
                            }
                         }
                         
                           
                        ?>
                    
              
            </ul>
        </nav>

    </div>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="menu.js"></script>

  
<hr>
<div class="tituloPagina"><h4>Ultimas Imagenes</h4></div>

<div class="contenedor"> 
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
		echo "<a href='muestraImagen.php?idI=".$registro["idImagen"]."'><img width = '200px' src = 'imagen.php?idI=" . $registro["idImagen"] . "'></a>
		FECHA: [" . $registro["Fecha"] . "]";  
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
<div class="tituloPagina"><h4>Ultimos Partidos</h4></div>
<form method="POST" action="galeria.php"> 
<label id="lfiltro"> Buscar por Equipo Local</label>
<select class="equipoFiltrol" name="equipoFiltrol" id="equipoFiltrol">
    <?php 
     $sqlfiltro="SELECT idEquipo, nombreEquipo FROM equipos";
     $rsfiltro=mysqli_query($conn,$sqlfiltro);
        while($datosfiltro=mysqli_fetch_array($rsfiltro))
        {

        $auxfiltro=$datosfiltro["nombreEquipo"];
     ?>
        
        <option value="<?php echo $datosfiltro['idEquipo'] ?>"><?php echo $auxfiltro ?></option>
            <?php 
        }
            ?>
    </select>
    <input type="submit" value="buscar"/>
</form>
<br>
<div class="contenedor2">
<div class="conTabla">
          <div id="main-container">

<table>
    <thead>
        <tr>
 
            <th>Local</th>
        <th>Fecha</th>
        <th>Visitante</th>
        <th>Liga</th>
        <th> imagen</th>
       
        
            
        </tr>
        </thead>
        <?php 
        if(isset($_POST['equipoFiltrol']))
        {
            $sql= "SELECT * FROM partidos where idEquipo1=" .$_POST['equipoFiltrol'];
            
            $contadormagico=0;
        }
        else{

        
        $contadormagico=0;
        $sql= "SELECT * FROM partidos";
        }
        $rs=mysqli_query($conn,$sql);
        while($mostrar=mysqli_fetch_array($rs)){
            $contadormagico++;
        ?>
    <tr>
        
        <td><?php $sql3= "SELECT nombreEquipo FROM equipos WHERE idEquipo= ".$mostrar['idEquipo1']; $rs3=mysqli_query($conn,$sql3); 
         while($mostrar3=mysqli_fetch_array($rs3)){
              echo  "<img width='30px' height='20px' src='imagenEquipo.php?idE=".$mostrar["idEquipo1"]."'> &nbsp; ". $mostrar3['nombreEquipo'];
         }
        ?></td>
         <td><?php echo $mostrar['fecha'] ?></td>
        <td><?php $sql4= "SELECT nombreEquipo FROM equipos WHERE idEquipo= ".$mostrar['idEquipo2']; $rs4=mysqli_query($conn,$sql4); 
         while($mostrar4=mysqli_fetch_array($rs4)){
            echo  "<img width='30px' height='20px' src='imagenEquipo.php?idE=".$mostrar["idEquipo2"]."'> &nbsp; ".$mostrar4['nombreEquipo']; 
         }
        ?></td>
       
        <td><?php $sql2= "SELECT nombreLiga FROM ligas WHERE idLiga= ".$mostrar['idLiga']; $rs2=mysqli_query($conn,$sql2); 
         while($mostrar2=mysqli_fetch_array($rs2)){
            echo $mostrar2['nombreLiga'];
         }
        ?></td>
        


        <td><?php  echo "<a href='partidoImagen.php?idP=".$mostrar['idPartido']."'> <button type='button' class='btn btn-success'><i class='fas fa-images'></i></button></a>" ?></td>
       
        
    </tr>
    <?php 
    if($contadormagico==4)
    {
    break;
    }
    }//while
    ?>
</table>
</div>
</div>
</div>
<a href="#"></a>
<?php 
if(isset($_SESSION['idUsuario']))
{
    echo "<h1>Mis Imagenes</h1>";
  //  echo "<p><a href='agregaImagen.php'><h2>Cargar imagen</h2></a></p>";
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
		<br>$i - [" . $registro["Fecha"] . "] ". "<br><br>".
		" <a href = 'eliminaImagen.php?idI=" . $registro["idImagen"] . "'><h3>Eliminar Imagen</h3></a>
		<a href='editaImagen.php?idI=" . $registro["idImagen"] . "'><h3>Modificar Imagen</h3></a><br>";
		$i++;	
	}
}
	else
	{
		echo "no tienes imagenes porfavor registrate o inicia sesion";
	}
}
?>
</div>

</body>
</html>