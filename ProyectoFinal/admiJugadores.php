<?php 
session_start();
if(!isset($_SESSION['idUsuario']) || $_SESSION['Rol']!='Administrador') header("location:http://localhost/ProyectoFinal/CanCerberoPortada.php");

    include ("funciones.php");
    $msg="";
    $conn=ConectarBD();
    //
    if(isset($_POST['txtNombreJugador']) && $_POST['txtNombreJugador']!="" || isset($_POST['txtAPaterno']) && $_POST['txtAPaterno']!=""
    || isset($_POST['txtAMaterno']) && $_POST['txtAMaterno']!="")   // validar el envio del formulario.
    {
        if(!empty($_FILES['imagenJugador']['tmp_name'])) //validar que el archivo se cargó del lado del servidor
        {
            
                //tomar el archivo de la carpeta temporales y entonces guardarlo en la BD.
            $nombre=$_FILES['imagenJugador']['name'];
            $tipo=$_FILES['imagenJugador']['type'];
            $nombreTemporal=$_FILES['imagenJugador']['tmp_name'];
            $tamanio=$_FILES['imagenJugador']['size'];
            
            $equipo=$_POST['equipo'];
            $nombreJ=$_POST['txtNombreJugador'];
            $aPaterno=$_POST['txtAPaterno'];
            $aMaterno=$_POST['txtAMaterno'];
            $posicion=$_POST['txtPosicion'];
            $numJugador=$_POST['numN'];
    
            //recuperar el contenido del archivo(imagen)
            $fp=fopen($nombreTemporal,"r");
            $contenido=fread($fp,$tamanio);
            fclose($fp);
    
            $contenido=addslashes($contenido);
    
            $qry="INSERT INTO jugadores (idEquipo, nombreJugador, apellidoPaternoJ, apellidoMaternoM, posicion, numero, imagenJugador, Tipo)
                    VALUES ('$equipo','$nombreJ','$aPaterno','$aMaterno','$posicion','$numJugador','$contenido', '$tipo')";
                        if(mysqli_query($conn,$qry))
                        {
                           
                            header("location:http://localhost/ProyectoFinal/admiJugadores.php");
                        }
                        else{
                            if(mysqli_errno($conn)=="1062")
                            {
                                $msg="error".$nombreEquipo. "Nombre de Equipo ya existe";
                            }
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
}
.equipoFiltro{
    margin-left: 13px;
}
input[type=number], input [type=file]
{
    margin-left: 13px;
}
.imagenJugador{
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
   max-width: 30em;
   width: 300px;
   padding-bottom: 10px;
   padding-top: 10px;
   height: 600px;
   
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
	margin-left: -40PX;

	width: 600px;
    
    
}

table{
	background-color: white;
	text-align: left;
	border-collapse: collapse;
	width: 100%;
}

th, td{
	padding: 15px;
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
    if(document.getElementById("txtNombreJugador").value =="" || document.getElementById("txtAPaterno").value =="" ||
    document.getElementById("txtAMaterno").value =="" || document.getElementById("txtPosicion").value =="" ||  document.getElementById("numN").value =="" )
    {
        alert("Todos los datos son obligatorios");
        return false;
    } 
    if(document.getElementById("txtNombreJugador").value =="") return false;
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

<div class="tituloPagina"><h2>Jugadores</h2></div>

<div class="contGrande">
<div id="ligas">
         <form action= "admiJugadores.php" method="POST" enctype="multipart/form-data" onsubmit="verificaFRM()">
         <label>Equipo:</label>
         <select class="equipo" name="equipo" id="equipo">
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
    <br>
    <br>
    <label>Nombre Del Jugador: </label>
    <input type="text" name="txtNombreJugador" id="txtNombreJugador"><br>
    <label>apellido Paterno: </label>   
    <input type="text" name="txtAPaterno" id="txtAPaterno"><br>
    <label>apellido Materno: </label>  
    <input type="text" name="txtAMaterno" id="txtAMaterno"><br>
    <label>posicion: </label> 
    <input type="text" name="txtPosicion" id="txtPosicion"><br>
    <label>numero: </label>    
    <input type="number" name="numN" id="numN" min="0" max="200"><br><br>
    <label>imagen: </label> 
    <input class="imagenJugador" type="file" name="imagenJugador"><br><br><br>
         <input type="submit" value="Insertar Jugador"/><br><br>
			<input type="reset" value="Cancelar">
			
			
         </form>
        
         <br>
         <form method="POST" action="admiJugadores.php"> 
<label id="lfiltro"> Buscar por equipo</label>
<select class="equipoFiltro" name="equipoFiltro" id="equipoFiltro">
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
    <br>
    <br>
    <input type="submit" value="filtrar"/>
</form>
         <?php if($msg!="") echo "<p class='alerta'>$msg</p>" ?>
      </div>
      <div class="conTabla">
          <div id="main-container">

<table>
    <thead>
        <tr>
        <th>id Jugador</th>
            <th>Nombre Equipo</th>
            <th>Nombre Jugador</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Posicion</th>
        <th>Numero</th>
        <th>Modificar</th>
        <th>Eliminar</th>
            
        </tr>
        </thead>
        <?php 
        if(isset($_POST['equipoFiltro']))
        {
            $parafiltro=$_POST['equipoFiltro'];
            $sql= "SELECT * FROM jugadores where idEquipo=$parafiltro";
        }
        else {
            $sql= "SELECT * FROM jugadores";
        }
        
        $rs=mysqli_query($conn,$sql);
        while($mostrar=mysqli_fetch_array($rs)){
        ?>
    <tr>
         <td><?php echo $mostrar['idJugador'] ?></td>
        <td><?php $sql2= "SELECT nombreEquipo FROM equipos WHERE idEquipo= ".$mostrar['idEquipo']; $rs2=mysqli_query($conn,$sql2); 
         while($mostrar2=mysqli_fetch_array($rs2)){
            echo $mostrar2['nombreEquipo'];
         }
        ?></td>
        <td><?php echo $mostrar['nombreJugador'] ?></td>
        <td><?php echo $mostrar['apellidoPaternoJ'] ?></td>
        <td><?php echo $mostrar['apellidoMaternoM'] ?></td>
        <td><?php echo $mostrar['posicion'] ?></td>
        <td><?php echo $mostrar['numero'] ?></td>
        


        <td><?php  echo "<a href='modificaRegistroJugador.php?idJ=".$mostrar['idJugador']."'> <button type='button' class='btn btn-success'>Modificar</button></a>" ?></td>
        <td><?php  echo "<a href='eliminaRegistroJugador.php?idJ=".$mostrar['idJugador']."'> <button type='button' class='btn btn-success'>Eliminar</button></a>" ?></td>
        
    </tr>
    <?php 
    }//while
    ?>
</table>
</div>
</div>
      
</div>
   
</form>