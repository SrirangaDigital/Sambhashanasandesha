<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<?php include("common.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-tags"></span>
		<h2><strong>Feature</strong></h2>
		<p><?php echo $_GET["featname"];?></p>
	</header>
	<section class="wrapper style4 container">
		<?php 
			if(isset($_GET['featid']) && $_GET['featid'] != '')
			{
				$featid = $_GET['featid'];
				$query = "select * from article where featid  = $featid order by volume, issue, title, page";
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
					$authorname1 = preg_replace("/ /","%20",$authorname);	
					echo "<div class=\"box\">";
					echo	"<div class=\"inside\">";
					echo		"<a href=\"bookReader.php?volume=$volume&amp;month=$month&amp;year=$year&amp;page=$page\"><span class=\"titlespan\">".$title."</span></a>&nbsp;|&nbsp;<a href=\"toc.php?volume=$volume&amp;issue=$inum&amp;year=$year&amp;month=$month\">".getMonth($month)."<span class=\"voliss\"> $year (Vol. ".intval($volume).", Issue&nbsp;".intval($inum).")</span></a><br/>";
					$sumne = preg_split("/;/",$authorid);
					for($k = 0; $k < count($sumne); $k++)
					{
						$query1 = "select * from author where authid = '$sumne[$k]'";
						$result1 = mysql_query($query1);
						$row1=mysql_fetch_assoc($result1);
						echo	"<a href=\"showAuthorArticles.php?authid=".$row1["authid"]."&amp;authorname=".$row1["authorname"]."\"><span class=\"authorspan\">".$row1["authorname"]."</span></a>";
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
