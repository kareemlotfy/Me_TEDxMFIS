<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
include '../phpqrcode/qrlib.php'; // Include the QRcode library

// Generates a QR code file and returns its path
function generateQRCode($data, $uniqueId) {
    $qrCodeFile = "../qrcodes/qrcode_$uniqueId.png";
    QRcode::png($data, $qrCodeFile);
    return $qrCodeFile;
}

// Merges QR code with a ticket template and returns the path of the merged file
function mergeQRWithTicket($qrCodeFile, $uniqueId) {
    $ticketTemplate = imagecreatefrompng('../Ticket_Design.png');
    $qrCode = imagecreatefrompng($qrCodeFile);

    $qrCodeWidth = imagesx($qrCode);
    $qrCodeHeight = imagesy($qrCode);

    // Adjust position if necessary
    $positionX = 0;
    $positionY = 0;

    imagecopy($ticketTemplate, $qrCode, $positionX, $positionY, 0, 0, $qrCodeWidth, $qrCodeHeight);

    $mergedFilePath = "../qrcodes/merged_qr_ticket_$uniqueId.png";
    imagepng($ticketTemplate, $mergedFilePath);

    imagedestroy($qrCode);
    imagedestroy($ticketTemplate);

    return $mergedFilePath;
}

// Sends an email with the QR code attachment
function sendQRCodeEmail($to, $subject, $message, $qrCodeFile) {
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
        $mail->setFrom('elmahyy.1122007@gmail.com', 'TEDxManaratAlFaroukSchool');
        $mail->addAddress($to);

        // Attach QR code
        $mail->addAttachment($qrCodeFile, 'qrcode.png');

        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        echo "QR code email sent to $to successfully.<br>";
    } catch (Exception $e) {
        echo "Failed to send QR code email. Error: {$mail->ErrorInfo}<br>";
    }
}

// Generates a secure unique ID
function generateUniqueURL($length = 10) {
    return bin2hex(random_bytes($length));
}

// Main script execution
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $userId = intval($_GET['id']);
    include("../Misc/db_conn.php");

    // Generate a unique ID and update the database
    $uniqueId = generateUniqueURL();
    $updateSql = $con->prepare("UPDATE user_cred SET isaccepted = 'yes', ticket_id = ? WHERE id = ?");
    $updateSql->bind_param("si", $uniqueId, $userId);
    $updateSql->execute();
    $updateSql->close();

    // Retrieve user email and unique ID
    $getUserDetailsSql = $con->prepare("SELECT email, ticket_id FROM user_cred WHERE id = ?");
    $getUserDetailsSql->bind_param("i", $userId);
    $getUserDetailsSql->execute();
    $getUserDetailsSql->bind_result($userEmail, $uniqueId);

    if ($getUserDetailsSql->fetch()) {
        $qrCodeFile = generateQRCode('localhost/TEDxManaratAlfaroukSchool/qr-panel/qrpanel.php/#' . $uniqueId, $uniqueId);
        $mergedFilePath = mergeQRWithTicket($qrCodeFile, $uniqueId);

        $emailMessage = 'Great news! Your ticket 🎫 for TEDxManaratAlFaroukSchool is confirmed! 🙌 <br> <br> 📅 Date: [Event Date] <br> 📍 Location: <a href="https://maps.app.goo.gl/kDEvHWHKKo9ffMCy5" target="_blank">Click here</a> <br> <br> Cheers, <br> TEDxManaratAlFaroukSchool';
        sendQRCodeEmail($userEmail, 'TEDxManaratAlFaroukSchool Ticket', $emailMessage, $mergedFilePath);
    }

    $getUserDetailsSql->close();
    $con->close();

    // Redirect
    header("Location: ../Tickets/tickets.php?userFilter=all");
    exit();
} else {
    // Handle error
    header("Location: ../error.php");
    exit();
}
