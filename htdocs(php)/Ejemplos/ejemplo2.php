<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
$filas=12;
$celdas=8;
$i=0;
echo "<table border='1'>";

while($i<$filas)
{
    $j=0;
    echo "<tr>";
    while($j<$celdas)
    {
        echo "<td>" . ($i+1) . "," . ($j+1) . "</td>";
        $j++;
    }
        echo "</tr>";
        $i++;
}
echo "</table>";



?>
<?php 
$filas=12;
$celdas=8;
echo "<table border='1'>";
for($i=0;$i<$filas;$i++)
{
    echo "<tr>";
        for($j=0;$j<$celdas;$j++)
            echo "<td>" . ($i+1) . "," . ($j+1) . "</td>";
    echo "</tr>";
}
echo "</table>";
?>
<p style="color: red">Hola <strong>Ulises</strong></p>
</body>
</html>