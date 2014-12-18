<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sambhashana Sandesha</title>
<link href="style/Style.css" rel="stylesheet" />
</head>
<body>
<div class="container">
  <div id="header">
    <div id="ctct"> Email : samskritam@gmail.com<br/>
      Phone : 9900223344 </div>
    <div id="head1"></div>
    <div id="menu">
      <div id="navcontainer">
        <ul id="navlist">
          <li id="active"><a href="../index.php">HOME(उपक्रमः)</a></li>
          <li><a href="about.php">ABOUT US(परिचयः)</a></li>
          <li><a href="subscribe.php">SUBSCRIBE(ग्राहकता)</a></li>
          <li><a href="feedback.php">FEEDBACK(प्रतिपुष्टिः)</a></li>
          <li><a href="contact.php">CONTACT US(सम्पर्कः)</a></li>
          <li><a href="advertise.php">ADVERTISE(विज्ञापना)</a></li>
          <li><a href="volume.php">ARCHIVE(संग्रह)</a>
			<ul id="nav">
				<li><a href="volume.php">VOLUMES</a></li>
				<li><a href="show_article.php?letter=अ">ARTICLES</a></li>
				<li><a href="show_author.php">AUTHORS</a></li>
				<li><a href="feature.php">FEATURES</a></li>
				<li><a href="search.php">SEARCH</a></li>
			</ul>
		</li>
        </ul>
      </div>
    </div>
  </div>
  <div id="cnt">
    <div id="hcnt1"> </div>
    <div id="hcnt2">
      
      <div id="">
        <div id="hcnt7">

<?php

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");

$month_name = array("1"=>"जनवरी","2"=>"फेब्रवरी","3"=>"मार्च्","4"=>"एप्रिल्","5"=>"मे","6"=>"जून्","7"=>"जुलै","8"=>"अगस्ट्","9"=>"सप्टम्बर्","10"=>"अक्टोबर्","11"=>"नवम्बर्","12"=>"डिसेम्बर्");
$month_eng=array('','January','February','March','April','May','June','July','August','September','October','November','December');

$query1 = "SELECT * FROM article where volume='019' and issue='04';";

$result1 = mysql_query($query1);
$num_rows1 = mysql_num_rows($result1);

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
			echo "<div class=\"vnum\">सम्पुट&nbsp;&nbsp;".intval($vnum)."&nbsp;-";
			$vol = $vnum;
		}
		if($iss != $inum)
		{
			echo "&nbsp;सञ्चिका&nbsp;&nbsp;".intval($inum)."&nbsp;&nbsp;:&nbsp;&nbsp;".$month_name{intval($month)}."&nbsp;$year</div>";
			$iss = $inum;
		}
		echo "<li class=\"topic\"><a href=\"\" target=\"_blank\">$title</a>";

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
                    echo "&nbsp;&nbsp;|&nbsp;&nbsp;<span class =\"featspan\"><a href=\"show_feature.php?featureid=$featureid&featurename=$featurename\">$featurename</a></span>";
				}
			}
		}
		echo "</li>";
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
mysqli_close($db);
function replace_space($str)
{
   $str = preg_replace('/ /', "%20", $str);
   return $str;
}
?>
 </p>
        </div>
      </div>
      <p align="center"> <img src="images/Img.jpg" width="728" height="70" /></a><br />
    </div>
    <div id="hcnt3"><img src="images/2.gif" /></div>
    <div id="footer">Copyright &copy; 2010 <a class="two" href="">www.samskrita.in</a> All Rights Reserved. Powered By <a href="http://dhyeyatech.com" target="_blank" class="two">DhyeyaTech</a> and <a href="http://www.vyomalabs.in/" target="_blank" class="two">Vyoma Linguistic Labs Foundation</a>
    </div>
</div>
</div>
</body>
</html>
