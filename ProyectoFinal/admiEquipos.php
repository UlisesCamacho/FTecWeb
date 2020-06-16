<?php 
session_start();
if(!isset($_SESSION['idUsuario']) || $_SESSION['Rol']!='Administrador') header("location:http://localhost/ProyectoFinal/CanCerberoPortada.php");

    include ("funciones.php");
    $msg="";
    $conn=ConectarBD();
    //
    if(isset($_POST['txtNombreEquipo']) && $_POST['txtNombreEquipo']!="" )
    {
        
        if(!empty($_FILES['imagenEquipo']['tmp_name'])) //validar que el archivo se cargó del lado del servidor
        {
            
                //tomar el archivo de la carpeta temporales y entonces guardarlo en la BD.
            $nombre=$_FILES['imagenEquipo']['name'];
            $tipo=$_FILES['imagenEquipo']['type'];
            $nombreTemporal=$_FILES['imagenEquipo']['tmp_name'];
            $tamanio=$_FILES['imagenEquipo']['size'];
                
                    $nombreEquipo=$_POST['txtNombreEquipo'];
                    $liga=$_POST['liga'];
                    
                    //recuperar el contenido del archivo(imagen)
            $fp=fopen($nombreTemporal,"r");
            $contenido=fread($fp,$tamanio);
            fclose($fp);
    
            $contenido=addslashes($contenido);
    

                    echo $liga;
                    
                    $qry= "INSERT INTO equipos (nombreEquipo, idLiga, imagenEquipo, Tipo)
                        values ('$nombreEquipo', '$liga','$contenido','$tipo')";

                    if(mysqli_query($conn,$qry))
                    header("location:http://localhost/ProyectoFinal/admiEquipos.php");
                    else
                    {
                    $msg="No se ha podido insertar la imagen en la BD . el error es:" . mysqli_error($conn);
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
.liga{
    margin-left: 13px;
}
.alerta{
	background-color: blue;
	color: red;
	text-transform: uppercase;
}
.imagenEquipo{
    margin-left: 13px;
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
   max-width: 22em;
   width: 320px;
   padding-bottom: 10px;
   padding-top: 10px;
   height: 280px;
   
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
   width: 240px;
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
   width: 240px;
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
	margin-left: 30px;
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
    if(document.getElementById("txtNombreEquipo").value =="")
    {
        alert("El nombre es obligatorio");
        return false;
    } 
    if(document.getElementById("txtNombreEquipo").value =="") return false;
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
    $sql="SELECT idLiga, nombreLiga FROM ligas";
    $rs=mysqli_query($conn,$sql);
?>

<div class="tituloPagina"><h2>Equipos</h2></div>
<div class="contGrande">
<div id="ligas">
         <form action= "admiEquipos.php" method="POST" enctype="multipart/form-data" onsubmit="verificaFRM()">
         <label>Liga:</label>
         <select class="liga" name="liga" id="liga">
    <?php 
        while($datos=mysqli_fetch_array($rs))
        {

        $aux=$datos["nombreLiga"];
     ?>
        
        <option value="<?php echo $datos['idLiga'] ?>"><?php echo $aux ?></option>
            <?php 
        }
            ?>
    </select>
    <br>
    <br>
            <label>Nombre De Equipo: </label>
            <input type="text" name="txtNombreEquipo" id="txtNombreEquipo"/><br><br>
            <label>Imagen Equipo: </label> 
            <input class="imagenEquipo" type="file" name="imagenEquipo"><br><br><br>
         <input type="submit" value="Insertar Equipo"/><br><br>
			<input type="reset" value="Cancelar">
			
			
         </form>
         <?php if($msg!="") echo "<p class='alerta'>$msg</p>" ?>
      </div>
      <div class="conTabla">
          <div id="main-container">

<table>
    <thead>
        <tr>
            <th>id Equipo</th>
            <th>Nombre Equipo</th>
            <th>Nombre Liga</th>
            <th>Modificar</th>
            <th>Eliminar</th>
            
        </tr>
        </thead>
        <?php 
        $sql= "SELECT * FROM equipos";
        $rs=mysqli_query($conn,$sql);
        while($mostrar=mysqli_fetch_array($rs)){
        ?>
    <tr>
        <td><?php echo $mostrar['idEquipo'] ?></td>
        <td><?php echo $mostrar['nombreEquipo'] ?></td>
        <td><?php $sql2= "SELECT nombreLiga FROM ligas WHERE idLiga= ".$mostrar['idLiga']; $rs2=mysqli_query($conn,$sql2); 
         while($mostrar2=mysqli_fetch_array($rs2)){
            echo $mostrar2['nombreLiga'];
         }
        ?></td>
        <td><?php  echo "<a href='modificaRegistroEquipo.php?idE=".$mostrar['idEquipo']."'> <button type='button' class='btn btn-success'>Modificar</button></a>" ?></td>
        <td><?php  echo "<a href='eliminaRegistroEquipo.php?idE=".$mostrar['idEquipo']."'> <button type='button' class='btn btn-success'>Eliminar</button></a>" ?></td>
        
    </tr>
    <?php 
    }//while
    ?>
    </table>
    </div>
    </div>
      
</div>
   
