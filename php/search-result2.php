<?php include("header.php");?>
<?php include("nav.php"); ?>
<?php include("common.php"); ?>
<?php
	if(empty($_GET['title']) && empty($_GET['author']) && empty($_GET['feature']) && empty($_GET['text']) && empty($_GET['year1']) && empty($_GET['year2'])) {
		header('Location: search.php');
		exit(1);
	}
?>

    		<article id="main">
					<?php
							include("connect.php");
							$db = @new mysqli('localhost', "$user", "$password", "$database");
							$db->set_charset("utf8");
							
							if($db->connect_errno > 0)
							{
								echo '<span class="aFeature clr2">Not connected to the Database</span>';
								echo '</div> <!-- cd-container -->';
								echo '</div> <!-- cd-scrolling-bg -->';
								echo '</main> <!-- cd-main-content -->';
								exit(1);
							}
							
							if(isset($_GET['author'])){$author = $_GET['author'];}else{$author = '';}
							if(isset($_GET['text'])){$text = $_GET['text'];}else{$text = '';}
							if(isset($_GET['title'])){$title = $_GET['title'];}else{$title = '';}
							if(isset($_GET['featid'])){$featid = $_GET['featid'];}else{$featid = '';}
							if(isset($_GET['year1'])){$year1 = $_GET['year1'];}else{$year1 = '';}
							if(isset($_GET['year2'])){$year2 = $_GET['year2'];}else{$year2 = '';}
							
							$text = entityReferenceReplace($text);
							$author = entityReferenceReplace($author);
							$title = entityReferenceReplace($title);
							$featid = entityReferenceReplace($featid);
							$year1 = entityReferenceReplace($year1);
							$year2 = entityReferenceReplace($year2);
							
							$author = preg_replace("/[,\-]+/", " ", $author);
							$author = preg_replace("/[\t]+/", " ", $author);
							$author = preg_replace("/[ ]+/", " ", $author);
							$author = preg_replace("/^ +/", "", $author);
							$author = preg_replace("/ +$/", "", $author);
							$author = preg_replace("/  /", " ", $author);
							$author = preg_replace("/  /", " ", $author);
							
							$title = preg_replace("/[,\-]+/", " ", $title);
							$title = preg_replace("/[\t]+/", " ", $title);
							$title = preg_replace("/[ ]+/", " ", $title);
							$title = preg_replace("/^ +/", "", $title);
							$title = preg_replace("/ +$/", "", $title);
							$title = preg_replace("/  /", " ", $title);
							$title = preg_replace("/  /", " ", $title);
							
							$text = preg_replace("/[,\-]+/", " ", $text);
							$text = preg_replace("/[\t]+/", " ", $text);
							$text = preg_replace("/[ ]+/", " ", $text);
							$text = preg_replace("/^ +/", "", $text);
							$text = preg_replace("/ +$/", "", $text);
							$text = preg_replace("/  /", " ", $text);
							$text = preg_replace("/  /", " ", $text);
							
							if($title=='')
							{
								$title='[अ-ह]*';
							}
							if($author=='')
							{
								$author='[अ-ह]*';
							}
							if($featid=='')
							{
								$featid='[0-9]*';
							}
							
							($year1 == '') ? $year1 = 1994 : $year1 = $year1;
							($year2 == '') ? $year2 = date('Y') : $year2 = $year2;
							
							if($year2 < $year1)
							{
								$tmp = $year1;
								$year1 = $year2;
								$year2 = $tmp;
							}
							
							$authorFilter = '';
							$titleFilter = '';
							$authors = preg_split("/ /", $author);
							$titles = preg_split("/ /", $title);
							
							for($ic=0;$ic<sizeof($authors);$ic++)
							{
								$authorFilter .= "and authorname REGEXP '" . $authors[$ic] . "' ";
							}
							for($ic=0;$ic<sizeof($titles);$ic++)
							{
								$titleFilter .= "and title REGEXP '" . $titles[$ic] . "' ";
							}
							$authorFilter = preg_replace("/^and /", "", $authorFilter);
							$titleFilter = preg_replace("/^and /", "", $titleFilter);
							$titleFilter = preg_replace("/ $/", "", $titleFilter);
							
							if($text=='')
							{
								$query="SELECT * FROM
											(SELECT * FROM
												(SELECT * FROM
													(SELECT * FROM article WHERE $authorFilter) AS tb1
												WHERE $titleFilter) AS tb2
											WHERE featid REGEXP '$featid') AS tb3
										WHERE year between $year1 and $year2 ORDER BY year, month, page";
							}
							elseif($text!='')
							{
								$text = rtrim($text);
								if(preg_match("/^\"/", $text)) {
									$stext = preg_replace("/\"/", "", $text);
									$dtext = $stext;
									$stext = '"' . $stext . '"';
								}
								elseif(preg_match("/\+/", $text)) {
									$stext = preg_replace("/\+/", " +", $text);
									$dtext = preg_replace("/\+/", "|", $text);
									$stext = '+' . $stext;
								}
								elseif(preg_match("/\|/", $text)) {
									$stext = preg_replace("/\|/", " ", $text);
									$dtext = $text;
								}
								else {
									$stext = $text;
									$dtext = $stext = preg_replace("/ /", "|", $text);
									$stext = $text;
								}
								
								$stext = addslashes($stext);
								
								$query="SELECT * FROM
											(SELECT * FROM
												(SELECT * FROM
													(SELECT * FROM
														(SELECT * FROM searchtable WHERE text regexp '$stext' ) AS tb1
													WHERE $authorFilter) AS tb2
												WHERE $titleFilter) AS tb3
											WHERE featid REGEXP '$featid') AS tb4
										WHERE year between $year1 and $year2 ORDER BY year, month, cur_page";
							}
							
							$result = $db->query($query) or die("query fraild"); 
							$num_results = $result ? $result->num_rows : 0;
							//~ echo $query;
							echo '<header class="special container">';
							echo '<span class="icon fa-search"></span>';
								echo'<h2>Search Results</h2>';
								if($num_results > 0)
								{
									echo ($num_results > 1) ? '<p>'.$num_results.'&nbsp;Results</p>' : '<p>'.$num_results.'&nbsp;Result</p>';
								}
								else
								{
									echo '<p>No Results</p>';
								}
							echo '</header>';
					?>
				<section class="wrapper style4 container">
						<div class="content">
								<?php
									$result = $db->query($query); 
									$num_rows = $result ? $result->num_rows : 0;
									$id = 0;
									$year = "";
									$month = "";
									$sd ="";
									if($num_rows > 0)
									{
										for($a=1;$a<=$num_rows;$a++)
										{
											$row=$result->fetch_assoc();
											
											if($a != 1 && (strcmp($id, $row['titleid'])) != 0)
											{
												echo	"</div>";
													echo"</div>";
											}
											
											if($year != $row['volume'] && $month != $row['month'])
											{
												$_SESSION['sd'][$year.$month] = $sd;
												$sd = "";
											}
											if ((strcmp($id, $row['titleid'])) != 0) 
											{
												$authorid = $row['authid'];
												$sumne = preg_split("/;/",$row['authorname']);
												if(count($sumne)>1)
												$authorname = $sumne[1];
												else
												$authorname = $sumne[0];
												
												$authorname1 = preg_replace("/ /","%20",$authorname);
												$volume = $row['volume'];
												$inum = $row['issue'];
												$page = $row['page'];
												$cur_page = "";
												if($text!=''){$cur_page = $row['cur_page'];}
												$title = $row['title'];
												$month = $row['month']; 
												$year = $row['year'];
												$featureid = $row['featid'];
												
												$query1 = "select * from feature where featid = '$featureid'";
												$result1 = $db->query($query1); 
												$row1=$result1->fetch_assoc();
												$fname = $row1['featurename'];
												$featurename = preg_replace("/ /","%20",$row1['featurename']);
												
												$featureid = $row1['featid'];
														
												echo "<div class=\"box\">";
												echo	"<div class=\"inside\">";
												echo		"<a href=\"bookReader2.php?volume=$volume&amp;month=$month&amp;year=$year&amp;page=$cur_page\"><span class=\"titlespan\">".$title."</span></a>&nbsp;|&nbsp;<a href=\"feat.php?featid=$featureid&amp;featname=$featurename\"><span class=\"featurespan\">".$fname."</span></a>&nbsp;|&nbsp;<span class=\"voliss\"><a href=\"toc.php?year=$year&amp;month=$month&amp;volume=$volume&amp;issue=$inum\">".getMonth($month)." $year (Vol. ".intval($volume).", Issue&nbsp;".intval($inum).")</a></span><br/>";
												$sumne = preg_split("/;/",$authorid);
												for($k = 0; $k < count($sumne); $k++)
												{
													$query1 = "select * from author where authid = '$sumne[$k]'";
													$result1 = $db->query($query1); 
													$row1=$result1->fetch_assoc();
													echo	"<a href=\"showAuthorArticles.php?authid=".$row1["authid"]."&amp;authorname=$authorname1\"><span class=\"authorspan\">".$authorname."</span></a>";
													if(count($sumne) > 1 && $k < count($sumne)-1)
													{
														echo "&nbsp;|&nbsp;";
													}
												}
											
												if($text != '')
												{
													echo '<br /><span class="aIssue">Text match found at page(s) : </span>';
													echo "<span class=\"aIssue\"><a href=\"bookReader2.php?volume=$volume&amp;month=$month&amp;year=$year&amp;page=".$row['cur_page']."&amp;text=$text\">" . intval($row['cur_page']) . "</a> </span>";
												}

											}
											else
											{
												if($text != '')
												{
													echo "<span class=\"aIssue\"><a href=\"bookReader2.php?volume=$volume&amp;month=$month&amp;year=$year&amp;page=".$row['cur_page']."&amp;text=$text\">" . intval($row['cur_page']) . "</a> </span>";
												}
											}
											$id = $row['titleid'];
											if($text != '')
											{
												//~******************************************************************************************************
												$query1 = "select * from word where word regexp '".$stext."' and pagenum = '".$row['cur_page']."' and year = '".$year."' and month = '".$month."'" ;
												$result1 = $db->query($query1);
												$num_rows1 = $result1 ? $result1->num_rows : 0;
												$cord = array();
												$array = "";
												for($b = 0; $b < $num_rows1; $b++)
												{
													$row1=$result1->fetch_assoc();
													$sumne = preg_split("/,/", $row1['cords']);
													//~ Base image size is 800X1200
													//~ Also note that coordinate has already been shifted to top left from bottom left (DjVu)
													$sumne[0] = floor($sumne[0] * 800 / $row1['width']);
													$sumne[2] = floor($sumne[2] * 800 / $row1['width']);
													$sumne[1] = floor($sumne[1] * 1200 / $row1['height']);
													$sumne[3] = floor($sumne[3] * 1200 / $row1['height']);
													$cord[] = array("l" => $sumne[0],"b" => $sumne[1],"r" => $sumne[2],"t" => $sumne[3]);
												}
												$row1["text"] = "Searched Text in from the given query";
												$qtext = "Text";
												$row1["text"] = preg_replace("/Text/" , "{{{".$qtext."}}}" , $row1["text"]);
												$array["text"] = $row1["text"];
												$array["par"][] = array( "page" => $row1["pagenum"] , "boxes" => $cord);
												$sd["matches"][] = $array;
												//~****************************************************************************************************** 
											}
											//~ echo json_encode($_SESSION['sd'][$year.$month]);
										}
										echo	"</div>";
										echo"</div>";
									}
									else
									{
										echo "<span class=\"empty topic\">There are no articles beginning with letter&nbsp;:&nbsp;</span>";

									}
									if($result){$result->free();}
									$db->close();

							?>
						</div>
					</section>	
               </article>
				<?php include("footer.php");?>
<?php
	function txtTrimer($text , $qtext){
		//~ return 200 character from $row["text"]
		$pos = stripos($text ,  $qtext);
		($pos - 75 ) < 0 ? $start = 0 : $start = $pos - 75; $end = 200;
		$text = substr($text ,$start , $end);
		$text = preg_replace("/$qtext/i" , "{{{".$qtext."}}}" , $text); 
		return $text;
	}

?>
