<?php 

include("../Misc/db_conn.php");
require("../Misc/functions.php");

adminLogin();

$adminId = $_SESSION['adminId']; // Assuming admin ID is stored in session after login
$pageId = 8; // Example: replace with the actual page ID you want to check

checkAdminPermission($con, $adminId, $pageId);
?>

<?php

$adminDetails = getAdminDetails($con, $adminId);

if ($adminDetails) {
    $adminName = $adminDetails['admin_name'];
    $adminCommitee = $adminDetails['admin_commitee'];
    $adminPic = $adminDetails['admin_pic'];
    $adminPosition = $adminDetails['admin_position'];
    $adminEmail = $adminDetails['admin_email'];
    $adminUsername = $adminDetails['admin_username'];
    $adminNumber = $adminDetails['admin_number'];
} else {
    echo "Admin details not found.";
}

?>


<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact ">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Profile</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="admin/assets/img/logos/x-art.png" />

    <!-- Base -->
    <base href="http://localhost/TEDxManaratAlfaroukSchool/">
    <link rel="stylesheet" href="admin/css/style.css">
    <link rel="stylesheet" href="admin/css/style-profile.css">
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
    <link rel="stylesheet" href="admin/assets/vendor/css/pages/page-profile.css" />


    <!-- Vendors CSS -->
    <link rel="stylesheet" href="admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="admin/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="admin/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Helpers -->
    <script src="admin/assets/vendor/js/helpers.js"></script>
    <script src="admin/assets/js/config.js"></script>
    <style>
        /* Basic resets */

        .saveButton {
            margin-top: 20px;
            border-radius: 10px;
        }

        .newcontainer {
            display: grid;
            grid-template-columns: 0.3fr 0.7fr;
            border-radius: 10px;
            /* box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); */
            overflow: hidden;
            gap: 20px;
            padding: 20px;
        }

        .toggle-section {
            display: flex;
            flex-direction: column;
            width: 100%;
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
            justify-content: space-between;
            padding: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 10px;
            border: 1px solid #d7d7d7aa;
        }

        .role-item a {
            color: #333;
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
            color: #fff;
            border: none;
            border-radius: 10px;
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
                    <a href="admin/Dashboard/dashboard.php" class="app-brand-link">
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
                    <li class="menu-item permi">
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
                                        <img src="admin/Profile/<?php echo !empty($adminPic) ? $adminPic : 'default-pic.jpg'; ?>" alt
                                            class="w-px-40 h-auto rounded-circle">
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="admin/Profile/profile.php">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="admin/Profile/<?php echo !empty($adminPic) ? $adminPic : 'default-pic.jpg'; ?>" alt
                                                            class="w-px-40 h-auto rounded-circle">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0"><?php echo htmlspecialchars($adminName); ?></h6>
                                                    <small class="text-muted"><?php echo htmlspecialchars($adminCommitee); ?></small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider my-1"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item menu-link" href="admin\Profile\profile.php">
                                            <i class="bx bx-user bx-sm me-3"></i><span>My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item menu-link" href="admin\Profile\edit_account.php">
                                            <i class="bx bx-cog bx-sm me-3"></i><span>Account Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider my-1"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item menu-link" href="admin/Login/logout.php">
                                            <i class="bx bx-power-off bx-sm me-3"></i><span>Log Out</span>
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
                        <!-- Header -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-6">
                                    <div class="user-profile-header-banner">
                                        <img src="admin/assets/img/pages/profile-banner.png" alt="Banner image"
                                            class="rounded-top">
                                    </div>
                                    <div
                                        class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center mb-8">
                                        <div class="flex-shrink-0 mt-1 mx-sm-0 mx-auto">
                                            <img src="admin/Profile/<?php echo !empty($adminPic) ? $adminPic : 'default-pic.jpg'; ?>"
                                                alt="user image"
                                                class="d-block h-auto ms-0 ms-sm-6 rounded-3 user-profile-img">
                                        </div>
                                        <div class="flex-grow-1 mt-3 mt-lg-5">
                                            <div
                                                class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-5 flex-md-row flex-column gap-4">
                                                <div class="user-profile-info">
                                                    <h4 class="mb-2 mt-lg-7"><?php echo htmlspecialchars($adminName); ?>
                                                    </h4>
                                                    <ul
                                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-4 mt-4">
                                                        <li class="list-inline-item">
                                                            <i class='bx bx-palette me-2 align-top'></i><span
                                                                class="fw-medium"><?php echo htmlspecialchars($adminCommitee); ?></span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <i class='bx bx-map me-2 align-top'></i><span
                                                                class="fw-medium">Cairo City</span>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <i class='bx bx-calendar me-2 align-top'></i><span
                                                                class="fw-medium"> Joined April
                                                                2021</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <a href="javascript:void(0)" class="btn btn-primary mb-1">
                                                    <i class='bx bx-user-check bx-sm me-2'></i>Connected
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Header -->

                        <!-- Navbar pills -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="nav-align-top">
                                    <ul class="nav nav-pills flex-column flex-sm-row mb-6">
                                        <li class="nav-item"><a class="nav-link"
                                                href="admin/Profile/profile.php"><i class='bx bx-user bx-sm me-1_5'></i>
                                                Profile</a></li>
                                        <li class="nav-item"><a class="nav-link active"
                                                href="admin/Permissions/permissions_page.php"><i
                                                    class='bx bx-group bx-sm me-1_5'></i> Admins and Permitions</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--/ Navbar pills -->
                        <div class="newcontainer">
                            <!-- Left Sidebar -->
                            <div class="roles-list">
                                <?php
    // Fetch and display list of admins
    $admins_query = "SELECT * FROM admin_cred";
    $admins_stmt = $con->prepare($admins_query);
    $admins_stmt->execute();
    $admins = $admins_stmt->get_result();

    // Display admins and store the first admin's ID
    $first_admin_id = null;
    while ($admin = $admins->fetch_assoc()) {
        if ($admin['id'] != $_SESSION["adminId"]) {
            if ($first_admin_id === null) {
                $first_admin_id = $admin['id'];
            }
            echo "<div class='role-item '>";
            echo "<span class='role-color green'></span>";
            echo "<a href='#' onclick='showPermissions(" . htmlspecialchars($admin['id']) . "); return false;'>" . htmlspecialchars($admin['admin_name']) . "</a> <a href='javascript:void(0);' onclick='confirmDelete(" . htmlspecialchars($admin['id']) . "); return false;'><i class='fa-regular fa-trash-can'></i></a>";
            echo "</div>";
        }
    }
    
    $admins_stmt->close();
    ?>
                                <button class=" create-role btn btn-secondary add-new btn-primary" type="button"
                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddAdmin">Add New
                                    Admin</button>
                            </div>



                            <!-- Right Section -->
                            <div id="permissionsSection"></div>
                            <!-- / Content -->
                            <div class="content-backdrop fade"></div>
                        </div>
                    </div>

                    <!-- Content wrapper -->
                </div>
                <!-- / Layout page -->
            </div>

            <!-- Offcanvas to add new user -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddAdmin"
                aria-labelledby="offcanvasAddUserLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
                    <form method="POST" class="add-new-user pt-0 fv-plugins-bootstrap5 fv-plugins-framework"
                        id="addNewAdminForm">
                        <div class="mb-6 fv-plugins-icon-container">
                            <label class="form-label" for="name">Full Name</label>
                            <input type="text" class="form-control" placeholder="John Doe" name="new_name" id="new_name"
                                autocomplete="off" required>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <div class="mb-6 fv-plugins-icon-container">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control" placeholder="john.doe@example.com" name="new_email"
                                id="new_email" autocomplete="off" required>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <div class="mb-6 fv-plugins-icon-container">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" class="form-control" placeholder="" name="new_username" id="new_username"
                                autocomplete="off" required>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <!-- Contace Place -->
                        <!-- <div class="mb-6">
                            <label class="form-label" for="add-user-contact">Contact</label>
                            <input type="text" id="add-user-contact" class="form-control phone-mask"
                                placeholder="+1 (609) 988-44-11" aria-label="john.doe@example.com" name="userContact">
                        </div> -->
                        <div class="mb-6">
    <label class="form-label" for="password">Password</label>
    <input type="password" class="form-control" name="new_password" id="new_password"
        autocomplete="off" required
        pattern="(?=.*\d)(?=.*[a-z])(?=.*[\W\s]).{8,}"
        title="Password must be at least 8 characters long, contain at least one lowercase letter, and at least one number, symbol, or whitespace character."
        placeholder="Enter a strong password">
</div>
                        <div class="mb-6">
                            <label class="form-label" for="committee">Committee</label>
                            <div class="position-relative">
                                <select name="new_committee" id="new_committee" required
                                    class="select2 form-select select2-hidden-accessible" tabindex="-1"
                                    aria-hidden="true">
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
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="position">Position</label>
                            <select name="new_position" id="new_position" required class="form-select">
                                <option value="" disabled selected>Select Position</option>
                                <option value="Organizer">Organizer</option>
                                <option value="Operation">Operation</option>
                                <option value="Head">Head</option>
                                <option value="Vice">Vice</option>
                                <option value="Member">Member</option>
                            </select>
                        </div>

                        <input type="submit" class="btn btn-primary me-3 data-submit" name="submit"
                            value="Add"></input>
                        <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
                        <input type="hidden">
                    </form>
                </div>
            </div>

            <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $frm_data = filteration($_POST);

    $newName = $frm_data['new_name'];
    $newUsername = $frm_data['new_username'];
    $newPassword = $frm_data['new_password'];
    $newCommittee = $frm_data['new_committee'];
    $newPosition = $frm_data['new_position'];
    $newEmail = $frm_data['new_email'];

    // Server-side password validation
    if (strlen($newPassword) < 8 || 
        !preg_match('/[a-z]/', $newPassword) || 
        !preg_match('/[\d\W\s]/', $newPassword)) {
        alert("error", "Password does not meet requirements", "Password must be at least 8 characters long, contain at least one lowercase letter, and at least one number, symbol, or whitespace character.");
        addBodyClassAndStyle();
    } else {
        // Check if username or email already exists
        $check_query = "SELECT * FROM admin_cred WHERE admin_username = ? OR email = ?";
        $check_stmt = $con->prepare($check_query);
        $check_stmt->bind_param("ss", $newUsername, $newEmail);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            alert("error", "Username or Email Already Exists!", "The username or email you entered is already in use. Please choose a different one and try again.");
            addBodyClassAndStyle();
        } else {
            if (!empty($newName) && !empty($newUsername) && !empty($newPassword) && !empty($newCommittee) && !empty($newPosition) && !empty($newEmail)) {
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
            } else {
                alert("error", "Please fill in all required fields", "Oops! It seems like you missed filling in some required fields. Please make sure to fill in all the mandatory information and try again.");
                addBodyClassAndStyle();
            }
        }
        $check_stmt->close();
        $con->close(); // Close the connection
    }
}
?>




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
                let firstAdminId = <?php echo json_encode($first_admin_id); ?> ;
                if (firstAdminId !== null) {
                    showPermissions(firstAdminId);
                }
            }
        </script>

</body>

</html>