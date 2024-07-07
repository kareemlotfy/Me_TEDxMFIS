<?php 
require("../Misc/db_conn.php");
require("../Misc/functions.php");
adminLogin();

$admin_id = $_SESSION['adminId']; // Assuming admin ID is stored in session after login
$page_id = 6; // Example: Page X ID
$has_permission = mysqli_query($con, "SELECT * FROM permissions WHERE admin_id=$admin_id AND page_id=$page_id");

if (mysqli_num_rows($has_permission) == 0) {
    // Admin doesn't have permission to access this page
    header("Location: ../Misc/unauthorized.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/TEDxManaratAlfaroukSchool/">
    <link rel="stylesheet" href="admin/css/style.css">
    <link rel="stylesheet" href="admin/css/style-profile.css">
    <title>Admin Panel - TEDx Manarat AlFarouk School</title>
    <link rel="shortcut icon" href="admin/images/x-art.png" type="image/x-icon">

</head>
<body>

<nav class="navbar">
<h1>Profile</h1>
    <form>
            <i class="fa-solid fa-bars"></i>
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
    <button><a href="admin/Permissions/permissions_page.php">Admins & Permissions</a></button>
</div>

</body>
</html>