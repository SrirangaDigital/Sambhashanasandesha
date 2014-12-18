<?php
$con = mysql_connect('localhost','root','mysql');
if (!$con)
	die('Could not connect: ' . mysql_error());
	mysql_select_db("samskrit_samskrit", $con);
	 mysql_error();
	 
?>
