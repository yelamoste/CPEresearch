<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';


$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                // Enable verbose debug output
    $mail->isSMTP();                                      // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                 // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                             // Enable SMTP authentication
    $mail->Username   = 'thesiskiosk0343@gmail.com';      // SMTP username
    $mail->Password   = 'nidumpwzvbfkdlts';               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Enable implicit TLS encryption
    $mail->Port       = 587;                              // TCP port to connect to

    // Disable SSL verification for debugging purposes
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ];

    $mail->isHTML(true);                                  // Set email format to HTML
    return $mail;

} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
    return null;
}
