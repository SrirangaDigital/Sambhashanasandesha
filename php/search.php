<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<?php include("common.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-search"></span>
		<h2><strong>अन्वेषणम्</strong></h2>
		<p>लेखाः - लेखकाः - प्रधानविभागाः - शब्दाः</p>
	</header>
	<section class="wrapper style4 container">
		<div class="content">
			<section>
			<?php include("keyboard.php");?>
			<form method="get" action="search-result.php">
				<div class="row uniform 50%">
					<div class="6u 12u(3)">
						<input type="text" name="title" id="title" onfocus="SetId('title')" value="" placeholder="शीर्षिकम्" />
					</div>
				</div>
				
				<div class="row uniform 50%">
					<div class="3u 12u(3)">
						<input type="text" name="author" id="author" onfocus="SetId('author')" value="" placeholder="लेखकः" />
					</div>
				</div>
				<div class="row uniform 50%">
					<div class="3u 12u(3)">
						<input type="text" name="feature" id="feature" onfocus="SetId('feature')" value="" placeholder="प्रधानविभागः" />
					</div>
				</div>
				<div class="row uniform 50%">
					<div class="3u 12u(3)">
						<input type="text" name="text" id="text" onfocus="SetId('text')" value="" placeholder="शब्दः" />
					</div>
				</div>
					<div class="row uniform 50%">
						<span style="line-height: 2.5em;color: rgba(124, 128, 129, 0.5);">अवधिः</span>
						<div class="5u 6u">
							<select name="year1" style="cursor:context-menu;">
								<option value="">&nbsp;</option>
									<?php
										include("connect.php");
										$db = mysql_connect($server,$user,$password) or die("Not connected to database");
										$rs = mysql_select_db($database,$db) or die("No Database");
										mysql_set_charset("utf8",$db);
									
										$query = "select distinct year from article order by year";
										$result = mysql_query($query);
										$num_rows = $result ? mysql_num_rows($result) : 0;
										if($num_rows > 0)
										{
											for($i=1;$i<=$num_rows;$i++)
											{
												$row = mysql_fetch_assoc($result);
												$year=$row['year'];
												echo '<option value="' . $year . '">' . convert_devanagari($year) . '</option>';
											}
										}
									?>
							</select>
							<span style="line-height: 2.5em;margin: 0 1em;color: rgba(124, 128, 129, 0.5)">प्रति</span>
							<select name="year2" style="cursor:context-menu;">
								<option value="">&nbsp;</option>
									<?php
										$result = mysql_query($query);
										$num_rows = $result ? mysql_num_rows($result) : 0;
										if($num_rows > 0)
										{
											for($i=1;$i<=$num_rows;$i++)
											{
												$row = mysql_fetch_assoc($result);
												$year=$row['year'];
												echo '<option value="' . $year . '">' . convert_devanagari($year) . '</option>';
											}
										}
									?>
							</select>
						</div>
					</div>
					<div class="row uniform 70%">
						<div class="2.2u 12u(3)">
							<input type="submit" value="अन्विष्यताम्" class="fit" />
						</div>
						<div class="2.2u 12u(3)">
							<input type="reset" value="पुनर्व्यवस्थापय" class="fit" />
						</div>
					</div>
			</form>
			</section>
		</div>

	</section>
</article>
<?php include("footer.php"); ?>
