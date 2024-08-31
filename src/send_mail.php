<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust the path if necessary

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                 // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                             // Enable SMTP authentication
    $mail->Username   = 'griffootieno@gmail.com';           // SMTP username
    $mail->Password   = 'grireon12g.';            // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     // Enable TLS encryption
    $mail->Port       = 587;                              // TCP port to connect to

    //Recipients
    $mail->setFrom('mamaryakeyo@gmail.com', 'mary akeyo');
    $mail->addAddress('mamaryakeyo@gmail.com');           // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
