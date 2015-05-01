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

			$db = mysql_connect($server,$user,$password) or die("Not connected to database");
			$rs = mysql_select_db($database,$db) or die("No Database");
			mysql_query("set names utf8");
			
			$result = mysql_query($query);
			$num_rows = mysql_num_rows($result);
			
			if($num_rows)
			{


				echo ($num_rows > 1) ? '<p class="sanskrit">' . convert_devanagari($num_rows) . ' लेखाः</p>' : '<p class="sanskrit">' . convert_devanagari($num_rows) . ' लेखः</p>';
				echo '		</header>
							<section class="wrapper style4 container">';

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
					
					echo "<div class=\"box\">";
					echo	"<div class=\"inside\">";
					echo		"<a href=\"bookReader.php?volume=$volume&amp;month=$month&amp;year=$year&amp;page=$page[0]\"  target=\"_blank\"><span class=\"titlespan sanskrit\">".$title."</span></a>&nbsp;|&nbsp;<span class=\"voliss sanskrit\"><a href=\"toc.php?year=$year&amp;month=$month&amp;volume=$volume&amp;issue=$inum\">" . getMonthDevanagari($month) . " ". convert_devanagari($year) . " (सम्पुटः " . convert_devanagari(intval($volume)) . ", सञ्चिका " . convert_devanagari(intval($inum)) . ")</a></span><br/>";
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
					echo"</div>";

				}
			}
			else
			{
				echo '	</header>
						<section class="wrapper style4 container">';

				echo "<span class=\"empty topic\">Error encountered!</span>";

			}
			mysql_close($db);
		?>
	</section>
</article>
<?php include("footer.php"); ?>
