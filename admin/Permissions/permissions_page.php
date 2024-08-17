<?php
require_once("../Misc/db_conn.php");
require_once("../Misc/functions.php");

// Ensure the admin is logged in
adminLogin();

// Fetch admin ID from session
$admin_id = $_SESSION['adminId'];
$adminName = getAdminName($con, $admin_id);
$page_id = 8; // Example: Page X ID

// Check if the admin has permission to access this page
$permission_query = "SELECT * FROM permissions WHERE admin_id = ? AND page_id = ?";
$permission_stmt = $con->prepare($permission_query);
$permission_stmt->bind_param("ii", $admin_id, $page_id);
$permission_stmt->execute();
$has_permission = $permission_stmt->get_result();

if ($has_permission->num_rows == 0) {
    // Redirect to unauthorized page if no permission
    header("Location: ../Misc/unauthorized.php");
    exit();
}
$permission_stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<!-- <div class="main">
        <div class="container">
            <div class="box form-box">
                <header>Add Another Admin</header>
                <form method="POST">
                    <div class="field input">
                        <label for="name">Name</label>
                        <input type="text" name="new_name" id="new_name" autocomplete="off" required>
                    </div>
                    <div class="field input">
                        <label for="username">Username</label>
                        <input type="text" name="new_username" id="new_username" autocomplete="off" required>
                    </div>
                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="new_password" id="new_password" autocomplete="off" required>
                    </div>
                    <div class="field input">
                        <label for="committee">Committee</label>
                        <select name="new_committee" id="new_committee" required>
                            <option value="" disabled selected>Select Committee</option>
                            <option value="Coaching">Coaching</option>
                            <option value="Designs">Designs</option>
                            <option value="Logistics">Logistics</option>
                            <option value="Human Resources (HR)">Human Resources (HR)</option>
                            <option value="Marketing">Marketing</option>
                            <option value="Information Technology (IT)">Information Technology (IT)</option>
                            <option value="Media">Media</option>
                            <option value="Public Relations (PR)">Public Relations (PR)</option>
                        </select>
                    </div>
                    <div class="field input">
                        <label for="position">Position</label>
                        <select name="new_position" id="new_position" required>
                            <option value="" disabled selected>Select Position</option>
                            <option value="Organizer">Organizer</option>
                            <option value="Operation">Operation</option>
                            <option value="Head">Head</option>
                            <option value="Vice">Vice</option>
                            <option value="Member">Member</option>
                        </select>
                    </div>
                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="email" name="new_email" id="new_email" autocomplete="off" required>
                    </div>
                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div> -->

<!-- 
    <?php
    // Fetch and display list of admins
    $admins_query = "SELECT * FROM admin_cred";
    $admins_stmt = $con->prepare($admins_query);
    $admins_stmt->execute();
    $admins = $admins_stmt->get_result();

    // Display admins and store the first admin's ID
    $first_admin_id = null;
    echo "<h2>Admins</h2>";
    echo "<ul>";
    while ($admin = $admins->fetch_assoc()) {
        if ($admin['id'] != $_SESSION["adminId"]) {
            if ($first_admin_id === null) {
                $first_admin_id = $admin['id'];
            }
            echo "<li><a href='#' onclick='showPermissions(" . htmlspecialchars($admin['id']) . "); return false;'>" . htmlspecialchars($admin['admin_name']) . "</a> <a href='#' onclick='confirmDelete(" . htmlspecialchars($admin['id']) . "); return false;'><i class='fa fa-trash'></i></a></li>";
        }
    }
    echo "</ul>";
    $admins_stmt->close();
    ?>

    <div id="permissionsSection"></div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $frm_data = filteration($_POST);

        $newName = $frm_data['new_name'];
        $newUsername = $frm_data['new_username'];
        $newPassword = $frm_data['new_password'];
        $newCommittee = $frm_data['new_committee'];
        $newPosition = $frm_data['new_position'];
        $newEmail = $frm_data['new_email'];

        // Check if username already exists
        $check_query = "SELECT * FROM admin_cred WHERE admin_username = ? AND admin_name = ?";
        $check_stmt = $con->prepare($check_query);
        $check_stmt->bind_param("ss", $newUsername, $newName);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if (!empty($newName) && !empty($newUsername) && !empty($newPassword) && !empty($newCommittee) && !empty($newPosition) && !empty($newEmail)) {
            if ($result->num_rows > 0) {
                alert("error", "Username Already Exists!", "The username you entered is already in use. Please choose a different username and try again.");
                addBodyClassAndStyle();
            } else {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $insert_query = "INSERT INTO admin_cred (admin_name, admin_username, admin_pass, admin_committee, admin_position, email) VALUES (?, ?, ?, ?, ?, ?)";
                $insert_stmt = $con->prepare($insert_query);
                $insert_stmt->bind_param("ssssss", $newName, $newUsername, $hashedPassword, $newCommittee, $newPosition, $newEmail);

                if ($insert_stmt->execute()) {
                    alert("success", "New admin account created successfully", "Congratulations! Your new admin account has been created successfully. You can now log in using your credentials.");
                    addBodyClassAndStyle();
                } else {
                    echo "Error: " . $insert_stmt->error;
                }
                $insert_stmt->close();
            }
            $check_stmt->close();
        } else {
            alert("error", "Please fill in all required fields", "Oops! It seems like you missed filling in some required fields. Please make sure to fill in all the mandatory information and try again.");
            addBodyClassAndStyle();
        }
    }
    ?>
 -->


<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact ">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="admin/assets/img/logos/x-art.png" />

    <!-- Base -->
    <base href="http://localhost/Me_TEDxMFIS/">
    <link rel="stylesheet" href="admin/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="admin/assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="admin/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="admin/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="admin/assets/vendor/css/core.css" />
    <link rel="stylesheet" href="admin/assets/vendor/css/theme-default.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="admin/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="admin/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Helpers -->
    <script src="admin/assets/vendor/js/helpers.js"></script>
    <script src="admin/assets/js/config.js"></script>
    <style>
        /* Basic resets */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .newcontainer {
            display: flex;
            border-radius: 10px;
            /* box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); */
            overflow: hidden;
            gap: 20px;
            padding: 20px;
        }

        .roles-list {
            /* width: 200px; */
            flex-basis: 30%;
            padding: 20px;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-radius: 15px;
        }

        .role-item {
            display: flex;
            align-items: center;
            padding: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 5px;
        }

        .role-item:hover,
        .role-item.active {
            background-color: #e1e1e1;
        }

        .role-color {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .role-color.green {
            background-color: #00ff00;
        }

        .role-color.red {
            background-color: #ff0000;
        }

        .role-color.yellow {
            background-color: #ffcc00;
        }

        .create-role {
            padding: 10px;
            background-color: #735cdd;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .create-role:hover {
            background-color: #5941a9;
        }

        .role-edit {
            padding: 20px;
            flex-basis: 70%;
            background-color: #fff;
            border-radius: 15px;
        }

        .role-edit h2 {
            margin-bottom: 20px;
        }

        .edit-form label {
            display: block;
            margin-bottom: 5px;
        }

        .edit-form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .toggle-section {
            margin-bottom: 20px;
        }

        .toggle-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #e1e1e1;
        }

        .toggle-item:last-child {
            border-bottom: none;
        }

        /* Switch */
        .switch {
            position: relative;
            display: inline-block;
            width: 34px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            border-radius: 34px;
            cursor: pointer;
            transition: 0.4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 12px;
            width: 12px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            border-radius: 50%;
            transition: 0.4s;
        }

        input:checked+.slider {
            background-color: #735cdd;
        }

        input:checked+.slider:before {
            transform: translateX(14px);
        }

        /* Action buttons */
        .action-buttons {
            display: flex;
            justify-content: flex-start;
            margin-top: 20px;
        }

        .action-buttons button {
            border: none;
            background: none;
            font-size: 20px;
            margin-right: 10px;
            cursor: pointer;
            color: #666;
            transition: color 0.3s ease;
        }

        .action-buttons button:hover {
            color: #333;
        }
    </style>

</head>

<body>


    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">

            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


                <div class="app-brand demo pb-4 pt-4 ">
                    <a href="index.html" class="app-brand-link">
                        <img src="admin/assets/img/logos/TEDx_logo_place2_RGB_CS2_page-0001.jpg" alt="tedx logo"
                            id="tedx_logo" style="
    width: auto;
    height: 60px;">
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>



                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item ">
                        <a href="admin/Dashboard/dashboard.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-smile"></i>
                            <div class="text-truncate" data-i18n="Dashboards">Dashboards</div>
                        </a>
                    </li>

                    <!-- e-commerce-app menu start -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class='menu-icon tf-icons bx bx-cart-alt'></i>
                            <div class="text-truncate" data-i18n="eCommerce">eCommerce</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="app-ecommerce-dashboard.html" class="menu-link">
                                    <div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div class="text-truncate" data-i18n="Products">Products</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="app-ecommerce-product-list.html" class="menu-link">
                                            <div class="text-truncate" data-i18n="Product List">Product List</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-product-add.html" class="menu-link">
                                            <div class="text-truncate" data-i18n="Add Product">Add Product</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-category-list.html" class="menu-link">
                                            <div class="text-truncate" data-i18n="Category List">Category List</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div class="text-truncate" data-i18n="Order">Order</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="app-ecommerce-order-list.html" class="menu-link">
                                            <div class="text-truncate" data-i18n="Order List">Order List</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-order-details.html" class="menu-link">
                                            <div class="text-truncate" data-i18n="Order Details">Order Details</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div class="text-truncate" data-i18n="Customer">Customer</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="app-ecommerce-customer-all.html" class="menu-link">
                                            <div class="text-truncate" data-i18n="All Customers">All Customers</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <div class="text-truncate" data-i18n="Customer Details">Customer Details
                                            </div>
                                        </a>
                                        <ul class="menu-sub">
                                            <li class="menu-item">
                                                <a href="app-ecommerce-customer-details-overview.html"
                                                    class="menu-link">
                                                    <div class="text-truncate" data-i18n="Overview">Overview</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="app-ecommerce-customer-details-security.html"
                                                    class="menu-link">
                                                    <div class="text-truncate" data-i18n="Security">Security</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="app-ecommerce-customer-details-billing.html" class="menu-link">
                                                    <div class="text-truncate" data-i18n="Address & Billing">Address &
                                                        Billing</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
                                <a href="app-ecommerce-manage-reviews.html" class="menu-link">
                                    <div class="text-truncate" data-i18n="Manage Reviews">Manage Reviews</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="app-ecommerce-referral.html" class="menu-link">
                                    <div class="text-truncate" data-i18n="Referrals">Referrals</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div class="text-truncate" data-i18n="Settings">Settings</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="app-ecommerce-settings-detail.html" class="menu-link">
                                            <div class="text-truncate" data-i18n="Store Details">Store Details</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-settings-payments.html" class="menu-link">
                                            <div class="text-truncate" data-i18n="Payments">Payments</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-settings-checkout.html" class="menu-link">
                                            <div class="text-truncate" data-i18n="Checkout">Checkout</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-settings-shipping.html" class="menu-link">
                                            <div class="text-truncate" data-i18n="Shipping & Delivery">Shipping &
                                                Delivery</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-settings-locations.html" class="menu-link">
                                            <div class="text-truncate" data-i18n="Locations">Locations</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-settings-notifications.html" class="menu-link">
                                            <div class="text-truncate" data-i18n="Notifications">Notifications</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- e-commerce-app menu end -->
                    <li class="menu-item">
                        <a href="admin/Tickets/tickets.php?userFilter=all" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div class="text-truncate" data-i18n="Users">Users</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="admin/Settings/settings.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-cog"></i>
                            <div class="text-truncate" data-i18n="Settings">Settings</div>
                        </a>
                    </li>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0   d-xl-none ">
                        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                            <i class="bx bx-menu bx-md"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Language -->
                            <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <i class='bx bx-globe bx-sm'></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-language="en"
                                            data-text-direction="ltr">
                                            <span>English</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-language="fr"
                                            data-text-direction="ltr">
                                            <span>French</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-language="ar"
                                            data-text-direction="rtl">
                                            <span>Arabic</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);" data-language="de"
                                            data-text-direction="ltr">
                                            <span>German</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- /Language -->

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="admin/assets/img/avatars/1.png" alt
                                            class="w-px-40 h-auto rounded-circle">
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="admin/Profile/profile.php">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="admin/assets/img/avatars/1.png" alt
                                                            class="w-px-40 h-auto rounded-circle">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0"><?php echo htmlspecialchars($adminName); ?></h6>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider my-1"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="admin\Profile\profile.php">
                                            <i class="bx bx-user bx-md me-3"></i><span>My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="admin\Profile\edit_account.php">
                                            <i class="bx bx-cog bx-md me-3"></i><span>Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider my-1"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="admin/Login/logout.php" target="_blank">
                                            <i class="bx bx-power-off bx-md me-3"></i><span>Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>


                    <!-- Search Small Screens -->
                    <div class="navbar-search-wrapper search-input-wrapper  d-none">
                        <input type="text" class="form-control search-input container-xxl border-0"
                            placeholder="Search..." aria-label="Search...">
                        <i class="bx bx-x bx-md search-toggler cursor-pointer"></i>
                    </div>
                </nav>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="newcontainer">
                            <!-- Left Sidebar -->
                            <div class="roles-list">
                                <div class="role-item active">
                                    <span class="role-color green"></span>
                                    SEO Specialist
                                </div>
                                <div class="role-item">
                                    <span class="role-color red"></span>
                                    Supervisor
                                </div>
                                <div class="role-item">
                                    <span class="role-color red"></span>
                                    Orders specialist
                                </div>
                                <div class="role-item">
                                    <span class="role-color yellow"></span>
                                    Operator
                                </div>
                                <button class="create-role">Create new role</button>
                            </div>

                            <!-- Right Section -->
                            <div class="role-edit">
                                <h2>Role edit - SEO Specialist</h2>
                                <div class="edit-form">
                                    <label>Role name</label>
                                    <input type="text" value="SEO Specialist" disabled>
                                </div>
                                <div class="toggle-section">
                                    <div class="toggle-item">
                                        <span>Products</span>
                                        <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                    <div class="toggle-item">
                                        <span>Settings</span>
                                        <label class="switch">
                                            <input type="checkbox" checked>
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                    <div class="toggle-item">
                                        <span>Orders</span>
                                        <label class="switch">
                                            <input type="checkbox" checked>
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                    <div class="toggle-item">
                                        <span>Blog</span>
                                        <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="action-buttons">
                                    <button class="delete-role"><i class="fa-regular fa-trash-can"></i></button>
                                    <button class="copy-role"><i class="fa-regular fa-clone"></i></button>
                                </div>
                            </div>
                            <!-- / Content -->
                            <div class="content-backdrop fade"></div>
                        </div>
                    </div>

                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>



            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>


            <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>

        </div>
        <!-- / Layout wrapper -->

        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->

        <script src="admin/assets/vendor/libs/jquery/jquery.js"></script>
        <script src="admin/assets/vendor/libs/popper/popper.js"></script>
        <script src="admin/assets/vendor/js/bootstrap.js"></script>
        <script src="admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="admin/assets/vendor/libs/hammer/hammer.js"></script>
        <script src="admin/assets/vendor/libs/i18n/i18n.js"></script>
        <script src="admin/assets/vendor/libs/typeahead-js/typeahead.js"></script>
        <script src="admin/assets/vendor/js/menu.js"></script>

        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="admin/assets/vendor/libs/apex-charts/apexcharts.js"></script>
        <script src="admin/assets/vendor/libs/chartjs/chartjs.js"></script>

        <!-- Main JS -->
        <script src="admin/assets/js/main.js"></script>

        <!-- Page JS -->
        <script src="admin/assets/js/dashboards-analytics.js"></script>

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

            function showPermissions(adminId) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'admin/Permissions/permissions.php?admin_id=' + adminId, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById('permissionsSection').innerHTML = xhr.responseText;
                    } else if (xhr.readyState == 4) {
                        document.getElementById('permissionsSection').innerHTML =
                            "An error occurred while loading permissions.";
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
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert(xhr.responseText); // Show alert message from server
                        location.reload(); // Refresh the page after deletion
                    } else if (xhr.readyState == 4) {
                        alert("Error deleting admin.");
                    }
                };
                xhr.send('admin_id=' + adminId);
            }

            window.onload = function () {
                let firstAdminId = < ? php echo json_encode($first_admin_id); ? > ;
                if (firstAdminId !== null) {
                    showPermissions(firstAdminId);
                }
            }
        </script>

</body>

</html>