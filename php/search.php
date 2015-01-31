<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>​सम्भाषण सन्देशः</title>
<link href="style/reset.css" rel="stylesheet" />
<link href="style/style.css" rel="stylesheet" />
<script type="text/javascript" src="js/devanagari_kbd.js" charset="UTF-8"></script>
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
                        <div class="alphabet"><h2>Search</h2></div><br><br><br>
                      <form method="POST" action="search-result.php">
						<table class="search_tbl">
							<tr>
								<td class="left"><span class="titlespan">Title</span></td>
								<td class="right"><input name="title" type="text" id="title" onfocus="SetId('title')" style="height: 1.8em; margin: 1em 0em 1em 0em;" /></td>
							</tr>
							<tr>
								<td class="left"><span class="titlespan">Author</span></td>
								<td class="right"><input name="author" type="text" id="author" onfocus="SetId('author')" style="height: 1.8em; margin: 1em 0em 1em 0em;" /></td>
							</tr>
							<tr>
								<td class="left"><span class="titlespan">Category</span></td>
                                <td class="right">
									<select name="feature" class="category">
<?php
include("connect.php");

$db = mysql_connect("localhost",$user,$password) or die("Not connected to database");
$rs = mysql_select_db($database,$db) or die("No Database");
mysql_set_charset("utf8",$db);
$query1 = "select * from feature order by featurename";
$result1 = mysql_query($query1);
$num_rows1 = mysql_num_rows($result1);
if($num_rows1)
{
    for($i=1;$i<=$num_rows1;$i++)
	{
		$row1=mysql_fetch_assoc($result1);
		$featurename = $row1['featurename'];
		$feature = $row1['featid'];
        if($featurename == '')
        {
            $featurename = "&nbsp;";
            echo "\n<option value=\"\">$featurename</option>";
        }
        else
        {
            echo "\n<option value=\"$feature\">$featurename</option>";
        }
	}
}

?>
                                </select>
                            </td>                                    
							</tr>
                            <tr>
                                <td class="left">&nbsp;</td>
                                <td class="right">
                                    <input name="button1" type="submit" class="titlespan" id="button1" value="Search" />&nbsp;&nbsp;
                                    <input name="button2" type="reset" class="titlespan" id="button2" value="Clear" />
                                </td>
                            </tr>
                        </table>
                    </form>
<?php include("keyboard.php"); ?>  
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
