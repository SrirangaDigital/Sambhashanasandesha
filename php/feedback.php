<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-envelope"></span>
		<h2>Feedback</h2>
		<p>Use the form below to reach us.</p>
	</header>
	<section class="wrapper style4 special container 75%">
		<div class="content">
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