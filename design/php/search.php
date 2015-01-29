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
						<div class="2u 12u(3)">
							<select name="year1" style="cursor:context-menu;">
								<option value="">&nbsp;</option>
										<?php
										?>
							</select>
						</div>
						<span class="clr1">Year</span>
		<!--
						<span class="clr1">&nbsp;to&nbsp;</span>
		-->
						<div class="2u 12u(3)">
							<select name="year2" style="cursor:context-menu;">
								<option value="">&nbsp;</option>
									<?php
										
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
