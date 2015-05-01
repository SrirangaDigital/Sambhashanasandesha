<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<?php require("common.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-pencil"></span>
		<h2><strong>Articles | <span class="sanskrit">लेखाः</span></strong>	</h2>
		<p class="sanskrit">अकाराद्यनुक्रमणिका</p>
	</header>
	<section class="wrapper style4 container">
		<div class="content">
		<div class="letters">
			<a href="articles.php?letter=अ"><span class="sanskrit">अ</span></a>
			<a href="articles.php?letter=आ"><span class="sanskrit">आ</span></a>
			<a href="articles.php?letter=इ"><span class="sanskrit">इ</span></a>
			<a href="articles.php?letter=ई"><span class="sanskrit">ई</span></a>
			<a href="articles.php?letter=उ"><span class="sanskrit">उ</span></a>
			<a href="articles.php?letter=ऊ"><span class="sanskrit">ऊ</span></a>
			<a href="articles.php?letter=ऋ"><span class="sanskrit">ऋ</span></a>
			<a href="articles.php?letter=ए"><span class="sanskrit">ए</span></a>
			<a href="articles.php?letter=ऐ"><span class="sanskrit">ऐ</span></a>
			<a href="articles.php?letter=ओ"><span class="sanskrit">ओ</span></a>
			<a href="articles.php?letter=औ"><span class="sanskrit">औ</span></a>
		
			<a href="articles.php?letter=क"><span class="sanskrit">क</span></a>
			<a href="articles.php?letter=ख"><span class="sanskrit">ख</span></a>
			<a href="articles.php?letter=ग"><span class="sanskrit">ग</span></a>
			<a href="articles.php?letter=घ"><span class="sanskrit">घ</span></a>
		
			<a href="articles.php?letter=च"><span class="sanskrit">च</span></a>
			<a href="articles.php?letter=छ"><span class="sanskrit">छ</span></a>
			<a href="articles.php?letter=ज"><span class="sanskrit">ज</span></a>
			<a href="articles.php?letter=झ"><span class="sanskrit">झ</span></a>
			
			<a href="articles.php?letter=ट"><span class="sanskrit">ट</span></a>
			<a href="articles.php?letter=ड"><span class="sanskrit">ड</span></a>
			
			<a href="articles.php?letter=त"><span class="sanskrit">त</span></a>
			<a href="articles.php?letter=थ"><span class="sanskrit">थ</span></a>
			<a href="articles.php?letter=द"><span class="sanskrit">द</span></a>
			<a href="articles.php?letter=ध"><span class="sanskrit">ध</span></a>
			<a href="articles.php?letter=न"><span class="sanskrit">न</span></a>
		
			<a href="articles.php?letter=प"><span class="sanskrit">प</span></a>
			<a href="articles.php?letter=फ"><span class="sanskrit">फ</span></a>
			<a href="articles.php?letter=ब"><span class="sanskrit">ब</span></a>
			<a href="articles.php?letter=भ"><span class="sanskrit">भ</span></a>
			<a href="articles.php?letter=म"><span class="sanskrit">म</span></a>


			<a href="articles.php?letter=य"><span class="sanskrit">य</span></a>
			<a href="articles.php?letter=र"><span class="sanskrit">र</span></a>
			<a href="articles.php?letter=ल"><span class="sanskrit">ल</span></a>
			<a href="articles.php?letter=व"><span class="sanskrit">व</span></a>
			<a href="articles.php?letter=श"><span class="sanskrit">श</span></a>
			<a href="articles.php?letter=ष"><span class="sanskrit">ष</span></a>
			<a href="articles.php?letter=स"><span class="sanskrit">स</span></a>
			<a href="articles.php?letter=ह"><span class="sanskrit">ह</span></a>
			<a title="English and Kannada Articles" href="articles.php?letter=special">#</a>
		</div>

<?php 
	if(isset($_GET['letter']) && $_GET['letter'] != '')
	{
		$letter = $_GET['letter'];
	}
	else
	{
		$letter = 'अ';
	}

	if($letter == 'special')
	{
		$query = "select * from article where title not regexp '^अ|आ|इ|ई|उ|ऊ|ऋ|ए|ऐ|ओ|औ|क|ख|ग|घ|च|छ|ज|झ|ट|ड|त|थ|द|ध|न|प|फ|ब|भ|म|य|र|ल|व|श|ष|स|ह' order by TRIM(BOTH '`' FROM TRIM(BOTH '``' FROM title))";

	}
	else
	{
		$query = "select * from article where title like '$letter%' union select * from article where title like '``$letter%' union select * from article where title like '`$letter%' order by TRIM(BOTH '`' FROM TRIM(BOTH '``' FROM title))";
	}


	include("connect.php");

	$db = mysql_connect($server,$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");
	mysql_query("set names utf8");

	$result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	if($num_rows)
	{
		for($a=1;$a<=$num_rows;$a++)
		{
			$row=mysql_fetch_assoc($result);
			$authorid = $row['authid'];
			$volume = $row['volume'];
			$inum = $row['issue'];
			$page = preg_split('/-/',$row['page'],2);
			$title = $row['title'];
			$month = $row['month']; 
			$year = $row['year'];
			$featureid = $row['featid'];
			/*$type = $row['type'];*/

			$query1 = "select * from feature where featid = '$featureid'";
			$result1 = mysql_query($query1);
			$row1=mysql_fetch_assoc($result1);
			$featurename = preg_replace("/ /","%20",$row1['featurename']);
			
			$featureid = $row1['featid'];
					
			echo "<div class=\"box\">";
			echo	"<div class=\"inside\">";
			echo		"<a href=\"bookReader.php?volume=$volume&amp;month=$month&amp;year=$year&amp;page=$page[0]\" target=\"_blank\"><span class=\"titlespan sanskrit\">".$title."</span></a>&nbsp;|&nbsp;<a href=\"feat.php?featid=$featureid&amp;featname=$featurename\"><span class=\"featurespan sanskrit\">".$row1['featurename']."</span></a>&nbsp;|&nbsp;<span class=\"voliss sanskrit\"><a href=\"toc.php?year=$year&amp;month=$month&amp;volume=$volume&amp;issue=$inum\">" . getMonthDevanagari($month) . " ". convert_devanagari($year) . " (सम्पुटः " . convert_devanagari(intval($volume)) . ", सञ्चिका " . convert_devanagari(intval($inum)) . ")</a></span><br/>";
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
			echo	"</div>";
			echo "</div>";
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
