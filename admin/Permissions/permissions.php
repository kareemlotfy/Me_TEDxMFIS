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

    if (!is_null($admin_id)) {
        // Clear existing permissions for the admin
        $mysqli->query("DELETE FROM permissions WHERE admin_id=$admin_id");

        // Insert new permissions
        foreach ($new_permissions as $page_id) {
            $mysqli->query("INSERT INTO permissions (admin_id, page_id) VALUES ($admin_id, $page_id)");
        }

        // Redirect back to permissions_page.php after saving permissions
        header("Location: permissions_page.php");
        exit();
    }
}

// Fetch admin details and permissions
if (isset($_GET['admin_id'])) {
    $admin_id = $_GET['admin_id'];
    
    // Retrieve admin's details
    $admin_query = $mysqli->query("SELECT * FROM admin_cred WHERE id=$admin_id");
    $admin = $admin_query->fetch_assoc();
    
    // Retrieve list of pages
    $pages_query = $mysqli->query("SELECT * FROM pages");
    
    // Retrieve admin's permissions
    $permissions_query = $mysqli->query("SELECT page_id FROM permissions WHERE admin_id=$admin_id");
    $permissions = [];
    while ($row = $permissions_query->fetch_assoc()) {
        $permissions[] = $row['page_id'];
    }
} else {
    // Admin ID not provided, return error
    echo "Admin ID not provided";
    exit();
}

// Display admin's permissions with checkboxes
if ($admin !== null && $admin_id != 1) {
    echo "<h2>Permissions for ".$admin['admin_name']."</h2>";
    echo "<form method='post' action='admin/Permissions/permissions.php'>";
    while ($page = mysqli_fetch_assoc($pages_query)) {
        $checked = in_array($page['id'], $permissions) ? "checked" : "";
        echo "<input type='checkbox' name='permissions[]' value='".$page['id']."' $checked>".$page['name']."<br>";
    }
    echo "<input type='hidden' name='admin_id' value='".$admin_id."'>";
    echo "<input type='submit' value='Save'>";
    echo "</form>";
} else {
    echo "Admin not found or is super admin";
}

?>