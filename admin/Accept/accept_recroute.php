<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';


if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    include("../db_conn.php");

    $updateSql = $con->prepare("UPDATE apply_form SET isaccepted = 'yes' WHERE id = ?");
    $updateSql->bind_param("i", $userId);
    $updateSql->execute();
    $updateSql->close();

    // get users email and unique ID from db
    $getUserDetailsSql = $con->prepare("SELECT email FROM apply_form WHERE id = ?");
    $getUserDetailsSql->bind_param("i",$userId);
    $getUserDetailsSql->execute();
    $getUserDetailsSql->bind_result($userEmail);

    if ($getUserDetailsSql->fetch()) {

        // Send email

        function sendQRCodeEmail($to, $subject, $message, $qrCodeFile) {
            // PHPMailer configuration
            $mail = new PHPMailer(true);
        
            try {
                // SMTP settings
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'elmahyy.1122007@gmail.com';
                $mail->Password = 'iudp uqvr acnt eonx';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
        
                // Recipients
                $mail->setFrom('elmahyy.1122007@gmail.com', 'TEDxManaratAlFaroukSchool HR');
                $mail->addAddress($to);
        
                // Email content
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $message;
        
                $mail->send();
                echo "email sent to $to successfully.<br>";
            } catch (Exception $e) {
                echo "Failed to send QR code email. Error: {$mail->ErrorInfo}<br>";
            }
        }
    }

        sendQRCodeEmail($userEmail, 'TEDxManaratAlFaroukSchool HR', 'Great news! You Are Accepted! 🙌 <br> <br> Cheers, <br> TEDxManaratAlFaroukSchool HR', $mergedFilePath);

    $getUserDetailsSql->close();

    // Redirect (refresh for now)
    header("Location: ../Recroute/recroute.php");
    exit();
} else {
    // handle error
    header("Location: ../error.php");
    exit();
}
