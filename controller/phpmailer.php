<?php

include("PHPMailer/class.phpmailer.php");
include("PHPMailer/class.smtp.php"); 
$mail             = new PHPMailer();
$mail->Body = "Hola <strong>Jim</strong>, bienvenido!!!";
$body             = "hola <p> mundo </p>";

//$mail->IsSMTP(); // telling the class to use SMTP

$mail->Host       = "mail.yourdomain.com"; // SMTP server

$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)

$mail->SMTPAuth   = true;                  // enable SMTP authentication

$mail->SMTPSecure = "tls";                 // sets the prefix to the servier

$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server

$mail->Port       = 587;                   // set the SMTP port for the GMAIL server

$mail->Username   = "admvetmas@gmail.com";  // GMAIL username

$mail->Password   = "A1V2M3;@";            // GMAIL password

 

$mail->SetFrom('admvetmas@gmail.com', 'VeteWebmaster');

 

$mail->AddReplyTo("al_xsnake@hotmail.com","First Last");

$mail->Subject    = "Verificacion de usuario";

$mail->AltBody    = "Se ha registrado"; // optional, comment out and test


$address = "al_xsnake@hotmail.com";

$mail->AddAddress($address, "Alex");

$foo = $mail->Send();

if(!foo) {

echo "Mailer Error: " . $mail->ErrorInfo;

} else {

echo "Message sent!";

}

?>
