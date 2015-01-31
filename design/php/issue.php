<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-newspaper-o"></span>
		<h2><strong>Issue</strong></h2>
		<p>Select a Month to view the articles.</p>
	</header>
	<section class="wrapper style4 container">
		<div class="content">
			<div class="volumes">
<?php

include("connect.php");
$volume = $_GET['volume'];
$year = $_GET['year'];

$db = mysql_connect($server,$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");
mysql_set_charset("utf8",$db);

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

//~ echo "<div class=\"alphabet\"><h2>Volume $volume_int, $year</h2></div>";
//~ echo "<br>";
//~ echo "<br>";
//~ echo "<br>";
//~ echo "<div class=\"auther_main\">";
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
			echo "<a class=\"box-shadow-outset\" href=\"toc.php?volume=$volume&issue=$issue\"><img src=\"images/cover/$temp.jpg\" alt=\"Issue $issue cover page\" /><p class=\"inum\">".$month_eng{intval($month)}."(Issue&nbsp;$inum&nbsp;)</p></a>";
	}
}
$db = mysql_close($db);
?>      
</div>
	</section>
</article>
<?php include("footer.php"); ?>
