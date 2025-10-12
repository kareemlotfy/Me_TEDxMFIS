<?php

include("../Misc/db_conn.php");
require("../Misc/functions.php");

adminLogin();

include '../phpqrcode/qrlib.php'; // QRcode library

// Generates a QR code file and returns its path
function generateQRCode($data, $uniqueId, $size = 20) {
    $qrCodeFile = "../qrcodes/qrcode_$uniqueId.png";
    $matrixPointSize = $size;
    QRcode::png($data, $qrCodeFile, QR_ECLEVEL_L, $matrixPointSize);
    return $qrCodeFile;
}

// Merges QR code with a ticket template and returns the path of the merged file
function mergeQRWithTicket($qrCodeFile, $uniqueId) {
    $ticketTemplate = imagecreatefrompng('../Ticket_Design.png');
    $qrCode = imagecreatefrompng($qrCodeFile);

    // Resize QR
    $targetWidth = 168;
    $targetHeight = 168;

    $qrCodeResized = imagecreatetruecolor($targetWidth, $targetHeight);
    imagecopyresampled(
        $qrCodeResized, $qrCode,
        0, 0, 0, 0,
        $targetWidth, $targetHeight,
        imagesx($qrCode), imagesy($qrCode)
    );

    $positionX = 1280;
    $positionY = 59;

    imagecopy($ticketTemplate, $qrCodeResized, $positionX, $positionY, 0, 0, $targetWidth, $targetHeight);

    $mergedFilePath = "../qrcodes/merged_qr_ticket_$uniqueId.png";
    imagepng($ticketTemplate, $mergedFilePath);

    imagedestroy($qrCode);
    imagedestroy($qrCodeResized);
    imagedestroy($ticketTemplate);

    return $mergedFilePath;
}


// Generates a secure unique ID
function generateUniqueURL($length = 10) {
    return bin2hex(random_bytes($length));
}

// Insert email into queue
function queueEmail($con, $userId, $userEmail, $subject, $message, $attachmentPath) {
    $insertQueue = $con->prepare("INSERT INTO email_queue (`user_id`, `email`, `subject`, `message`, `attachment_path`, `status`) VALUES (?, ?, ?, ?, ?, 'pending')");
    if (!$insertQueue) {
        die("SQL Error (queueEmail): " . $con->error);
    }

    $insertQueue->bind_param("issss", $userId, $userEmail, $subject, $message, $attachmentPath);
    $insertQueue->execute();
    $insertQueue->close();
}

// Main script execution
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $userId = intval($_GET['id']);

    // Retrieve the group ID for the selected user
    $getGroupSql = $con->prepare("SELECT group_id FROM user_cred WHERE id = ?");
    $getGroupSql->bind_param("i", $userId);
    $getGroupSql->execute();
    $getGroupSql->bind_result($groupId);
    $getGroupSql->fetch();
    $getGroupSql->close();

    if ($groupId) {
        // If group ID exists, process all users in that group
        $getUsersSql = $con->prepare("SELECT id, email FROM user_cred WHERE group_id = ?");
        $getUsersSql->bind_param("s", $groupId);
        $getUsersSql->execute();
        $result = $getUsersSql->get_result();
        $users = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
        $getUsersSql->close();

        foreach ($users as $user) {
            $userEmail = $user['email'];
            $userId = $user['id'];
            $uniqueId = generateUniqueURL();

            // Update the user status to 'accepted' and store the unique ticket ID
            $updateSql = $con->prepare("UPDATE user_cred SET isaccepted = 'yes', ticket_id = ? WHERE id = ?");
            $updateSql->bind_param("si", $uniqueId, $userId);
            $updateSql->execute();
            $updateSql->close();

            // Generate QR code and merge with ticket template
            $qrCodeFile = generateQRCode('https://tedxmanaratalfaroukschool.com/qr-panel/qrpanel.php/#' . $uniqueId, $uniqueId, 20);
            $mergedFilePath = mergeQRWithTicket($qrCodeFile, $uniqueId);

            // Prepare the email message
            $emailMessage = 'Great news! Your group ticket offer for TEDxManaratAlFaroukSchool is confirmed! <br> <br> Date: [6/12/2024] <br> Location: <a href="https://maps.app.goo.gl/kDEvHWHKKo9ffMCy5" target="_blank">Click here</a> <br><br> Dear Attendee,

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
6.12.2024 <br><br><br> <br> Cheers, <br> TEDxManaratAlFaroukSchool';

            // Queue the email instead of sending immediately
            queueEmail($con, $userId, $userEmail, 'TEDxManaratAlFaroukSchool Ticket', $emailMessage, $mergedFilePath);
        }

        echo "All users in the group with ID $groupId have been accepted, and QR codes have been queued for sending.";
    } else {
        // If group ID is null, proceed with the old logic
        $uniqueId = generateUniqueURL();
        $updateSql = $con->prepare("UPDATE user_cred SET isaccepted = 'yes', ticket_id = ? WHERE id = ?");
        $updateSql->bind_param("si", $uniqueId, $userId);
        $updateSql->execute();
        $updateSql->close();

        // Retrieve user email for the single user
        $getUserDetailsSql = $con->prepare("SELECT email FROM user_cred WHERE id = ?");
        $getUserDetailsSql->bind_param("i", $userId);
        $getUserDetailsSql->execute();
        $result = $getUserDetailsSql->get_result();
        $user = $result->fetch_assoc();
        $getUserDetailsSql->close();

        if ($user) {
            $userEmail = $user['email'];
            $qrCodeFile = generateQRCode('https://tedxmanaratalfaroukschool.com/qr-panel/qrpanel.php/#' . $uniqueId, $uniqueId, 20);
            $mergedFilePath = mergeQRWithTicket($qrCodeFile, $uniqueId);

            $emailMessage = 'Great news! Your ticket for TEDxManaratAlFaroukSchool is confirmed! <br> <br> Date: [6/12/2024] <br> Location: <a href="https://maps.app.goo.gl/kDEvHWHKKo9ffMCy5" target="_blank">Click here</a> <br><br> Dear Attendee,

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
6.12.2024 <br><br><br> <br> Cheers, <br> TEDxManaratAlFaroukSchool';

            // Queue the email
            queueEmail($con, $userId, $userEmail, 'TEDxManaratAlFaroukSchool Ticket', $emailMessage, $mergedFilePath);
        }

        echo "User with ID $userId has been accepted, and QR code has been queued for sending.";
    }

    $con->close();

    // Redirect
    header("Location: ../Tickets/single.php?userFilter=all");
    exit();
} else {
    // Handle error
    header("Location: ../error.php");
    exit();
}
