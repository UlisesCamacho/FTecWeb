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
    h2{
        margin: auto;
        text-align: center;
        font-family:Arial, Helvetica, sans-serif;
        color:white;
        font-size: 50px;
        
        background-color: #2d572c;
        width: 65%;
    }
    img{
        text-align: center;
    }
    
    .elemento{
    width: 75%;
    margin: auto;
    margin-top: 0.0%;
    overflow: hidden;
    height: 40%;
    font-size: 20px;
    text-align: left;
    border-top: 1px solid black;
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #18171c;
    background-color: #DDDDDD;
   
}
.contenedor{
 
   
    display: flex;
    flex-direction:column;
    background-color: white;
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
         include("funciones.php");
         $contador=0;
         $conn=ConectarBD();
         $sql="SELECT nombreLiga, idLiga FROM ligas";
         $rs=mysqli_query($conn,$sql);
         echo "<br>";
         echo "<div class=' contenedor'>";
         while($datos=mysqli_fetch_array($rs))
         {
            echo "<h2>$datos[nombreLiga]<h2>";
            echo "<div class='elemento'>";
            $sqli= "SELECT nombreEquipo, idEquipo, imagenEquipo FROM equipos WHERE idLiga=". $datos['idLiga'];
            $rsi=mysqli_query($conn,$sqli);
            while($datosi=mysqli_fetch_array($rsi))
            {
                echo  "<img width='100px' height='70px' src='imagenEquipo.php?idE=".$datosi["idEquipo"]."'>". "      " . $datosi['nombreEquipo'] . "<br>";
                //echo <img width = '100px' src = 'imagen.php?idI=" . $registro["idImagen"] . "'
               // echo  "<img width='100px' src='imagenEquipo.php?idE=".$datosi["idEquipo"]."'>";
            }
            echo "</div>";
           
         }
         echo "</div>";

         
    ?>
  