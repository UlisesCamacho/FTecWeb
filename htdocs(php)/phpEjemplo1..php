<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Untitled 1</title>
<?php
echo "<script type='text/javascript'>";
echo "alert('esto es desde js');";
echo "</script>";
?>
<script type="text/javascript">
alert("esto es desde JS");
</script>
</head>

<body>
<?php
$nombre="Ulises";
echo "<h1>Titulo de la pagina</h1>";
echo "<p>Este es un parrafo de la pagina</p>";
echo "<p>Hola <strong>" . $nombre . "</strong></p>";
for($i=0; $i<10; $i++)
	echo "<p style='color:red'>Hola <strong>" . $nombre . "</strong></p>
?>
<p style="color:red">Hola<strong>Ulises</strong></p>
</body>

</html>
