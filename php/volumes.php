<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-book"></span>
		<h2><strong>Volumes</strong></h2>
		<p>Click on the year to see the issues.</p>
	</header>
	<section class="wrapper style4 container">
		<div class="content">
			<div class="volumes">
<?php
	include("connect.php");
	$db = mysql_connect($server,$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");
	mysql_set_charset("utf8",$db);
	
	$row_count = 4;
	$query = "select distinct volume from article order by volume";
	$result = mysql_query($query);

	$num_rows = mysql_num_rows($result);

	$count = 0;
	$col = 1;
	if($num_rows)
	{
		for($i=1;$i<=$num_rows;$i++)
		{
			$row=mysql_fetch_assoc($result);
			$volume=$row['volume'];

			$query1 = "select distinct year from article where volume='$volume'";
			$result1 = mysql_query($query1);
			$num_rows1 = mysql_num_rows($result1);
			if($num_rows1)
			{
				for($i1=1;$i1<=$num_rows1;$i1++)
				{
					$row1=mysql_fetch_assoc($result1);

					if($i1==1)
					{
						$year=$row1['year'];
					}
					else if($i1==2)
					{
						$year2 = $row1['year'];
						$year21 = preg_split('//',$year2);
						$year=$year."-".$year21[3].$year21[4];
					}
				}
				$count++;
				$volume_int = intval($volume);
				if($count > $row_count)
				{
					$col++;
					$count = 1;
				}
				$vnum = preg_replace("/^[0]+/", "", $volume);
				echo "<a class=\"box-shadow-outset\" href=\"issue.php?volume=$volume&amp;year=$year\"><img src=\"images/cover/$vnum.png\" alt=\"Issue $vnum cover page\" /><p class=\"inum\"> $year</p></a>";
				
			}
		}
	}
	echo '</div>';
	$db=mysql_close($db);
?>         
			
			</div>
	</section>
</article>
<?php include("footer.php"); ?>
