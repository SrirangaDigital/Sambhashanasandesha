<?php include("header.php");?>
<?php include("nav.php"); ?>
<?php include("common.php"); ?>
<?php
	if(empty($_GET['title']) && empty($_GET['author']) && empty($_GET['featid']) && empty($_GET['text']) && empty($_GET['year1']) && empty($_GET['year2'])) {
		header('Location: search.php');
		exit(1);
	}
?>

    		<article id="main">
					<?php
							include("connect.php");
							$db=mysql_connect('localhost', "$user", "$password") or die("Not Connected to databases");
							mysql_select_db("$database",$db);
							mysql_set_charset("utf8",$db);
							
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
							

							$result = mysql_query($query) or die("query failed".mysql_error()); 
							$num_rows = $num_results = $result ? mysql_num_rows($result) : 0;
							echo $query;
							echo '<header class="special container">';
							echo '<span class="icon fa-search"></span>';
								echo'<h2>अन्वेषणस्य फलम्</h2>';
								if($num_results > 0)
								{
									echo ($num_results > 1) ? '<p>' . convert_devanagari($num_results) . ' परिणामाः</p>' : '<p>' . convert_devanagari($num_results) . ' परिणामः</p>';
								}
							echo '</header>';
					?>
				<section class="wrapper style4 container">
						<div class="content">
								<?php
									//~ $result = $db->query($query); 
									//~ $num_rows = $result ? $result->num_rows : 0;
									$id = 0;
									$year = "";
									$month = "";
									if($num_rows > 0)
									{
										for($a=1;$a<=$num_rows;$a++)
										{
											$row=mysql_fetch_assoc($result);
											
											if($a != 1 && (strcmp($id, $row['titleid'])) != 0)
											{
												echo	"</div>";
													echo"</div>";
											}
											if ((strcmp($id, $row['titleid'])) != 0) 
											{
												$authorid = $row['authid'];
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
												$result1 = mysql_query($query1); 
												$row1=mysql_fetch_assoc($result1);
												$fname = $row1['featurename'];
												$featurename = preg_replace("/ /","%20",$row1['featurename']);
												
												$featureid = $row1['featid'];
														
												echo "<div class=\"box\">";
												echo	"<div class=\"inside\">";
												echo		"<a href=\"bookReader.php?volume=$volume&amp;month=$month&amp;year=$year&amp;page=$page\"><span class=\"titlespan\">".$title."</span></a>&nbsp;|&nbsp;<a href=\"feat.php?featid=$featureid&amp;featname=$featurename\"><span class=\"featurespan\">".$fname."</span></a>&nbsp;|&nbsp;<span class=\"voliss\"><a href=\"toc.php?year=$year&amp;month=$month&amp;volume=$volume&amp;issue=$inum\">" . getMonthDevanagari($month) . " ". convert_devanagari($year) . " (सम्पुटः " . convert_devanagari(intval($volume)) . ", सञ्चिका " . convert_devanagari(intval($inum)) . ")</a></span><br/>";
												if($authorid != "")
												{
													$sumne = preg_split("/;/",$authorid);
													for($k = 0; $k < count($sumne); $k++)
													{
														$query1 = "select * from author where authid = '$sumne[$k]'";
														$result1 = mysql_query($query1); 
														$row1=mysql_fetch_assoc($result1);
														echo	"<a href=\"showAuthorArticles.php?authid=".$row1["authid"]."&amp;authorname=".preg_replace("/ /","%20",$row1["authorname"])."\"><span class=\"authorspan\">".$row1["authorname"]."</span></a>";
														if(count($sumne) > 1 && $k < count($sumne)-1)
														{
															echo "&nbsp;|&nbsp;";
														}
													}
												}
												
											
												if($text != '')
												{
													if($authorid != ""){echo "<br />";}
													echo '<span class="aIssue">Text match found at page(s) : </span>';
													echo "<span class=\"aIssue\"><a href=\"bookReader.php?volume=$volume&amp;month=$month&amp;year=$year&amp;page=".$row['cur_page']."&amp;text=$text\">" . intval($row['cur_page']) . "</a> </span>";
												}

											}
											else
											{
												if($text != '')
												{
													echo "<span class=\"aIssue\"><a href=\"bookReader.php?volume=$volume&amp;month=$month&amp;year=$year&amp;page=".$row['cur_page']."&amp;text=$text\">" . intval($row['cur_page']) . "</a> </span>";
												}
											}
											$id = $row['titleid'];
										}
										echo	"</div>";
										echo"</div>";
									}
									else
									{
										echo "<span class=\"empty topic\">परिणामः नास्ति</span>";

									}
									mysql_close();

							?>
						</div>
					</section>	
               </article>
				<?php include("footer.php");?>
