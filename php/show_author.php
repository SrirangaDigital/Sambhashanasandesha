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
                        <div class="alphabet"><h2>List of authors</h2></div><br><br><br>
                        <div class="letters">
                            <a href="show_author.php?letter=अ">अ</a>
                            <a href="show_author.php?letter=आ">आ</a>
                            <a href="show_author.php?letter=इ">इ</a>
                            <a href="show_author.php?letter=ई">ई</a>
                            <a href="show_author.php?letter=उ">उ</a>
                            <a href="show_author.php?letter=ऊ">ऊ</a>
                            <a href="show_author.php?letter=ऋ">ऋ</a>
                            <a href="show_author.php?letter=ए">ए</a>
                            <a href="show_author.php?letter=ऐ">ऐ</a>
                            <a href="show_author.php?letter=ओ">ओ</a>
                            <a href="show_author.php?letter=औ">औ</a>
                            <a href="show_author.php?letter=अं">अं</a>
                            <a href="show_author.php?letter=अः">अः</a><br />
		
                            <a href="show_author.php?letter=क">क</a>
                            <a href="show_author.php?letter=ख">ख</a>
                            <a href="show_author.php?letter=ग">ग</a>
                            <a href="show_author.php?letter=घ">घ</a>
                            <a href="show_author.php?letter=ङ">ङ</a><br />
	
                            <a href="show_author.php?letter=च">च</a>
                            <a href="show_author.php?letter=छ">छ</a>
                            <a href="show_author.php?letter=ज">ज</a>
                            <a href="show_author.php?letter=झ">झ</a>
                            <a href="show_author.php?letter=ञ">ञ</a><br />
		
                            <a href="show_author.php?letter=ट">ट</a>
                            <a href="show_author.php?letter=ठ">ठ</a>
                            <a href="show_author.php?letter=ड">ड</a>
                            <a href="show_author.php?letter=ढ़">ढ़</a>
                            <a href="show_author.php?letter=ण">ण</a><br />
		
                            <a href="show_author.php?letter=त">त</a>
                            <a href="show_author.php?letter=थ">थ</a>
                            <a href="show_author.php?letter=द">द</a>
                            <a href="show_author.php?letter=ध">ध</a>
                            <a href="show_author.php?letter=न">न</a><br />
	
                            <a href="show_author.php?letter=प">प</a>
                            <a href="show_author.php?letter=फ">फ</a>
                            <a href="show_author.php?letter=ब">ब</a>
                            <a href="show_author.php?letter=भ">भ</a>
                            <a href="show_author.php?letter=म">म</a><br />


                            <a href="show_author.php?letter=य">य</a>
                            <a href="show_author.php?letter=र">र</a>
                            <a href="show_author.php?letter=ल">ल</a>
                            <a href="show_author.php?letter=व">व</a>
                            <a href="show_author.php?letter=श">श</a>
                            <a href="show_author.php?letter=ष">ष</a>
                            <a href="show_author.php?letter=स">स</a>
                            <a href="show_author.php?letter=ह">ह</a>
                            <a href="show_author.php?letter=ळ">ळ</a>
                        </div>
				
<?php

$letter = $_GET['letter'];

include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");


$query1 = "select * from author where authorname like '$letter%' order by authorname";
$result1 = mysql_query($query1);
$num_rows1 = mysql_num_rows($result1);
echo "<div class=\"author_main\">";

if($num_rows1)
{
    echo "<ul>";
	for($a=1;$a<=$num_rows1;$a++)
	{
		$row1=mysql_fetch_assoc($result1);
		$authorname = $row1['authorname'];
        $sal = $row1['sal'];
		$authorid = $row1['authid'];
        if($sal == '')
        {
            echo "<li class=\"authors\"><a href=\"author.php?authorname=$sal%20".replace_space($authorname)."&amp;authorid=$authorid\">$authorname</a></li>";
        }
        else
        {
            echo "<li class=\"authors\"><a href=\"author.php?authorname=$sal%20".replace_space($authorname)."&amp;authorid=$authorid\">$sal&nbsp;$authorname</a></li>";
        }
    }
	echo "</ul>";
}
else
{
	echo "<span class=\"empty topic\">There are no authors beginning with letter&nbsp;:&nbsp;$letter</span>";

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

