<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<?php include("common.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-tags"></span>
		<h2><strong>Features | <span class="sanskrit">प्रधानविभागाः</span></strong></h2>
		<p class="sanskrit">सूचिः</p>
	</header>
	<section class="wrapper style4 container">
		<div class="content">
			
<?php
	include("connect.php");
	$query = "select * from feature where featid != '' order by featurename";
	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;

	if($num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$featurename = $row['featurename'];
			$featid = $row['featid'];
			
			echo "<div class=\"box\">";
			echo	"<div class=\"inside\">";
			echo		"<a href=\"feat.php?featid=$featid&amp;featname=$featurename\"><span class=\"authorspan sanskrit\">".$featurename."</span></a>";
			echo	"</div>";
			echo"</div>";
		}
	}
	if($result){$result->free();}
	$db->close();
?>	
		</div>
	</section>
</article>
<?php include("footer.php"); ?>
