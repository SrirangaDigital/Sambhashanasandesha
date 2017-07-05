<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<?php include("common.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-book"></span>
		<h2>
			<strong>
				<span class="head_t1">Special Issues | </span>  <span class="sanskrit">विशेषाङ्काः</span>
			</strong>
		</h2>
		<p class="sanskrit">विशेषाङ्कं द्रष्टुं ‘वर्षं’ स्पृशत</p>
	</header>
	<section class="wrapper style4 container">
		<div class="content">
			<div class="volumes">
<?php
	include("connect.php");

	$query = "select distinct month, year from article order by year desc";
	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;

	if($num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$month=$row['month'];
			$year=$row['year'];

			$query2 = "select * from article where month = '$month' and year = '$year' order by year desc";
			$result2 = $db->query($query2);
			$num_rows2 = $result2 ? $result2->num_rows : 0;
			if($num_rows2 > 0)
			{
				$row2 = $result2->fetch_assoc();

				$volume=$row2['volume'];
				$issue=$row2['issue'];
				
				if($month == 'specialA' || $month == 'specialB' || $month == 'special')
				{
					echo "<a class=\"box-shadow-outset\" href=\"toc.php?year=$year&amp;month=$month&amp;volume=$volume&amp;issue=$issue\">";
					echo "<img src=\"images/cover/thumbs/$year/$month.jpg\" alt=\"$month thumbnail\" />";
					echo "<p class=\"inum sanskrit\">" . convert_devanagari($year) . "</p></a>";
				}
			}
		}
	}
	echo '</div>';
	if($result){$result->free();}
	$db->close();
?>         
			
			</div>
	</section>
</article>
<?php include("footer.php"); ?>
