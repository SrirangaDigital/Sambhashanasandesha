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
$authorid = $_GET['authorid'];
$authorname = $_GET['authorname'];

include("connect.php");

$db = mysql_connect($server,$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");
mysql_set_charset("utf8",$db);
$month_name = array("1"=>"जनवरी","2"=>"फेब्रवरी","3"=>"मार्च्","4"=>"एप्रिल्","5"=>"मे","6"=>"जून्","7"=>"जुलै","8"=>"अगस्ट्","9"=>"सप्टम्बर्","10"=>"अक्टोबर्","11"=>"नवम्बर्","12"=>"डिसेम्बर्");
$month_eng=array('','January','February','March','April','May','June','July','August','September','October','November','December');

echo "<div class=\"alphabet\"><h2>Articles by &nbsp;$authorname &nbsp;</h2></div><br>";
echo "<br><br>";

$query1 = "select * from article where authid like '%$authorid%'";

$result1 = mysql_query($query1);
$num_rows1 = mysql_num_rows($result1);

if($num_rows1)
{
    echo "<ul>";
    for($a=1;$a<=$num_rows1;$a++)
	{
		$row1=mysql_fetch_assoc($result1);
		$vnum = $row1['volume'];
		$inum = $row1['issue'];
		$title = $row1['title'];
		$page = $row1['page'];
		$month = $row1['month'];
		$year = $row1['year'];
		$featureid = $row1['featid'];
	
		echo "<li class=\"topic\"><a href=\"../Volumes/$year/$month/index.djvu?djvuopts&amp;page=$page.djvu&amp;zoom=page\" target=\"_blank\">$title</a>";
		
		$query2 = "select * from feature where featid = '$featureid'";
		$result2 = mysql_query($query2);
		$num_rows2 = mysql_num_rows($result2);
		if($num_rows2)
		{
			for($i=1;$i<=$num_rows2;$i++)
			{
				$row2=mysql_fetch_assoc($result2);
				$featurename = $row2['featurename'];
				$featureid = $row2['featid'];
				if($featurename != "")
				{
                    echo "&nbsp;&nbsp;|&nbsp;&nbsp;<span class =\"featspan\"><a href=\"show_feature.php?featureid=$featureid&amp;featurename=".replace_space($featurename)."\">$featurename</a></span>";
                }
			}
		}
		$issue = $inum;
		$volume = $vnum;
		$issue = preg_replace("/^[0]+/", "", $inum);
		$vnum = preg_replace("/^[0]+/", "", $vnum);
			echo "&nbsp;&nbsp;|&nbsp;&nbsp;";
			echo "<span class=\"month\"><a href=\"toc.php?volume=$volume&amp;issue=$inum\">".$month_eng{intval($month)}."&nbsp;$year";
			echo ",&nbsp;$vnum($issue)</a></span>";
			echo "</li>";
		}
        echo "</ul>";
}

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
