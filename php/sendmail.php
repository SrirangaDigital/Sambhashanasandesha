<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-envelope"></span>
		<h2>Feedback</h2>
	</header>
	<section class="wrapper style4 special container 75%">
		<div class="content">
<?php
//if "email" variable is filled out, send email
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];
if($name == '')
{
	print "Name is required <br>";
}
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
  print "Invalid email format";
}
elseif($subject == '')
{
	print "Subject is required <br>";
}
elseif($message == '')
{
	print "Message is required <br>";
}
else
{
	$admin_email = "shruthitr.nayak@gmail.com";
	//send email
	mail($admin_email, $subject, $message);
  
	//Email response
	echo "Thank you for contacting us!";  
}
?>
			
		</div>
	</section>
</article>
<?php include("footer.php"); ?>
