<?php
	$url ="";
	if(isset($_GET['volume']) && $_GET['volume'] != ''){$volume = $_GET['volume']; $url = "volume=".$volume;}
	if(isset($_GET['month']) && $_GET['month'] != ''){$month = $_GET['month']; $url .= "&month=".$month;}
	if(isset($_GET['year']) && $_GET['year'] != ''){$year = $_GET['year']; $url .= "&year=".$year;}
	if(isset($_GET['page']) && $_GET['page'] != ''){$page = $_GET['page']; $url .= "&pagenum=".$page;}
	header("Location: bookreader/templates/book.php?".$url);
?>
