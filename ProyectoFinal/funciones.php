<?php 
function ConectarBD()
{
	$c = mysqli_connect("localhost","root","","cb");
	return $c;
}
function fechaSvr()
{
	$f= date('Y-m-d: H:i:s');
	return $f;
}

?>