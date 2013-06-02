<?php

-include("PHPMailer/class.phpmailer.php");
-include("PHPMailer/class.smtp.php"); 

$mail             = new PHPMailer();

$body             = "<p>hola</p>";

$mail->IsSMTP();
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port

$mail->Username   = "admvetmas@gmail.com";  // GMAIL username
$mail->Password   = "A1V2M3;@";            // GMAIL password

$mail->From       = "admvetmas@gmail.com";
$mail->FromName   = "Webmaster";
$mail->Subject    = "This is the subject";
$mail->AltBody    = "This is the body when user views in plain text format"; //Text Body
$mail->WordWrap   = 50; // set word wrap

$mail->Body=$body;
$mail->AddAddress("al_xsnake@hotmail.com","alex");

$mail->IsHTML(true); // send as HTML

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message has been sent";
}

?>
