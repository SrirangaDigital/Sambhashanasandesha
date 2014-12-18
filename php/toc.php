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
$volume = $_GET['volume'];
$issue = $_GET['issue'];
		
include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$month_name = array("1"=>"जनवरी","2"=>"फेब्रवरी","3"=>"मार्च्","4"=>"एप्रिल्","5"=>"मे","6"=>"जून्","7"=>"जुलै","8"=>"अगस्ट्","9"=>"सप्टम्बर्","10"=>"अक्टोबर्","11"=>"नवम्बर्","12"=>"डिसेम्बर्");
$month_eng=array('','January','February','March','April','May','June','July','August','September','October','November','December');
$type = array("1"=>"मूलम्","2"=>"अनु.","3"=>"सं","4"=>"चित्रम् ","5"=>"प्रायोजकः","6"=>"पद्याण","7"=>"कथा");


$query1 = "SELECT * FROM article where volume='$volume' and issue='$issue'";

$result1 = mysql_query($query1);
$num_rows1 = mysql_num_rows($result1);
$iss = $issue+1;
$vol = $volume+1;
if($num_rows1)
{
	for($a=1;$a<=$num_rows1;$a++)
	{
		$row1=mysql_fetch_assoc($result1);
		$vnum = $row1['volume'];
		$inum = $row1['issue'];
		$title = $row1['title'];
		$authorid = $row1['authid'];
		$authname = $row1['authorname'];
		$page = $row1['page'];
		$month = $row1['month'];
		$year = $row1['year'];
		$featureid = $row1['featid'];
	
        if($vol != $vnum)
		{
			$volume = preg_replace("/^[0]+/", "", $vnum);
            echo "<div class=\"gap_above\"><span>Volume</span>&nbsp;$volume&nbsp;";
			$vol = $vnum;
		}
		if ($iss != $inum)
		{   
			$issue = preg_replace("/^[0]+/", "", $inum);
            echo "&nbsp;<span style=font-size:1.09em;>Issue</span>&nbsp;$issue&nbsp;&nbsp;:&nbsp;&nbsp;<span style=font-size:1.09em;>".$month_eng{intval($month)}."</span>&nbsp;$year</div>";
			echo "<hr style=width:50%;float:left;margin-left:1em;>";
			$iss = $inum;
		}
		
		echo "<ul>";
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
					echo "&nbsp;&nbsp;|&nbsp;&nbsp;<span class =\"article_span\"><a href=\"show_feature.php?featureid=$featureid&amp;featurename=".replace_space($featurename)."\">$featurename</a></span>";
				}
			}
		}
		echo "</li>";
        echo "</ul>";
		if($authorid != 0)
		{
			$authors_list = preg_split("/;/",$authname);
			$author_ids_list = preg_split("/;/", $authorid);
			
			$i = 0;
			$count = sizeof($authors_list);
			if($count == 1)
			{
				$authorname = preg_split("/\|/",$authors_list[$i]);
				if($authorname[1] == 1)
				{
					echo "<span class=\"auth\"><a href=\"author.php?authorname=".replace_space($authorname[0])."&amp;authorid=$author_ids_list[$i]\">$authorname[0]</a></span>";
				}
				else
				{
					echo "<span class=\"auth\"><a href=\"author.php?authorname=".replace_space($authorname[0])."&amp;authorid=$author_ids_list[$i]\">$authorname[0]&nbsp;(".$type{intval($authorname[1])}.")</a></span>";
				}
			}
			elseif($count > 1)
			{
				$list_n = array();
				$list_t = array();
			
				for($i=0;$i<sizeof($authors_list);$i++)
				{
					$temp = array();
					$temp = preg_split("/\|/",$authors_list[$i]);
					$list_n[$i] = $temp[0];
					$list_t[$i] = $temp[1];
				}
				$flag = 0;
				for($i=0;$i<sizeof($list_n);$i++)
				{
					if($flag == 0)
                    {
                        echo "<span class=\"auth\"><a href=\"author.php?authorname=".replace_space($list_n[$i])."&amp;authorid=$author_ids_list[$i]\">$list_n[$i]&nbsp;(".$type{$list_t[$i]}.")</a></span>";
                        $flag = 1;
                    }
                    else
                    {
                        echo "<span class=\"auth\"><span style=font-weight:bold>;</span></span><span class=\"auth\"><a href=\"author.php?authorname=".replace_space($list_n[$i])."&amp;authorid=$author_ids_list[$i]\">$list_n[$i]&nbsp;(".$type{$list_t[$i]}.")</a></span>";
                    }
                }
            }
		}
	}
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
</div>
</body>
</html> 
