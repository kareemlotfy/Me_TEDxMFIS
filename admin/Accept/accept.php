<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

include '../phpqrcode\qrlib.php'; // Include the QRcode library file

function generateQRCode($data, $uniqueId) {
    $qrCodeFile = '../qrcodes/qrcode_' . $uniqueId . '.png'; // Unique filename for each QR code
    QRcode::png($data, $qrCodeFile);
    return $qrCodeFile;
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    include("../Misc/db_conn.php");

    // Generate a unique ID
    $uniqueId = generateUniqueURL();

    // Update db accepted to yes and send the unique ID to db
    $updateSql = $con->prepare("UPDATE user_cred SET isaccepted = 'yes', ticket_id = ? WHERE id = ?");
    $updateSql->bind_param("si", $uniqueId, $userId);
    $updateSql->execute();
    $updateSql->close();

    // get users email and unique ID from db
    $getUserDetailsSql = $con->prepare("SELECT email, ticket_id FROM user_cred WHERE id = ?");
    $getUserDetailsSql->bind_param("i", $userId);
    $getUserDetailsSql->execute();
    $getUserDetailsSql->bind_result($userEmail, $uniqueId);

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
    }


// Function to merge QR code with ticket template
function mergeQRWithTicket($qrCodeFile, $uniqueId) {
    $ticketTemplate = imagecreatefrompng('../Ticket_Design.png'); // Replace with your ticket template path

    $qrCode = imagecreatefrompng($qrCodeFile);

    $qrCodeWidth = imagesx($qrCode);
    $qrCodeHeight = imagesy($qrCode);

    $positionX = 0;
    $positionY = 0;

    imagecopy($ticketTemplate, $qrCode, $positionX, $positionY, 0, 0, $qrCodeWidth, $qrCodeHeight);

    $mergedFilePath = '../qrcodes/merged_qr_ticket_' . $uniqueId . '.png'; // Unique filename for the merged image
    imagepng($ticketTemplate, $mergedFilePath);

    // Free up memory
    imagedestroy($qrCode);
    imagedestroy($ticketTemplate);

    return $mergedFilePath;
}

        $qrCodeFile = generateQRCode('localhost/TEDxManaratAlfaroukSchool/qr-panel/qrpanel.php/#' . $uniqueId, $uniqueId);

        $mergedFilePath = mergeQRWithTicket($qrCodeFile, $uniqueId);

        sendQRCodeEmail($userEmail, 'TEDxManaratAlFaroukSchool Ticket', 'Great news! Your ticket 🎫 for TEDxManaratAlFaroukSchool is confirmed! 🙌 <br> <br> 📅 Date: [Event Date] <br> 📍 Location: <a href="https://maps.app.goo.gl/kDEvHWHKKo9ffMCy5" target="_blank">Click here</a> <br> <br> Cheers, <br> TEDxManaratAlFaroukSchool', $mergedFilePath);

    $getUserDetailsSql->close();

    // Redirect (refresh for now)
    header("Location: ../Tickets/tickets.php?userFilter=all");
    exit();
} else {
    // handle error
    header("Location: ../error.php");
    exit();
}

// Function to generate a unique ID
function generateUniqueURL($length = 10) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $uniqueString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, strlen($characters) - 1);
        $uniqueString .= $characters[$randomIndex];
    }

    return $uniqueString;
}
