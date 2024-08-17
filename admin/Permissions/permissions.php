<?php
// permissions.php

$mysqli = new mysqli("localhost", "root", "", "tedx");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

require("../Misc/functions.php");
adminLogin();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission to update permissions
    $new_permissions = $_POST['permissions'] ?? [];
    $admin_id = $_POST['admin_id'] ?? null;

    if (is_array($new_permissions) && ctype_digit($admin_id)) {
        $admin_id = intval($admin_id); // Ensure admin_id is an integer

        // Clear existing permissions for the admin
        $deleteStmt = $mysqli->prepare("DELETE FROM permissions WHERE admin_id = ?");
        $deleteStmt->bind_param("i", $admin_id);
        $deleteStmt->execute();
        $deleteStmt->close();

        // Insert new permissions
        $insertStmt = $mysqli->prepare("INSERT INTO permissions (admin_id, page_id) VALUES (?, ?)");
        foreach ($new_permissions as $page_id) {
            if (ctype_digit($page_id)) {
                $page_id = intval($page_id); // Ensure page_id is an integer
                $insertStmt->bind_param("ii", $admin_id, $page_id);
                $insertStmt->execute();
            }
        }
        $insertStmt->close();

        // Redirect back to permissions_page.php after saving permissions
        header("Location: permissions_page.php");
        exit();
    } else {
        echo "Invalid admin ID or permissions.";
        exit();
    }
}

// Fetch admin details and permissions
if (isset($_GET['admin_id']) && ctype_digit($_GET['admin_id'])) {
    $admin_id = intval($_GET['admin_id']); // Ensure admin_id is an integer
    
    // Retrieve admin's details
    $adminStmt = $mysqli->prepare("SELECT * FROM admin_cred WHERE id = ?");
    $adminStmt->bind_param("i", $admin_id);
    $adminStmt->execute();
    $admin = $adminStmt->get_result()->fetch_assoc();
    $adminStmt->close();
    
    // Retrieve list of pages
    $pages_query = $mysqli->query("SELECT * FROM pages");
    
    // Retrieve admin's permissions
    $permissionsStmt = $mysqli->prepare("SELECT page_id FROM permissions WHERE admin_id = ?");
    $permissionsStmt->bind_param("i", $admin_id);
    $permissionsStmt->execute();
    $permissions_result = $permissionsStmt->get_result();
    $permissions = [];
    while ($row = $permissions_result->fetch_assoc()) {
        $permissions[] = $row['page_id'];
    }
    $permissionsStmt->close();
} else {
    echo "Admin ID not provided or invalid.";
    exit();
}

// Display admin's permissions with checkboxes
if ($admin !== null && $admin_id != 1) {
    echo "<h2>Permissions for " . htmlspecialchars($admin['admin_name']) . "</h2>";
    echo "<form method='post' action='admin/Permissions/permissions.php'>";
    
    while ($page = $pages_query->fetch_assoc()) {
        $checked = in_array($page['id'], $permissions) ? "checked" : "";
        echo "<input type='checkbox' name='permissions[]' value='" . htmlspecialchars($page['id']) . "' $checked>" . htmlspecialchars($page['name']) . "<br>";
    }
    
    echo "<input type='hidden' name='admin_id' value='" . htmlspecialchars($admin_id) . "'>";
    echo "<input type='submit' value='Save'>";
    echo "</form>";
} else {
    echo "Admin not found or is a super admin.";
}
?>
