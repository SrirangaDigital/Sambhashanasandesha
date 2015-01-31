<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-newspaper-o"></span>
		<h2><strong>Authors</strong></h2>
		<p>Lists of authors by letter <?php echo '"'.$_GET['letter'].'"';?> in Sambhashana Sandesha.</p>
	</header>
	<section class="wrapper style4 container">
		<div class="content">
			<div class="letters">	
		<a href="authors.php?letter=अ">अ</a>
		<a href="authors.php?letter=आ">आ</a>
		<a href="authors.php?letter=इ">इ</a>
		<a href="authors.php?letter=ई">ई</a>
		<a href="authors.php?letter=उ">उ</a>
		<a href="authors.php?letter=ए">ए</a>
		<a href="authors.php?letter=ओ">ओ</a>

		<a href="authors.php?letter=क">क</a>
		<a href="authors.php?letter=ख">ख</a>
		<a href="authors.php?letter=ग">ग</a>
		<a href="authors.php?letter=घ">घ</a>
	
		<a href="authors.php?letter=च">च</a>
		<a href="authors.php?letter=ज">ज</a>
		
		<a href="authors.php?letter=ट">ट</a>
		<a href="authors.php?letter=ड">ड</a>
		
		<a href="authors.php?letter=त">त</a>
		<a href="authors.php?letter=द">द</a>
		<a href="authors.php?letter=ध">ध</a>
		<a href="authors.php?letter=न">न</a><br />
	
		<a href="authors.php?letter=प">प</a>
		<a href="authors.php?letter=फ">फ</a>
		<a href="authors.php?letter=ब">ब</a>
		<a href="authors.php?letter=भ">भ</a>
		<a href="authors.php?letter=म">म</a><br />


		<a href="authors.php?letter=य">य</a>
		<a href="authors.php?letter=र">र</a>
		<a href="authors.php?letter=ल">ल</a>
		<a href="authors.php?letter=व">व</a>
		<a href="authors.php?letter=श">श</a>
		<a href="authors.php?letter=ष">ष</a>
		<a href="authors.php?letter=स">स</a>
		<a href="authors.php?letter=ह">ह</a>
		
	</div>
<?php
	//actual PHP code goes here (for suresh)
	include("connect.php");
	if(isset($_GET['letter']) && $_GET['letter'] != '')
	{
		$letter = $_GET['letter'];
		$query1 = "select * from author where authorname like '$letter%' order by authorname";
	}
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
			$authorname = $row1['authorname'];
			$sal = $row1['sal'];
			$authorid = $row1['authid'];
			echo "<div class=\"box\">";
			echo	"<div class=\"inside\">";
			echo		"<a href=\"showAuthorArticles.php?authid=$authorid\"><span class=\"authorspan\">".$authorname."</span></a>";
			echo	"</div>";
			echo"</div>";
		}
	}
?>	
		</div>
	</section>
</article>
<?php include("footer.php"); ?>
