<?php 

/* Email form variables */
$name = $_POST["naam"];
$visitor_email = $_POST["email"];
$message = $_POST["text"];

/* Email that's send */
$email_from = "daan.smets1@gmail.com";
$email_subject = "Sukkel die Drekwerk contacteerd";
$email_body = "Deze mongol heeft iets te zeggen: $name.\n". "Dit is wat ie lult:\n $message";

/* Email recipient */
$to = "daan.smets1@gmail.com";
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email";

mail($to,$email_subject,$email_body,$headers);

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>