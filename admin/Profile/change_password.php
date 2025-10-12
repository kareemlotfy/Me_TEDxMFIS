<?php

include '../Misc/db_conn.php'; // Ensure your DB connection is included
include '../Misc/functions.php'; // Ensure your DB connection is included
adminLogin();

// Assuming you store the admin's ID in the session
$admin_id = $_SESSION['adminId'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Prepare the SQL statement
    $stmt = $con->prepare("SELECT admin_pass FROM admin_cred WHERE id = ?");
    
    // Check if prepare() was successful
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($con->error));
    }
    
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    $stmt->close();

    // Verify the current password
    if (!password_verify($currentPassword, $hashedPassword)) {
        alert("error", "", "Error",'Current password is incorrect.',"close");
        exit();
    }

    // Check if the new password matches the confirmation password
    if ($newPassword !== $confirmPassword) {
        alert("error", "", "Error",'New password and confirmation password do not match.', "close");
        exit();
    }

    // Check if the new password meets the requirements
    if (strlen($newPassword) < 8 || !preg_match('/[a-z]/', $newPassword) || !preg_match('/[\d\s\W]/', $newPassword)) {
        alert("error", "", "Error",'Password does not meet the requirements.', "close");
        exit();
    }

    // Hash the new password
    $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the password in the database
    $stmt = $con->prepare("UPDATE admin_cred SET admin_pass = ? WHERE id = ?");
    
    // Check if prepare() was successful
    if ($stmt === false) {
        alert("error", "", "Error",'Prepare failed: ' . htmlspecialchars($con->error), "close");
        exit();
    }
    
    $stmt->bind_param("si", $newHashedPassword, $admin_id);
    if ($stmt->execute()) {
        alert("success", "", "Success",'Password changed successfully!', "close");
        exit();
    } else {
        alert("error","","Error",'Failed to update password.' , "close");
        exit();
    }

    $stmt->close();
}
?>
