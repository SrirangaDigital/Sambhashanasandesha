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
require_once 'mail/class.phpmailer.php';
require_once 'mail/class.pop3.php';
require_once 'mail/class.smtp.php';
require_once 'mail/PHPMailerAutoload.php';
require_once 'mail/recaptchalib.php';

$privatekey = "6LdBywUTAAAAAD1K1YCNS1P7IT0uhiOJZ6HFEfY7";
$resp = recaptcha_check_answer ($privatekey,
                                 $_SERVER["REMOTE_ADDR"],
                                 $_POST["recaptcha_challenge_field"],
                                 $_POST["recaptcha_response_field"]);
if (!$resp->is_valid)
{
   // What happens when the CAPTCHA was entered incorrectly
   die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
        "(reCAPTCHA said: " . $resp->error . ")");
}
else
{
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
		$toEmail = "samskritam@gmail.com";
		$toName = "Sambhashanasandesha";
		$mail = new PHPMailer();
		$mail->isSendmail();
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
}
?>
			
		</div>
	</section>
</article>
<?php include("footer.php"); ?>
