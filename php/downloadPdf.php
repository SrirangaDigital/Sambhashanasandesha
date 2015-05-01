<?php
	
	
	if(isset($_GET['titleid']) && $_GET['titleid'] != "")
	{
		$titleid = $_GET['titleid'];
		include("connect.php");
		$db = mysql_connect($server,$user,$password) or die("Not connected to database");
		$rs = mysql_select_db($database,$db) or die("No Database");
		mysql_query("set names utf8");
			
		$query = "select * from article where titleid =  $titleid";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		$year = $row['year'];
		$month = $row['month'];
		$pdfList = "";
		$str = '';
		$pageRangeList = preg_split('/;/',$row['page']);
		
		for($i = 0; $i < count($pageRangeList); $i++)
		{
			$pageRange = preg_split('/-/',$pageRangeList[$i]);
			$str .= "'".$pageRange[0]."' and '".$pageRange[1]."' or cur_page between ";
		}
		
		$str = preg_replace("/ or cur_page between $/", "" ,$str);
		$query1 = "select * from testocr where year='$year' and month='$month' and (cur_page between $str)";
		$result1 = mysql_query($query1) or die(mysql_error());
		$numOfRows1 = mysql_num_rows($result1);
		$pdfList='';
		
		for($j = 0; $j < $numOfRows1; $j++)
		{
			$row1 = mysql_fetch_assoc($result1);
			$pdfList .=  "../Volumes/pdf/".$row['year']."/".$row['month']."/".$row1["cur_page"].".pdf ";
		}
	}
	elseif((isset($_GET['year']) && $_GET['year'] != "") && (isset($_GET['month']) && $_GET['month'] != ""))
	{
		$year = $_GET['year'];
		$month = $_GET['month'];
		$pdfurl = "../Volumes/pdf/".$year."/".$month;
		$pdfArrayList=scandir($pdfurl);
		
		$pdfList='';
		for($i=0;$i<count($pdfArrayList);$i++)
		{
			if($pdfArrayList[$i] != '.' && $pdfArrayList[$i] != '..' && preg_match('/(\.pdf)/' , $pdfArrayList[$i]))
			{
				$pdfList .= " ".$pdfurl."/".$pdfArrayList[$i];
			}
		}
	}
		
	$outFilename = '../ReadWrite/' . time() . '-' . $year . '-' . $month . '.pdf';
	system ('pdftk '.$pdfList.' cat output ' . $outFilename);
	@header("Location: $outFilename");
	
	
    //~ $file_name = $outFilename;
    //~ $file = $outFilename;
    //~ if (file_exists($file)) {
        //~ header('Content-Type: ' . mime_content_type($file_name));
        //~ header('Content-Disposition: attachment;filename="' . basename($file_name) . '"');
        //~ header('Content-Length: ' . filesize($file));
        //~ readfile($file);
    //~ } else {
        //~ header('HTTP/1.1 404 Not Found');
    //~ }
?>
