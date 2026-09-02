<?php
// Set secure session cookie parameters before starting the session
ini_set('session.cookie_secure', '1'); // Ensure cookies are sent over HTTPS
ini_set('session.cookie_httponly', '1'); // Prevent JavaScript access to session cookies
ini_set('session.cookie_samesite', 'Strict'); // Mitigate CSRF attacks
require_once __DIR__ . '/../../config.php';
?>

<?php 

include("../Misc/db_conn.php");
require("../Misc/functions.php");

adminLogin();

$adminId = $_SESSION['adminId']; // Assuming admin ID is stored in session after login
$pageId = 2; // Example: replace with the actual page ID you want to check

checkAdminPermission($con, $adminId, $pageId);
date_default_timezone_set('Africa/Cairo');

$now = date("Y-m-d H:i:s");

$update = $con->prepare("UPDATE admin_cred SET last_activity=? WHERE id=?");
$update->bind_param("si", $now, $adminId);
$update->execute();
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
$filter = "WHERE ticket_type = 'single'";

if (isset($_GET['userFilter'])) {
    $userFilter = htmlspecialchars($_GET['userFilter'], ENT_QUOTES, 'UTF-8');
    if ($userFilter == 'paid') {
        $filter .= " AND isaccepted = 'yes'";
    } elseif ($userFilter == 'unpaid') {
        $filter .= " AND isaccepted = 'no'";
    } elseif ($userFilter == 'reject') {
        $filter .= " AND isaccepted = 'reject'";
    }
}


$searchType = isset($_GET['searchType']) ? $_GET['searchType'] : 'phone';

$searchName = '';
$searchPhone = '';
if (isset($_GET['searchName']) && !empty($_GET['searchName'])) {
    $searchName = $con->real_escape_string($_GET['searchName']);
    $filter .= " AND name LIKE '%$searchName%'";
}

$searchPhone = '';
if (isset($_GET['searchPhone']) && !empty($_GET['searchPhone'])) {
    $searchPhone = $con->real_escape_string($_GET['searchPhone']);
    $filter .= " AND phone LIKE '%$searchPhone%'";
}



// NEWW Optimized query for counts (saved max connections)
$countSql = "
    SELECT 
        SUM(CASE WHEN isaccepted = 'yes' AND ticket_type = 'single' THEN 1 ELSE 0 END) AS paid_count,
        SUM(CASE WHEN isaccepted = 'no' AND ticket_type = 'single' THEN 1 ELSE 0 END) AS unpaid_count,
        SUM(CASE WHEN isaccepted = 'reject' AND ticket_type = 'single' THEN 1 ELSE 0 END) AS rejected_count,
        SUM(CASE WHEN ticket_type = 'single' THEN 1 ELSE 0 END) AS total_users,
        SUM(CASE WHEN isaccepted = 'yes' AND ticket_type = 'single' THEN paid ELSE 0 END) AS total_profit
    FROM user_cred
    WHERE ticket_type = 'single'
"; 

$countResult = $con->query($countSql);

if (!$countResult) {
    die("Invalid query: " . $con->error);
}

$countRow = $countResult->fetch_assoc();
$paidCount = $countRow["paid_count"];
$unpaidCount = $countRow["unpaid_count"];
$rejectedCount = $countRow["rejected_count"];
$totalUsers = $countRow["total_users"];
$totalProfit = $countRow["total_profit"];

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

?>

<!DOCTYPE html>

<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-compact">


<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Users</title>
    <base href="<?php echo BASE_URL; ?>">

    <!-- <link rel="stylesheet" href="admin/css/style.css"> -->
    <!-- <link rel="stylesheet" href="admin/css/style-tickets.css"> -->
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="admin/assets/img/logos/x-art.png" />

    <!-- System font via Apple HIG -->

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

    <style>
        .profile-circle{
            background-color: #fde0de;
            justify-content: center;
            display: flex;
            align-items: center;
            border-radius: 50%;
        }

        .number-wrapper {
            position: relative;
            display: inline-block;
        }

        .blur-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(6px);
            background: rgba(255, 255, 255, 0.4);
            border-radius: 4px;
            z-index: 5;
            pointer-events: none;
        }
    </style>

    <!-- Apple HIG Design System -->
    <link rel="stylesheet" href="admin/assets/css/apple-hig.css" />

    <!-- Helpers -->
    <script src="admin/assets/vendor/js/helpers.js"></script>
    <script src="admin/assets/js/config.js"></script>

</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">
<!-- Menu -->

            <?php include('../Components/aside.php'); ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php include('../components/nav.php'); ?>
                <!-- / Navbar -->



                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->

<?php $canViewStats = hasPermission($con, $_SESSION["adminId"], 10); ?>

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row g-6 mb-6">

        <!-- Total Users -->
        <div class="col-sm-6 col-xl-3">
            <div class="card hig-stat-card <?php echo !$canViewStats ? 'locked-card' : ''; ?>">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-heading">Total Users</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">
                                    <div class="number-wrapper">
                                        <?php 
                                            echo $canViewStats 
                                                ? htmlspecialchars($totalUsers, ENT_QUOTES, 'UTF-8') 
                                                : '•••••••';
                                        ?>
                                        <?php if (!$canViewStats): ?>
                                            <span class="blur-overlay"></span>
                                        <?php endif; ?>
                                    </div>
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


        <!-- Paid Users -->
        <div class="col-sm-6 col-xl-3">
            <div class="card hig-stat-card <?php echo !$canViewStats ? 'locked-card' : ''; ?>">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-heading">Paid Users</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">
                                    <div class="number-wrapper">
                                        <?php 
                                            echo $canViewStats 
                                                ? htmlspecialchars($paidCount, ENT_QUOTES, 'UTF-8') 
                                                : '•••••••';
                                        ?>
                                        <?php if (!$canViewStats): ?>
                                            <span class="blur-overlay"></span>
                                        <?php endif; ?>
                                    </div>
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


        <!-- Unpaid Users -->
        <div class="col-sm-6 col-xl-3">
            <div class="card hig-stat-card <?php echo !$canViewStats ? 'locked-card' : ''; ?>">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-heading">Unpaid Users</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">
                                    <div class="number-wrapper">
                                        <?php 
                                            echo $canViewStats 
                                                ? htmlspecialchars($unpaidCount, ENT_QUOTES, 'UTF-8') 
                                                : '•••••••';
                                        ?>
                                        <?php if (!$canViewStats): ?>
                                            <span class="blur-overlay"></span>
                                        <?php endif; ?>
                                    </div>
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


        <!-- Rejected Users -->
        <div class="col-sm-6 col-xl-3">
            <div class="card hig-stat-card <?php echo !$canViewStats ? 'locked-card' : ''; ?>">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-heading">Rejected Users</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">
                                    <div class="number-wrapper">
                                        <?php 
                                            echo $canViewStats 
                                                ? htmlspecialchars($rejectedCount, ENT_QUOTES, 'UTF-8') 
                                                : '•••••••';
                                        ?>
                                        <?php if (!$canViewStats): ?>
                                            <span class="blur-overlay"></span>
                                        <?php endif; ?>
                                    </div>
                                </h4>
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


        <!-- Profit -->
        <div class="col-sm-6 col-xl-3">
            <div class="card hig-stat-card <?php echo !$canViewStats ? 'locked-card' : ''; ?>">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span class="text-heading">Profit</span>
                            <div class="d-flex align-items-center my-1">
                                <h4 class="mb-0 me-2">
                                    <div class="number-wrapper">
                                        <?php 
                                            echo $canViewStats 
                                                ? htmlspecialchars($totalProfit, ENT_QUOTES, 'UTF-8') 
                                                : '•••••••••••••';
                                        ?>
                                        <?php if (!$canViewStats): ?>
                                            <span class="blur-overlay"></span>
                                        <?php endif; ?>
                                    </div>
                                </h4>
                            </div>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-warning">
                                <i class="bx bx-wallet bx-sm"></i>
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
                                            <form action="admin/Tickets/single.php" method="get">
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
                                                    <option value="reject"
                                                        <?php if (isset($_GET['userFilter']) && $_GET['userFilter'] == 'reject') echo 'selected'; ?>>
                                                        Rejected</option>
                                                </select>
                                            </form>
                                        </div>
                                        <div class="col-md-10">
                                            <div
                                                class="dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-6 mb-md-0 mt-n6 mt-md-0 gap-md-4">
                                                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                                    <form action="admin/Tickets/single.php" method="get"
                                                        id="searchForm">
                                                        <input type="hidden" name="userFilter" value="<?php echo htmlspecialchars(isset($_GET['userFilter']) ? $_GET['userFilter'] : 'all', ENT_QUOTES, 'UTF-8'); ?>">

<!-- Dropdown to choose search type -->
<select id="searchType" style="width:90%; margin-left:1.3rem;" class="form-select text-capitalize" name="searchType" onchange="toggleSearchFields()">
    <option value="phone" <?php if (!isset($_GET['searchType']) || $_GET['searchType'] == 'phone') echo 'selected'; ?>>Search by Phone</option>
    <option value="name" <?php if (isset($_GET['searchType']) && $_GET['searchType'] == 'name') echo 'selected'; ?>>Search by Name</option>
</select>

<!-- Search by Phone -->
<input type="text"  style="width:90%; margin-left:0;" class="form-control mt-2" id="searchPhone" name="searchPhone" placeholder="Search by Phone" value="<?php echo htmlspecialchars($searchPhone, ENT_QUOTES, 'UTF-8'); ?>" style="display: <?php echo (!isset($_GET['searchType']) || $_GET['searchType'] == 'phone') ? 'block' : 'none'; ?>;">

<!-- Search by Name -->
<input type="text" class="form-control mt-2" id="searchName" name="searchName" placeholder="Search by Name" value="<?php echo htmlspecialchars($searchName, ENT_QUOTES, 'UTF-8'); ?>" style="display: <?php echo (isset($_GET['searchType']) && $_GET['searchType'] == 'name') ? 'block' : 'none'; ?>;">

                                                    </form>

                                                </div>
                                                <div class="dt-buttons btn-group flex-wrap">
                                                    <div class="btn-group">
                                                    <form action="admin/Tickets/export_pdf.php" method="post">
    <!-- Pass user filter -->
    <input type="hidden" name="userFilter" value="<?php echo htmlspecialchars(isset($_GET['userFilter']) ? $_GET['userFilter'] : 'all', ENT_QUOTES, 'UTF-8'); ?>">

    <!-- Pass search type (phone or name) -->
    <input type="hidden" name="searchType" value="<?php echo htmlspecialchars(isset($_GET['searchType']) ? $_GET['searchType'] : 'phone', ENT_QUOTES, 'UTF-8'); ?>">

    <!-- Pass search phone if searchType is phone -->
    <input type="hidden" name="searchPhone" value="<?php echo htmlspecialchars(isset($_GET['searchPhone']) ? $_GET['searchPhone'] : '', ENT_QUOTES, 'UTF-8'); ?>">

    <!-- Pass search name if searchType is name -->
    <input type="hidden" name="searchName" value="<?php echo htmlspecialchars(isset($_GET['searchName']) ? $_GET['searchName'] : '', ENT_QUOTES, 'UTF-8'); ?>">

    <button class="btn buttons-collection pagination-btn btn-label-secondary me-4" tabindex="0" aria-controls="DataTables_Table_0" type="submit" aria-haspopup="dialog" aria-expanded="false">
        <span><i class="bx bx-export me-2 bx-sm"></i>Export</span>
    </button>
</form>

                                                    </div> 
                                                    <button class="btn btn-secondary add-new btn-primary" type="button"
                                                        data-bs-toggle="offcanvas"
                                                        data-bs-target="#offcanvasAddUser" disabled>
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
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1" style="width: 201px;"
                                                    aria-label="Billing: activate to sort column ascending">Payment method</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1" style="width: 201px;"
                                                    aria-label="Billing: activate to sort column ascending">Ticket Type</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1" style="width: 201px;"
                                                    aria-label="Billing: activate to sort column ascending">Ticket Sub Type</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                    rowspan="1" colspan="1" style="width: 201px;"
                                                    aria-label="Billing: activate to sort column ascending">Accepted by</th>

                                                <th class="sorting_disabled dtr-hidden" rowspan="1" colspan="1"
                                                    style="width: 175px;" aria-label="Actions">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="userTable">
                                            <?php

            while ($row = $result->fetch_assoc()) {
                $name = htmlspecialchars($row["first_name"] . " " . $row["last_name"], ENT_QUOTES, 'UTF-8');
                $initials = htmlspecialchars(strtoupper($row["first_name"][0] . $row["last_name"][0]), ENT_QUOTES, 'UTF-8');
                if ($row["isaccepted"] == 'no') {
                    $status = 'Unpaid';
                } elseif ($row["isaccepted"] == 'yes') {
                    $status = 'Paid';
                } else {
                    $status = 'Rejected';
                }

                if ($row["payment_method"] == "cash") {
                    $payment_method = "Cash";
                } else {
                    $payment_method = "Instapay";
                }

                if ($row["ticket_type"] == "single") {
                    $ticket_type = "Single";
                }

                if ($row["ticket_sub_type"] == "early bird") {
                    $ticket_sub_type = "Early Bird";
                } elseif ($row["ticket_sub_type"] == "late owl") {
                    $ticket_sub_type = "Late Owl";
                }

                 $accepted_by = $row["accepted_by"];


                $rowId = htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8');
                echo "<tr>
                        <td class='sorting_1'>
                          <div class='d-flex justify-content-start align-items-center user-name'>
                            <div class='avatar-wrapper'>
                              <div class='avatar avatar me-4 profile-circle'>
                                <div class='rounded-circle ' style='color:#333;'>$initials</div>
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
    <td><span class='badge bg-label-danger'>" . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . "</span></td>
    <td><span class='badge bg-label-gray'>" . htmlspecialchars($payment_method, ENT_QUOTES, 'UTF-8') . "</span></td>
    <td><span class='badge bg-label-info'>" . htmlspecialchars($ticket_type, ENT_QUOTES, 'UTF-8') . "</span></td>
    <td><span class='badge bg-label-info'>" . htmlspecialchars($ticket_sub_type, ENT_QUOTES, 'UTF-8') . "</span></td>
    <td><span class='badge bg-label-info'>" . htmlspecialchars($accepted_by, ENT_QUOTES, 'UTF-8') . "</span></td>
    <td>
        <div class='d-flex align-items-center'>
            <a href='javascript:;'
                class='btn btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown'><i
                class='bx bx-dots-vertical-rounded bx-sm'></i>
            </a>
            <div class='dropdown-menu dropdown-menu-end m-0'>
                <a href='admin/Update/update.php?id=" . $rowId . "&redirect=" . basename($_SERVER["PHP_SELF"]) . "' class='dropdown-item'>Edit</a>
                <a href='javascript:;' 
                    onclick='showCustomPopup(\"admin/Accept/accept.php?id=" . $rowId . "\")' 
                    class='dropdown-item'>Accept</a>
                <a href='admin/Reject/reject.php?id=" . $rowId . "' class='dropdown-item'>Reject</a>
            </div>
        </div>
    </td>
    ";

                ?>
                <!-- Custom Popup HTML -->
<div id="custom-popup" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 9999; justify-content: center; align-items: center;">
    <div style="background: white; padding: 20px; border-radius: 8px; width: 300px; text-align: center;">
        <p>Are you sure you want to accept?</p>
<button onclick="confirmAction(this)" 
        style="margin-right: 10px; padding: 10px 20px; background: #4CAF50; color: white; border: none; border-radius: 4px;">
    Yes
</button>

        <button onclick="closePopup()" style="padding: 10px 20px; background: #f44336; color: white; border: none; border-radius: 4px;">No</button>
    </div>
</div>

<script>
    let acceptUrl = '';

    function showCustomPopup(url) {
        acceptUrl = url; // Save the URL for later use
        document.getElementById('custom-popup').style.display = 'flex'; // Show the popup
    }

function confirmAction(button) {

    if (button.dataset.clicked === "true") return;

    button.dataset.clicked = "true";
    button.style.pointerEvents = "none";
    button.style.opacity = "0.6";
    button.innerText = "Processing...";

    window.location.href = acceptUrl;
}


    function closePopup() {
        document.getElementById('custom-popup').style.display = 'none'; // Hide the popup
    }
</script>
                <?php
                } elseif ($row["isaccepted"] == 'yes') {
                    echo "
                        <td><span class='badge bg-label-success' text-capitalized=''>" . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . "</span></td>
                        <td><span class='badge bg-label-gray' text-capitalized=''>" . htmlspecialchars($payment_method, ENT_QUOTES, 'UTF-8') . "</span></td>
                        <td><span class='badge bg-label-info' text-capitalized=''>" . htmlspecialchars($ticket_type, ENT_QUOTES, 'UTF-8') . "</span></td>
                        <td><span class='badge bg-label-info'>" . htmlspecialchars($ticket_sub_type, ENT_QUOTES, 'UTF-8') . "</span></td>
                        <td><span class='badge bg-label-info'>" . htmlspecialchars($accepted_by, ENT_QUOTES, 'UTF-8') . "</span></td>

                        <td >
                          <div class='d-flex align-items-center'>
                    <!--<a href='javascript:;'
                              class='btn btn-icon delete-record'><i class='bx bx-trash bx-sm'></i>
                            </a>
                <a href='admin/Update/update.php?id=" . $rowId . "&redirect=" . basename($_SERVER["PHP_SELF"]) . "' class='dropdown-item'>Edit</a>
                                class='bx bx-show bx-sm'></i>
                            </a>-->
                            <a href='javascript:;'
                              class='btn btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown'><i
                                class='bx bx-dots-vertical-rounded bx-sm'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-end m-0'>
                <a href='admin/Update/update.php?id=" . $rowId . "&redirect=" . basename($_SERVER["PHP_SELF"]) . "' class='dropdown-item'>Edit</a>
                            </div>
                        </div>
                    </td>
                </tr>
                
                ";
                } else {
                    echo "
                        <td><span class='badge bg-label-warning' text-capitalized=''>" . htmlspecialchars($status, ENT_QUOTES, 'UTF-8') . "</span></td>
                        <td><span class='badge bg-label-gray' text-capitalized=''>" . htmlspecialchars($payment_method, ENT_QUOTES, 'UTF-8') . "</span></td>
                        <td><span class='badge bg-label-info' text-capitalized=''>" . htmlspecialchars($ticket_type, ENT_QUOTES, 'UTF-8') . "</span></td>
                        <td><span class='badge bg-label-info'>" . htmlspecialchars($ticket_sub_type, ENT_QUOTES, 'UTF-8') . "</span></td>
                        <td><span class='badge bg-label-info'>" . htmlspecialchars($accepted_by, ENT_QUOTES, 'UTF-8') . "</span></td>

                        <td >
                          <div class='d-flex align-items-center'>
                    <!--<a href='javascript:;'
                              class='btn btn-icon delete-record'><i class='bx bx-trash bx-sm'></i>
                            </a>
                <a href='admin/Update/update.php?id=" . $rowId . "&redirect=" . basename($_SERVER["PHP_SELF"]) . "' class='dropdown-item'>Edit</a>
                                class='bx bx-show bx-sm'></i>
                            </a>-->
                            <a href='javascript:;'
                              class='btn btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown'><i
                                class='bx bx-dots-vertical-rounded bx-sm'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-end m-0'>
                <a href='admin/Update/update.php?id=" . $rowId . "&redirect=" . basename($_SERVER["PHP_SELF"]) . "' class='dropdown-item'>Edit</a>
                            </div>
                        </div>
                    </td>
                </tr>";
                
            }
        }
            ?>
            <?php

$sql = $con->prepare("SELECT accepted_by FROM user_cred WHERE id = ?");
$sql->bind_param("i", $userId);
$sql->execute();
$result = $sql->get_result();
$user = $result->fetch_assoc();

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
                                                <?php echo $viewedUsersCount ?> of total entries</div>
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
            <a href='admin/Tickets/single.php?$queryString' class='page-link'><i class='bx bx-chevron-left bx-18px'></i></a>
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
                    <a href='admin/Tickets/single.php?$queryString' class='page-link'>$i</a>
                  </li>";
        } else {
            echo "<li class='paginate_button page-item'>
                    <a href='admin/Tickets/single.php?$queryString' class='page-link'>$i</a>
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
                        <a href='admin/Tickets/single.php?$queryString' class='page-link'>$i</a>
                      </li>";
            } else {
                echo "<li class='paginate_button page-item'>
                        <a href='admin/Tickets/single.php?$queryString' class='page-link'>$i</a>
                      </li>";
            }
        }
        echo "<li class='paginate_button page-item disabled'><a class='page-link'>...</a></li>";
    } elseif ($currentPage > 3 && $currentPage < $totalPages - 2) {
        // Show the first page, dots, current page, dots, and the last page
        $queryString = http_build_query(array_merge($_GET, ['page' => 1]));
        echo "<li class='paginate_button page-item'>
                <a href='admin/Tickets/single.php?$queryString' class='page-link'>1</a>
              </li>";
        echo "<li class='paginate_button page-item disabled'><a class='page-link'>...</a></li>";

        for ($i = $currentPage - 1; $i <= $currentPage + 1; $i++) {
            $queryString = http_build_query(array_merge($_GET, ['page' => $i]));
            if ($i == $currentPage) {
                echo "<li class='paginate_button page-item active'>
                        <a href='admin/Tickets/single.php?$queryString' class='page-link'>$i</a>
                      </li>";
            } else {
                echo "<li class='paginate_button page-item'>
                        <a href='admin/Tickets/single.php?$queryString' class='page-link'>$i</a>
                      </li>";
            }
        }
        echo "<li class='paginate_button page-item disabled'><a class='page-link'>...</a></li>";
        $queryString = http_build_query(array_merge($_GET, ['page' => $totalPages]));
        echo "<li class='paginate_button page-item'>
                <a href='admin/Tickets/single.php?$queryString' class='page-link'>$totalPages</a>
              </li>";
    } else {
        // Show the last 5 pages
        echo "<li class='paginate_button page-item disabled'><a class='page-link'>...</a></li>";
        for ($i = $totalPages - 4; $i <= $totalPages; $i++) {
            $queryString = http_build_query(array_merge($_GET, ['page' => $i]));
            if ($i == $currentPage) {
                echo "<li class='paginate_button page-item active'>
                        <a href='admin/Tickets/single.php?$queryString' class='page-link'>$i</a>
                      </li>";
            } else {
                echo "<li class='paginate_button page-item'>
                        <a href='admin/Tickets/single.php?$queryString' class='page-link'>$i</a>
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
            <a href='admin/Tickets/single.php?$queryString' class='page-link'><i class='bx bx-chevron-right bx-18px'></i></a>
          </li>";
} else {
    echo "<li class='paginate_button page-item next disabled' id='DataTables_Table_0_next'>
            <a href='admin/Tickets/single.php?$queryString' class='page-link'><i class='bx bx-chevron-right bx-18px'></i></a>
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

        <!-- Overlay (handled by iOS sheet overlay) -->`n        <!-- <div class="layout-overlay layout-menu-toggle"></div> -->

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
    <script type="module" src="admin/assets/js/dashboards-analytics.js"></script>

    <script>
    function toggleSearchFields() {
        var searchType = document.getElementById('searchType').value;
        var phoneField = document.getElementById('searchPhone');
        var nameField = document.getElementById('searchName');

        if (searchType === 'phone') {
            phoneField.style.display = 'block';
            nameField.style.display = 'none';
        } else if (searchType === 'name') {
            phoneField.style.display = 'none';
            nameField.style.display = 'block';
        }
    }

    // Submit form when pressing Enter in the visible input
    document.getElementById('searchPhone').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('searchForm').submit();
        }
    });

    document.getElementById('searchName').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('searchForm').submit();
        }
    });
</script>

<?php
$con->close();
?>

</body>

</html>

