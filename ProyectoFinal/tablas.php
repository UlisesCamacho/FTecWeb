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
    text-align: left;
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
	background-color: #252850;
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


include ("funciones.php");
$msg="";
$conn=ConectarBD();

?>

    <div class="tituloPagina"><h2>Tabla General</h2></div>
<div class="conTabla">
          <div id="main-container">
*dar click en "PTS" para ordenar...
<table id="myTable">
    <thead>
        <tr>
            <th>Equipo</th>
            <th>PG</th>
            <th>PE</th>
            <th>PP</th>
            <th>PJ</th>
            <th onclick="sortTable(5, 'int')">PTS</th>
        </tr>
        <?php 
        $sql= "SELECT * FROM equipos where idLiga=1";
        $rs=mysqli_query($conn,$sql);
        while($mostrar=mysqli_fetch_array($rs)){
        ?>
    <tr>
        <td><?php  echo  "<img width='10px' height='10px' src='imagenEquipo.php?idE=".$mostrar["idEquipo"]."'>". "      " . $mostrar['nombreEquipo'] . "<br>"; ?></td>
       <td><?php
       $contadorganados=0;
       $contadorperdidos=0;
       $contadorempatados=0;
        $sqlG= "SELECT idPartido FROM goles WHERE idEquipo= ".$mostrar['idEquipo']; $rslG=mysqli_query($conn,$sqlG);
        
        while($mostrarG=mysqli_fetch_array($rslG)){
           $Partido=$mostrarG['idPartido'];
           $acomulador=0;
           $sqlfinal= "SELECT cantidad, idEquipo FROM goles WHERE idPartido=".$Partido;
           $rsfinal=mysqli_query($conn,$sqlfinal);
           while($mostrarf=mysqli_fetch_array($rsfinal)){
               if($mostrar['idEquipo']==$mostrarf['idEquipo'])
           $acomulador+=$mostrarf['cantidad']; 
          } //echo $acomulador;
          $acomulador2=0;
           $sqlfinal= "SELECT cantidad, idEquipo FROM goles WHERE idPartido='".$Partido."' and idEquipo!='".$mostrar['idEquipo']."'";
           $rsfinal=mysqli_query($conn,$sqlfinal);
           while($mostrarf=mysqli_fetch_array($rsfinal)){
               
           $acomulador2+=$mostrarf['cantidad']; 
          } //echo $acomulador2;
          if($acomulador>$acomulador2)
          {
             $contadorganados++;
          }
          if($acomulador<$acomulador2)
          {
              $contadorperdidos++;
          }
          if($acomulador==$acomulador2)
          {
              $contadorempatados++;
          }

        }
        echo $contadorganados;
       // echo $contadorempatados;
        //echo $contadorperdidos;
        ?></td>
        <td><?php
       $contadorganados=0;
       $contadorperdidos=0;
       $contadorempatados=0;
        $sqlG= "SELECT idPartido FROM goles WHERE idEquipo= ".$mostrar['idEquipo']; $rslG=mysqli_query($conn,$sqlG);
        
        while($mostrarG=mysqli_fetch_array($rslG)){
           $Partido=$mostrarG['idPartido'];
           $acomulador=0;
           $sqlfinal= "SELECT cantidad, idEquipo FROM goles WHERE idPartido=".$Partido;
           $rsfinal=mysqli_query($conn,$sqlfinal);
           while($mostrarf=mysqli_fetch_array($rsfinal)){
               if($mostrar['idEquipo']==$mostrarf['idEquipo'])
           $acomulador+=$mostrarf['cantidad']; 
          } //echo $acomulador;
          $acomulador2=0;
           $sqlfinal= "SELECT cantidad, idEquipo FROM goles WHERE idPartido='".$Partido."' and idEquipo!='".$mostrar['idEquipo']."'";
           $rsfinal=mysqli_query($conn,$sqlfinal);
           while($mostrarf=mysqli_fetch_array($rsfinal)){
               
           $acomulador2+=$mostrarf['cantidad']; 
          } //echo $acomulador2;
          if($acomulador>$acomulador2)
          {
             $contadorganados++;
          }
          if($acomulador<$acomulador2)
          {
              $contadorperdidos++;
          }
          if($acomulador==$acomulador2)
          {
              $contadorempatados++;
          }

        }
      //  echo $contadorganados;
        echo $contadorempatados;
       // echo $contadorperdidos;
        ?>

        </td>
        <td><?php
       $contadorganados=0;
       $contadorperdidos=0;
       $contadorempatados=0;
        $sqlG= "SELECT idPartido FROM goles WHERE idEquipo= ".$mostrar['idEquipo']; $rslG=mysqli_query($conn,$sqlG);
        
        while($mostrarG=mysqli_fetch_array($rslG)){
           $Partido=$mostrarG['idPartido'];
           $acomulador=0;
           $sqlfinal= "SELECT cantidad, idEquipo FROM goles WHERE idPartido=".$Partido;
           $rsfinal=mysqli_query($conn,$sqlfinal);
           while($mostrarf=mysqli_fetch_array($rsfinal)){
               if($mostrar['idEquipo']==$mostrarf['idEquipo'])
           $acomulador+=$mostrarf['cantidad']; 
          } //echo $acomulador;
          $acomulador2=0;
           $sqlfinal= "SELECT cantidad, idEquipo FROM goles WHERE idPartido='".$Partido."' and idEquipo!='".$mostrar['idEquipo']."'";
           $rsfinal=mysqli_query($conn,$sqlfinal);
           while($mostrarf=mysqli_fetch_array($rsfinal)){
               
           $acomulador2+=$mostrarf['cantidad']; 
          } //echo $acomulador2;
          if($acomulador>$acomulador2)
          {
             $contadorganados++;
          }
          if($acomulador<$acomulador2)
          {
              $contadorperdidos++;
          }
          if($acomulador==$acomulador2)
          {
              $contadorempatados++;
          }

        }
       // echo $contadorganados;
       // echo $contadorempatados;
        echo $contadorperdidos;
        ?></td>
        <td><?php echo $resultado=$contadorganados+$contadorempatados+$contadorperdidos ?> </td>
        <td><?php echo $pts=$contadorganados*3+$contadorempatados*1 ?></td>
        
        
    </tr>
    <?php 
    }//while
    ?>
</table>
</div>
</div>
<script>
/**
 * Funcion para ordenar una tabla... tiene que recibir el numero de columna a
 * ordenar y el tipo de orden
 * @param int n
 * @param str type - ['str'|'int']
 */
function sortTable(n,type) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
 
  table = document.getElementById("myTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc";
 
  /*Make a loop that will continue until no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare, one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place, based on the direction, asc or desc:*/
      if (dir == "asc") {
        if ((type=="str" && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) || (type=="int" && parseFloat(x.innerHTML) > parseFloat(y.innerHTML))) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if ((type=="str" && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) || (type=="int" && parseFloat(x.innerHTML) < parseFloat(y.innerHTML))) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /*If no switching has been done AND the direction is "asc", set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
<div class="tituloPagina"><h2>goleadores</h2></div>
<div class="conTabla">
          <div id="main-container">

<table id="myTable">
<table>
    <thead>
        <tr>
        <th>Jugador</th>
        <th>Equipo</th>
        <th>Cantidad De Goles</th>
   
            
        </tr>
        </thead>
        <?php 
        $sql= "SELECT * FROM goles";
        $rs=mysqli_query($conn,$sql);
        while($mostrar=mysqli_fetch_array($rs)){
           
        ?>
    <tr>
    <td><?php $sql4= "SELECT idJugador, nombreJugador, apellidoPaternoJ, imagenJugador FROM jugadores WHERE idJugador= ".$mostrar['idJugador']; $rs4=mysqli_query($conn,$sql4); 
         while($mostrar4=mysqli_fetch_array($rs4)){
            echo "<img width='70px' height='40px' src='imagenJugador.php?idJ=".$mostrar4["idJugador"]."'>"."&nbsp;". $mostrar4['nombreJugador']. "&nbsp;". $mostrar4['apellidoPaternoJ'];
         }
        ?></td>
       
        <td><?php $sql3= "SELECT nombreEquipo, imagenEquipo, idEquipo FROM equipos WHERE idEquipo= ".$mostrar['idEquipo']; $rs3=mysqli_query($conn,$sql3); 
         while($mostrar3=mysqli_fetch_array($rs3)){
            echo "<img width='70px' height='40px' src='imagenEquipo.php?idE=".$mostrar3["idEquipo"]."'>"."&nbsp;".$mostrar3['nombreEquipo'];
         }
        ?></td>
        
        <td><?php echo $mostrar['cantidad'] ?></td>

        


        
        
    </tr>
    <?php 
    
    }//while
    ?>
</table>
          
</table>
</div>
</div>