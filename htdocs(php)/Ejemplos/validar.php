<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
if(isset($_GET['txtNombre']) && isset($_GET['txtPassword'])) //que las variables existan
{
    if($_GET['txtNombre']!="" && $_GET['txtPassword']!="") //tengan valores
    {
        $nombre=$_GET['txtNombre'];
        $password=$_GET['txtPassword'];
        echo "Bienvenida de la pagina <br>$nombre";
    }
    else
    {
        echo "El usuario y la contraseña son obligatorios";
    }
}
else
{
    echo "para usar esta pagina debes usar <a href='login.html'>login.html</a>";
}
?>    
</body>
</html>