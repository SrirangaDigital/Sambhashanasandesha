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
	$query1 = "select * from feature where featid != '' order by featurename";
	$result1 = $db->query($query1);
	$num_rows1 = $result1 ? $result1->num_rows : 0;

	if($num_rows1 > 0)
	{
		while($row1 = $result1->fetch_assoc())
		{
			$featurename = $row1['featurename'];
			$featid = $row1['featid'];
			
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
