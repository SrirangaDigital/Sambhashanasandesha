<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>​सम्भाषण सन्देशः</title>
<link href="style/reset.css" rel="stylesheet" />
<link href="style/style.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
		<div class="page">
			<div class="header">
				<div class="image">
					<img src="images/SS.png" alt="sambhashana sandesha Logo" style="width:350px">
				</div>
                <ul id="menu">
					<li><a href="../index.html">HOME</a></li>
					<li><a href="about.php">ABOUT</a></li>
					<li><a href="subscribe.php">SUBSCRIBE</a></li>
					<li><a href="contact.php">CONTACT</a></li>
					<li><a href="volume.php">ARCHIVE</a></li>
				</ul>
            </div>
            <div class="display_content">
				<div class="nav_archive sticky">
					<ul class="nav_archive_eng" style="float: left;">
						<li><a href="volume.php">Volumes</a></li>
						<li><a href="show_article.php?letter=अ">Articles</a></li>
						<li><a href="show_author.php?letter=अ">Authors</a></li>
						<li><a href="feature.php">Category</a></li>
						<li><a href="search.php">Search</a></li>
					</ul>
				</div>
				<div class="widget12">
					<div class="col2 largeSpace">
<?php
include("connect.php");
$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");
echo "<div class=\"alphabet\"><h2>Volumes</h2></div>";
echo "<br><br>";

$row_count = 4;
$query = "select distinct volume from article order by volume";
$result = mysql_query($query);

$num_rows = mysql_num_rows($result);

$count = 0;
$col = 1;

echo "<div class=\"author_main\">";
echo"<br />";

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
			echo "\n<a class=\"issue\" href=\"issue.php?volume=$volume&amp;year=$year\"><img src=\"cover/$vnum.png\" alt=\"Issue $vnum cover page\" /><p class=\"inum\">$year</p></a>";
        }
	}
}
echo "</div>";
mysql_close($db);
?>      
                    </div> 
                </div>     
            </div>
		</div>
        <div class="footer_top">&nbsp;</div>
        <div class="footer">
            <div class="footer_inside">
                <p><span class="bld">SAMBHASHANA SANDESHA,</span><br />
                “Aksharam”, 8th cross,<br> Girinagar 2nd phase<br />
                Bangalore - 560 085<br />
                INDIA<br />
                </p>
                <p>Tel. : +91 80 2672 1052 / 2672 2576</p>
                <p class="bld">samskritam@gmail.com</p>
            </div>
        </div>
    </div>
</body>
</html> 
