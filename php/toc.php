<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<?php include("common.php"); ?>
<?php
	
	if((isset($_GET['month']) && $_GET['month'] != '') && isset($_GET['year']) && $_GET['year'] != '')
	{
		$month = $_GET['month'];
		$year = $_GET['year'];
		$volume = $_GET['volume'];
		$issue = $_GET['issue'];
		$query = "select * from article where year = $year and month = $month order by volume, issue, title, page";
	}
	else
	{
		$query = "select * from article order by year, month, title, page";
	}
	
?>
<article id="main">
	<header class="special container">
		<span class="icon toc_image"><?php $temp=$year."_".$month;; echo "<img src=\"images/cover/$temp.jpg\" alt=\"Issue $issue cover page\" />"; ?></span>
		<h2><strong><?php echo getMonth($month)." ".$year; ?></strong></h2>
		<p><?php echo "Volume ".intval($volume).", Issue ".$issue?></p>
	</header>
	
	<section class="wrapper style4 container">
<?php 
	include("connect.php");
	$db = mysql_connect($server,$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");
	mysql_set_charset("utf8",$db);


	$result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	$vnum = intval($volume);
	if($num_rows)
	{
		for($a=1;$a<=$num_rows;$a++)
		{
			$row=mysql_fetch_assoc($result);
			$authorid = $row['authid'];
			$sumne = preg_split("/;/",$row['authorname']);
			$volume = $row['volume'];
			$inum = $row['issue'];
			$page = $row['page'];
			$title = $row['title'];
			$month = $row['month']; 
			$year = $row['year'];
			$featureid = $row['featid'];
			$vnum = intval($volume);
			/*$type = $row['type'];*/
		
			$query1 = "select * from feature where featid = '$featureid'";
			$result1 = mysql_query($query1);
			$row1=mysql_fetch_assoc($result1);
			$featurename = preg_replace("/ /","%20",$row1['featurename']);
			
			$featureid = $row1['featid'];
					
			echo "<div class=\"box\">";
			echo	"<div class=\"inside\">";
			echo		"<a href=\"bookReader.php?volume=$volume&amp;month=$month&amp;year=$year&amp;page=$page\"><span class=\"titlespan .sanskrit\">".$title."</span></a>&nbsp;|&nbsp;<a href=\"feat.php?featid=$featureid&amp;featname=$featurename\"><span class=\"featurespan\">".$row1['featurename']."</span></a><br/>";
			$sumne = preg_split("/;/",$authorid);
			for($k = 0; $k < count($sumne); $k++)
			{
				$query1 = "select * from author where authid = '$sumne[$k]'";
				$result1 = mysql_query($query1); 
				$row1 = mysql_fetch_assoc($result1);
				echo	"<a href=\"showAuthorArticles.php?authid=".$row1["authid"]."&amp;authorname=".preg_replace("/ /","%20",$row1["authorname"])."\"><span class=\"authorspan\">".$row1["authorname"]."</span></a>";
				if(count($sumne) > 1 && $k < count($sumne)-1)
				{
					echo "&nbsp;|&nbsp;";
				}
			}
			
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
