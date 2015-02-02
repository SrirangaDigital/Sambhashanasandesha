<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<?php include("common.php"); ?>
<?php
	if(isset($_GET['authid']) && $_GET['authid'] != '' && isset($_GET['authorname']) && $_GET['authorname'] != '')
	{
		$authid = $_GET['authid'];
		$authorname = $_GET['authorname'];
		$query = "select * from article where authid  = $authid order by volume, issue, title, page";
	}
	else
	{
		$query = "select * from article order by volume, issue, title, page";
	}
?>
<article id="main">
	<header class="special container">
		<span class="icon fa-pencil"></span>
		<h2><strong><?php echo $authorname; ?></strong></h2>
		<p>Biblography</p>
	</header>
	<section class="wrapper style4 container">
		<div class="content">
	
<?php 
	
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
			$authname = $sumne[1];
			$volume = $row['volume'];
			$inum = $row['issue'];
			$page = $row['page'];
			$title = $row['title'];
			$month = $row['month'];
			$year = $row['year'];
			$featureid = $row['featid'];
				
			$query1 = "select * from feature where featid = '$featureid'";
			$result1 = mysql_query($query1);
			$row1=mysql_fetch_assoc($result1);
			$featurename = preg_replace("/ /","%20",$row1['featurename']);
			$featureid = $row1['featid'];
					
					echo "<div class=\"box\">";
					echo	"<div class=\"inside\">";
					echo		"<a href=\"bookReader.php?volume=$volume&amp;month=$month&amp;year=$year&amp;page=$page\"><span class=\"titlespan\">".$title."</span></a>&nbsp;|&nbsp;<a href=\"feat.php?featid=$featureid&amp;featname=$featurename\"><span class=\"featurespan\">".$row1['featurename']."</span></a>&nbsp;|&nbsp;<a href=\"toc.php?year=$year&amp;month=$month&amp;volume=$volume&amp;issue=$issue\">".getMonth($month)." $year (Vol. ".intval($volume).", Issue&nbsp;".intval($inum).")</a>";
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
			</div>
	</section>
</article>
<?php include("footer.php"); ?>
