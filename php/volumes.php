<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<?php include("common.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-book"></span>
		<h2>
			<strong>
				<span class="head_t1">Volumes | </span> <span class="sanskrit">सम्पुटाः</span>
			</strong>
		</h2>
		<p class="sanskrit">सञ्चिकाः द्रष्टुं ‘वर्षं’ स्पृशत</p>
	</header>
	<section class="wrapper style4 container">
		<div class="content">
			<div class="volumes">
<?php
	include("connect.php");

	$query = "select distinct year from article order by year desc";
	$result = $db->query($query);
	$num_rows = $result ? $result->num_rows : 0;

	$count = 0;
	$col = 1;
	$row_count = 4;

	if($num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$year=$row['year'];

			$query1 = "select distinct volume from article where year='$year'";
			$result1 = $db->query($query1);
			$num_rows1 = $result1 ? $result1->num_rows : 0;

			if($num_rows1 > 0)
			{
				$volume = '';
				while($row1 = $result1->fetch_assoc())
				{
					$volume = $volume . '-' . intval($row1['volume']);
				}
				$volume = preg_replace('/^\-/', '', $volume);

				$count++;
				$year_int = intval($year);
				if($count > $row_count)
				{
					$col++;
					$count = 1;
				}
				$ynum = preg_replace("/^[0]+/", "", $year);
				echo "<a class=\"box-shadow-outset\" href=\"issue.php?year=$year&amp;volume=$volume\">";
				echo (file_exists('images/cover/thumbs/' . $year . '/09.jpg')) ? "<img src=\"images/cover/thumbs/$year/09.jpg\" alt=\"$year thumbnail\" />" : "<img src=\"images/cover/thumbs/$year/01.jpg\" alt=\"$year thumbnail\" />";
				echo "<p class=\"inum\"><span class=\"sanskrit\">" . convert_devanagari($year) . "</span></p></a>";
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
