<?php
require 'class.phpmailer.php';

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = 'smtp';
$mail->SMTPSecure = 'tls';
$mail->Port = 587; //587
$mail->Host = "smtp.gmail.com";
$mail->IsHTML(true);


$mail->SMTPAuth = true;
$mail->Username = "arasvaharas@gmail.com"; //arasvah23@gmail.com
$mail->Password = "Jekkmama91";

//Sender Info
$mail->From = "Bani@jouwWinkel.nl";
$mail->FromName = "Bani Supermarkt";
