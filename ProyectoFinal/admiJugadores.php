<?php 
session_start();
if(!isset($_SESSION['idUsuario']) || $_SESSION['Rol']!='Administrador') header("location:http://localhost/ProyectoFinal/CanCerberoPortada.php");
    include ("funciones.php");
    $conn=ConectarBD();
    $msg="";
    
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
    
            $qry="insert into jugadores (idEquipo, nombre, apellidoPaterno, apellidoMaterno, posicion, numero, imagenJugador)
                    values ('$equipo','$nombreJ','$aPaterno','$aMaterno','$posicion','$numJugador','$contenido')";
    
            if(mysqli_query($conn,$qry))
                header("location:http://localhost/ProyectoFinal/admiJugadores.php");
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
.alerta{
	background-color: blue;
	color: red;
	text-transform: uppercase;
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
    $sql="SELECT idEquipo, nombre FROM equipos";
    $rs=mysqli_query($conn,$sql);
?>
<h1>Agregar Jugador</h1>
<hr>
<form method="post" action="admiJugadores.php" enctype="multipart/form-data" onsubmit="verificaFRM()">
     
    <h4>Equipo</h4>
    <select name="equipo">
    <?php 
        while($datos=mysqli_fetch_array($rs))
        {

        $aux=$datos["nombre"];
     ?>
        
        <option value="<?php echo $datos['idEquipo'] ?>"><?php echo $aux ?></option>
            <?php 
        }
            ?>
    </select>
    <br>
            
	nombre: <input type="text" name="txtNombreJugador" id="txtNombreJugador"><br>
	apellido Paterno: <input type="text" name="txtAPaterno" id="txtAPaterno"><br>
	apellido Materno: <input type="text" name="txtAMaterno" id="txtAMaterno"><br>
    posicion: <input type="text" name="txtPosicion" id="txtPosicion"><br>
    numero: <input type="number" name="numN" id="numN" min="0" max="200"><br>
    imagen: <input type="file" name="imagenJugador"><br>
    
	<input type="submit" value="cargar jugador">
    <input type="reset" value="Cancelar">
</form>
<?php if($msg!="") echo "<p class='alerta'>$msg</p>" ?>
<a href="admi.php">Regresar</a>.
<hr>
<h2>Jugadores</h2>
    <table>
        <tr>
        <td>Nombre Equipo</td>
        <td>Nombre Jugador</td>
        <td>Apellido Paterno</td>
        <td>Apellido Materno</td>
        <td>Posicion</td>
        <td>Numero</td>
        </tr>
    <?php 
    $sql= "SELECT * from jugadores";
    $rs=mysqli_query($conn,$sql);
    while($mostrar=mysqli_fetch_array($rs)){
    ?>
    <tr>
        <td><?php echo $mostrar['idEquipo'] ?></td>
        <td><?php echo $mostrar['nombre'] ?></td>
        <td><?php echo $mostrar['apellidoPaterno'] ?></td>
        <td><?php echo $mostrar['apellidoMaterno'] ?></td>
        <td><?php echo $mostrar['posicion'] ?></td>
        <td><?php echo $mostrar['numero'] ?></td>
    </tr>
    <?php 
    }//while
    ?>
    </table>

</body>
</html>