<?php 

include("../Misc/db_conn.php");
require("../Misc/functions.php");

adminLogin();

$adminId = $_SESSION['adminId']; // Assuming admin ID is stored in session after login
$pageId = 1; // Example: Page X ID

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

<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize input
    $adminName = filter_input(INPUT_POST, 'admin_name', FILTER_SANITIZE_STRING);
    $adminUsername = filter_input(INPUT_POST, 'admin_username', FILTER_SANITIZE_STRING);
    $adminEmail = filter_input(INPUT_POST, 'admin_email', FILTER_SANITIZE_EMAIL);
    $adminCommitee = filter_input(INPUT_POST, 'admin_commitee', FILTER_SANITIZE_STRING);
    $adminPosition = filter_input(INPUT_POST, 'admin_position', FILTER_SANITIZE_STRING);
    $adminNumber = filter_input(INPUT_POST, 'admin_number', FILTER_SANITIZE_NUMBER_INT);

    // Validate required fields
    $errors = [];

    if (empty($adminName)) {
        $errors[] = "Admin name is required.";
    }

    if (empty($adminUsername)) {
        $errors[] = "Admin username is required.";
    }

    if (empty($adminEmail) || !filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid admin email is required.";
    }

    if (empty($adminCommitee)) {
        $errors[] = "Admin committee is required.";
    }

    if (empty($adminPosition)) {
        $errors[] = "Admin position is required.";
    }

    if (empty($adminNumber)) {
        $errors[] = "Admin Number is required.";
    }

    if (empty($errors)) {
        // Update admin data in the database
        $update_sql = "UPDATE admin_cred SET admin_name = ?, admin_username = ?, admin_email = ?, admin_commitee = ?, admin_position = ?, admin_number = ? WHERE id = ?";
        $stmt = $con->prepare($update_sql);

        if (!$stmt) {
            alert("error", "Error", "Prepare failed: (" . $con->errno . ") " . $con->error);
            exit();
        }

        $stmt->bind_param("sssssii", $adminName, $adminUsername, $adminEmail, $adminCommitee, $adminPosition, $adminNumber, $adminId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            alert("success","Success","Account updated successfully.");
        } else {
            alert("error","Error","Error updating account or no changes made.");
        }

        $stmt->close();
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            alert("error", "Validation Error", $error);
        }
    }
}
?>

<!DOCTYPE html>


<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr"
    data-theme="theme-default" data-assets-path="admin/assets/" data-template="vertical-menu-template"
    data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Account Settings</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="admin/assets/img/logos/x-art.png" />

    <!-- Base -->
    <base href="http://localhost/TEDxManaratAlfaroukSchool/">
    <link rel="stylesheet" href="admin/css/style.css">
    <link rel="stylesheet" href="admin/css/style-profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Font Awesome CSS -->

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
    <link rel="stylesheet" href="admin/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="admin/assets/vendor/libs/@form-validation/form-validation.css" />
    <link rel="stylesheet" href="admin/assets/vendor/libs/animate-css/animate.css" />
    <link rel="stylesheet" href="admin/assets/vendor/libs/sweetalert2/sweetalert2.css" />

    <!-- Page CSS -->


    <!-- Helpers -->
    <script src="admin/assets/vendor/js/helpers.js"></script>
    <script src="admin/assets/js/config.js"></script>

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
                    <li class="menu-item">
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


                        <div class="row">
                            <div class="col-md-12">

                                <div class="card mb-6">
                                    <!-- Account -->
                                    <div class="card-body">
                                        <div
                                            class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
                                            <img src="admin/Profile/<?php echo !empty($adminPic) ? $adminPic : 'default-pic.jpg'; ?>"
                                                alt="user-avatar" class="d-block w-px-100 h-px-100 rounded"
                                                id="uploadedAvatar" />
                                            <div class="button-wrapper">
                                                <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                                                    <span class="d-none d-sm-block">Upload new photo</span>
                                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                                    <input type="file" id="upload" class="account-file-input" hidden
                                                        accept="image/png, image/jpeg" />
                                                </label>

                                                <div>Allowed JPG, GIF or PNG. Max size of 800K</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-4">
                                        <form id="formAccountSettings" method="POST">
                                            <div class="row g-6">
                                                <div class="col-md-6">
                                                    <label for="admin_name" class="form-label">Admin Name</label>
                                                    <input class="form-control" type="text" id="admin_name"
                                                        name="admin_name"
                                                        value="<?php echo htmlspecialchars($adminName); ?>" autofocus
                                                        required />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="admin_username" class="form-label">Username</label>
                                                    <input class="form-control" type="text" name="admin_username"
                                                        id="admin_username"
                                                        value="<?php echo htmlspecialchars($adminUsername); ?>"
                                                        required />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="admin_email" class="form-label">E-mail</label>
                                                    <input class="form-control" type="text" id="email" name="admin_email"
                                                        value="<?php echo htmlspecialchars($adminEmail); ?>"
                                                        placeholder="john.doe@example.com" required />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="phoneNumber">Phone Number</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text">EG (+20)</span>
                                                        <input type="text" id="phoneNumber" name="admin_number"
                                                            value="<?php echo htmlspecialchars($adminNumber); ?>"
                                                            class="form-control" placeholder="1234567890" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="admin_commitee">Commetie</label>
                                                    <div class="input-group input-group-merge">
                                                        <select name="admin_commitee" id="admin_committee"
                                                            class="form-control">
                                                            <option value="Coaching"
                                                                <?php echo $adminCommitee == 'Coaching' ? 'selected' : ''; ?>>
                                                                Coaching</option>
                                                            <option value="Designs"
                                                                <?php echo $adminCommitee == 'Designs' ? 'selected' : ''; ?>>
                                                                Designs</option>
                                                            <option value="Logistics"
                                                                <?php echo $adminCommitee == 'Logistics' ? 'selected' : ''; ?>>
                                                                Logistics</option>
                                                            <option value="Human Resources (HR)"
                                                                <?php echo $adminCommitee == 'Human Resources (HR)' ? 'selected' : ''; ?>>
                                                                Human Resources (HR)</option>
                                                            <option value="Marketing"
                                                                <?php echo $adminCommitee == 'Marketing' ? 'selected' : ''; ?>>
                                                                Marketing</option>
                                                            <option value="Information Technology (IT)"
                                                                <?php echo $adminCommitee == 'Information Technology (IT)' ? 'selected' : ''; ?>>
                                                                Information Technology (IT)</option>
                                                            <option value="Media"
                                                                <?php echo $adminCommitee == 'Media' ? 'selected' : ''; ?>>
                                                                Media</option>
                                                            <option value="Public Relations (PR)"
                                                                <?php echo $adminCommitee == 'Public Relations (PR)' ? 'selected' : ''; ?>>
                                                                Public Relations (PR)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="admin_position">Position</label>
                                                    <div class="input-group input-group-merge">
                                                        <select name="admin_position" id="admin_position"
                                                            class="form-control">
                                                            <option value="Organizer"
                                                                <?php echo $adminPosition == 'Organizer' ? 'selected' : ''; ?>>
                                                                Organizer</option>
                                                            <option value="Operation"
                                                                <?php echo $adminPosition == 'Operation' ? 'selected' : ''; ?>>
                                                                Operation</option>
                                                            <option value="Head"
                                                                <?php echo $adminPosition == 'Head' ? 'selected' : ''; ?>>
                                                                Head</option>
                                                            <option value="Vice"
                                                                <?php echo $adminPosition == 'Vice' ? 'selected' : ''; ?>>
                                                                Vice</option>
                                                            <option value="Member"
                                                                <?php echo $adminPosition == 'Member' ? 'selected' : ''; ?>>
                                                                Member</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-6">
                                                <button type="submit" class="btn btn-primary me-3">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /Account -->
                                </div>
                                <div class="card mb-6">
                                    <!-- Change Password -->
                                    <h5 class="card-header">Change Password</h5>
                                    <div class="card-body pt-1">
                                    <form id="formAccountSettings" method="POST" action="admin/Profile/change_password.php" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                                            <div class="row">
                                                <div
                                                    class="mb-6 col-md-6 form-password-toggle fv-plugins-icon-container">
                                                    <label class="form-label" for="currentPassword">Current
                                                        Password</label>
                                                    <div class="input-group input-group-merge has-validation">
                                                        <input class="form-control" type="password"
                                                            name="currentPassword" id="currentPassword"
                                                            placeholder="············">
                                                        <span class="input-group-text cursor-pointer"><i
                                                                class="bx bx-hide"></i></span>
                                                    </div>
                                                    <div
                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div
                                                    class="mb-6 col-md-6 form-password-toggle fv-plugins-icon-container">
                                                    <label class="form-label" for="newPassword">New Password</label>
                                                    <div class="input-group input-group-merge has-validation">
                                                        <input class="form-control" type="password" id="newPassword"
                                                            name="newPassword" placeholder="············">
                                                        <span class="input-group-text cursor-pointer"><i
                                                                class="bx bx-hide"></i></span>
                                                    </div>
                                                    <div
                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                    </div>
                                                </div>

                                                <div
                                                    class="mb-6 col-md-6 form-password-toggle fv-plugins-icon-container">
                                                    <label class="form-label" for="confirmPassword">Confirm New
                                                        Password</label>
                                                    <div class="input-group input-group-merge has-validation">
                                                        <input class="form-control" type="password"
                                                            name="confirmPassword" id="confirmPassword"
                                                            placeholder="············">
                                                        <span class="input-group-text cursor-pointer"><i
                                                                class="bx bx-hide"></i></span>
                                                    </div>
                                                    <div
                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="text-body">Password Requirements:</h6>
                                            <ul class="ps-4 mb-0">
                                                <li class="mb-4">Minimum 8 characters long - the more, the better</li>
                                                <li class="mb-4">At least one lowercase character</li>
                                                <li>At least one number, symbol, or whitespace character</li>
                                            </ul>
                                            <div class="mt-6">
                                                <button type="submit" class="btn btn-primary me-3">Save changes</button>
                                            </div>
                                            <input type="hidden">
                                        </form>
                                    </div>
                                    <!-- / Change Password -->
                                </div>
                                <div class="card">
    <h5 class="card-header">Delete Account</h5>
    <div class="card-body">
        <div class="mb-6 col-12 mb-0">
            <div class="alert alert-warning">
                <h5 class="alert-heading mb-1">Are you sure you want to delete your account?</h5>
                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
            </div>
        </div>
        <form action="admin/Profile/DeleteAdminScript.php" id="formAccountDeactivation" method="POST">
            <div class="form-check my-8 ms-2">
                <input type="hidden" name="delete_account" value="1">
                <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
                <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
            </div>
            <button type="submit" class="btn btn-danger deactivate-account" id="deactivateButton" disabled>Deactivate Account</button>
        </form>
    </div>
</div>
                    <!-- / Content -->



                    <div class="content-backdrop fade"></div>
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
    <script src="admin/assets/vendor/libs/select2/select2.js"></script>
    <script src="admin/assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="admin/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="admin/assets/vendor/libs/@form-validation/auto-focus.js"></script>
    <script src="admin/assets/vendor/libs/cleavejs/cleave.js"></script>
    <script src="admin/assets/vendor/libs/cleavejs/cleave-phone.js"></script>
    <script src="admin/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>

    <!-- Main JS -->
    <script src="admin/assets/js/main.js"></script>


    <!-- Page JS -->
    <script src="admin/assets/js/pages-account-settings-account.js"></script>

    <script>
    // Get the checkbox and the button
    const checkbox = document.getElementById('accountActivation');
    const deactivateButton = document.getElementById('deactivateButton');

    // Add an event listener to the checkbox
    checkbox.addEventListener('change', function () {
        // Enable the button if the checkbox is checked, otherwise disable it
        deactivateButton.disabled = !this.checked;
    });
</script>

</body>

</html>