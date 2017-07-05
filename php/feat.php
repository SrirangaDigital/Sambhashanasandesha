<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<?php include("common.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-tags"></span>
		<h2><strong>
				<?php
					$featurename = $_GET["featname"];
					echo '<span class="sanskrit">' . $featurename . '</span>';
				?>
			</strong></h2>
		<?php 
			if(isset($_GET['featid']) && $_GET['featid'] != '')
			{
				$featid = $_GET['featid'];
				if($featurename == 'निकषोपलः' || $featurename == 'पदरञ्जिनी' || $featurename == 'सुयोगः' || $featurename == 'कुतुककुटी')
				{ 
					$query = "select * from article where featid = $featid order by volume, issue";
				}
				else
				{
					$query = "select * from article where featid = $featid order by TRIM(LEADING '`' FROM title)";
				}
			}
			else
			{
				$query = "select * from article where featid  = '1003' order by TRIM(LEADING '`' FROM title)";
			}
			include("connect.php");

			$result = $db->query($query);
			$num_rows = $result ? $result->num_rows : 0;

			if($num_rows > 0)
			{
				echo ($num_rows > 1) ? '<p class="sanskrit">' . convert_devanagari($num_rows) . ' लेखाः</p>' : '<p class="sanskrit">' . convert_devanagari($num_rows) . ' लेखः</p>';
				echo '		</header>
							<section class="wrapper style4 container">';

				while($row = $result->fetch_assoc())
				{
					$authorid = $row['authid'];
					$volume = $row['volume'];
					$inum = $row['issue'];
					$page = preg_split('/-/',$row['page'],2);
					$title = $row['title'];
					$month = $row['month']; 
					$year = $row['year'];
					$featureid = $row['featid'];
					$titleid = $row['titleid'];
					/*$type = $row['type'];*/
					
					echo "<div class=\"box\">";
					echo	"<div class=\"inside\">";
					echo		"<a href=\"bookReader.php?volume=$volume&amp;month=$month&amp;year=$year&amp;page=$page[0]\"  target=\"_blank\"><span class=\"titlespan sanskrit\">".$title."</span></a>&nbsp;|&nbsp;<span class=\"voliss sanskrit\"><a href=\"toc.php?year=$year&amp;month=$month&amp;volume=$volume&amp;issue=$inum\">" . getMonthDevanagari($month) . " ". convert_devanagari($year) . " (सम्पुटः " . convert_devanagari(intval($volume)) . ", सञ्चिका " . convert_devanagari(intval($inum)) . ")</a></span><br/>";
					$sumne = preg_split("/;/",$authorid);
					for($k = 0; $k < count($sumne); $k++)
					{
						$query1 = "select * from author where authid = '$sumne[$k]'";
						$result1 = $db->query($query1);
						$row1 = $result1->fetch_assoc();
						echo	"<a href=\"showAuthorArticles.php?authid=".$row1["authid"]."&amp;authorname=".preg_replace("/ /","%20",$row1["authorname"])."\"><span class=\"authorspan sanskrit\">".$row1["authorname"]."</span></a>";
						if(count($sumne) > 1 && $k < count($sumne)-1)
						{
							echo "&nbsp;|&nbsp;";
						}
					}
					//~ Link To Download Pdf 
					//~ if($row1['authid'] != ""){echo "<br/>";}
					//~ echo	"<a href=\"bookReader.php?volume=$volume&amp;month=$month&amp;year=$year&amp;page=$page[0]\" target=\"_blank\"><span class=\"downloadspan\">Read Online | </span></a><a target=\"_blank\" href=\"downloadPdf.php?titleid=$titleid\"><span class=\"downloadspan\">Download Article</span></a>";
					echo	"</div>";
					echo"</div>";

				}
			}
			else
			{
				echo '	</header>
						<section class="wrapper style4 container">';

				echo "<span class=\"empty topic\">Error encountered!</span>";

			}
			if($result){$result->free();}
			$db->close();
		?>
	</section>
</article>
<?php include("footer.php"); ?>
