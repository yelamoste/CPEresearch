<?php

require "../php/functions.php";
$mail = require "../php/mailer.php";

$webmail = $_POST['forgotPassEmail'];

// Generate token and token hash
$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

// Connect to the database
$conn = db_connect();

// Update the reset token and expiry time in the database
$sql = "UPDATE faculty SET reset_token_hash = ?, reset_token_expires_at = ? WHERE webmail = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $token_hash, $expiry, $webmail);
$stmt->execute();

if ($stmt->affected_rows) {
    if ($mail) {
        // Set email parameters
        $mail->setFrom('thesiskiosk0343@gmail.com', 'The CPE Research E-Library Kiosk');
        $mail->addAddress($webmail);
        $mail->Subject = "The CPE Research E-Library: Forgot Password";
        $mail->Body = <<<END
        Click <a href="http://localhost/CPEResearch/php/FacultyresetPassword.php?token=$token">here</a> to reset your password.
        END;

        try {
            // Send the email
            $mail->send();
            // echo "<script>
            // alert('Message sent, please check your inbox.');
            // </script>";
            
            echo "<script>alert('Message sent, please check your inbox'); window.location.href='../index.php';</script>";
            exit;
            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Mailer configuration error.";
    }
} else {
    echo "Failed to update the database.";
}

?>
