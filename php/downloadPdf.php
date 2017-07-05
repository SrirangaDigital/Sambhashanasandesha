<?php
	
	
	if(isset($_GET['titleid']) && $_GET['titleid'] != "")
	{
		$titleid = $_GET['titleid'];
		include("connect.php");

		$query = "select * from article where titleid =  $titleid";
		$result = $db->query($query);
		$row = $result->fetch_assoc();
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
		$result1 = $db->query($query1);
		$numOfRows1 = $result1 ? $result1->num_rows : 0;
		$pdfList='';

		for($j = 0; $j < $numOfRows1; $j++)
		{
			$row1 = $result1->fetch_assoc();
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
