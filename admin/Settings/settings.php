<?php
include("../Misc/db_conn.php");
require("../Misc/functions.php");
adminLogin();

$admin_id = $_SESSION['adminId'];
$adminName = getAdminName($con, $admin_id);

// Validate and sanitize admin_id before using it in the query
if (!filter_var($admin_id, FILTER_VALIDATE_INT)) {
    header("Location: ../Misc/unauthorized.php");
    exit();
}

$page_id = 4; // Example: Page X ID

// Use prepared statements to avoid SQL injection
$stmt = $con->prepare("SELECT * FROM permissions WHERE admin_id=? AND page_id=?");
$stmt->bind_param("ii", $admin_id, $page_id);
$stmt->execute();
$has_permission = $stmt->get_result();

if ($has_permission->num_rows == 0) {
    // Admin doesn't have permission to access this page
    header("Location: ../Misc/unauthorized.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkbox_status'])) {
    $new_status = $_POST['checkbox_status'] ? 1 : 0;
    $query = "UPDATE settings SET checkbox_status = ? WHERE id = 1";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $new_status);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
    exit;
}

// Fetch checkbox status for initial page load
$query = "SELECT checkbox_status FROM settings WHERE id = 1";
$result = $con->query($query);
$checkbox_status = $result->fetch_assoc()['checkbox_status'];

$con->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/TEDxManaratAlfaroukSchool/">
    <link rel="stylesheet" href="admin/css/style.css">
    <link rel="stylesheet" href="admin/css/style-settings.css">
    <title>Admin Panel - TEDx Manarat AlFarouk School</title>
    <link rel="shortcut icon" href="admin/images/x-art.png" type="image/x-icon">
</head>
<body>

<nav class="navbar">
    <h1>Settings</h1>
    <form class="centered">
        <a href="admin/Profile/profile.php"><?php echo htmlspecialchars($adminName); ?></a>&nbsp;&nbsp;&nbsp;
        <a href="admin/Profile/profile.php"><i class="fi fi-tr-circle-user"></i></a>
    </form>
</nav>

<div class="aside">
    <br><br>
    <img src="user/images/TEDx_logo_place2_RGB_CS2_page-0001.jpg" alt="" class="logo">
    <br><br><br>
    <ul>
        <a href="admin/Dashboard/dashboard.php"><li><i class="fi fi-rr-house-chimney"></i> &nbsp;&nbsp;Dashboard</li></a>
        <a href="admin/Tickets/tickets.php?userFilter=all"><li><i class="fi fi-rr-ticket"></i> &nbsp;&nbsp;Tickets</li></a>
        <a href="admin/Misc/coming-soon.php"><li><i class="fi fi-rr-briefcase-blank"></i> &nbsp;&nbsp;Recroute</li></a>
        <a href="admin/Misc/coming-soon.php"><li><i class="fi fi-rr-shopping-cart"></i> &nbsp;&nbsp;Shop</li></a>
        <a href="admin/Settings/settings.php"><li><i class="fi fi-rr-settings"></i> &nbsp;&nbsp;Settings</li></a>
        <br><br><br><br><br>
    </ul>
    <br>
    <a href="admin/Login/logout.php" class="logout"><i class="fi fi-rr-exit"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
</div>

    <div class="main">
    <div class="card_shutdown">
        <h2>Shutdown Ticketing System</h2>
        <label for="settingsCheckbox" class="switch">
            <input type="checkbox" id="settingsCheckbox" <?php if ($checkbox_status) echo 'checked'; ?>>
            <span class="slider"></span>
        </label>
        <p>This Should Shutdown The Ticketing System After The Event Ends</p>
    </div>
</div>

<script>
        function updateCheckboxStatus(checked) {
            var checkboxStatus = checked ? 1 : 0;

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "admin/Settings/settings.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        console.log('Checkbox status updated successfully');
                    } else {
                        console.error('Failed to update checkbox status');
                    }
                }
            };
            xhr.send("checkbox_status=" + checkboxStatus);
        }

        window.onload = function() {
            var checkbox = document.getElementById('settingsCheckbox');
            checkbox.addEventListener('change', function() {
                updateCheckboxStatus(this.checked);
            });
        }
    </script>
</body>
</html>
