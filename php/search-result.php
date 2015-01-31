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
                        <div class="alphabet"><h2>Search Result(s)</h2></div><br><br><br><br>
<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");
mysql_set_charset("utf8",$db);
$author=$_POST['author'];
$title=$_POST['title'];
$feature=$_POST['feature'];

$author = preg_replace("/[\t]+/", " ", $author);
$author = preg_replace("/[ ]+/", " ", $author);
$author = preg_replace("/^ /", "", $author);

$title = preg_replace("/[\t]+/", " ", $title);
$title = preg_replace("/[ ]+/", " ", $title);
$title = preg_replace("/^ /", "", $title);

if($author=='')
{
	$author='[a-z]*';
}
if($title=='')
{
	$title='[a-z]*';
}
if($feature=='')
{
	$feature='[0-9]*';
}

$month_name = array("1"=>"जनवरी","2"=>"फेब्रवरी","3"=>"मार्च्","4"=>"एप्रिल्","5"=>"मे","6"=>"जून्","7"=>"जुलै","8"=>"अगस्ट्","9"=>"सप्टम्बर्","10"=>"अक्टोबर्","11"=>"नवम्बर्","12"=>"डिसेम्बर्");
$month_eng=array('','January','February','March','April','May','June','July','August','September','October','November','December');

$query="SELECT * FROM
					(SELECT * FROM
						(SELECT * FROM
							(SELECT * FROM article WHERE authorname REGEXP '$author') AS tb1
					WHERE title REGEXP '$title') AS tb2
					WHERE featid REGEXP '$feature') AS tb3
					ORDER BY volume, issue, page";
#echo $query;
$result = mysql_query($query);
$num_rows = mysql_num_rows($result);
if($num_rows)
{
	for($a=1;$a<=$num_rows;$a++)
	{
		$row=mysql_fetch_assoc($result);
		$authorid = $row['authid'];
		$authname = $row['authorname'];
		$volume = $row['volume'];
		$inum = $row['issue'];
		$page = $row['page'];
		$title = $row['title'];
		$month = $row['month'];
		$year = $row['year'];
		$featureid = $row['featid'];
	
		$query1 = "select * from feature where featid = '$featureid'";
		$result1 = mysql_query($query1);
		$num_rows1 = mysql_num_rows($result1);
	
		if($num_rows1)
		{
            echo "\n<ul>";
            for($k=1;$k<=$num_rows1;$k++)
			{
				$row1=mysql_fetch_assoc($result1);
				$featurename = $row1['featurename'];
				$featureid = $row1['featid'];
				echo "<li class=\"topic\"><a href=\"../Volumes/$year/$month/index.djvu?djvuopts&amp;page=$page.djvu&amp;zoom=page\" target=\"_blank\">$title</a>";
				
				if($featurename != "")
				{
					echo "&nbsp;&nbsp;|&nbsp;&nbsp;";
					echo "<a href=\"show_feature.php?featureid=$featureid&amp;featurename=".replace_space($featurename)."\">$featurename</a>";
				}
			}
			$issue = preg_replace("/^[0]+/", "", $inum);
			$vnum = preg_replace("/^[0]+/", "", $volume);
			echo "&nbsp;&nbsp;|&nbsp;&nbsp;";
			echo "<span class=\"month\"><a href=\"toc.php?volume=$volume&amp;issue=$inum\">".$month_eng{intval($month)}."&nbsp;$year";
			echo ",&nbsp;$vnum($issue)</a></span>";
			echo "</li>";
            echo "</ul>\n";
		}
        
		$type = array("1"=>"मूलम्","2"=>"अनु.","3"=>"सं","4"=>"चित्रम् ","5"=>"प्रायोजकः","6"=>"पद्याण","7"=>"कथा");
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
else
{
	echo "<div class=\"empty topic\">No results</div>";
	echo "<div class=\"empty topic\"><a href=\"search.php\">Go back and Search again</a></div>";

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
