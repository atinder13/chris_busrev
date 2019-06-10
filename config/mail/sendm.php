<?php


require 'class.phpmailer.php';

try {
	$mail = new PHPMailer(true); //New instance, with exceptions enabled

	
	//$body             = preg_replace('/\\\\/','', $body); //Strip backslashes
	$body             = "<h1> Hello </h1>";
	$mail->IsSMTP();                           // tell the class to use SMTP
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Port       = 25;                    // set the SMTP server port
	$mail->Host       = "mail.1neclick.com"; // SMTP server
	$mail->Username   = "charanpal@1neclick.com";     // SMTP server username
	$mail->Password   = "welcome@123";            // SMTP server password

	$mail->IsSendmail();  // tell the class to use Sendmail

	$mail->AddReplyTo("charanpal@1neclick.com","First Last");

	$mail->From       = "charanpal@1neclick.com";
	$mail->FromName   = "First Last";

	$to = "cpboss150@gmail.com";

	$mail->AddAddress($to);

	$mail->Subject  = "First PHPMailer Message";

	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 80; // set word wrap

	$mail->MsgHTML($body);

	$mail->IsHTML(true); // send as HTML

	$mail->Send();
	echo  "Send OK";
} catch (phpmailerException $e) {
	echo $e->errorMessage();
	
}
?>