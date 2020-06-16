<?php 
session_start();
if(!isset($_SESSION['idUsuario']) || $_SESSION['Rol']!='Administrador') header("location:http://localhost/ProyectoFinal/CanCerberoPortada.php");

    include ("funciones.php");
    $msg="";
    $conn=ConectarBD();
    //
    if(isset($_POST['partido']) && $_POST['partido']!="" || isset($_POST['equipo']) && $_POST['equipo']!=""
    || isset($_POST['jugador']) && $_POST['jugador']!="")   // validar el envio del formulario.
    {
        
            echo "entro";
                //tomar el archivo de la carpeta temporales y entonces guardarlo en la BD.
           
            
            $partido=$_POST['partido'];
            $equipo=$_POST['equipo'];
            $jugadorE=$_POST['jugador'];
            $jugadorS=$_POST['jugador1'];
            
            echo $partido;
            echo $equipo;
            echo $jugadorE;
            echo $jugadorS;

            
            //recuperar el contenido del archivo(imagen)
           
            $qry="INSERT INTO cambios (idPartido, idEquipo, idJugadorEntra, idJugadorSale)
                    VALUES ('$partido','$equipo','$jugadorE','$jugadorS')";
                        if(mysqli_query($conn,$qry))
                        {
                           
                            header("location:http://localhost/ProyectoFinal/admiCambios.php");
                        }
                        else{
                            
                                $msg="error".mysqli_errno($conn);
                            
                        }
                
        
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/83b0530ef8.js"></script>
    <title>Portada</title>
    <link href="baseAdmi.css" rel="stylesheet" type="text/css" />
    <link href="great.css" rel="stylesheet" type="text/css"  media="screen and (min-width: 981px)" />
    <link href="medium.css" rel="stylesheet" type="text/css" media="screen and (min-width: 481px) and (max-width: 980px)" />
    <link href="mini.css" rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" />
    <style type="text/css">
.equipo{
    margin-left: 13px;
    font-size: 20px;
    width: 260px;
  
}
.jugador{
    margin-left: 13px;
    font-size: 20px;
    width: 260px;
}
.jugador1{
    margin-left: 13px;
    font-size: 20px;
    width: 260px;
}
.partido{
    margin-left: 13px;
    width: 260px;
    font-size: 20px;
}
#goles{
    margin-left: 13px;
    width: 260px;
    font-size: 20px;
}
input[type=number], input [type=date]
{
    margin-left: 13px;
}
.imagenPartido{
    margin-left: 13px;
    color: white;
}
.alerta{
	background-color: blue;
	color: red;
	text-transform: uppercase;
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
	/* Contenedor del login */
.contGrande{
    
    display: flex;
    height: 240px;
}
.conTabla{
   border-bottom: 1px solid white;
}
#ligas {
   background-color: #060330;
   border-radius: 8px;
   box-shadow: 3px 3px 10px 0px rgba(50, 50, 50, 0.75);
   -moz-box-shadow: 3px 3px 10px 0px rgba(50, 50, 50, 0.75);
   -webkit-box-shadow: 3px 3px 10px 0px rgba(50, 50, 50, 0.75);
   margin-left: 40px;
   margin-right: 100px;
   margin-top: 2%;
   max-width: 25em;
   width: 300px;
   padding-bottom: 10px;
   padding-top: 10px;
   height: 320px;
   
}

/* Etiquetas del formulario */

label {
   color: white;
   display: block;
   margin-bottom: 6px;
   margin-left: 1.2em;
   font-family: Arial, Helvetica, sans-serif;
   
}

/* Campos del formulario */

input[type=text], input[type=password] {
   border: none;
   display: block;
   font-size: 1em;
   height: 2em;
   text-align:left;
   width: 90%;
   margin-left: auto;
   margin-right: auto;
}

/* BotÃ³n */

input[type=submit] {
   background-color: #a6a0f8;
   border: none;
   color: black;
   display: block;
   font-size: 1em;
   height: 2em;
   margin-left: auto;
   margin-right: auto;
   margin-top: -10px;
   text-align: center;
   width: 275px;
}

input[type=submit]:hover {
   cursor: pointer;
   background-color: #d2cffc;
   opacity: 1;
   color: white;
}
input[type=reset] {
   background-color: #a6a0f8;
   border: none;
   color: black;
   display: block;
   font-size: 1em;
   height: 2em;
   margin-left: auto;
   margin-right: auto;
   margin-top: -10px;
   text-align: center;
   width: 275px;
}

input[type=reset]:hover {
   cursor: pointer;
   background-color: #d2cffc;
   opacity: 1;
   color: white;
}
/*tabla*/
#main-container{
    margin-top: 2%;
	margin-left: 10px;
	width: 700px;
    
}

table{
	background-color: white;
	text-align: left;
	border-collapse: collapse;
	width: 100%;
}

th, td{
	padding: 10px;
}

thead{
	background-color: #060330;
	border-bottom: solid 5px #a6a0f8;
	color: white;
}

tr:nth-child(even){
	background-color: #ddd;
}

tr:hover td{
	background-color: #d2cffc;
	color: white;
}

    </style>
    <script type="text/javascript">
function verificaFRM()
{
    if(document.getElementById("partido").value =="" || document.getElementById("equipo").value =="" ||
    document.getElementById("jugador").value =="" || document.getElementById("jugador1").value =="" )
    {
        alert("Todos los datos son obligatorios");
        return false;
    } 
    if(document.getElementById("partido").value =="") return false;
    else
    return true;
}
</script>
</head>
<body>
    
    <div class="encabezado">
        <div class="logo">
            <div class="logoImagen">
                <a href="#"><img class="imagenLogo" src="logoCancerberoPaginaInvertido.jpg">
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
                    
               <div id="admiEnlace">
               <a href="CanCerberoPortada.php"><strong>[ Regresar ]  </strong></a>	
               
               <a href='salir.php'><strong>[ Salir ]</strong> </a>		
            
                </div>
              
           
          
        </div>
        
        
    </div>
    
    <div class="menuHeader">
        <div class="menu_bar">
            <a href="#" class="bt-menu"><i class="fas fa-bars"></i> Menu</a>
        </div>
        <nav>
            <ul>
               
               
                        <li><a href='admiLigas.php'>Ligas</a></li>
                        <li><a href='admiEquipos.php'>Equipos</a></li>
                        <li><a href='admiJugadores.php'>Jugadores</a></li> 
                        <li><a href='admiPartido.php'>Partido</a></li>
                        <li><a href='admiGoles.php'>Goles</a></li>
                        <li><a href='admiAmonestaciones.php'>Amonestaciones</a></li>
                        <li><a href='admiCambios.php'>Cambios</a></li>
                        
              
            </ul>
        </nav>

    </div>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="menu.js"></script>
    <?php 
    $sql="SELECT idJugador, nombreJugador, apellidoPaternoJ FROM jugadores";
    $rs=mysqli_query($conn,$sql);
?>

<div class="tituloPagina"><h2>Cambios</h2></div>
<div class="contGrande">
<div id="ligas">
         <form action= "admiCambios.php" method="POST"  onsubmit="verificaFRM()">
         <label>Partido:</label>
         <select class="partido" name="partido" id="partido">
    <?php 
        $sql="SELECT idPartido FROM partidos";
        $rsPartido=mysqli_query($conn,$sql);
        while($datosPartido=mysqli_fetch_array($rsPartido))
        {

        $aux=$datosPartido["idPartido"];
     ?>
        
        <option value="<?php echo $datosPartido['idPartido'] ?>"><?php echo $aux ?></option>
            <?php 
        }
            ?>
    </select>
    <br>
    <br>
         <label>Equipo :</label>
         <select class="equipo" name="equipo" id="equipo">
    <?php 
     $sql="SELECT idEquipo, nombreEquipo FROM equipos";
     $rs1=mysqli_query($conn,$sql);
        while($datos1=mysqli_fetch_array($rs1))
        {

        $aux1=$datos1["nombreEquipo"];
     ?>
        
        <option value="<?php echo $datos1['idEquipo'] ?>"><?php echo $aux1 ?></option>
            <?php 
        }
            ?>
    </select>
    <br>
    <br>
    <label>Jugador Entra:</label>
         <select class="jugador" name="jugador" id="jugador">
    <?php 
     
        while($datos=mysqli_fetch_array($rs))
        {

        $aux=$datos["nombreJugador"];
     ?>
        
        <option value="<?php echo $datos['idJugador'] ?>"><?php echo $aux . "&nbsp;". $datos['apellidoPaternoJ'] ?></option>
            <?php 
        }
            ?>
    </select>
    <br><br>
    <label>Jugador Sale:</label>
         <select class="jugador1" name="jugador1" id="jugador1">
    <?php 
    
        $sql10="SELECT idJugador, nombreJugador, apellidoPaternoJ FROM jugadores";
        $rs10=mysqli_query($conn,$sql10);
        while($datos10=mysqli_fetch_array($rs10))
        {

        $aux10=$datos10["nombreJugador"];
     ?>
        
        <option value="<?php echo $datos10['idJugador'] ?>"><?php echo $aux10 ."&nbsp;" . $datos10['apellidoPaternoJ'] ?></option>
            <?php 
        }
            ?>
    </select>
    <br>
    <br>
    <br>

         <input type="submit" value="Insertar Cambios"/><br><br>
			<input type="reset" value="Cancelar">
			
			
         </form>
         <?php if($msg!="") echo "<p class='alerta'>$msg</p>" ?>
      </div>
      <div class="conTabla">
          <div id="main-container">

<table>
    <thead>
        <tr>
        <th>id Partido</th>
        <th>Nombre Equipo</th>
            <th>Jugador Entra</th>
            <th>Jugador Sale</th>
        <th>Modificar</th>
        <th>Eliminar</th>
            
        </tr>
        </thead>
        <?php 
        $sql= "SELECT * FROM cambios";
        $rs=mysqli_query($conn,$sql);
        while($mostrar=mysqli_fetch_array($rs)){
        ?>
    <tr>
         <td><?php echo $mostrar['idPartido'] ?></td>
        <td><?php $sql3= "SELECT nombreEquipo FROM equipos WHERE idEquipo= ".$mostrar['idEquipo']; $rs3=mysqli_query($conn,$sql3); 
         while($mostrar3=mysqli_fetch_array($rs3)){
            echo $mostrar3['nombreEquipo'];
         }
        ?></td>
        <td><?php $sql4= "SELECT nombreJugador, apellidoPaternoJ FROM jugadores WHERE idJugador= ".$mostrar['idJugadorEntra']; $rs4=mysqli_query($conn,$sql4); 
         while($mostrar4=mysqli_fetch_array($rs4)){
            echo $mostrar4['nombreJugador'] . "&nbsp;". $mostrar4['apellidoPaternoJ'];
         }
        ?></td>
        <td><?php $sql5= "SELECT nombreJugador, apellidoPaternoJ FROM jugadores WHERE idJugador= ".$mostrar['idJugadorSale']; $rs5=mysqli_query($conn,$sql5); 
         while($mostrar5=mysqli_fetch_array($rs5)){
            echo $mostrar5['nombreJugador'] . "&nbsp;". $mostrar5['apellidoPaternoJ'];
         }
        ?></td>
        

        


        <td><?php  echo "<a href='modificaRegistroCambio.php?idP=".$mostrar['idPartido']."'> <button type='button' class='btn btn-success'>Modificar</button></a>" ?></td>
        <td><?php  echo "<a href='eliminaRegistroCambio.php?idP=".$mostrar['idPartido']."'> <button type='button' class='btn btn-success'>Eliminar</button></a>" ?></td>
        
    </tr>
    <?php 
    }//while
    ?>
</table>
</div>
</div>
      
</div>
   
</form>