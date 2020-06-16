<?php
session_start();
require("funciones.php");
if(!isset($_SESSION['idUsuario']))header("location:http://localhost/Sistema/portada.php");

$conn = ConectarBD();
if(isset($_GET['partido']) && $_GET['partido']!="" || isset($_GET['equipo']) && $_GET['equipo']!=""
|| isset($_GET['jugador']) && $_GET['jugador']!="")   // validar el envio del formulario.
{      
            
                //tomar el archivo de la carpeta temporales y entonces guardarlo en la BD. 
               
            $partido=$_GET['partido'];
            $equipo=$_GET['equipo'];
            $jugador=$_GET['jugador'];
            $falta=$_GET['falta'];
                
    
            //recuperar el contenido del archivo(imagen)
            
    
           
            $qry = "UPDATE amonestaciones SET idPartido='". $partido . "', idEquipo='". $equipo . "',
            idJugador='". $jugador . "', tipo='". $falta . "' WHERE idAmonestacion=". $_GET['idA'];
            $rs = mysqli_query($conn, $qry);
            header("location:http://localhost/ProyectoFinal/admiAmonestaciones.php");
    
}
if(isset($_GET['idA']) && $_GET['idA']!= "")
{
    $qry = "SELECT * FROM amonestaciones WHERE idAmonestacion = ". $_GET['idA'];
    $rs = mysqli_query($conn, $qry);
    $datos1 = mysqli_fetch_array($rs);
}
?>

<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Untitled 1</title>
<link href="baseAdmi.css" rel="stylesheet" type="text/css" />
    <link href="great.css" rel="stylesheet" type="text/css"  media="screen and (min-width: 981px)" />
    <link href="medium.css" rel="stylesheet" type="text/css" media="screen and (min-width: 481px) and (max-width: 980px)" />
    <link href="mini.css" rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" />
    <style type="text/css">
    .partido{
    margin-left: 20px;
    width: 430px;
    height: 60px;
    font-size: 30px;
    }
    .jugador{
    margin-left: 20px;
    width: 430px;
    height: 60px;
    font-size: 30px;
    }
    #goles{
        margin-left: 20px;
    width: 430px;
    height: 60px;
    font-size: 30px;
}
.tituloFormulario
{
    margin-top: 20px;
    width: 95%;
	margin: auto;
    overflow: hidden;
    height: 40px;
    border-bottom: 2px solid black;
    text-align: center;
    font-size: 30px;
}
.imagenPartido{
    margin-left: 20px;
    width: 430px;
    height: 60px;
    font-size: 20px;
    color: white;
}
.regreso{
    width: 95%;
	margin: auto;
    overflow: hidden;
    height: 40px;
    border-top: 2px solid black;
    text-align: center;
    font-size: 30px;
}
	/* Contenedor del login */

#login {
   background-color: black;
   border-radius: 8px;
   box-shadow: 3px 3px 10px 0px rgba(50, 50, 50, 0.75);
   -moz-box-shadow: 3px 3px 10px 0px rgba(50, 50, 50, 0.75);
   -webkit-box-shadow: 3px 3px 10px 0px rgba(50, 50, 50, 0.75);
   margin-left: auto;
   margin-right: auto;
   margin-top: 5%;
   max-width: 40em;
   padding-bottom: 10px;
   padding-top: 10px;
   margin-bottom: 3%;
   
}


/* Etiquetas del formulario */

label {
   color: white;
   display: block;
   margin-bottom: 20px;
   margin-left: 1.2em;
   font-size: 20px;
}
.equipo{
    margin-left: 20px;
    width: 430px;
    height: 60px;
    font-size: 30px;
    text-align: center;
}
.equipo1{
    margin-left: 20px;
    width: 430px;
    height: 60px;
    font-size: 30px;
    text-align: center;
}
input[type=number], input [type=file]
{
    margin-left: 20px;
    width: 430px;
    height: 60px;
    font-size: 30px;
    text-align: center;
}
.imagenJugador{
    margin-left: 20px;
    width: 430px;
    height: 60px;
    font-size: 30px;
    text-align: center;
}

/* Campos del formulario */

input[type="text"],
input[type="password"] {
   border: none;
   display: block;
   font-size: 2em;
   height: 2em;
   text-align: center;
   width: 90%;
   margin-left: auto;
   margin-right: auto;
}

/* Botón */

input[type="submit"] {
   background-color: #a6a0f8;
   border: none;
   border-radius: 6px;
   color: black;
   display: block;
   font-size: 2em;
   height: 2em;
   margin-left: auto;
   margin-right: auto;
   margin-top: -10px;
   text-align: center;
   width: 430px;
}

input[type="submit"]:hover {
   cursor: pointer;
   background-color: gray;
   opacity: 1;
   color: white;
}
input[type="reset"] {
   background-color: #a6a0f8;
   border: none;
   border-radius: 6px;
   color: black;
   display: block;
   font-size: 2em;
   height: 2em;
   margin-left: auto;
   margin-right: auto;
   margin-top: -10px;
   text-align: center;
   width: 430px;
}

input[type="reset"]:hover {
   cursor: pointer;
   background-color: gray;
   opacity: 1;
   color: white;
}
	</style>
<script type="text/javascript">

function verificaFRM()
{
    if(document.getElementById("partido").value =="" || document.getElementById("equipo").value =="" ||
    document.getElementById("jugador").value =="" || document.getElementById("falta").value =="" )
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
<?php 
    $sql="SELECT idJugador, nombreJugador FROM jugadores";
    $rs=mysqli_query($conn,$sql);
?>
<div class="tituloFormulario">Formulario Partidos
 </div>

<div id="login">
<form method="GET" action="modificaRegistroAmonestacion.php" onsubmit="return verificaFRM()">
<input type="hidden" name="idA" value="<?php echo $_GET['idA']?>">
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
    <label>Jugador:</label>
         <select class="jugador" name="jugador" id="jugador">
    <?php 
     
        while($datos=mysqli_fetch_array($rs))
        {

        $aux=$datos["nombreJugador"];
     ?>
        
        <option value="<?php echo $datos['idJugador'] ?>"><?php echo $aux ?></option>
            <?php 
        }
            ?>
    </select>
    <label>Tipo de falta: </label>    
    <input type="text" name="falta" id="falta"><br><br><br>
    

         <input type="submit" value="Modificar Amonestado"/><br><br>
			<input type="reset" value="Cancelar">
			
			
         </form>
         </div>
<div class="regreso"><a href="admiAmonestaciones.php">Regresar</a></div>
        
</body>

</html>
