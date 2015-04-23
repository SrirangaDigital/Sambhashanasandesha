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
require_once 'mail/class.phpmailer.php';
require_once 'mail/class.pop3.php';
require_once 'mail/class.smtp.php';
require_once 'mail/PHPMailerAutoload.php';

//if "email" variable is filled out, send email
$fromName = $_POST['name'];
$fromEmail = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];
if($fromName == '')
{
	echo "Name is required <br>";
}
elseif (!filter_var($fromEmail, FILTER_VALIDATE_EMAIL))
{
	echo "Invalid email format <br>";
	
}
else
{
	$toEmail = "arjun.kashyap@srirangadigital.com";
	$toName = "Sriranga";
	$mail = new PHPMailer();
	$mail->isSendmail();
	$mail->isHTML(true);
	$mail->setFrom($fromEmail, $fromName);
	$mail->addReplyTo($fromEmail, $fromName);
	$mail->addAddress($toEmail, $toName);
	$mail->Subject = $subject;
	$mail->Body = $message;
	$mail->SMTPDebug = 2;
	
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		echo 'Message has been sent';
	}
}
?>
			
		</div>
	</section>
</article>
<?php include("footer.php"); ?>
