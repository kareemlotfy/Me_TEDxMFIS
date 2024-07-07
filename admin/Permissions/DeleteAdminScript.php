<?php
require_once("../Misc/db_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['admin_id'])) {
    $adminId = $_POST['admin_id'];

    // Check if the admin is a super admin (Assuming super admin has an admin_id of 1)
    if ($adminId == 1) {
        echo "Error: Cannot delete the super admin.";
        exit();
    }

    // Begin a transaction
    mysqli_begin_transaction($con);

    try {
        // Delete permissions associated with the admin
        $deletePermissionsQuery = "DELETE FROM permissions WHERE admin_id = ?";
        $stmt = $con->prepare($deletePermissionsQuery);
        $stmt->bind_param("i", $adminId);
        $stmt->execute();
        $stmt->close();
        
        // Delete the admin from admin_cred
        $deleteAdminQuery = "DELETE FROM admin_cred WHERE id = ?";
        $stmt = $con->prepare($deleteAdminQuery);
        $stmt->bind_param("i", $adminId);
        $stmt->execute();
        $stmt->close();
        
        // Commit the transaction
        mysqli_commit($con);
        echo "Admin deleted successfully.";
    } catch (Exception $e) {
        // Rollback the transaction on error
        mysqli_rollback($con);
        echo "Error deleting admin: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
