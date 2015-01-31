<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8" />
<title>​सम्भाषण सन्देशः</title>
<link href="style/reset.css" rel="stylesheet" />
<link href="style/style.css" rel="stylesheet" />
</head>
<body>
<script type="text/javascript" src="js/sticky.js"></script>
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
mysql_set_charset("utf8",$db);

echo "<div class=\"alphabet\"><h2>List of Features</h2></div>";
$query1 = "select * from feature order by featurename";


$result1 = mysql_query($query1);
$num_rows1 = mysql_num_rows($result1);


echo "<div class=\"author_main\">";	
echo "<br><br><br>";
if($num_rows1)
{
    echo "<ul>";
	for($a=1;$a<=$num_rows1;$a++)
	{
		$row1=mysql_fetch_assoc($result1);
		$featurename = $row1['featurename'];
		$featureid = $row1['featid'];
	
		if($featurename != "")
		{
			echo "<li class =\"authors\"><a href=\"show_feature.php?featureid=$featureid&amp;featurename=".replace_space($featurename)."\">$featurename</a></li>";
		}
	}
    echo "</ul>";
}
echo "</div>";
mysql_close($db);
function replace_space($str)
{
   $str = preg_replace('/ /', "%20", $str);
   return $str;
}
?>	     
          
           </div> 
          </div>     
        </div>
    </div>
</div>
<div class="footer_top">&nbsp;</div>
<div class="footer">
    <div class="footer_inside">
		<p>
			<span class="bld">SAMBHASHANA SANDESHA,</span><br />
			“Aksharam”, 8th cross,<br> Girinagar 2nd phase<br />
			Bangalore - 560 085<br />
			INDIA<br />
		</p>
		<p>Tel. : +91 80 2672 1052 / 2672 2576</p>
		<p class="bld">samskritam@gmail.com</p>
	</div>
</div>
</body>
</html> 
