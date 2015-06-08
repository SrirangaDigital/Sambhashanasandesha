<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<?php include("common.php"); ?>
<?php

$advtID = '1001';
	if((isset($_GET['month']) && $_GET['month'] != '') && isset($_GET['year']) && $_GET['year'] != '')
	{
		$month = $_GET['month'];
		$year = $_GET['year'];
		$volume = $_GET['volume'];
		$issue = $_GET['issue'];
		$query = "(select * from article where year = '$year' and month = '$month' and featid != '$advtID' order by page) UNION (select * from article where year = '$year' and month = '$month' and featid = '$advtID' order by page)";
	}
	else
	{
		$query = "select * from article order by year, month, title, page";
	}
?>
<article id="main">
	<header class="special container">
		<span class="icon toc_image"><?php echo '<img src="images/cover/thumbs/' . $year . '/' . $month . '.jpg" alt="Issue ' . $year . ' ' . $month . ' cover page" />'; ?></span>
		<h2>
			<strong>
				<?php echo "<span class=\"head_t2\">" . getMonthEnglish($month) . " " . $year . " | </span>" ; ?>
				<?php echo '<span class="sanskrit">' . getMonthDevanagari($month) . " " . convert_devanagari($year) . '</span>'; ?>
			</strong>
		</h2>
		<p>
			<strong>
				<?php
					if($month == 'specialA' || $month == 'specialB' || $month == 'special')
					{
						echo "Volume " . intval($volume) . ", Special Issue " . intval($issue) . " | ";
					}
					else
					{
						echo "Volume " . intval($volume) . ", Issue " . intval($issue) . " | ";
					}
				?>
				<?php
					if($month == 'specialA' || $month == 'specialB' || $month == 'special')
					{
						echo "<span class=\"sanskrit\">सम्पुटः " . convert_devanagari(intval($volume)) . ", विशेषसञ्चिका " . convert_devanagari($issue) . '</span>';
					}
					else
					{
						echo "<span class=\"sanskrit\">सम्पुटः " . convert_devanagari(intval($volume)) . ", सञ्चिका " . convert_devanagari($issue) . '</span>';
					}
					//~ Link for downloading pdf 
					//~ echo "<br/><br/><a target=\"_blank\" href=\"downloadPdf.php?year=$year&amp;month=$month\"><span class=\"downloadspan\">Download Issue</span></a>"
				 ?>
			</strong>
		</p>
	</header>
	
	<section class="wrapper style4 container">
<?php 


	include("connect.php");
	$db = mysql_connect($server,$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");
	mysql_query("set names utf8");


	$result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	$vnum = intval($volume);
	if($num_rows)
	{
		for($a=1;$a<=$num_rows;$a++)
		{
			$row=mysql_fetch_assoc($result);
			$authorid = $row['authid'];
			$titleid = $row['titleid'];
			$sumne = preg_split("/;/",$row['authorname']);
			$volume = $row['volume'];
			$inum = $row['issue'];
			$page = preg_split('/-/',$row['page'],2);
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
			echo		"<a href=\"bookReader.php?volume=$volume&amp;month=$month&amp;year=$year&amp;page=$page[0]\" target=\"_blank\"><span class=\"titlespan sanskrit\">".$title."</span></a>&nbsp;|&nbsp;<a href=\"feat.php?featid=$featureid&amp;featname=$featurename\"><span class=\"featurespan sanskrit\">".$row1['featurename']."</span></a><br/>";
			$sumne = preg_split("/;/",$authorid);
			for($k = 0; $k < count($sumne); $k++)
			{
				$query1 = "select * from author where authid = '$sumne[$k]'";
				$result1 = mysql_query($query1); 
				$row1 = mysql_fetch_assoc($result1);
				echo	"<a href=\"showAuthorArticles.php?authid=".$row1["authid"]."&amp;authorname=".preg_replace("/ /","%20",$row1["authorname"])."\"><span class=\"authorspan sanskrit\">".$row1["authorname"]."</span></a>";
				if(count($sumne) > 1 && $k < count($sumne)-1)
				{
					echo "&nbsp;|&nbsp;";
				}
			}
			//~ Link for downloading pdf 
			//~ if($row['authid'] != ""){echo "<br/>";}
			//~ echo	"<a href=\"bookReader.php?volume=$volume&amp;month=$month&amp;year=$year&amp;page=$page[0]\" target=\"_blank\"><span class=\"downloadspan\">Read Online | </span></a><a target=\"_blank\" href=\"downloadPdf.php?titleid=$titleid\"><span class=\"downloadspan\">Download Article</span></a>";
			echo	"</div>";
			echo"</div>";
		}
	}
	else
	{
		echo "<span class=\"empty topic\">Error encountered!</span>";

	}
	mysql_close($db);
?>
	</section>
</article>
<?php include("footer.php"); ?>
