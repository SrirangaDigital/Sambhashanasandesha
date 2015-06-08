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
	$db = mysql_connect($server,$user,$password) or die("Not connected to database");
	$rs = mysql_select_db($database,$db) or die("No Database");
	mysql_query("set names utf8");
	
	$row_count = 4;
	$query = "select distinct year from article order by year desc";
	$result = mysql_query($query);

	$num_rows = mysql_num_rows($result);

	$count = 0;
	$col = 1;
	if($num_rows)
	{
		for($i=1;$i<=$num_rows;$i++)
		{
			$row=mysql_fetch_assoc($result);
			$year=$row['year'];

			$query1 = "select distinct volume from article where year='$year'";
			$result1 = mysql_query($query1);
			$num_rows1 = mysql_num_rows($result1);
			if($num_rows1)
			{

				$volume = '';
				for($i1=1;$i1<=$num_rows1;$i1++)
				{
					$row1=mysql_fetch_assoc($result1);

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
	$db=mysql_close($db);
?>         
			
			</div>
	</section>
</article>
<?php include("footer.php"); ?>
