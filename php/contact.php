<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-envelope"></span>
		<h2>Get In Touch</h2>
	</header>
	<section class="wrapper style4 special container 75%">
		<div class="content">
			<header>
				<p>SAMBHASHANA SANDESHA,<br />
					“Aksharam”, 8th cross, Girinagar- 2nd phase<br />
					Bangalore - 560 085<br /></p>
					<span class="icon fa-phone">&nbsp;&nbsp;[080]- 2672 1052 / 2672 2576<br /></span>
					<span class="icon fa-envelope"> samskritam@gmail.com</span> 
			</header><br /><br />
			<form method="post" action="sendmail.php">
				<div class="row 50%">
					<div class="6u 12u(mobile)">
						<input type="text" name="name" placeholder="Name" />
					</div>
					<div class="6u 12u(mobile)">
						<input type="text" name="email" placeholder="Email" />
					</div>
				</div>
				<div class="row 50%">
					<div class="12u">
						<input type="text" name="subject" placeholder="Subject" />
					</div>
				</div>
				<div class="row 50%">
					<div class="12u">
						<textarea name="message" placeholder="Message" rows="7"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="12u">
						<ul class="buttons">
							<li><input type="submit" class="special" value="Send Message" /></li>
							<li><input type="reset" class="special" value="Reset" /></li>
						</ul>
					</div>
				</div>
			</form>
		</div>
	</section>
</article>
<?php include("footer.php"); ?>
