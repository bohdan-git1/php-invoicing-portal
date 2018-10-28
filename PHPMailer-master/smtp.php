<?php
date_default_timezone_set('Etc/UTC');
require 'PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->Host = "smtpout.secureserver.net";
$mail->Port = 25;
$mail->SMTPAuth = true;
$mail->Username = "noreply@mob-voip.net";
$mail->Password = "@!murty999";
$mail->setFrom('noreply@mob-voip.net', 'First Last');
$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('snmurty99@gmail.com', 'John Doe');
//$mail->addCC('ecsqatar@gmail.com');
$mail->Subject = "natural Test subject";//"msgsubject;
$mail->msgHTML("mydear test body");
$mail->AltBody = 'This is a plain-text message body';
//$mail->addAttachment('images/phpmailer_mini.png');
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
