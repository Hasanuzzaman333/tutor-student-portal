<?php
$mailto = $_POST['to'];
$mailSub = $_POST['subject'];
$mailMsg = $_POST['message'];
require 'PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer();
$mail ->IsSmtp();
$mail ->SMTPDebug = 0;
$mail ->SMTPAuth = true;
$mail ->SMTPSecure = 'ssl';
$mail ->Host = "smtp.gmail.com";
$mail ->Port = 465; // or 587
$mail ->IsHTML(true);
$mail ->Username = "mhasanuzzaman142017@bscse.uiu.ac.bd";
$mail ->Password = "emui3143";
$mail ->SetFrom("mhasanuzzaman142017@bscse.uiu.ac.bd");
$mail ->Subject = $mailSub;
$mail ->Body = $mailMsg;
$mail ->AddAddress($mailto);

if(!$mail->Send())
{
    header('location:home.php?msg=Email sending failed !');
}
else
{
    header('location:home.php?msg=Email send Successfully !');

}



?>