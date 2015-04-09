<?php include("header.php"); ?>
<?php include("nav.php"); ?>
<article id="main">
	<header class="special container">
		<span class="icon fa-envelope"></span>
		<h2>Get In Touch</h2>
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
	echo "Name is required <br>";
}
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
	echo "Invalid email format <br>";
	
}
else
{
	$admin_email = "samskritam@gmail.com";
	$headers = "From: $email" . "\n";
	//send email
	mail($admin_email, $subject, $message, $headers);
  
	//Email response
	echo "Thank you for contacting us!";  
}
?>
			
		</div>
	</section>
</article>
<?php include("footer.php"); ?>
