<?php
session_start();
require("funciones.php");
if(!isset($_SESSION['idUsuario']))header("location:http://localhost/Sistema/portada.php");

$conn = ConectarBD();
if(isset($_GET['equipo']) && $_GET['equipo']!="" || isset($_GET['equipo1']) && $_GET['equipo1']!=""
|| isset($_GET['fecha']) && $_GET['fecha']!="")   // validar el envio del formulario.
{
    if($_GET['equipo']!=$_GET['equipo1'])
    {
            
                //tomar el archivo de la carpeta temporales y entonces guardarlo en la BD. 
                $equipo=$_GET['equipo'];
                $equipo1=$_GET['equipo1'];
                $fecha=$_GET['fecha'];
                $liga=$_GET['liga'];
                
    
            //recuperar el contenido del archivo(imagen)
            
    
           
            $qry = "UPDATE partidos SET idEquipo1='". $equipo . "', idEquipo2='". $equipo1 . "',
            fecha='". $fecha . "', idLiga='". $liga . "' WHERE idPartido=". $_GET['idP'];
            $rs = mysqli_query($conn, $qry);
            header("location:http://localhost/ProyectoFinal/admiPartido.php");
    }
    else{
        echo "error";
    }
}
if(isset($_GET['idP']) && $_GET['idP']!= "")
{
    $qry = "SELECT * FROM partidos WHERE idPartido = ". $_GET['idP'];
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
     #main-container{
    margin:auto;
    margin-top: 5%;
	width: 450px;
    
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
    background-color: black;
	border-bottom: solid 5px white;
	color: white;
    font-size: 30px;
}

tr:nth-child(even){
	background-color: #ddd;
}

tr:hover td{
	background-color: gray;
	color: white;
}
    .liga{
    margin-left: 20px;
    width: 430px;
    height: 60px;
    font-size: 30px;
    }
    #fecha{
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
<?php 
    $sql="SELECT idEquipo, nombreEquipo FROM Equipos";
    $rs=mysqli_query($conn,$sql);
?>
<div class="tituloFormulario">Formulario Partidos
 </div>
 <div class="conTabla">
          <div id="main-container">
<h4>Partido a modificar</h4>
<table>
    <thead>
        <tr>
       
            <th>Nombre Equipo1</th>
            <th>Nombre Equipo2</th>
        <th>fecha</th>
        <th>Nombre Liga</th>
       
            
        </tr>
        </thead>
        <?php 
        $sql= "SELECT * FROM partidos WHERE idPartido=". $_GET['idP'];
        $rs=mysqli_query($conn,$sql);
        while($mostrar=mysqli_fetch_array($rs)){
        ?>
    <tr>
        
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
        


       
        
    </tr>
    <?php 
    }//while
    ?>
</table>
</div>
</div>
<div id="login">
<form method="GET" action="modificaRegistroPartido.php" onsubmit="return verificaFRM()">
<input type="hidden" name="idP" value="<?php echo $_GET['idP']?>">
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
         $sqle2="SELECT idEquipo, nombreEquipo FROM equipos";
         $rse2=mysqli_query($conn,$sql);
        while($datose2=mysqli_fetch_array($rse2))
        {

        $auxe2=$datose2["nombreEquipo"];
     ?>
        
        <option value="<?php echo $datose2['idEquipo'] ?>"><?php echo $auxe2 ?></option>
            <?php 
        }
            ?>
    </select>
    <label>fecha: </label>
    <input type="date" name="fecha" id="fecha"><br>
    <br>
    <br>

         <input type="submit" value="Modificar Partido"/><br><br>
			<input type="reset" value="Cancelar">
			
			
         </form>
         </div>
<div class="regreso"><a href="admiPartido.php">Regresar</a></div>
        
</body>

</html>
