<?php

include("../Misc/db_conn.php");
require("../Misc/functions.php");

adminLogin();

include '../phpqrcode/qrlib.php'; // QRcode library

$adminId = $_SESSION['adminId']; // Assuming admin ID is stored in session after login
$adminDetails = getAdminDetails($con, $adminId);

if ($adminDetails) {
    $adminName = $adminDetails['admin_name'];
} else {
    echo "Admin details not found.";
}

// Generates a QR code file and returns its path
function generateQRCode($data, $uniqueId, $size = 20) {
    $qrCodeFile = "../qrcodes/qrcode_$uniqueId.png";
    QRcode::png($data, $qrCodeFile, QR_ECLEVEL_L, $size);
    return $qrCodeFile;
}

// Merge QR with ticket (now supports dynamic template path)
function mergeQRWithTicket($qrCodeFile, $uniqueId, $ticketTemplatePath) {
    $ticketTemplate = imagecreatefrompng($ticketTemplatePath);
    $qrCode = imagecreatefrompng($qrCodeFile);

    $targetWidth = 868;
    $targetHeight = 868;

    $qrCodeResized = imagecreatetruecolor($targetWidth, $targetHeight);
    imagecopyresampled(
        $qrCodeResized, 
        $qrCode, 
        0, 0, 0, 0, 
        $targetWidth, 
        $targetHeight, 
        imagesx($qrCode), 
        imagesy($qrCode)
    );

    imagecopy($ticketTemplate, $qrCodeResized, 5518, 59, 0, 0, $targetWidth, $targetHeight);

    $mergedFilePath = "../qrcodes/merged_qr_ticket_$uniqueId.png";
    imagepng($ticketTemplate, $mergedFilePath);

    imagedestroy($qrCode);
    imagedestroy($qrCodeResized);
    imagedestroy($ticketTemplate);

    return $mergedFilePath;
}

// secure unique id
function generateUniqueURL($length = 10) {
    return bin2hex(random_bytes($length));
}

// queue email
function queueEmail($con, $userId, $userEmail, $subject, $message, $attachmentPath) {
    $insertQueue = $con->prepare("INSERT INTO email_queue (`user_id`, `email`, `subject`, `message`, `attachment_path`, `status`) 
        VALUES (?, ?, ?, ?, ?, 'pending')");
    $insertQueue->bind_param("issss", $userId, $userEmail, $subject, $message, $attachmentPath);
    $insertQueue->execute();
    $insertQueue->close();
}

// =============================================
// MAIN
// =============================================
$userId = intval($_GET['id']);

$uniqueId = generateUniqueURL();

$update = $con->prepare("UPDATE user_cred 
    SET isaccepted = 'yes', ticket_id = ?, accepted_by = ?
    WHERE id = ?");
$update->bind_param("ssi", $uniqueId, $adminName, $userId);
$update->execute();
$update->close();

// email
$getUser = $con->prepare("SELECT email, ticket_type FROM user_cred WHERE id = ?");
$getUser->bind_param("i", $userId);
$getUser->execute();
$result = $getUser->get_result();
$user = $result->fetch_assoc();
$getUser->close();

if ($user) {

    // ========== NEW: Choose ticket design based on ticket_type ==========
    if ($user["ticket_type"] === "vip") {
        $ticketTemplatePath = '../Ticket_Design_VIP.png';
    } else {
        $ticketTemplatePath = '../Ticket_Design.png';
    }
    // =====================================================================

    $qrCodeFile = generateQRCode("https://tedxmanaratalfaroukschool.com/qr-panel/qrpanel.php/#".$uniqueId, $uniqueId);
    $mergedFile = mergeQRWithTicket($qrCodeFile, $uniqueId, $ticketTemplatePath);

    queueEmail(
        $con,
        $userId,
        $user["email"],
        "TEDxManaratAlFaroukSchool Ticket",
        'Great news! Your ticket for TEDxManaratAlFaroukSchool is confirmed! <br> <br> Date: [12/12/2025] <br> Location: <a href="https://maps.app.goo.gl/kDEvHWHKKo9ffMCy5" target="_blank">Click here</a> <br><br> Dear Attendee,

<br>
1. Make sure to bring your ticket. Come on time.
<br>
2. Remain in your seats during the talks. (Gates will be closed, no entry or exit during the talks.)
<br>
3. No flash photography or video taking.
<br>
4. Food and drinks are strictly not allowed inside the auditorium.
<br>
5. Phones should be in silent mode. Side talk, walking, or any distraction methods during talks are not allowed.
<br>
6. Dress code is smart casual.
<br>
7. Organizers are not liable or responsible for the loss of any personal belongings during the event.
<br>
<br>

Manarat Al Farouk School
1st Settlement - New Cairo
12.12.2025 <br><br><br> <br> Cheers, <br> TEDxManaratAlFaroukSchool',
        $mergedFile
    );
}

$con->close();
header("Location: ../Tickets/single.php?userFilter=all");
exit();
?>
