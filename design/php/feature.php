<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<?php include("common.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-newspaper-o"></span>
		<h2><strong>Features</strong></h2>
		<p>Lists of features.</p>
	</header>
	<section class="wrapper style4 container">
		<div class="content">
			
<?php
	//actual PHP code goes here (for suresh)
	include("connect.php");
	$query1 = "select * from feature where featid != '' order by featurename";
	
	$db = mysql_connect($server,$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");
	mysql_set_charset("utf8",$db);
	
	$result1 = mysql_query($query1);
	$num_rows1 = mysql_num_rows($result1);

	if($num_rows1)
	{
	
		for($a=1;$a<=$num_rows1;$a++)
		{
			$row1=mysql_fetch_assoc($result1);
			$featurename = $row1['featurename'];
			$featid = $row1['featid'];
			
			echo "<div class=\"box\">";
			echo	"<div class=\"inside\">";
			echo		"<a href=\"feat.php?feat=$featid\"><span class=\"authorspan\">".$featurename."</span></a>";
			echo	"</div>";
			echo"</div>";
		}
	}
?>	
		</div>
	</section>
</article>
<?php include("footer.php"); ?>
