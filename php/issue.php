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
$volume = $_GET['volume'];
$year = $_GET['year'];

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");


$month_eng=array('','January','February','March','April','May','June','July','August','September','October','November','December');

$month_name = array("1"=>"जनवरी","2"=>"फेब्रवरी","3"=>"मार्च्","4"=>"एप्रिल्","5"=>"मे","6"=>"जून्","7"=>"जुलै","8"=>"अगस्ट्","9"=>"सप्टम्बर्","10"=>"अक्टोबर्","11"=>"नवम्बर्","12"=>"डिसेम्बर्");
$row_count = 2;
$query = "select distinct issue,month,volume,year from article where volume = '$volume'";
$result = mysql_query($query);
$num_rows = mysql_num_rows($result);
$vnum = preg_replace("/^[0]+/", "", $volume);


$count = 0;
$col = 1;

$volume_int = intval($volume);

echo "<div class=\"alphabet\"><h2>Volume $volume_int, $year</h2></div>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<div class=\"author_main\">";
if($num_rows)
{
	for($i=1;$i<=$num_rows;$i++)
	{
		$row=mysql_fetch_assoc($result);

		$volume=$row['volume'];
		$issue=$row['issue'];
		$month=$row['month'];
		$year=$row['year'];
	
		$count++;
        if($count > $row_count)
		{
			$col++;
			$count = 1;
		}
		$temp=$year."_".$month;
		$inum = preg_replace("/^[0]+/", "", $issue);
		echo "<a class=\"main_issue\" href=\"toc.php?volume=$volume&amp;issue=$issue\"><img src=\"cover/$temp.jpg\" alt=\"Issue $issue cover page\" />&nbsp;Issue&nbsp;$inum&nbsp;(".$month_eng{intval($month)}.")</a>\n";

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
