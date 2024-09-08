<?php
require_once("../Misc/db_conn.php");

// Ensure a valid connection
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['admin_id'])) {
    // Sanitize and validate the admin ID input
    $adminId = filter_var($_POST['admin_id'], FILTER_VALIDATE_INT);

    if ($adminId === false) {
        echo "Invalid admin ID.";
        exit();
    }

    // Check if the admin is a super admin (Assuming super admin has an admin_id of 1)
    if ($adminId == 1) {
        echo "Error: Cannot delete the super admin.";
        exit();
    }

    // Begin a transaction
    mysqli_begin_transaction($con);

    try {
        // Delete permissions associated with the admin using prepared statements
        $deletePermissionsQuery = "DELETE FROM permissions WHERE admin_id = ?";
        $stmt = $con->prepare($deletePermissionsQuery);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $con->error);
        }
        $stmt->bind_param("i", $adminId);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $stmt->close();
        
        // Delete the admin from admin_cred using prepared statements
        $deleteAdminQuery = "DELETE FROM admin_cred WHERE id = ?";
        $stmt = $con->prepare($deleteAdminQuery);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $con->error);
        }
        $stmt->bind_param("i", $adminId);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $stmt->close();
        
        // Commit the transaction
        mysqli_commit($con);
        header("Location: ../Login/logout.php");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction on error
        mysqli_rollback($con);
        echo "Error deleting admin: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    }
} else {
    echo "Invalid request.";
}
?>
