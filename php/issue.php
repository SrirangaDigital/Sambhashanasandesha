<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<?php include("common.php"); ?>
<article id="main">
	<?php
	include("connect.php");
	$year = $_GET['year'];
	$volume = $_GET['volume'];
	?>
	<header class="special container">
		<span class="icon fa-book"></span>
		<h2>
			<strong>
				<?php echo "<span class=\"head_t2\">" . $year . " | </span>"; ?>
				<?php echo convert_devanagari($year); ?>
			</strong>
		</h2>
		<p>
			<strong>
				<?php echo "Volume&nbsp;" . $volume . " | "; ?>
				<?php echo "सम्पुटाः " . convert_devanagari($volume); ?>
			</strong>
		</p>
	</header>
	<section class="wrapper style4 container">
		<div class="content">
			<div class="volumes">
<?php

$db = mysql_connect($server,$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");
mysql_query("set names utf8");
$month_eng=array('','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');

$month_name = array("1"=>"जनवरी","2"=>"फेब्रवरी","3"=>"मार्च्","4"=>"एप्रिल्","5"=>"मे","6"=>"जून्","7"=>"जुलै","8"=>"अगस्ट्","9"=>"सप्टम्बर्","10"=>"अक्टोबर्","11"=>"नवम्बर्","12"=>"डिसेम्बर्");

$row_count = 2;
$query = "select distinct issue,month,volume,year from article where year = '$year' order by month";
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
			echo "<a class=\"box-shadow-outset\" href=\"toc.php?year=$year&amp;month=$month&amp;volume=$volume&amp;issue=$issue\"><img src=\"images/cover/thumbs/$year/$month.jpg\" alt=\"$year $month coverpage\" /><p class=\"inum\">" . getMonthDevanagari($month) . "</p></a>";
	}
}
echo '</div>';
$db = mysql_close($db);
?>      
</div>
	</section>
</article>
<?php include("footer.php"); ?>
