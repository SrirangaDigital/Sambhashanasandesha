<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<article id="main">
	<?php
	include("connect.php");
	$volume = $_GET['volume'];
	$year = $_GET['year'];
	?>
	<header class="special container">
		<span class="icon fa-book"></span>
		<h2><strong><?php echo $year; ?></strong></h2>
		<p><?php echo "Volume ".intval($volume); ?></p>
	</header>
	<section class="wrapper style4 container">
		<div class="content">
			<div class="volumes">
<?php


$db = mysql_connect($server,$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");
mysql_set_charset("utf8",$db);
$month_eng=array('','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');

$month_name = array("1"=>"जनवरी","2"=>"फेब्रवरी","3"=>"मार्च्","4"=>"एप्रिल्","5"=>"मे","6"=>"जून्","7"=>"जुलै","8"=>"अगस्ट्","9"=>"सप्टम्बर्","10"=>"अक्टोबर्","11"=>"नवम्बर्","12"=>"डिसेम्बर्");

$row_count = 2;
$query = "select distinct issue,month,volume,year from article where volume = '$volume'";
$result = mysql_query($query);
$num_rows = mysql_num_rows($result);
$vnum = preg_replace("/^[0]+/", "", $volume);


$count = 0;
$col = 1;

$volume_int = intval($volume);
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
			echo "<a class=\"box-shadow-outset\" href=\"toc.php?year=$year&amp;month=$month&amp;volume=$volume&amp;issue=$issue\"><img src=\"images/cover/$temp.jpg\" alt=\"Issue $issue cover page\" /><p class=\"inum\">".$month_eng{intval($month)}."&nbsp;(Issue&nbsp;$inum)</p></a>";
	}
}
echo '</div>';
$db = mysql_close($db);
?>      
</div>
	</section>
</article>
<?php include("footer.php"); ?>
