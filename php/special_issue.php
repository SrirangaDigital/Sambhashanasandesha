<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<?php include("common.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-book"></span>
		<h2>
			<strong>
				<span class="head_t1">Special Issues | </span> विशेषाङ्कः
			</strong>
		</h2>
		<p>सञ्चिकाः द्रष्टुं ‘वर्षं’ स्पृशत</p>
	</header>
	<section class="wrapper style4 container">
		<div class="content">
			<div class="volumes">
<?php
	include("connect.php");
	$db = mysql_connect($server,$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");
	mysql_query("set names utf8");
	
	$row_count = 4;
	$query = "select distinct month, year from article order by year desc";
	$result = mysql_query($query);

	$num_rows = mysql_num_rows($result);

	$count = 0;
	$col = 1;
	if($num_rows)
	{
		for($i=1;$i<=$num_rows;$i++)
		{
			$row=mysql_fetch_assoc($result);
			
			$month=$row['month'];
			$year=$row['year'];
			
			$query2 = "select * from article where month = '$month' and year = '$year' order by year desc";
			$result2 = mysql_query($query2);
			$num_rows2 = mysql_num_rows($result2);
			if($num_rows2)
			{
				$row2=mysql_fetch_assoc($result2);
				$volume=$row2['volume'];
				$issue=$row2['issue'];
				
				if($month == 'special' || $month == 'specialA' || $month == 'specialB')
				{
					echo "<a class=\"box-shadow-outset\" href=\"toc.php?year=$year&amp;month=$month&amp;volume=$volume&amp;issue=$issue\">";
					echo "<img src=\"images/cover/thumbs/$year/$month.jpg\" alt=\"$month thumbnail\" />";
					echo "<p class=\"inum\">" . convert_devanagari($year) . "</p></a>";
				}
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
