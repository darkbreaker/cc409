<?php

include("PHPMailer/class.phpmailer.php");
include("PHPMailer/class.smtp.php"); 
$mail             = new PHPMailer();

$body             = $mail->getFile('contents.html');
$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP();
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port

$mail->Username   = "admvetmas@gmail.com";  // GMAIL username
$mail->Password   = "A1V2M3;@";            // GMAIL password

$mail->From       = "replyto@yourdomain.com";
$mail->FromName   = "MascotaWebmaster";
$mail->Subject    = "Autentificacion";
$mail->AltBody    = "Gracias por registrarse como usuario en mascota "; //Text Body
$mail->WordWrap   = 50; // set word wrap

$mail->MsgHTML($body);

$mail->AddReplyTo("replyto@yourdomain.com","Webmaster");

$mail->AddAttachment("/path/to/file.zip");             // attachment
$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment

$mail->AddAddress("al_xsnake@hotmail.com","First Last");

$mail->IsHTML(true); // send as HTML

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message has been sent";
}

?>
