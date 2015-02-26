<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-search"></span>
		<h2><strong>Search</strong></h2>
		<p>search in the volumes,articles,authors of Sambhashana Sandesha</p>
	</header>
	<section class="wrapper style4 container">
		<div class="content">
			<section>
				<header>
					<h3><strong>Search Form</strong></h3>
				</header>
			<?php include("keyboard.php");?>
			<form method="get" action="search-result.php">
				<div class="row uniform 50%">
					<div class="6u 12u(3)">
						<input type="text" name="title" id="title" onfocus="SetId('title')" value="" placeholder="Title" />
					</div>
				</div>
				
				<div class="row uniform 50%">
					<div class="3u 12u(3)">
						<input type="text" name="author" id="author" onfocus="SetId('author')" value="" placeholder="Author" />
					</div>
				</div>
				<div class="row uniform 50%">
					<div class="3u 12u(3)">
						<input type="text" name="feature" id="feature" onfocus="SetId('feature')" value="" placeholder="Feature" />
					</div>
				</div>
				<div class="row uniform 50%">
					<div class="3u 12u(3)">
						<input type="text" name="text" id="text" onfocus="SetId('text')" value="" placeholder="Words" />
					</div>
				</div>
					<div class="row uniform 50%">
						<span class="clr1">Year</span>
						<div class="1u 6u">
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
												echo "<option value=\"$year\">" . $year . "</option>";
											}
										}
									?>
							</select>
						</div>
						<p>To</p>
						<div class="1u 6u">
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
												echo "<option value=\"$year\">" . $year . "</option>";
											}
										}
									?>
							</select>
						</div>
					</div>
					<div class="row uniform 50%">
						<div class="4u 12u(3)">
							<input type="submit" value="Search" class="fit" />
						</div>
						<div class="2u 12u(3)">
							<input type="reset" value="Reset" class="fit" />
						</div>
					</div>
			</form>
			</section>
		</div>

	</section>
</article>
<?php include("footer.php"); ?>
