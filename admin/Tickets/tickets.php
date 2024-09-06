<?php
// Set secure session cookie parameters before starting the session
ini_set('session.cookie_secure', '1'); // Ensure cookies are sent over HTTPS
ini_set('session.cookie_httponly', '1'); // Prevent JavaScript access to session cookies
ini_set('session.cookie_samesite', 'Strict'); // Mitigate CSRF attacks
?>

<?php 

include("../Misc/db_conn.php");
require("../Misc/functions.php");

adminLogin();

$adminId = $_SESSION['adminId']; // Assuming admin ID is stored in session after login
$pageId = 2; // Example: replace with the actual page ID you want to check

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
} else {
    echo "Admin details not found.";
}

?>

<?php

$limit = 10; // Number of records per page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get current page number from query string, default to page 1
$offset = ($currentPage - 1) * $limit; // Calculate the offset

// Filter condition
$filter = '';
if (isset($_GET['userFilter'])) {
    $userFilter = htmlspecialchars($_GET['userFilter'], ENT_QUOTES, 'UTF-8');
    if ($userFilter == 'paid') {
        $filter = "WHERE isaccepted = 'yes'";
    } elseif ($userFilter == 'unpaid') {
        $filter = "WHERE isaccepted = 'no'";
    }
}

// Search phone
$searchPhone = '';
if (isset($_GET['searchPhone']) && !empty($_GET['searchPhone'])) {
    $searchPhone = $con->real_escape_string($_GET['searchPhone']);
    $filter .= $filter ? " AND phone LIKE '%$searchPhone%'" : "WHERE phone LIKE '%$searchPhone%'";
}

// Count users who paid (isaccepted = 'yes')
$paidCountSql = "SELECT COUNT(*) as paid_count FROM user_cred WHERE isaccepted = 'yes'";
$paidCountResult = $con->query($paidCountSql);

if (!$paidCountResult) {
    die("Invalid query: " . $con->error);
}

$paidCountRow = $paidCountResult->fetch_assoc();
$paidCount = $paidCountRow["paid_count"];

// Count users who did not pay (isaccepted = 'no')
$unpaidCountSql = "SELECT COUNT(*) as unpaid_count FROM user_cred WHERE isaccepted = 'no'";
$unpaidCountResult = $con->query($unpaidCountSql);

if (!$unpaidCountResult) {
    die("Invalid query: " . $con->error);
}

$unpaidCountRow = $unpaidCountResult->fetch_assoc();
$unpaidCount = $unpaidCountRow["unpaid_count"];

// Total user count
$totalUsers = $paidCount + $unpaidCount;

// Query to fetch users with pagination and filter
$sql = "SELECT * FROM user_cred $filter LIMIT ? OFFSET ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Invalid query: " . $con->error);
}

// Total filtered user count
$totalFilteredSql = "SELECT COUNT(*) as total_filtered FROM user_cred $filter";
$totalFilteredResult = $con->query($totalFilteredSql);

if (!$totalFilteredResult) {
    die("Invalid query: " . $con->error);
}

$totalFilteredRow = $totalFilteredResult->fetch_assoc();
$totalFilteredUsers = $totalFilteredRow["total_filtered"];

$con->close();
?>

<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr"
    data-theme="theme-default" data-assets-path="admin/assets/" data-template="vertical-menu-template"
    data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>User</title>
    <!-- Base -->
    <base href="http://localhost/TEDxManaratAlfaroukSchool/">
    <!-- <link rel="stylesheet" href="admin/css/style.css"> -->
    <!-- <link rel="stylesheet" href="admin/css/style-tickets.css"> -->
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="admin/assets/img/logos/x-art.png" />

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
    <link rel="stylesheet" href="admin/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="admin/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="admin/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
    <link rel="stylesheet" href="admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">
    <link rel="stylesheet" href="admin/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css">
    <link rel="stylesheet" href="admin/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="admin/assets/vendor/libs/@form-validation/form-validation.css" />

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
                            <div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
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
                                    <li class="menu-item">3
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
                    <li class="menu-item  active open">
                        <a href="app-user-list.html" class="menu-link">
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
                                        <a class="dropdown-item" href="pages-account-settings-account.html">
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
                                        <a class="dropdown-item menu-link" href="pages-profile-user.html">
                                            <i class="bx bx-user bx-sm me-3"></i><span>My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item menu-link" href="pages-account-settings-account.html">
                                            <i class="bx bx-cog bx-sm me-3"></i><span>Account Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider my-1"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item menu-link" href="auth-login-cover.html">
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
                        <!-- Analysis Part -->
                        <div class="row g-6 mb-6">
                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="content-left">
                                                <span class="text-heading">Total Users</span>
                                                <div class="d-flex align-items-center my-1">
                                                    <h4 class="mb-0 me-2">
                                                        <?php echo htmlspecialchars($totalUsers, ENT_QUOTES, 'UTF-8'); ?>
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="avatar">
                                                <span class="avatar-initial rounded bg-label-primary">
                                                    <i class="bx bx-group bx-sm"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="content-left">
                                                <span class="text-heading">Paid Users</span>
                                                <div class="d-flex align-items-center my-1">
                                                    <h4 class="mb-0 me-2">
                                                        <?php echo htmlspecialchars($paidCount, ENT_QUOTES, 'UTF-8'); ?>
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="avatar">
                                                <span class="avatar-initial rounded bg-label-success">
                                                    <i class="bx bx-user-check bx-sm"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="content-left">
                                                <span class="text-heading">Unpaid Users</span>
                                                <div class="d-flex align-items-center my-1">
                                                    <h4 class="mb-0 me-2">
                                                        <?php echo htmlspecialchars($unpaidCount, ENT_QUOTES, 'UTF-8'); ?>
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="avatar">
                                                <span class="avatar-initial rounded bg-label-danger">
                                                    <i class="bx bx-user-plus bx-sm"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="content-left">
                                                <span class="text-heading">Rejected Users</span>
                                                <div class="d-flex align-items-center my-1">
                                                    <h4 class="mb-0 me-2">Unknown</h4>
                                                </div>
                                            </div>
                                            <div class="avatar">
                                                <span class="avatar-initial rounded bg-label-warning">
                                                    <i class="bx bx-user-voice bx-sm"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Users List Table -->
                        <div class="card">
                            <div class="card-header border-bottom">
                                <h5 class="card-title mb-0">Search Filters</h5>
                                <div
                                    class="d-flex justify-content-between align-items-center row pt-4 gap-4 gap-md-0 g-6">
                                </div>
                            </div>
                            <div class="card-datatable table-responsive">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <div class="row">
                                        <div class="col-md-2" style="margin-top: 1.5rem; margin-bottom:1.5rem">
                                            <form action="admin/Tickets/tickets.php" method="get">
                                                <select id="UserRole" class="form-select text-capitalize"
                                                    name="userFilter" id="userFilter" onchange="this.form.submit()">
                                                    <option value="all"
                                                        <?php if (!isset($_GET['userFilter']) || $_GET['userFilter'] == 'all') echo 'selected'; ?>>
                                                        All</option>
                                                    <option value="paid"
                                                        <?php if (isset($_GET['userFilter']) && $_GET['userFilter'] == 'paid') echo 'selected'; ?>>
                                                        Paid</option>
                                                    <option value="unpaid"
                                                        <?php if (isset($_GET['userFilter']) && $_GET['userFilter'] == 'unpaid') echo 'selected'; ?>>
                                                        Unpaid</option>
                                                </select>
                                            </form>
                                        </div>
                                        <div class="col-md-10">
                                            <div
                                                class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-6 mb-md-0 mt-n6 mt-md-0 gap-md-4">
                                                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                    <form action="admin/Tickets/tickets.php" method="get"
                                                        id="searchForm">
                                                        <input type="hidden" name="userFilter"
                                                            value="<?php echo htmlspecialchars(isset($_GET['userFilter']) ? $_GET['userFilter'] : 'all', ENT_QUOTES, 'UTF-8'); ?>">
                                                        <input type="text" class="form-control" id="searchPhone"
                                                            name="searchPhone" placeholder="Search User"
                                                            value="<?php echo htmlspecialchars($searchPhone, ENT_QUOTES, 'UTF-8'); ?>">

                                                    </form>

                                                </div>
                                                <div class="dt-buttons btn-group flex-wrap">
                                                    <div class="btn-group">
                                                        <form action="admin/Tickets/export_pdf.php" method="post">
                                                            <input type="hidden" name="userFilter"
                                                                value="<?php echo htmlspecialchars(isset($_GET['userFilter']) ? $_GET['userFilter'] : 'all', ENT_QUOTES, 'UTF-8'); ?>">
                                                            <input type="hidden" name="searchPhone"
                                                                value="<?php echo htmlspecialchars(isset($_GET['searchPhone']) ? $_GET['searchPhone'] : '', ENT_QUOTES, 'UTF-8'); ?>">
                                                            <button
                                                                class="btn buttons-collection pagination-btn btn-label-secondary me-4"
                                                                tabindex="0" aria-controls="DataTables_Table_0"
                                                                type="submit" aria-haspopup="dialog"
                                                                aria-expanded="false">
                                                                <span><i
                                                                        class="bx bx-export me-2 bx-sm"></i>Export</span>
                                                            </button>
                                                        </form>
                                                    </div> 
                                                    <button class="btn btn-secondary add-new btn-primary" type="button"
                                                        data-bs-toggle="offcanvas"
                                                        data-bs-target="#offcanvasAddUser">
                                                        <span><i class="bx bx-plus bx-sm me-0 me-sm-2"></i>
                                                            <span class="d-none d-sm-inline-block">Add New User</span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table
                                        class="datatables-users table border-top dataTable no-footer dtr-column collapsed"
                                        id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info"
                                        style="width: 1391px;">
                                        <thead>
                                            <tr>

                                                <th class="sorting sorting_desc" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    style="width: 334px;"
                                                    aria-label="User: activate to sort column ascending"
                                                    aria-sort="descending">Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1" style="width: 149px;"
                                                    aria-label="Role: activate to sort column ascending">Email</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1" style="width: 107px;"
                                                    aria-label="Plan: activate to sort column ascending">Phone</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1" style="width: 201px;"
                                                    aria-label="Billing: activate to sort column ascending">Status</th>
                                                <th class="sorting_disabled dtr-hidden" rowspan="1" colspan="1"
                                                    style="width: 175px;" aria-label="Actions">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="userTable">
                                            <?php
            while ($row = $result->fetch_assoc()) {
                $name = htmlspecialchars($row["first_name"] . " " . $row["last_name"], ENT_QUOTES, 'UTF-8');
                $initials = htmlspecialchars(strtoupper($row["first_name"][0] . $row["last_name"][0]), ENT_QUOTES, 'UTF-8');
                $status = $row["isaccepted"] == 'yes' ? "Paid" : "Unpaid";
                $rowId = htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8');
                echo "<tr>
                        <td class='sorting_1'>
                          <div class='d-flex justify-content-start align-items-center user-name'>
                            <div class='avatar-wrapper'>
                              <div class='avatar avatar-sm me-4'>
                                <div class='rounded-circle profile-circle'>$initials</div>
                              </div>
                            </div>
                            <div class='d-flex flex-column'><a href='javascript:;'
                                class='text-heading text-truncate'><span class='fw-medium'>" . $name . "</span></a>
                            </div>
                          </div>
                        </td>
                        <td><span class='text-truncate d-flex align-items-center text-heading'>" . htmlspecialchars($row["email"], ENT_QUOTES, 'UTF-8') . "</span>
                        </td>
                        <td ><span class='text-heading'>" . htmlspecialchars($row["phone"], ENT_QUOTES, 'UTF-8') . "</span></td>";
                          if ($row["isaccepted"] == 'no') {
                    echo "
                        <td><span class='badge bg-label-danger' text-capitalized=''>" . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . "</span>
                        </td>
                        <td >
                          <div class='d-flex align-items-center'>
                    <a href='javascript:;'
                              class='btn btn-icon delete-record'><i class='bx bx-trash bx-sm'></i>
                            </a>
                            <a href='admin/Update/update.php?id=" . $rowId . "' class='btn btn-icon'><i
                                class='bx bx-show bx-sm'></i>
                            </a>
                            <a href='javascript:;'
                              class='btn btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown'><i
                                class='bx bx-dots-vertical-rounded bx-sm'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-end m-0'>
                                <a href='admin/Update/update.php?id=" . $rowId . "'class='dropdown-item'>Edit</a>
                                <a href='admin/Accept/accept.php?id=" . $rowId . "'class='dropdown-item'>Accept</a>
                            </div>
                        </div>
                    </td>
                </tr>";
                } else {
                    echo "
                        <td><span class='badge bg-label-success' text-capitalized=''>" . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . "</span>
                        </td>
                        <td >
                          <div class='d-flex align-items-center'>
                    <a href='javascript:;'
                              class='btn btn-icon delete-record'><i class='bx bx-trash bx-sm'></i>
                            </a>
                            <a href='admin/Update/update.php?id=" . $rowId . "' class='btn btn-icon'><i
                                class='bx bx-show bx-sm'></i>
                            </a>
                            <a href='javascript:;'
                              class='btn btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown'><i
                                class='bx bx-dots-vertical-rounded bx-sm'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-end m-0'>
                                <a href='admin/Update/update.php?id=" . $rowId . "'class='dropdown-item'>Edit</a>
                            </div>
                        </div>
                    </td>
                </tr>";
                }
            }
            ?>
            <?php
            $startIndex = ($currentPage - 1) * $limit + 1; // Starting user index on the current page
            $endIndex = min($currentPage * $limit, $totalFilteredUsers); // Ending user index on the current page
            
            // Calculate the number of viewed users
            $viewedUsersCount = $endIndex - $startIndex + 1;
            ?>

                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status"
                                                aria-live="polite">Showing
                                                <?php echo $viewedUsersCount ?> of <?php echo $totalUsers ?> entries</div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_paginate paging_simple_numbers"
                                                id="DataTables_Table_0_paginate">
                                                <ul class="pagination">
                                                <?php 
$totalPages = ceil($totalFilteredUsers / $limit);
$queryString = http_build_query(array_merge($_GET, ['page' => 1]));

// Previous button
if ($currentPage > 1) {
    $prevPage = $currentPage - 1;
    $queryString = http_build_query(array_merge($_GET, ['page' => $prevPage]));
    echo "<li class='paginate_button page-item previous' id='DataTables_Table_0_previous'>
            <a href='admin/Tickets/tickets.php?$queryString' class='page-link'><i class='bx bx-chevron-left bx-18px'></i></a>
          </li>";
} else {
    echo "<li class='paginate_button page-item previous disabled' id='DataTables_Table_0_previous'>
            <a class='page-link'><i class='bx bx-chevron-left bx-18px'></i></a>
          </li>";
}

// Page numbers
if ($totalPages <= 5) {
    // If total pages are less than or equal to 5, display all page numbers
    for ($i = 1; $i <= $totalPages; $i++) {
        $queryString = http_build_query(array_merge($_GET, ['page' => $i]));
        if ($i == $currentPage) {
            echo "<li class='paginate_button page-item active'>
                    <a href='admin/Tickets/tickets.php?$queryString' class='page-link'>$i</a>
                  </li>";
        } else {
            echo "<li class='paginate_button page-item'>
                    <a href='admin/Tickets/tickets.php?$queryString' class='page-link'>$i</a>
                  </li>";
        }
    }
} else {
    // If total pages are more than 5
    if ($currentPage <= 3) {
        // Show the first 5 pages
        for ($i = 1; $i <= 5; $i++) {
            $queryString = http_build_query(array_merge($_GET, ['page' => $i]));
            if ($i == $currentPage) {
                echo "<li class='paginate_button page-item active'>
                        <a href='admin/Tickets/tickets.php?$queryString' class='page-link'>$i</a>
                      </li>";
            } else {
                echo "<li class='paginate_button page-item'>
                        <a href='admin/Tickets/tickets.php?$queryString' class='page-link'>$i</a>
                      </li>";
            }
        }
        echo "<li class='paginate_button page-item disabled'><a class='page-link'>...</a></li>";
    } elseif ($currentPage > 3 && $currentPage < $totalPages - 2) {
        // Show the first page, dots, current page, dots, and the last page
        $queryString = http_build_query(array_merge($_GET, ['page' => 1]));
        echo "<li class='paginate_button page-item'>
                <a href='admin/Tickets/tickets.php?$queryString' class='page-link'>1</a>
              </li>";
        echo "<li class='paginate_button page-item disabled'><a class='page-link'>...</a></li>";

        for ($i = $currentPage - 1; $i <= $currentPage + 1; $i++) {
            $queryString = http_build_query(array_merge($_GET, ['page' => $i]));
            if ($i == $currentPage) {
                echo "<li class='paginate_button page-item active'>
                        <a href='admin/Tickets/tickets.php?$queryString' class='page-link'>$i</a>
                      </li>";
            } else {
                echo "<li class='paginate_button page-item'>
                        <a href='admin/Tickets/tickets.php?$queryString' class='page-link'>$i</a>
                      </li>";
            }
        }
        echo "<li class='paginate_button page-item disabled'><a class='page-link'>...</a></li>";
        $queryString = http_build_query(array_merge($_GET, ['page' => $totalPages]));
        echo "<li class='paginate_button page-item'>
                <a href='admin/Tickets/tickets.php?$queryString' class='page-link'>$totalPages</a>
              </li>";
    } else {
        // Show the last 5 pages
        echo "<li class='paginate_button page-item disabled'><a class='page-link'>...</a></li>";
        for ($i = $totalPages - 4; $i <= $totalPages; $i++) {
            $queryString = http_build_query(array_merge($_GET, ['page' => $i]));
            if ($i == $currentPage) {
                echo "<li class='paginate_button page-item active'>
                        <a href='admin/Tickets/tickets.php?$queryString' class='page-link'>$i</a>
                      </li>";
            } else {
                echo "<li class='paginate_button page-item'>
                        <a href='admin/Tickets/tickets.php?$queryString' class='page-link'>$i</a>
                      </li>";
            }
        }
    }
}

// Next button
if ($currentPage < $totalPages) {
    $nextPage = $currentPage + 1;
    $queryString = http_build_query(array_merge($_GET, ['page' => $nextPage]));
    echo "<li class='paginate_button page-item next' id='DataTables_Table_0_next'>
            <a href='admin/Tickets/tickets.php?$queryString' class='page-link'><i class='bx bx-chevron-right bx-18px'></i></a>
          </li>";
} else {
    echo "<li class='paginate_button page-item next disabled' id='DataTables_Table_0_next'>
            <a href='admin/Tickets/tickets.php?$queryString' class='page-link'><i class='bx bx-chevron-right bx-18px'></i></a>
          </li>";
}

?>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="width: 1%;"></div>
                                </div>
                            </div>
                            <!-- Offcanvas to add new user -->
                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser"
                                aria-labelledby="offcanvasAddUserLabel">
                                <div class="offcanvas-header border-bottom">
                                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
                                    <form class="add-new-user pt-0 fv-plugins-bootstrap5 fv-plugins-framework"
                                        id="addNewUserForm" onsubmit="return false" novalidate="novalidate">
                                        <div class="mb-6 fv-plugins-icon-container">
                                            <label class="form-label" for="add-user-fullname">Full Name</label>
                                            <input type="text" class="form-control" id="add-user-fullname"
                                                placeholder="John Doe" name="userFullname" aria-label="John Doe">
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                        <div class="mb-6 fv-plugins-icon-container">
                                            <label class="form-label" for="add-user-email">Email</label>
                                            <input type="text" id="add-user-email" class="form-control"
                                                placeholder="john.doe@example.com" aria-label="john.doe@example.com"
                                                name="userEmail">
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                        <div class="mb-6">
                                            <label class="form-label" for="add-user-contact">Contact</label>
                                            <input type="text" id="add-user-contact" class="form-control phone-mask"
                                                placeholder="+1 (609) 988-44-11" aria-label="john.doe@example.com"
                                                name="userContact">
                                        </div>
                                        <div class="mb-6">
                                            <label class="form-label" for="add-user-company">Company</label>
                                            <input type="text" id="add-user-company" class="form-control"
                                                placeholder="Web Developer" aria-label="jdoe1" name="companyName">
                                        </div>
                                        <div class="mb-6">
                                            <label class="form-label" for="country">Country</label>
                                            <div class="position-relative"><select id="country"
                                                    class="select2 form-select select2-hidden-accessible"
                                                    data-select2-id="country" tabindex="-1" aria-hidden="true">
                                                    <option value="" data-select2-id="2">Select</option>
                                                    <option value="Australia">Australia</option>
                                                    <option value="Bangladesh">Bangladesh</option>
                                                    <option value="Belarus">Belarus</option>
                                                    <option value="Brazil">Brazil</option>
                                                    <option value="Canada">Canada</option>
                                                    <option value="China">China</option>
                                                    <option value="France">France</option>
                                                    <option value="Germany">Germany</option>
                                                    <option value="India">India</option>
                                                    <option value="Indonesia">Indonesia</option>
                                                    <option value="Israel">Israel</option>
                                                    <option value="Italy">Italy</option>
                                                    <option value="Japan">Japan</option>
                                                    <option value="Korea">Korea, Republic of</option>
                                                    <option value="Mexico">Mexico</option>
                                                    <option value="Philippines">Philippines</option>
                                                    <option value="Russia">Russian Federation</option>
                                                    <option value="South Africa">South Africa</option>
                                                    <option value="Thailand">Thailand</option>
                                                    <option value="Turkey">Turkey</option>
                                                    <option value="Ukraine">Ukraine</option>
                                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                                    <option value="United Kingdom">United Kingdom</option>
                                                    <option value="United States">United States</option>
                                                </select><span
                                                    class="select2 select2-container select2-container--default"
                                                    dir="ltr" data-select2-id="1" style="width: 352px;"><span
                                                        class="selection"><span
                                                            class="select2-selection select2-selection--single"
                                                            role="combobox" aria-haspopup="true" aria-expanded="false"
                                                            tabindex="0" aria-disabled="false"
                                                            aria-labelledby="select2-country-container"><span
                                                                class="select2-selection__rendered"
                                                                id="select2-country-container" role="textbox"
                                                                aria-readonly="true"><span
                                                                    class="select2-selection__placeholder">Select
                                                                    Country</span></span><span
                                                                class="select2-selection__arrow" role="presentation"><b
                                                                    role="presentation"></b></span></span></span><span
                                                        class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                                        </div>
                                        <div class="mb-6">
                                            <label class="form-label" for="user-role">User Role</label>
                                            <select id="user-role" class="form-select">
                                                <option value="subscriber">Subscriber</option>
                                                <option value="editor">Editor</option>
                                                <option value="maintainer">Maintainer</option>
                                                <option value="author">Author</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>
                                        <div class="mb-6">
                                            <label class="form-label" for="user-plan">Select Plan</label>
                                            <select id="user-plan" class="form-select">
                                                <option value="basic">Basic</option>
                                                <option value="enterprise">Enterprise</option>
                                                <option value="company">Company</option>
                                                <option value="team">Team</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary me-3 data-submit">Submit</button>
                                        <button type="reset" class="btn btn-label-danger"
                                            data-bs-dismiss="offcanvas">Cancel</button>
                                        <input type="hidden">
                                    </form>
                                </div>
                            </div>
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

    <!-- <script src="admin/assets/vendor/libs/jquery/jquery.js"></script> -->
    <script src="admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="admin/assets/vendor/js/bootstrap.js"></script>
    <script src="admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="admin/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="admin/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="admin/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="admin/assets/vendor/js/menu.js"></script>
    <script src="../js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="admin/assets/vendor/libs/moment/moment.js"></script>
    <script src="admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="admin/assets/vendor/libs/select2/select2.js"></script>
    <script src="admin/assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="admin/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="admin/assets/vendor/libs/@form-validation/auto-focus.js"></script>
    <script src="admin/assets/vendor/libs/cleavejs/cleave.js"></script>
    <script src="admin/assets/vendor/libs/cleavejs/cleave-phone.js"></script>

    <!-- Main JS -->
    <script src="admin/assets/js/main.js"></script>

    <script>
        document.getElementById('searchPhone').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('searchForm').submit();
            }
        });
    </script>

</body>

</html>