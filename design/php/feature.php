<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-newspaper-o"></span>
		<h2><strong>Features</strong></h2>
		<p>Lists of features in Sambhashana Sandesha.</p>
	</header>
	<section class="wrapper style4 container">
		<div class="content">
			
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
