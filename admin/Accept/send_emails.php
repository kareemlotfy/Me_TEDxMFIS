<?php
include("../Misc/db_conn.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

function sendQRCodeEmail($to, $subject, $message, $qrCodeFile) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'hr.tedxmanaratalfarouk@gmail.com';
        $mail->Password = 'wqib pdod wqny tqjj';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('hr.tedxmanaratalfarouk@gmail.com', 'TEDxManaratAlFaroukSchool');
        $mail->addAddress($to);
        $mail->addAttachment($qrCodeFile, 'qrcode.png');
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Email failed to $to : {$mail->ErrorInfo}");
        return false;
    }
}

// Process max 5 emails per run
$getEmails = $con->query("SELECT * FROM email_queue WHERE status = 'pending' LIMIT 5");

while ($row = $getEmails->fetch_assoc()) {
    $success = sendQRCodeEmail($row['email'], $row['subject'], $row['message'], $row['attachment_path']);

    if ($success) {
        $con->query("UPDATE email_queue SET status='sent' WHERE id=" . $row['id']);
    } else {
        $con->query("UPDATE email_queue SET status='failed' WHERE id=" . $row['id']);
    }
}

$con->close();
