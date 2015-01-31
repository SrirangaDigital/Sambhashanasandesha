<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<?php include("common.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-newspaper-o"></span>
		<h2><strong>Articles</strong></h2>
		<p>Lists all the articles of Sambhashana Sandesha.</p>
	</header>
	<section class="wrapper style4 container">
<?php 
	if((isset($_GET['volume']) && $_GET['volume'] != '') && isset($_GET['issue']) && $_GET['issue'] != '')
	{
		$volume = $_GET['volume'];
		$issue = $_GET['issue'];
		$query = "select * from article where volume = $volume and issue = $issue order by volume, issue, title, page";
	}
	else
	{
		$query = "select * from article order by volume, issue, title, page";
	}
	include("connect.php");

	$db = mysql_connect($server,$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");
	mysql_set_charset("utf8",$db);


	$result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	
	if($num_rows)
	{
		for($a=1;$a<=$num_rows;$a++)
		{
			$row=mysql_fetch_assoc($result);
			$authorid = $row['authid'];
			$sumne = preg_split("/;/",$row['authorname']);
			$authorname = $sumne[1];
			$volume = $row['volume'];
			$inum = $row['issue'];
			$page = $row['page'];
			$title = $row['title'];
			$month = $row['month']; 
			$year = $row['year'];
			$featureid = $row['featid'];
			/*$type = $row['type'];*/
		
			$query1 = "select * from feature where featid = '$featureid'";
			$result1 = mysql_query($query1);
			$row1=mysql_fetch_assoc($result1);
			$featurename = $row1['featurename'];
			$featureid = $row1['featid'];
					
					echo "<div class=\"box\">";
					echo	"<div class=\"inside\">";
					echo		"<a href=\"bookReader.php?volume=$volume&month=$month&year=$year&page=$page\"><span class=\"titlespan\">".$title."</span></a>&nbsp;|&nbsp;<a href=\"feat.php?featid=$featureid&featname=$featurename\"><span class=\"featurespan\">".$featurename."</span></a>&nbsp;|&nbsp;".getMonth($month)." $year<br/><a href=\"showAuthorArticles.php?authid=$authorid\"><span class=\"authorspan\">".$authorname."</span> </a>";
					echo	"</div>";
					echo"</div>";
		}
	}
	else
	{
		echo "<span class=\"empty topic\">There are no articles beginning with letter&nbsp;:&nbsp;$letter</span>";

	}
	mysql_close($db);
?>
	</section>
</article>
<?php include("footer.php"); ?>
