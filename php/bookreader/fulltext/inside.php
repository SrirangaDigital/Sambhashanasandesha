<?php
	session_start();
	$year = $_GET["year"];
	$month = $_GET["month"];
	$qtext = $_GET["q"];
	$stext  = $_GET["q"];
	echo json_encode($_SESSION["sd"][$year.$month]);
?>
