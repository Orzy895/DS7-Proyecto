<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "../phpmailer/src/PHPMailer.php";
require "../phpmailer/src/SMTP.php";
require "../phpmailer/src/Exception.php";

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$mail = new PHPMailer();

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'clinicahospital123@gmail.com';
    $mail->Password = 'klkr vfbw yhba obvu';
    $mail->setFrom('clinicahospital123@gmail.com', 'Mailer');
    $mail->addAddress($email, $name);
    $mail->isHTML(true);
    $mail->Subject = 'PHPMailer Test Subject';
    $mail->Body = $message;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
