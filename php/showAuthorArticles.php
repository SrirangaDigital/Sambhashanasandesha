<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<?php include("common.php"); ?>
<?php
	if(isset($_GET['authid']) && $_GET['authid'] != '' && isset($_GET['authorname']) && $_GET['authorname'] != '')
	{
		$authid = $_GET['authid'];
		$authorname = $_GET['authorname'];
		$query = "select * from article where authid  like '%$authid%' order by title, volume, issue, page";
	}
	else
	{
		$query = "select * from article where authid  like '%1031%' order by title, volume, issue, page";
	}
?>
<article id="main">
	<header class="special container">
		<span class="icon fa-pencil"></span>
		<h2><strong><?php echo '<span class="sanskrit">' . $authorname . '</span>'; ?></strong></h2>	
<?php 

	include("connect.php");
	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;

	if($num_rows > 0)
	{
		echo ($num_rows > 1) ? '<p class="sanskrit">' . convert_devanagari($num_rows) . ' लेखाः</p>' : '<p class="sanskrit">' . convert_devanagari($num_rows) . ' लेखः</p>';
		echo '		</header>
				<section class="wrapper style4 container">
					<div class="content">';

		while($row = $result->fetch_assoc())
		{
			$authorid = $row['authid'];
			$sumne = preg_split("/;/",$row['authorname']);
			if(count($sumne)>1)
			{
				$authorname = $sumne[1];
			}
			else
			{
				$authorname = $sumne[0];
			}
			$volume = $row['volume'];
			$inum = $row['issue'];
			$page = preg_split('/-/',$row['page'],2);
			$title = $row['title'];
			$month = $row['month'];
			$year = $row['year'];
			$featureid = $row['featid'];
			$titleid = $row['titleid'];
				
			$query1 = "select * from feature where featid = '$featureid'";
			$result1 = $db->query($query1);
			$row1 = $result1->fetch_assoc();
			$featurename = preg_replace("/ /","%20",$row1['featurename']);
			$featureid = $row1['featid'];
					
					echo "<div class=\"box\">";
					echo	"<div class=\"inside\">";
					echo		"<a href=\"bookReader.php?volume=$volume&amp;month=$month&amp;year=$year&amp;page=$page[0]\" target=\"_blank\"><span class=\"titlespan sanskrit\">".$title."</span></a>&nbsp;|&nbsp;<a href=\"feat.php?featid=$featureid&amp;featname=$featurename\"><span class=\"featurespan sanskrit\">".$row1['featurename']."</span></a>&nbsp;|&nbsp;<span class=\"voliss sanskrit\"><a href=\"toc.php?year=$year&amp;month=$month&amp;volume=$volume&amp;issue=$inum\">" . getMonthDevanagari($month) . " ". convert_devanagari($year) . " (सम्पुटः " . convert_devanagari(intval($volume)) . ", सञ्चिका " . convert_devanagari(intval($inum)) . ")</a></span><br/>";
					//~ Link To Download Pdf 
					//~ echo	"<a href=\"bookReader.php?volume=$volume&amp;month=$month&amp;year=$year&amp;page=$page[0]\" target=\"_blank\"><span class=\"downloadspan\">Read Online | </span></a><a target=\"_blank\" href=\"downloadPdf.php?titleid=$titleid\"><span class=\"downloadspan\">Download Article</span></a>";
					echo	"</div>";
					echo"</div>";
		}
	}
	else
	{
		echo '	</header>
				<section class="wrapper style4 container">
					<div class="content">';

		echo "<span class=\"empty topic\">There are no articles by this author&nbsp;&nbsp;</span>";

	}
	if($result){$result->free();}
	$db->close();
?>
			</div>
	</section>
</article>
<?php include("footer.php"); ?>
