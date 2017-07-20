<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-user"></span>
		<h2><strong>Authors | <span class="sanskrit">लेखकाः</span></strong></h2>
		<p class="sanskrit">अकाराद्यनुक्रमणिका</p>
	</header>
	<section class="wrapper style4 container">
		<div class="content">
			<div class="letters">	
		<a href="authors.php?letter=अ"><span class="sanskrit">अ</span></a>
		<a href="authors.php?letter=आ"><span class="sanskrit">आ</span></a>
		<a href="authors.php?letter=इ"><span class="sanskrit">इ</span></a>
		<a href="authors.php?letter=ई"><span class="sanskrit">ई</span></a>
		<a href="authors.php?letter=उ"><span class="sanskrit">उ</span></a>
		<a href="authors.php?letter=ओ"><span class="sanskrit">ओ</span></a>

		<a href="authors.php?letter=क"><span class="sanskrit">क</span></a>
		<a href="authors.php?letter=ख"><span class="sanskrit">ख</span></a>
		<a href="authors.php?letter=ग"><span class="sanskrit">ग</span></a>
		<a href="authors.php?letter=घ"><span class="sanskrit">घ</span></a>
	
		<a href="authors.php?letter=च"><span class="sanskrit">च</span></a>
		<a href="authors.php?letter=ज"><span class="sanskrit">ज</span></a>
		
		<!-- <a href="authors.php?letter=ट"><span class="sanskrit">ट</span></a> -->
		<a href="authors.php?letter=ड"><span class="sanskrit">ड</span></a>
		
		<a href="authors.php?letter=त"><span class="sanskrit">त</span></a>
		<a href="authors.php?letter=द"><span class="sanskrit">द</span></a>
		<a href="authors.php?letter=ध"><span class="sanskrit">ध</span></a>
		<a href="authors.php?letter=न"><span class="sanskrit">न</span></a>
	
		<a href="authors.php?letter=प"><span class="sanskrit">प</span></a>
		<a href="authors.php?letter=फ"><span class="sanskrit">फ</span></a>
		<a href="authors.php?letter=ब"><span class="sanskrit">ब</span></a>
		<a href="authors.php?letter=भ"><span class="sanskrit">भ</span></a>
		<a href="authors.php?letter=म"><span class="sanskrit">म</span></a>


		<a href="authors.php?letter=य"><span class="sanskrit">य</span></a>
		<a href="authors.php?letter=र"><span class="sanskrit">र</span></a>
		<a href="authors.php?letter=ल"><span class="sanskrit">ल</span></a>
		<a href="authors.php?letter=व"><span class="sanskrit">व</span></a>
		<a href="authors.php?letter=श"><span class="sanskrit">श</span></a>
		<a href="authors.php?letter=ष"><span class="sanskrit">ष</span></a>
		<a href="authors.php?letter=स"><span class="sanskrit">स</span></a>
		<a href="authors.php?letter=ह"><span class="sanskrit">ह</span></a>
		
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
	include("connect.php");

	$query = "select * from author where authorname like '$letter%' order by authorname";
	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;

	if($num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$authorname = $row['authorname'];
			$authorname1 = preg_replace("/ /","%20",$authorname);
			$sal = $row['sal'];
			$authorid = $row['authid'];
			echo "<div class=\"box\">";
			echo	"<div class=\"inside\">";
			echo		"<a href=\"showAuthorArticles.php?authid=$authorid&amp;authorname=$authorname1\"><span class=\"authorspan sanskrit\">".$authorname."</span></a>";
			echo	"</div>";
			echo "</div>";
		}
	}
	if($result){$result->free();}
	$db->close();
?>	
		</div>
	</section>
</article>
<?php include("footer.php"); ?>
