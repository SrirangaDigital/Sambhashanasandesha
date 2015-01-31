<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<?php require("common.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-newspaper-o"></span>
		<h2><strong>Articles</strong></h2>
		<p>Lists all the articles of Sambhashana Sandesha.</p>
	</header>
	<section class="wrapper style4 container">
		<div class="content">
<!--
			<div class="alphabet">
-->
		<div class="letters">	
		<a href="articles.php?letter=अ">अ</a>
		<a href="articles.php?letter=आ">आ</a>
		<a href="articles.php?letter=इ">इ</a>
		<a href="articles.php?letter=ई">ई</a>
		<a href="articles.php?letter=उ">उ</a>
		<a href="articles.php?letter=ऊ">ऊ</a>
		<a href="articles.php?letter=ऋ">ऋ</a>
		<a href="articles.php?letter=ए">ए</a>
		<a href="articles.php?letter=ऐ">ऐ</a>
		<a href="articles.php?letter=ओ">ओ</a>
		<a href="articles.php?letter=औ">औ</a>
		<a href="articles.php?letter=अं">अं</a>
		<a href="articles.php?letter=अः">अः</a><br />
		
		
		
		<a href="articles.php?letter=क">क</a>
		<a href="articles.php?letter=ख">ख</a>
		<a href="articles.php?letter=ग">ग</a>
		<a href="articles.php?letter=घ">घ</a>
		<a href="articles.php?letter=ङ">ङ</a>
	
		<a href="articles.php?letter=च">च</a>
		<a href="articles.php?letter=छ">छ</a>
		<a href="articles.php?letter=ज">ज</a>
		<a href="articles.php?letter=झ">झ</a>
		<a href="articles.php?letter=ञ">ञ</a>
		
		<a href="articles.php?letter=ट">ट</a>
		<a href="articles.php?letter=ठ">ठ</a>
		<a href="articles.php?letter=ड">ड</a>
		<a href="articles.php?letter=ढ़">ढ़</a>
		<a href="articles.php?letter=ण">ण</a>
		
		<a href="articles.php?letter=त">त</a>
		<a href="articles.php?letter=थ">थ</a>
		<a href="articles.php?letter=द">द</a>
		<a href="articles.php?letter=ध">ध</a>
		<a href="articles.php?letter=न">न</a>
	
		<a href="articles.php?letter=प">प</a>
		<a href="articles.php?letter=फ">फ</a>
		<a href="articles.php?letter=ब">ब</a>
		<a href="articles.php?letter=भ">भ</a>
		<a href="articles.php?letter=म">म</a>


		<a href="articles.php?letter=य">य</a>
		<a href="articles.php?letter=र">र</a>
		<a href="articles.php?letter=ल">ल</a>
		<a href="articles.php?letter=व">व</a>
		<a href="articles.php?letter=श">श</a>
		<a href="articles.php?letter=ष">ष</a>
		<a href="articles.php?letter=स">स</a>
		<a href="articles.php?letter=ह">ह</a>
		<a href="articles.php?letter=ळ">ळ</a>
	</div>
	
<?php 
	if(isset($_GET['letter']) && $_GET['letter'] != '')
	{
		$letter = $_GET['letter'];
		$query = "select * from article where title like '$letter%' order by volume, issue, title, page";
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
			echo		"<a href=\"#\"><span class=\"titlespan\">".$title."</span></a>&nbsp;|&nbsp;<a href=\"feat.php?featid=$featureid&featname=$featurename\"><span class=\"featurespan\">".$featurename."</span></a>&nbsp;|&nbsp;".getMonth($month)." $year <a href=\"toc.php?volume=$volume&issue=$inum\">(Vol. ".intval($volume).", Issue&nbsp;".intval($inum).")</a><br/>";
			$sumne = preg_split("/;/",$authorid);
			for($k = 0; $k < count($sumne); $k++)
			{
				$query1 = "select * from author where authid = '$sumne[$k]'";
				$result1 = mysql_query($query1);
				$row1=mysql_fetch_assoc($result1);
				echo	"<a href=\"showAuthorArticles.php?authid=".$row1["authid"]."\"><span class=\"authorspan\">".$row1["authorname"]."</span></a>";
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
