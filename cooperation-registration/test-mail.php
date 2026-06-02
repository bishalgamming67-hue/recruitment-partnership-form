<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "STEP 1 OK - PHP is running";

require __DIR__ . '/PHPMailer-master/src/Exception.php';
require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    // YOUR EMAIL (SENDER)
    $mail->Username = 'bishalgamming67@gmail.com';
    $mail->Password = 'oxeuhcndnybkjdzz';

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // SENDER NAME
    $mail->setFrom('globalnepal.joi@gmail.com', 'Global Nepal Joi');

    // RECEIVER EMAIL
    $mail->addAddress('bkk855504@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Test Email from XAMPP';
    $mail->Body = 'Hello! This email is sent from PHPMailer using XAMPP 🚀';

    $mail->send();

    echo "Email sent successfully!";

} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}