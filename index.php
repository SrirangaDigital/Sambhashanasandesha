<!DOCTYPE HTML>
<html>
<head>
	<title>Sambhashana Sandesha</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
	<script src="php/js/jquery.min.js"></script>
	<script src="php/js/jquery.dropotron.min.js"></script>
	<script src="php/js/jquery.scrolly.min.js"></script>
	<script src="php/js/jquery.scrollgress.min.js"></script>
	<script src="php/js/skel.min.js"></script>
	<script src="php/js/skel-layers.min.js"></script>
	<script src="php/js/init.js"></script>
	<noscript>
		<link rel="stylesheet" href="php/css/skel.css" />
		<link rel="stylesheet" href="php/css/style.css" />
		<link rel="stylesheet" href="php/css/style-wide.css" />
		<link rel="stylesheet" href="php/css/style-noscript.css" />
	</noscript>
</head>
<body class="index">
	<!-- Header -->
	<header id="header" class="alt">
		<nav id="nav">
			<ul>
				<li><a href="index.php">Home | उपक्रमः:</a></li>
				<li><a href="php/about.php">About | परिचयः</a>
					<ul>
						<li><a href="php/about.php">Sambhshana Sandesha</a></li>
						<li><a href="php/about_sb.php">Samskrita Bharati</a></li>
					</ul>
				</li>
				<li><a href="php/subscribe.php">Subscribe | ग्राहकता</a>
					<ul>
						<li><a href="php/subscribe.php">India</a></li>
						<li><a href="php/subscribe_us.php">US &amp; Canada</a></li>
						<li><a href="php/subscribe_ot.php">Other Nations</a></li>
					</ul>
				</li>
				<li><a href="javascript:void(0);">Archives | सङ्ग्रहः</a>
					<ul>
						<li><a href="php/volumes.php">Volumes | सम्पुटाः</a></li>
						<li><a href="php/feature.php">Features | प्रधानविभागाः</a></li>
						<li><a href="php/articles.php?letter=अ">Articles | लेखाः</a></li>
						<li><a href="php/authors.php?letter=अ">Authors | लेखकाः</a></li>
						<li><a href="php/search.php">Search | अन्वेषणम्</a></li>
					</ul>
				</li>
				<li><a href="php/feedback.php">Feedback | प्रतिपुष्टिः</a></li>
				<li><a href="php/contact.php">Contact | सम्पर्कः</a></li>
			</ul>
		</nav>
	</header>
	<!-- Banner -->
	<section id="banner">
		<div class="inner">
			<header>
				<h2>सम्भाषण सन्देश:</h2>
			</header>
			<p>World's first of its kind <strong>Samskrit</strong> monthly magazine</p>
			<?php include("php/connect.php");?>
			<footer>
				<?php 
					echo "<ul class=\"buttons vertical\">";
					echo "<li><a class=\"button fit scrolly\" href=\"php/toc.php?year=$year&amp;month=$month&amp;volume=$volume&amp;issue=$issue\"> Click to view the latest issue</a></li>";
					echo "</ul>";
				?>
			</footer>
		</div>
	</section>
	<!-- Main -->
	<article id="main">
		<header class="special container">
			<span class="icon fa-newspaper-o"></span>
			<h2>Welcome to our web portal</h2>
			<p>Be it globalization or global warming, Sandesha is always at the forefront of burning issues. Not to mention articles that unearth the hidden treasures in Samskritam texts. There are sections suited for beginners, children, adult and advanced students. Comics, short stories, serials, puzzles and thought-provoking articles are some of the highlights of this wonderful monthly magazine.</p>
		</header>
	<!-- One -->
		<section class="wrapper style2 container special-alt">
			<div class="row 50%">
				<div class="8u 12u(narrower)">
					<header>
						<h2>Surf through the volumes, issues, articles and authors of <strong>"Sambhashana Sandesha"</strong></h2>
					</header>
					<p>The language is very simple. Anyone with a basic knowledge of Sanskrit can easily understand. This is a project of "Sanskrit Bharati", which conducts the famous 10 day Sanskrit conversation classes.</p>
					<footer>
						<ul class="buttons">
							<li><a href="php/volumes.php" class="button">Find Out More</a></li>
						</ul>
					</footer>
				</div>
				<div class="4u 4u(narrower) important(narrower)">
					<ul class="featured-icons">
						<li><a href="index.php"><span class="icon fa-home"><span class="label">Home</span></span></a></li>
						<li><a href="php/volumes.php"><span class="icon fa-book"><span class="label">Volumes</span></span></a></li>
						<li><a href="php/feature.php"><span class="icon fa-tags"><span class="label">Categories</span></span></a></li>
						<li><a href="php/articles.php"><span class="icon fa-pencil"><span class="label">Articles</span></span></a></li>
						<li><a href="php/authors.php?letter=अ"><span class="icon fa-user"><span class="label">Authors</span></span></a></li>
						<li><a href="php/search.php"><span class="icon fa-search"><span class="label">Search</span></span></a></li>
					</ul>
				</div>
			</div>
		</section>
		<section id="temp" class="wrapper style1 container special">
			<div class="row">
				<div class="6u 12u(narrower)">
					<section>
						<span class="icon featured fa-newspaper-o"></span>
							<header>
								<h3>Sambhashana Sandesha</h3>
							</header>
							<p>Sambhashana Sandesha (सम्भाषणसन्देश:) is a magazine published by Samskrita Bharati from Aksharam.The monthly magazine comes to you with news, current affairs, articles, Samskritam news and events from across the world, stories for children and grown-ups, cartoons, crossword, vocabulary builders, and so on. Written in conversational-style prose, many articles are easily accessible to even beginners in Samskritam. For our more scholarly readers, we bring you articles on a wide range of topics including science, philosophy, biographical sketches, discussions in grammar and so on.</p>
					</section>
				</div>
				<div class="6u 12u(narrower)">
					<section>
						<span class="icon featured fa-university"></span>
						<header>
							<h3>Samskritabharati</h3>
						</header>
						<p>A movement for the development of Samskrit language, literature and mankind. It is registered as a Trust and also under Section 12A of IT Act. The Movement, called “Speak Samskrit Movement”, started in 1981 in Bangalore and it was later named and registered as “Samskrita Bharati” in 1995 in Delhi. Samskrita Bharati is also an organization of dedicated volunteers, who strive for the popularization of Samskrit, Samskriti and the Knowledge Tradition of Bharat. Its activities are spread to more than 2000 places all over the country.</p>
					</section>
				</div>
			</div>
			<footer class="major">
				<ul class="buttons">
					<li><a href="php/about.php" class="button">See More</a></li>
				</ul>
			</footer>
		</section>
	</article>
	<!-- CTA -->
	<section id="cta">
		<header>
				<h2>Subscribe for <strong>Sambhashana Sandesha</strong></h2>
		</header>
		<footer>
			<ul class="buttons">
				<li><a href="php/subscribe.php" class="button special">Click here to subscribe</a></li>
			</ul>
		</footer>
	</section>
	<!-- Footer -->
	<footer id="footer">
		<ol class="icons">
			<li>samskritam@gmail.com</li>
		</ol>
		<ol class="copyright">
			<li>©&nbsp;www.samskrita.in All Rights Reserved</li><li>Digitization &amp; Design : <a href="http://srirangadigital.com/">Sriranga Digital Software Technologies</a></li>
		</ol>
	</footer>
</body>
</html>
