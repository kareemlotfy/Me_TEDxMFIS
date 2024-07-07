<?php 
require("../Misc/db_conn.php");
require("../Misc/functions.php");
adminLogin();

$admin_id = $_SESSION['adminId']; // Assuming admin ID is stored in session after login
$page_id = 8; // Example: Page X ID
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Font Awesome CSS -->
    <title>Admin Panel - TEDx Manarat AlFarouk School</title>
    <link rel="shortcut icon" href="admin/images/x-art.png" type="image/x-icon">
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content span {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content span:hover {
            background-color: #f1f1f1;
        }

        .show {
            display: block;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <h1>Admins & Permissions</h1>
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
    <div class="container">
        <div class="box form-box">
            <header>Add Another Admin</header>
            <form method="POST">
                <div class="field input">
                    <label for="email">Username</label>
                    <input type="text" name="new_username" id="new_username" autocomplete="off">
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="new_password" id="new_password" autocomplete="off">
                </div>

                <div class="dropdown">
                    <div class="field input">
                        <label for="role">Committee</label>
                        <input type="text" name="role_Input" id="role_Input" class="dropbtn" onclick="toggleDropdown()" readonly>
                    </div>
                    <div id="role_Dropdown" class="dropdown-content">
                        <span onclick="select_role('@IT')">@IT</span>
                        <span onclick="select_role('@HR')">@HR</span>
                        <span onclick="select_role('@Marketing')">@Marketing</span>
                        <span onclick="select_role('@ER')">@ER</span>
                        <span onclick="select_role('@Media')">@Media</span>
                        <span onclick="select_role('@Design')">@Design</span>
                        <span onclick="select_role('@coaching')">@coaching</span>
                    </div>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Add">
                </div>
            </form>
        </div>
    </div>

    <?php
    // Include database connection file
    include '../Misc/db_conn.php';

    // Retrieve list of admins
    $admins = mysqli_query($con, "SELECT * FROM admin_cred");

    // Display list of admins and store the first admin's ID
    $first_admin_id = null;
    echo "<h2>Admins</h2>";
    echo "<ul>";
    while ($admin = mysqli_fetch_assoc($admins)) {
        if ($admin['id'] != $_SESSION["adminId"]) {
            if ($first_admin_id === null) {
                $first_admin_id = $admin['id'];
            }
            echo "<li><a href='#' onclick='showPermissions(" . $admin['id'] . "); return false;'>" . $admin['admin_name'] . "</a> <a href='#' onclick='confirmDelete(" . $admin['id'] . "); return false;'><i class='fa fa-trash'></i></a></li>";
        }
    }
    echo "</ul>";
    ?>

    <div id="permissionsSection"></div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $frm_data = filteration($_POST);

        $newUsername = $frm_data['new_username'];
        $newPassword = $frm_data['new_password'];
        $selectedJob = $frm_data['role_Input']; // Retrieve the selected job from the form

        $newUsernameConcatenated = $newUsername . $selectedJob;

        $checkQuery = "SELECT * FROM admin_cred WHERE admin_name = '$newUsernameConcatenated'";
        $result = $con->query($checkQuery);

        if (!empty($newUsername) && !empty($newPassword) && !empty($selectedJob)) {
            if ($result->num_rows > 0) {
                alert("error","Username Already Exists!","The username you entered is already in use. Please choose a different username and try again.");
                addBodyClassAndStyle();
            } else {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $insertQuery = "INSERT INTO admin_cred (admin_name, admin_pass) VALUES ('$newUsernameConcatenated', '$hashedPassword')";
                if ($con->query($insertQuery) === TRUE) {
                    alert("success","New admin account created successfully","Congratulations! Your new admin account has been created successfully. You can now log in using your credentials.");
                    addBodyClassAndStyle();
                } else {
                    echo "Error: " . $insertQuery . "<br>" . $con->error;
                }
            }
            $con->close();
        } else {
            alert("error","Please fill in all required fields","Oops! It seems like you missed filling in some required fields. Please make sure to fill in all the mandatory information and try again.");
            addBodyClassAndStyle();
        }
    }
    ?>

    <script>
        function closePopup() {
            let popup = document.getElementById("popup");
            let newUsername = document.getElementById("new_username");
            popup.classList.add("close_popup");
            document.body.classList.remove("popup_active");
            newUsername.focus();
        }

        function addBodyClassAndStyle() {
            let popup = document.getElementById("popup");
            popup.classList.remove("close_popup");
            document.body.classList.add("popup_active");
        }

        function toggleDropdown() {
            document.getElementById("role_Dropdown").classList.toggle("show");
        }

        function select_role(job) {
            document.getElementById("role_Input").value = job;
            document.getElementById("role_Dropdown").classList.remove("show");
        }

        function showPermissions(adminId) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'admin/Permissions/permissions.php?admin_id=' + adminId, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        document.getElementById('permissionsSection').innerHTML = xhr.responseText;
                    } else {
                        document.getElementById('permissionsSection').innerHTML = "An error occurred while loading permissions.";
                    }
                }
            };
            xhr.send();
        }

        function confirmDelete(adminId) {
            if (confirm("Are you sure you want to delete this admin?")) {
                deleteAdmin(adminId);
            }
        }

        function deleteAdmin(adminId) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'admin/Permissions/DeleteAdminScript.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        alert(xhr.responseText); // Show alert message from server
                        // Optionally update admin list or perform UI update
                        location.reload(); // Refresh the page after deletion
                    } else {
                        alert("Error deleting admin.");
                    }
                }
            };
            xhr.send('admin_id=' + adminId);
        }

        window.onload = function() {
            if (<?php echo $first_admin_id; ?> !== null) {
                showPermissions(<?php echo $first_admin_id; ?>);
            }
        }
    </script>

</body>
</html>
