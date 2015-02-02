<!--
<?php
	// If nothing is GETed, redirect to search page
	if(empty($_GET['author']) && empty($_GET['title']) && empty($_GET['year1']) && empty($_GET['year2'])) {
		header('Location: search.php');
		exit(1);
	}
?>
-->

    <?php include("header.php");?>
	<?php include("nav.php"); ?>
	<?php include("common.php"); ?>
			<article id="main">
					<?php
							include("connect.php");
							$db = mysql_connect($server,$user,$password) or die("Not connected to database");
							$rs = mysql_select_db($database,$db) or die("No Database");
							mysql_set_charset("utf8",$db);
							
							if(mysql_error() > 0)
							{
								echo '<span class="aFeature clr2">Not connected to the Database</span>';
								echo '</div> <!-- cd-container -->';
								echo '</div> <!-- cd-scrolling-bg -->';
								echo '</main> <!-- cd-main-content -->';
								//~ include("include_footer.php");
								exit(1);
							}
							if(isset($_GET['author'])){$author = $_GET['author'];}else{$author = '';}
							//~ if(isset($_GET['text'])){$text = $_GET['text'];}else{$text = '';}
							if(isset($_GET['title'])){$title = $_GET['title'];}else{$title = '';}
							if(isset($_GET['featid'])){$featid = $_GET['featid'];}else{$featid = '';}
							if(isset($_GET['year1'])){$year1 = $_GET['year1'];}else{$year1 = '';}
							if(isset($_GET['year2'])){$year2 = $_GET['year2'];}else{$year2 = '';}
							//~ $text = entityReferenceReplace($text);
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
							//~ $text = preg_replace("/[,\-]+/", " ", $text);
							//~ $text = preg_replace("/[\t]+/", " ", $text);
							//~ $text = preg_replace("/[ ]+/", " ", $text);
							//~ $text = preg_replace("/^ +/", "", $text);
							//~ $text = preg_replace("/ +$/", "", $text);
							//~ $text = preg_replace("/  /", " ", $text);
							//~ $text = preg_replace("/  /", " ", $text);
							if($title=='')
							{
								$title='[a-z]*';
							}
							if($author=='')
							{
								$author='[a-z]*';
							}
							if($featid=='')
							{
								$featid='[a-z]*';
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
							
							$query="SELECT * FROM
										(SELECT * FROM
											(SELECT * FROM
												(SELECT * FROM article WHERE $authorFilter) AS tb1
											WHERE $titleFilter) AS tb2
										WHERE featid REGEXP '$featid') AS tb3
									WHERE year between $year1 and $year2 ORDER BY volume, issue, page";
							
							$result = mysql_query($query); 
							$num_results = $result ? mysql_num_rows($result) : 0;
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
									$result = mysql_query($query);
									$num_rows = mysql_num_rows($result);
									
									if($num_rows)
									{
										for($a=1;$a<=$num_rows;$a++)
										{
											$row=mysql_fetch_assoc($result);
											$authorid = $row['authid'];
											$sumne = preg_split("/;/",$row['authorname']);
											if(count($sumne)>1)
											{
												$authorname = $sumne[1];
											}
											else
											{
												$authorname = $sumne[0];
											}
											$authorname1 = preg_replace("/ /","%20",$authorname);
											$volume = $row['volume'];
											$inum = $row['issue'];
											$page = $row['page'];
											$title = $row['title'];
											$month = $row['month']; 
											$year = $row['year'];
											$featureid = $row['featid'];
											/*$type = $row['type'];*/
										
											$query1 = "select * from feature where featid = '$featureid'";
											$result1 = mysql_query($query1);
											$row1=mysql_fetch_assoc($result1);
											$featurename = preg_replace("/ /","%20",$row1['featurename']);
											
											$featureid = $row1['featid'];
													
											echo "<div class=\"box\">";
											echo	"<div class=\"inside\">";
											echo		"<a href=\"bookReader.php?volume=$volume&amp;month=$month&amp;year=$year&amp;page=$page\"><span class=\"titlespan .sanskrit\">".$title."</span></a>&nbsp;|&nbsp;<a href=\"feat.php?featid=$featureid&amp;featname=$featurename\"><span class=\"featurespan\">".$featurename."</span></a>&nbsp;|&nbsp;<span class=\"voliss\"><a href=\"toc.php?year=$year&amp;month=$month&amp;volume=$volume&amp;issue=$inum\">".getMonth($month)." $year (Vol. ".intval($volume).", Issue&nbsp;".intval($inum).")</a></span><br/>";
											$sumne = preg_split("/;/",$authorid);
											for($k = 0; $k < count($sumne); $k++)
											{
												$query1 = "select * from author where authid = '$sumne[$k]'";
												$result1 = mysql_query($query1);
												$row1=mysql_fetch_assoc($result1);
												echo	"<a href=\"showAuthorArticles.php?authid=".$row1["authid"]."&amp;authorname=$authorname1\"><span class=\"authorspan\">".$authorname."</span></a>";
												if(count($sumne) > 1 && $k < count($sumne)-1)
												{
													echo "&nbsp;|&nbsp;";
												}
											}
											
											echo	"</div>";
											echo"</div>";
										}
									}
									else
									{
										echo "<span class=\"empty topic\">There are no articles beginning with letter&nbsp;:&nbsp;$letter</span>";

									}
									mysql_close($db);
							?>
						</div>
					</section>	
               </article>
				<?php include("footer.php");?>
