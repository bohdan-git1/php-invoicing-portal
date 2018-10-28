<?php
ob_start();
function externalmail($to,$msgsubject,$msgbody,$pdfpath)
{
date_default_timezone_set('Etc/UTC');
require_once('PHPMailer-master/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->Host = "smtpout.secureserver.net";
$mail->Port = 25;
$mail->SMTPAuth = true;
$mail->Username = "noreply@mob-voip.net";
$mail->Password = "@!murty999";
$mail->setFrom('noreply@mob-voip.net', 'Mob-Voip');
$mail->addReplyTo('noreply@mob-voip.ne', 'Mob-Voip');
//Set who the message is to be sent to
$mail->addAddress($to, 'Mob-Voip');
$mail->addCC('info@mob-voip.net');
$mail->Subject = $msgsubject;
$mail->msgHTML($msgbody);
$mail->AltBody = 'This is a plain-text message body';
//$mail->addAttachment('images/phpmailer_mini.png');
$mail->AddAttachment($pdfpath, '', $encoding = 'base64', $type = 'application/pdf');


$mail->send();
}
?>
