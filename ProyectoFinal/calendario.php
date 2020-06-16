<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/83b0530ef8.js"></script>
    <title>Portada</title>
    <link href="base.css" rel="stylesheet" type="text/css" />
    <link href="great.css" rel="stylesheet" type="text/css"  media="screen and (min-width: 981px)" />
    <link href="medium.css" rel="stylesheet" type="text/css" media="screen and (min-width: 481px) and (max-width: 980px)" />
    <link href="mini.css" rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" />
    <style type="text/css">
    #main-container{
    margin:auto;
    margin-top: 5%;
	width: 800px;
    
}

table{
	background-color: white;
	text-align: left;
	border-collapse: collapse;
	width: 100%;
}

th, td{
	padding: 5px;
    text-align: center;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 15px;
    
}

thead{
    background-color: #2d572c;
	border-bottom: solid 5px green;
	color: white;
    font-size: 30px;
}

tr:nth-child(even){
	background-color: #ddd;
}

tr:hover td{
	background-color: #5dc1b9;
	color: white;
}
.tituloPagina{
    width: 95%;
    margin: auto;
    margin-top: 0.5%;
    overflow: hidden;
    height: 80px;
    font-size: 20px;
    text-align: center;
    border-bottom: 2px solid black;
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
<?php 
// variables aparte
$arrayPF=[];
$arrayPP=[];

$contPF=0;
$contPP=0;

include ("funciones.php");
$msg="";
$conn=ConectarBD();
$sql= "SELECT * FROM partidos";
$rs=mysqli_query($conn,$sql);
while($mostrar=mysqli_fetch_array($rs))
{
$fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
$auxfecha=$mostrar['fecha'];
$fecha_entrada = strtotime($auxfecha);
	
if($fecha_actual > $fecha_entrada)
	{
    $arrayPF[$contPF]=$mostrar['idPartido'];
    $contPF++;
    }
    else
		{  
        $arrayPP[$contPP]=$mostrar['idPartido'];
        $contPP++;
        }
    }
      //  echo "partidos proximos <br>";
    foreach ($arrayPP as $element) {
      //  echo $element;
       // echo '<br>';
      }
      //echo "partidos finalizados <br>";
      foreach ($arrayPF as $element) {
      //  echo $element;
       // echo '<br>';
      }
?>
<div class="tituloPagina"><h2>Proximos Partidos</h2></div>
<div class="conTabla">
          <div id="main-container">

<table>
    <thead>
        <tr>
            <th>Equipo Local</th>
            <th>-</th>
            <th>Equipo Vistante</th>
            
            
        </tr>
        </thead>
        <?php
        
        foreach ($arrayPP as $element) {
            // echo $element;
            // echo '<br>';
           
        $sql= "SELECT * FROM partidos where idPartido=".$element;
        $rs=mysqli_query($conn,$sql);
        while($mostrar=mysqli_fetch_array($rs)){
        ?>
    <tr>
        <td><?php $sql3= "SELECT nombreEquipo FROM equipos WHERE idEquipo= ".$mostrar['idEquipo1']; $rs3=mysqli_query($conn,$sql3); 
         while($mostrar3=mysqli_fetch_array($rs3)){
            echo  "<img width='30px' height='30px' src='imagenEquipo.php?idE=".$mostrar["idEquipo1"]."'> &nbsp; ". $mostrar3['nombreEquipo'];
         }
        ?></td>
        <td><?php echo $mostrar['fecha'] ."<br>" ?><strong>vs</strong></td>
        <td><?php $sql4= "SELECT nombreEquipo FROM equipos WHERE idEquipo= ".$mostrar['idEquipo2']; $rs4=mysqli_query($conn,$sql4); 
         while($mostrar4=mysqli_fetch_array($rs4)){
            echo $mostrar4['nombreEquipo'] . "&nbsp; ". "<img width='30px' height='30px' src='imagenEquipo.php?idE=".$mostrar["idEquipo2"]."'>";
         }
        ?></td>
        
        
    </tr>
    <?php 
    }//while
}
    ?>
</table>
</div>
</div>

<div class="tituloPagina"><h2>Partidos Finalizados</h2></div>
<div class="conTabla">
          <div id="main-container">

<table>
    <thead>
        <tr>
            <th>Equipo Local</th>
            <th>-</th>
            <th>Equipo Vistante</th>
            <th>+</th>
            
            
        </tr>
        </thead>
        <?php
        
        foreach ($arrayPF as $element) {
            // echo $element;
            // echo '<br>';
           
        $sql= "SELECT * FROM partidos where idPartido=".$element;
        $rs=mysqli_query($conn,$sql);
        while($mostrar=mysqli_fetch_array($rs)){
        ?>
    <tr>
        <td><?php $sql3= "SELECT nombreEquipo FROM equipos WHERE idEquipo= ".$mostrar['idEquipo1']; $rs3=mysqli_query($conn,$sql3); 
         while($mostrar3=mysqli_fetch_array($rs3)){
            echo  "<img width='30px' height='30px' src='imagenEquipo.php?idE=".$mostrar["idEquipo1"]."'> &nbsp; ". $mostrar3['nombreEquipo'];
         }
        ?></td>
        <td><?php echo $mostrar['fecha'] ."<br>" ?><strong>vs</strong></td>
        <td><?php $sql4= "SELECT nombreEquipo FROM equipos WHERE idEquipo= ".$mostrar['idEquipo2']; $rs4=mysqli_query($conn,$sql4); 
         while($mostrar4=mysqli_fetch_array($rs4)){
            echo $mostrar4['nombreEquipo'] . "&nbsp; ". "<img width='30px' height='30px' src='imagenEquipo.php?idE=".$mostrar["idEquipo2"]."'>";
         }
        ?></td>
         <td><?php  echo "<a href='infoPartido.php?idP=".$mostrar['idPartido']."'> <button type='button' class='btn btn-success'>InfoPartido</button></a>" ?></td>
        
        
    </tr>
    <?php 
    }//while
}
    ?>
</table>
</div>
</div>

