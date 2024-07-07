<?php 

include("../Misc/db_conn.php");
require("../Misc/functions.php");
adminLogin();

$admin_id = $_SESSION['adminId'];
$page_id = 4; // Example: Page X ID
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
    <link rel="stylesheet" href="admin/css/style-settings.css">
    <title>Admin Panel - TEDx Manarat AlFarouk School</title>
    <link rel="shortcut icon" href="admin/images/x-art.png" type="image/x-icon">
</head>
<body>

<nav class="navbar">
    <h1>Settings</h1>
    <form class="centered">
    <a href="admin/Profile/profile.php"><?php echo $_SESSION["adminName"] ?></a>&nbsp;&nbsp;&nbsp;<a href="admin/Profile/profile.php"><i class="fi fi-tr-circle-user"></i></a>
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
        <label for="adminSwitch" class="switch">
            <input type="checkbox" id="adminSwitch">
            <span class="slider"></span>
        </label>
        <p>This Should Shutdown The Tickiting System After The Event Ends</p>
    </div>
</div>


<script>
        document.addEventListener('DOMContentLoaded', () => {
            async function initCheckbox() {
                try {
                    const response = await fetch('user/backend.php');
                    const data = await response.json();
                    document.getElementById('adminSwitch').checked = (data.formOpen === '1');
                } catch (error) {
                    console.error('Error initializing checkbox:', error);
                }
            }

            initCheckbox();

            document.getElementById('adminSwitch').addEventListener('change', async (event) => {
                const isOpen = event.target.checked ? '1' : '0';
                try {
                    await fetch('user/backend.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ isOpen })
                    });
                } catch (error) {
                    console.error('Error updating form status:', error);
                }
            });
        });
    </script>

</body>
</html>