<?php 

$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage".$para_path."next_page=$prev$type_navi\"><< previous</a>";
		else
			$pagination.= "<span class=\"disabled\"><< previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage".$para_path."next_page=$counter$type_navi\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage".$para_path."next_page=$counter$type_navi\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage".$para_path."next_page=$lpm1$type_navi\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage".$para_path."next_page=$lastpage$type_navi\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage".$para_path."next_page=1$type_navi\">1</a>";
				$pagination.= "<a href=\"$targetpage".$para_path."next_page=2$type_navi\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage".$para_path."next_page=$counter$type_navi\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage".$para_path."next_page=$lpm1$type_navi\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage".$para_path."next_page=$lastpage$type_navi\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage".$para_path."next_page=1$type_navi\">1</a>";
				$pagination.= "<a href=\"$targetpage".$para_path."next_page=2$type_navi\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage".$para_path."next_page=$counter$type_navi\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage".$para_path."next_page=$next$type_navi\">next >></a>";
		else
			$pagination.= "<span class=\"disabled\">next >></span>";
		$pagination.= "</div>\n";		
	}
?>