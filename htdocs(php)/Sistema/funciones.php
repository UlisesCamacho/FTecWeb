<?php
function ConectarBD()
{
	$c=mysqli_connect("localhost","root","","tecweb20192020");
	return $c;
}
?>