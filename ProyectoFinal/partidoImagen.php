<?php
session_start();
if(!isset($_SESSION['idUsuario'])) header("location:http://localhost/ProyectoFinal/galeria.php");

include ("funciones.php");

//conectar a la BD
$conn = ConectarBD();
$msg="";

if(isset($_POST['txtTitulo']) && $_POST['txtTitulo']!="")   // validar el envio del formulario.
{
	if(!empty($_FILES['imagen']['tmp_name'])) //validar que el archivo se cargó del lado del servidor
	{
		//tomar el archivo de la carpeta temporales y entonces guardarlo en la BD.
		$nombre=$_FILES['imagen']['name'];
		$tipo=$_FILES['imagen']['type'];
		$nombreTemporal=$_FILES['imagen']['tmp_name'];
		$tamanio=$_FILES['imagen']['size'];
		$titulo=$_POST['txtTitulo'];
		$descripcion=$_POST['txtDescripcion'];
		$fecha=$_POST['txtFecha'];
		$idUsuario=$_SESSION['idUsuario'];
        $partido=$_POST['txtpartido'];
		//recuperar el contenido del archivo(imagen)
		$fp=fopen($nombreTemporal,"r");
		$contenido=fread($fp,$tamanio);
		fclose($fp);

		$contenido=addslashes($contenido);

		$qry="insert into imagenes (Nombre, Tipo, Imagen, idUsuario, Titulo, Descripcion, Fecha, idPartido)
				values ('$nombre','$tipo','$contenido','$idUsuario','$titulo','$descripcion','$fecha', '$partido')";

        if(mysqli_query($conn,$qry))
        {
           
            header("location:http://localhost/ProyectoFinal/partidoImagen.php?idP=".$partido);
        }
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
    <title>Document</title>
    <style type="text/css">
    .contenedor{
    display:flex;
    flex-direction:column;
    border:1px solid black;
    width: 100%; 
    background-color: green;
    
}
.elemento{
    
    margin:auto;
   
    width: 95%;
    background-color: white;

}
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
    text-align: center;
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
    border-bottom: 2px solid black;
}
#login {
   background-color: black;
   border-radius: 8px;
   box-shadow: 3px 3px 10px 0px rgba(50, 50, 50, 0.75);
   -moz-box-shadow: 3px 3px 10px 0px rgba(50, 50, 50, 0.75);
   -webkit-box-shadow: 3px 3px 10px 0px rgba(50, 50, 50, 0.75);
   margin-left: auto;
   margin-right: auto;
   margin-top: 1%;
   max-width: 30em;
   padding-bottom: 10px;
   padding-top: 10px;
   color:white;
}

/* Etiquetas del formulario */

label {
   color: white;
   display: block;
   margin-bottom: 6px;
   margin-left: 1.2em;
}

/* Campos del formulario */

input[type="text"],
input[type="password"] {
   border: none;
   border-radius: 6px;
   display: block;
   font-size: 1em;
   height: 2em;
   text-align: center;
   width: 90%;
   margin-left: auto;
   margin-right: auto;
}

/* Botón */

input[type="submit"] {
   background-color: white;
   border: none;
   border-radius: 6px;
   color: black;
   display: block;
   font-size: 1em;
   height: 2em;
   margin-left: auto;
   margin-right: auto;
   margin-top: -10px;
   text-align: center;
   width: 330px;
}

input[type="submit"]:hover {
   cursor: pointer;
   background-color: gray;
   opacity: 1;
   color: white;
}
input[type="reset"] {
   background-color: white;
   border: none;
   border-radius: 6px;
   color: black;
   display: block;
   font-size: 1em;
   height: 2em;
   margin-left: auto;
   margin-right: auto;
   margin-top: -10px;
   text-align: center;
   width: 330px;
}

input[type="reset"]:hover {
   cursor: pointer;
   background-color: gray;
   opacity: 1;
   color: white;
}
.regreso{
   margin:auto;
   text-align: center;
}
.regreso a{
   margin:auto;
    width: 95%;
	 color: white;
    overflow: hidden;
    height: 40px;
    text-align: center;
    font-size: 30px;
    text-decoration: none;
}
.type{
    margin-left: 10px;
}
.descripcion{
    margin-left: 10px;
    width: 330px;
}
.fecha{
    margin-left: 10px;
    width: 330px;
    text-align: center;
}
.regreso{
   margin:auto;
   text-align: center;
}
.regreso a{
   margin:auto;
    width: 95%;
	 color: black;
    overflow: hidden;
    height: 40px;
    text-align: center;
    font-size: 30px;
    text-decoration: none;
}
.contenedorpruebita{
    display: flex;
    flex-wrap:wrap;
   
}
.pruebita{
    border: 1px solid black;
    margin:auto;
    text-align: center;
   
    font-family: Arial, Helvetica, sans-serif;
    
}
.pruebita,p{
    
    color: green;
    font-size: 15px;
    
}
    </style>
</head>
<body>
<div class="contenedor">
    <div class="elemento">
    <div class="conTabla">
          <div id="main-container">

<table>
    <thead>
        <tr>
        
            <th>equipo local</th>
            <th>-</th>
            <th>equipo visitante</th>
        <th>fecha</th>
            
        </tr>
        </thead>
        <?php 
        $sql= "SELECT * FROM partidos where idPartido=" .$_GET['idP'];
        $rs=mysqli_query($conn,$sql);
        while($mostrar=mysqli_fetch_array($rs)){
        ?>
    <tr>
        
        <td><?php $sql3= "SELECT nombreEquipo, imagenEquipo FROM equipos WHERE idEquipo= ".$mostrar['idEquipo1']; $rs3=mysqli_query($conn,$sql3); 
         while($mostrar3=mysqli_fetch_array($rs3)){
         echo  "<img width='30px' height='30px' src='imagenEquipo.php?idE=".$mostrar["idEquipo1"]."'> &nbsp; ". $mostrar3['nombreEquipo']  ;
         }
        ?></td>
        <td>vs</td>
        <td><?php $sql4= "SELECT nombreEquipo, imagenEquipo FROM equipos WHERE idEquipo= ".$mostrar['idEquipo2']; $rs4=mysqli_query($conn,$sql4); 
         while($mostrar4=mysqli_fetch_array($rs4)){
            echo  "<img width='30px' height='30px' src='imagenEquipo.php?idE=".$mostrar["idEquipo2"]."'> &nbsp; ". $mostrar4['nombreEquipo'];
         }
        ?></td>
        <td><?php echo $mostrar['fecha'] ?></td>
        
    </tr>
    <?php 
    }//while
    ?>
</table>
</div>
</div>
    </div>
    <div class="elemento">
    <div class="tituloPagina"><h2>ecos de la afición</h2></div><br>
<?php 
$sql= "SELECT * FROM imagenes where idPartido=" .$_GET['idP'];
echo "<div class='contenedorpruebita'>";
$rs=mysqli_query($conn,$sql);
while($mostrar=mysqli_fetch_array($rs)){
  
    echo  "<div class='pruebita'><img width='70px' height='60px' src='imagen.php?idI=".$mostrar["idImagen"]."'>" . "&nbsp;" . "<p>"."D:" .$mostrar["Descripcion"]."</p>" ."</div>";
   
}
echo "</div>";
?>
<?php if(isset($_GET['idP']))
{
    $auxPartido=$_GET['idP'];
} 
?>
    </div>
    
    <div class="elemento"> <div class="tituloPagina"><h2>subir imagen de tu experiencia </h2></div>
    <div id="login">
    <form method="post" action="partidoImagen.php" enctype="multipart/form-data">
<label>TItulo:</label> <input type="text" name="txtTitulo"><br>
<label>Archivo:</label>	 <input class="type" type="file" name="imagen"><br><br>
<label>Descripción:</label>	 <textarea class="descripcion" name="txtDescripcion"></textarea><br><br>
<label>Fecha:</label> <input class="fecha" type="date" name="txtFecha"><br><br>
<input type="hidden" name="txtpartido" value="<?php echo $auxPartido ?>"><br>
	<?php if($msg!="") echo "<p class='alerta'>$msg</p>" ?>
	<input type="submit" value="Cargar la imagen"><br><br>
	<input type="reset" value="Cancelar">
</form>
</div>
<br>
<br>
<div class="regreso"><a href="galeria.php">Regresar</a></div>
</div>

</div>
</body>
</html>
