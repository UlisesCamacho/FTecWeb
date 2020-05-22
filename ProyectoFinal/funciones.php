<?php 
function ConectarBD()
{
	$c = mysqli_connect("localhost","root","","cancerbero");
	return $c;
}
function fechaSvr()
{
	$f= date('Y-m-d: H:i:s');
	return $f;
}

?>