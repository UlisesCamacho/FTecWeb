<?php 
session_start();
if(!isset($_SESSION['idUsuario']) || $_SESSION['Rol']!='Administrador') header("location:http://localhost/ProyectoFinal/CanCerberoPortada.php");

    include ("funciones.php");
    $msg="";
    $conn=ConectarBD();
    //
    if(isset($_POST['equipo']) && $_POST['equipo']!="" || isset($_POST['equipo1']) && $_POST['equipo1']!=""
    || isset($_POST['fecha']) && $_POST['fecha']!="")   // validar el envio del formulario.
    {
        if($_POST['equipo']!=$_POST['equipo1'])
        {
            
                
                    //tomar el archivo de la carpeta temporales y entonces guardarlo en la BD.
                $nombre=$_FILES['imagenPartido']['name'];
                $tipo=$_FILES['imagenPartido']['type'];
                $nombreTemporal=$_FILES['imagenPartido']['tmp_name'];
                $tamanio=$_FILES['imagenPartido']['size'];
                
                $equipo=$_POST['equipo'];
                $equipo1=$_POST['equipo1'];
                $fecha=$_POST['fecha'];
                $liga=$_POST['liga'];
                $idImagen=1;
    
                
                //recuperar el contenido del archivo(imagen)
                $fp=fopen($nombreTemporal,"r");
                $contenido=fread($fp,$tamanio);
                fclose($fp);
        
                $contenido=addslashes($contenido);
        
                $qry="INSERT INTO partidos (idEquipo1, idEquipo2, fecha, idliga)
                        VALUES ('$equipo','$equipo1','$fecha','$liga')";
                            if(mysqli_query($conn,$qry))
                            {
                               
                                header("location:http://localhost/ProyectoFinal/admiPartido.php");
                            }
                            else{
                                
                                    $msg="error".mysqli_errno($conn). "Nombre de Equipo ya existe";
                                
                            }
                    
            
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
.equipo1{
    margin-left: 13px;
    font-size: 20px;
    width: 260px;
}
.liga{
    margin-left: 13px;
    width: 260px;
}
#fecha{
    margin-left: 13px;
    width: 260px;
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
    if(document.getElementById("equipo").value =="" || document.getElementById("equipo1").value =="" ||
    document.getElementById("fecha").value =="" || document.getElementById("liga").value =="" )
    {
        alert("Todos los datos son obligatorios");
        return false;
    }
    else if(document.getElementById("equipo").value==document.getElementById("equipo1").value){
        alert("no pueden ser iguales equipo1 y equipo 2");
        return false;
    } 
    else if(document.getElementById("equipo").value =="") return false;
   
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
    $sql="SELECT idEquipo, nombreEquipo FROM equipos";
    $rs=mysqli_query($conn,$sql);
?>

<div class="tituloPagina"><h2>Partidos</h2></div>
<div class="contGrande">
<div id="ligas">
         <form action= "admiPartido.php" method="POST" enctype="multipart/form-data" onsubmit="verificaFRM()">
         <label>Liga:</label>
         <select class="liga" name="liga" id="liga">
    <?php 
        $sql="SELECT idLiga, nombreLiga FROM ligas";
        $rsligas=mysqli_query($conn,$sql);
        while($datosligas=mysqli_fetch_array($rsligas))
        {

        $aux=$datosligas["nombreLiga"];
     ?>
        
        <option value="<?php echo $datosligas['idLiga'] ?>"><?php echo $aux ?></option>
            <?php 
        }
            ?>
    </select>
    <br>
    <br>
         <label>Equipo 1:</label>
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
    <label>Equipo 2:</label>
         <select class="equipo1" name="equipo1" id="equipo1">
    <?php 
        while($datos=mysqli_fetch_array($rs))
        {

        $aux=$datos["nombreEquipo"];
     ?>
        
        <option value="<?php echo $datos['idEquipo'] ?>"><?php echo $aux ?></option>
            <?php 
        }
            ?>
    </select>
    <label>fecha: </label>
    <input type="date" name="fecha" id="fecha"><br><br><br>
    

         <input type="submit" value="Insertar Partido"/><br><br>
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
            <th>Nombre Equipo1</th>
            <th>Nombre Equipo2</th>
        <th>fecha</th>
        <th>Nombre Liga</th>
        <th>Modificar</th>
        <th>Eliminar</th>
            
        </tr>
        </thead>
        <?php 
        $sql= "SELECT * FROM partidos";
        $rs=mysqli_query($conn,$sql);
        while($mostrar=mysqli_fetch_array($rs)){
        ?>
    <tr>
         <td><?php echo $mostrar['idPartido'] ?></td>
        <td><?php $sql3= "SELECT nombreEquipo FROM equipos WHERE idEquipo= ".$mostrar['idEquipo1']; $rs3=mysqli_query($conn,$sql3); 
         while($mostrar3=mysqli_fetch_array($rs3)){
            echo $mostrar3['nombreEquipo'];
         }
        ?></td>
        <td><?php $sql4= "SELECT nombreEquipo FROM equipos WHERE idEquipo= ".$mostrar['idEquipo2']; $rs4=mysqli_query($conn,$sql4); 
         while($mostrar4=mysqli_fetch_array($rs4)){
            echo $mostrar4['nombreEquipo'];
         }
        ?></td>
        <td><?php echo $mostrar['fecha'] ?></td>
        <td><?php $sql2= "SELECT nombreLiga FROM ligas WHERE idLiga= ".$mostrar['idLiga']; $rs2=mysqli_query($conn,$sql2); 
         while($mostrar2=mysqli_fetch_array($rs2)){
            echo $mostrar2['nombreLiga'];
         }
        ?></td>
        


        <td><?php  echo "<a href='modificaRegistroPartido.php?idP=".$mostrar['idPartido']."'> <button type='button' class='btn btn-success'>Modificar</button></a>" ?></td>
        <td><?php  echo "<a href='eliminaRegistroPartido.php?idP=".$mostrar['idPartido']."'> <button type='button' class='btn btn-success'>Eliminar</button></a>" ?></td>
        
    </tr>
    <?php 
    }//while
    ?>
</table>
</div>
</div>
      
</div>
   
</form>