<?php
session_start();
require("funciones.php");
if(!isset($_SESSION['idUsuario']))header("location:http://localhost/ProyectoFinal/calendario.php");
    $conn = ConectarBD();
    if(isset($_GET['idP']) && $_GET['idP']!= "")
    {
      //  $qry = "SELECT * FROM amonestaciones WHERE idAmonestacion = ". $_GET['idA'];
      //  $rs = mysqli_query($conn, $qry);
      //  $datos1 = mysqli_fetch_array($rs);
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
    .contenedor{
    height:600px;
    display:flex;
    flex-flow:row wrap;
    align-content:stretch;
    
    margin: auto;
    background: url("infoPartido.jpg") no-repeat center center fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
   
    
    
}
.elemento{
    width:49.60%;
    
    height: 50%;
}
#main-container{
    margin: auto;
    width: 400px;
    
}

table{
	background-color: white;
	text-align: left;
	border-collapse: collapse;
	width: 100%;
}

th, td{
	padding: 10px;
    text-align: center;
    font-family: Arial, Helvetica, sans-serif;
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
    
}
body{
    background-color: black;
}


    </style>
</head>
<body>
    <div class="contenedor">
    <div class="elemento">
    <div class="tituloPagina"><h2>Resultado</h2></div>
    <div class="conTabla">
          <div id="main-container">
<?php 

?>
<table>
    <thead>
        <tr>
            
            <th><?php $sql= "SELECT idEquipo1 FROM partidos WHERE idPartido=".$_GET['idP'];
         $rs=mysqli_query($conn,$sql);
         while($mostrar=mysqli_fetch_array($rs)){ 
            $sqle= "SELECT nombreEquipo FROM equipos WHERE idEquipo= ".$mostrar['idEquipo1']; $rse=mysqli_query($conn,$sqle); 
            $equipo1=$mostrar['idEquipo1'];
            while($mostrare=mysqli_fetch_array($rse)){
               echo  "<img width='70px' height='50px' src='imagenEquipo.php?idE=".$equipo1."'>"."&nbsp; ".  $mostrare['nombreEquipo'];
            }
         }?></th>
            <th>vs</th>
            <th><?php $sql= "SELECT idEquipo2 FROM partidos WHERE idPartido=".$_GET['idP'];
         $rs=mysqli_query($conn,$sql);
         while($mostrar=mysqli_fetch_array($rs)){ 
            $sqle= "SELECT nombreEquipo FROM equipos WHERE idEquipo= ".$mostrar['idEquipo2']; $rse=mysqli_query($conn,$sqle); 
            $equipo2=$mostrar['idEquipo2'];
            while($mostrare=mysqli_fetch_array($rse)){
               echo $mostrare['nombreEquipo'] ."&nbsp; " ."<img width='70px' height='50px' src='imagenEquipo.php?idE=".$equipo2."'>" ;
            }
         }?></th>
        </tr>
        </thead>
     <tr>
          
         <td><?php $acomulador=0;
         $sqlfinal= "SELECT cantidad, idEquipo FROM goles WHERE idPartido=".$_GET['idP'];
         $rsfinal=mysqli_query($conn,$sqlfinal);
         while($mostrarf=mysqli_fetch_array($rsfinal)){
             if($equipo1==$mostrarf['idEquipo'])
         $acomulador+=$mostrarf['cantidad']; 
        } echo $acomulador ?>
         </td>
         <td>-</td>
         <td><?php $acomulador=0;
         $sqlfinal= "SELECT cantidad, idEquipo FROM goles WHERE idPartido=".$_GET['idP'];
         $rsfinal=mysqli_query($conn,$sqlfinal);
         while($mostrarf=mysqli_fetch_array($rsfinal)){
             if($equipo2==$mostrarf['idEquipo'])
         $acomulador+=$mostrarf['cantidad']; 
        } echo $acomulador ?></td>
        
        
    </tr>
    <?php 
    //}//while
    ?>
    </table>
    </div>
    </div>
    </div>
    <div class="elemento">
    <div class="tituloPagina"><h2>Anotaciones</h2></div>
    <div class="conTabla">
          <div id="main-container">

<table>
    <thead>
        <tr>
            
            <th>Equipo</th>
            <th>Jugador</th>
            <th>Goles</th>
        </tr>
        </thead>
        <?php 
         $sql= "SELECT * FROM goles WHERE idPartido=".$_GET['idP'];
         $rs=mysqli_query($conn,$sql);
         while($mostrar=mysqli_fetch_array($rs)){
         ?>
     <tr>
          
         <td><?php $sql3= "SELECT nombreEquipo FROM equipos WHERE idEquipo= ".$mostrar['idEquipo']; $rs3=mysqli_query($conn,$sql3); 
          while($mostrar3=mysqli_fetch_array($rs3)){
             echo $mostrar3['nombreEquipo'];
          }
         ?></td>
         <td><?php $sql4= "SELECT nombreJugador, apellidoPaternoJ FROM jugadores WHERE idJugador= ".$mostrar['idJugador']; $rs4=mysqli_query($conn,$sql4); 
          while($mostrar4=mysqli_fetch_array($rs4)){
             echo $mostrar4['nombreJugador']. "&nbsp;". $mostrar4['apellidoPaternoJ'];;
          }
         ?></td>
         <td><?php echo $mostrar['cantidad'] ?></td>
        
        
    </tr>
    <?php 
    }//while
    ?>
    </table>
    </div>
    </div>
    </div>
    <div class="elemento">
    <div class="tituloPagina"><h2>Faltas</h2></div>
    <div class="conTabla">
          <div id="main-container">

<table>
    <thead>
        <tr>
            
            <th>Equipo</th>
            <th>Jugador</th>
            <th>Tipo</th>
        </tr>
        </thead>
        <?php 
         $sql= "SELECT * FROM amonestaciones WHERE idPartido=".$_GET['idP'];
         $rs=mysqli_query($conn,$sql);
         while($mostrar=mysqli_fetch_array($rs)){
         ?>
     <tr>
          
         <td><?php $sql3= "SELECT nombreEquipo FROM equipos WHERE idEquipo= ".$mostrar['idEquipo']; $rs3=mysqli_query($conn,$sql3); 
          while($mostrar3=mysqli_fetch_array($rs3)){
             echo $mostrar3['nombreEquipo'];
          }
         ?></td>
         <td><?php $sql4= "SELECT nombreJugador, apellidoPaternoJ FROM jugadores WHERE idJugador= ".$mostrar['idJugador']; $rs4=mysqli_query($conn,$sql4); 
          while($mostrar4=mysqli_fetch_array($rs4)){
             echo $mostrar4['nombreJugador']. "&nbsp;". $mostrar4['apellidoPaternoJ'];
          }
         ?></td>
         <td><?php echo $mostrar['tipo'] ?></td>
        
        
    </tr>
    <?php 
    }//while
    ?>
    </table>
    </div>
    </div>

    </div>
    <div class="elemento">
    <div class="tituloPagina"><h2>Cambios</h2></div>
    <div class="conTabla">
          <div id="main-container">

<table>
    <thead>
        <tr>
            
            <th>Equipo</th>
            <th>Jugador Entra</th>
            <th>Jugador Sale</th>
        </tr>
        </thead>
        <?php 
         $sql= "SELECT * FROM cambios WHERE idPartido=".$_GET['idP'];
         $rs=mysqli_query($conn,$sql);
         while($mostrar=mysqli_fetch_array($rs)){
         ?>
     <tr>
          
         <td><?php $sql3= "SELECT nombreEquipo FROM equipos WHERE idEquipo= ".$mostrar['idEquipo']; $rs3=mysqli_query($conn,$sql3); 
          while($mostrar3=mysqli_fetch_array($rs3)){
             echo $mostrar3['nombreEquipo'];
          }
         ?></td>
         <td><?php $sql4= "SELECT nombreJugador, apellidoPaternoJ FROM jugadores WHERE idJugador= ".$mostrar['idJugadorEntra']; $rs4=mysqli_query($conn,$sql4); 
          while($mostrar4=mysqli_fetch_array($rs4)){
             echo $mostrar4['nombreJugador']. "&nbsp;". $mostrar4['apellidoPaternoJ'];
          }
         ?></td>
          <td><?php $sql5= "SELECT nombreJugador FROM jugadores WHERE idJugador= ".$mostrar['idJugadorSale']; $rs5=mysqli_query($conn,$sql5); 
          while($mostrar5=mysqli_fetch_array($rs5)){
             echo $mostrar5['nombreJugador'];
          }
         ?></td>
        
    </tr>
    <?php 
    }//while
    ?>
    </table>
    </div>
    </div>
    </div>
    </div>
    <div class="tituloPagina"><h2><a href="calendario.php" >REGRESAR</a></h2></div>
</body>
</html>