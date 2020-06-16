<?php
session_start();
require("funciones.php");
if(!isset($_SESSION['idUsuario']))header("location:http://localhost/Sistema/portada.php");

$conn = ConectarBD();
if(isset($_GET['txtNombreJugador']) && $_GET['txtNombreJugador']!="" || isset($_GET['txtAPaterno']) && $_GET['txtAPaterno']!=""
    || isset($_GET['txtAMaterno']) && $_GET['txtAMaterno']!="")   // validar el envio del formulario.
    {
        
            
                //tomar el archivo de la carpeta temporales y entonces guardarlo en la BD. 
            $equipo=$_GET['equipo'];
            $nombreJ=$_GET['txtNombreJugador'];
            $aPaterno=$_GET['txtAPaterno'];
            $aMaterno=$_GET['txtAMaterno'];
            $posicion=$_GET['txtPosicion'];
            $numJugador=$_GET['numN'];
    
            //recuperar el contenido del archivo(imagen)
            
    
            
            $qry = "UPDATE jugadores SET idEquipo='". $equipo . "', nombreJugador='". $nombreJ . "',
            apellidoPaternoJ='". $aPaterno . "', apellidoMaternoM='". $aMaterno . "', posicion='". $posicion . "'  
            , numero='". $numJugador . "' WHERE idJugador=". $_GET['idJ'];
            $rs = mysqli_query($conn, $qry);
            header("location:http://localhost/ProyectoFinal/admiJugadores.php");
    
}
if(isset($_GET['idJ']) && $_GET['idJ']!= "")
{
    $qry = "SELECT * FROM jugadores WHERE idJugador = ". $_GET['idJ'];
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
    .liga{
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
<?php 
    $sql="SELECT idEquipo, nombreEquipo FROM Equipos";
    $rs=mysqli_query($conn,$sql);
?>
<div class="tituloFormulario">Formulario Jugadores
 </div>

<div id="login">
<form method="GET" action="modificaRegistroJugador.php" onsubmit="return verificaFRM()">
<input type="hidden" name="idJ" value="<?php echo $_GET['idJ']?>">
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
    <input type="text" name="txtNombreJugador" id="txtNombreJugador"  value="<?php echo $datos1["nombreJugador"]?>"><br>
    <label>apellido Paterno: </label>   
    <input type="text" name="txtAPaterno" id="txtAPaterno" value="<?php echo $datos1["apellidoPaternoJ"]?>"><br>
    <label>apellido Materno: </label>  
    <input type="text" name="txtAMaterno" id="txtAMaterno" value="<?php echo $datos1["apellidoMaternoM"]?>"><br>
    <label>posicion: </label> 
    <input type="text" name="txtPosicion" id="txtPosicion" value="<?php echo $datos1["posicion"]?>"><br>
    <label>numero: </label>    
    <input type="number" name="numN" id="numN" min="0" max="200" value="<?php echo $datos1["numero"]?>"><br><br>
   

         <input type="submit" value="Modificar Jugador"/><br><br>
			<input type="reset" value="Cancelar">
			
			
         </form>
         </div>
<div class="regreso"><a href="admiJugadores.php">Regresar</a></div>
        
</body>

</html>
