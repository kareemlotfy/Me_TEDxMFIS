<?php 

include("../Misc/db_conn.php");
require("../Misc/functions.php");
require_once __DIR__ . '/../../config.php';

adminLogin();

$adminId = $_SESSION['adminId']; // Assuming admin ID is stored in session after login
$pageId = 1; // Example: replace with the actual page ID you want to check

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
    $adminNumber = $adminDetails['admin_number'];
} else {
    echo "Admin details not found.";
}


$query = "SELECT SUM(CASE WHEN isaccepted = 'yes' THEN paid ELSE 0 END) AS total_profit FROM user_cred";
$result = $con->query($query);

$totalProfit = 0;
if ($result && $row = $result->fetch_assoc()) {
    $totalProfit = $row['total_profit'] ?? 0;
}


$con->close();

$currentPage = 'dashboard';
?>



<!DOCTYPE html>
<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-compact">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="admin/assets/img/logos/x-art.png" />

    <base href="<?php echo BASE_URL; ?>">

    <!-- System font via Apple HIG -->

    <!-- Icons -->
    <link rel="stylesheet" href="admin/assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="admin/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="admin/assets/vendor/fonts/flag-icons.css" />
    <link href='https://cdn.boxicons.com/3.0.6/fonts/basic/boxicons.min.css' rel='stylesheet'>

    <!-- Core CSS -->
    <link rel="stylesheet" href="admin/assets/vendor/css/core.css" />
    <link rel="stylesheet" href="admin/assets/vendor/css/theme-default.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="admin/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="admin/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Apple HIG Design System -->
    <link rel="stylesheet" href="admin/assets/css/apple-hig.css" />

    <!-- Helpers -->
    <script src="admin/assets/vendor/js/helpers.js"></script>
    <script src="admin/assets/js/config.js"></script>

</head>

<body class="layout-menu-fixed layout-menu-hig">


    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">


            <!-- Menu -->

            <?php include('../Components/aside.php'); ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php include('../Components/nav.php'); ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-xxl-6 col-lg-12 col-md-6 order-0">
                                <div class="row">
                                    <div class="col-6 mb-6">
                                        <div class="card h-100 hig-stat-card">
                                            <div class="card-body pb-0">
                                                <span class="d-block fw-medium mb-1">Users</span>
                                                <h4 class="card-title mb-0 mb-lg-4">Total
                                                    <span id="totalUsers">Loading...</span>
                                                </h4>
                                                <div id="genderChart2"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-6">
                                        <div class="card h-100 hig-stat-card">
                                            <div class="card-body pb-0">
                                                <span class="d-block fw-medium mb-1">Ages</span>
                                                <h4 class="card-title mb-0 mb-lg-4">Users age are
                                                    <span id=""></span>
                                                </h4>
                                                <div id="ageChart2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-12 col-xxl-6 order-3 order-md-2">
                                <div class="row">
                                    <div class="col-6 mb-6">
                                        <div class="card h-100 hig-stat-card">
                                            <div class="card-body pb-0">
                                                <span class="d-block fw-medium mb-1">From MFIS</span>
                                                <h4 class="card-title mb-0 mb-lg-4">Total
                                                    <span id="mfis"></span>
                                                </h4>
                                                <div id="mfisChart222"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-6">
                                        <div class="card h-100 hig-stat-card">
                                            <div class="card-body pb-0">
                                                <span class="d-block fw-medium mb-1">Total Profit</span>
                                                <h4 class="card-title mb-0 mb-lg-4">Total
                                                    <span id="profit"><?php echo number_format($totalProfit); ?></span>
                                                </h4>
                                                <div id="profit"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-6">
                                        <div class="card h-100 hig-stat-card">
                                            <div class="card-body pb-0">
                                                <span class="d-block fw-medium mb-1">Login Type</span>
                                                <h4 class="card-title mb-0 mb-lg-4">Users are
                                                    <span id=""></span>
                                                </h4>
                                                <div id="loginChart22"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Event Statistics -->
                            <div class="col-md-6 col-lg-6 col-xl-6 order-0 mb-6">
                                <div class="card h-100 hig-stat-card">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="card-title mb-0">
                                            <h5 class="mb-1 me-2">Event Status</h5>
                                            <p class="card-subtitle">
                                                <span id="totalUsers"></span> Total
                                                Users
                                            </p>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-6">
                                            <div class="d-flex flex-column align-items-center gap-1">
                                                <h3 class="mb-1" id="totalUsers2">Loading...</h3>
                                                <small>Total Users</small>
                                            </div>
                                            <div id="eChart22"></div>
                                        </div>
                                        <ul class="p-0 m-0">
                                            <li class="d-flex align-items-center mb-5">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-success"><i
                                                            class='bx bx-check'></i></span>
                                                </div>
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Entered Event</h6>
                                                    </div>
                                                    <div class="user-progress">
                                                        <h6 class="mb-0">
                                                            <span id="entered_count"></span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex align-items-center mb-5">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-primary"><i
                                                            class='bx bx-x'></i></span>
                                                </div>
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Didn't Enter Event</h6>
                                                    </div>
                                                    <div class="user-progress">
                                                        <h6 class="mb-0">
                                                            <span id="not_entered_count"></span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex align-items-center mb-5">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-info"><i
                                                            class='bx bx-burger-alt'></i></span>
                                                </div>
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Ate Dinner</h6>
                                                    </div>
                                                    <div class="user-progress">
                                                        <h6 class="mb-0">
                                                            <span id="used_dinner_count"></span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex align-items-center mb-5">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-secondary"><i
                                                            class='bx bx-x'></i></span>
                                                </div>
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Didn't Eat Dinner</h6>
                                                    </div>
                                                    <div class="user-progress">
                                                        <h6 class="mb-0">
                                                            <span id="not_used_dinner_count"></span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex align-items-center mb-5">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-info"><i
                                                            class='bx bx-egg-fried'></i></span>
                                                </div>
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Ate Breakfast</h6>
                                                    </div>
                                                    <div class="user-progress">
                                                        <h6 class="mb-0">
                                                            <span id="used_breakfast_count"></span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-secondary"><i
                                                            class='bx bx-football'></i></span>
                                                </div>
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Didn't Eat breakfast</h6>
                                                    </div>
                                                    <div class="user-progress">
                                                        <h6 class="mb-0">
                                                            <span id="not_used_breakfast_count"></span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <br>
                                            <li class="d-flex align-items-center mb-5">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-info"><i
                                                            class='bx bx-cookie'></i></span>
                                                </div>
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Ate snack</h6>
                                                    </div>
                                                    <div class="user-progress">
                                                        <h6 class="mb-0">
                                                            <span id="used_snack_count"></span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-secondary"><i
                                                            class='bx bx-x'></i></span>
                                                </div>
                                                <div
                                                    class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Didn't Eat snack</h6>
                                                    </div>
                                                    <div class="user-progress">
                                                        <h6 class="mb-0">
                                                            <span id="not_used_snack_count"></span>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--/ Event Statistics -->

                            <!-- Grades Overview -->
                            <div class="col-md-6 col-lg-6 col-xl-6 order-1 mb-6">
                                <div class="card" style="height: 100%;">
                                    <div class="card-header header-elements">
                                        <h5 class="card-title mb-0">Grade Analysis</h5>

                                    </div>
                                    <div class="card-body">
                                        <canvas id="gardesChart2222" class="chartjs" data-height="337"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!--/ Grades Overview -->

                            <!-- Google and Events Timeline -->
                            <!-- <div class="col-md-6 col-lg-6 order-4 order-lg-3">
                                <div class="card text-center h-100">
                                    <div class="card-header nav-align-top">
                                        <ul class="nav nav-pills" role="tablist">
                                            <li class="nav-item">
                                                <button type="button" class="nav-link active" role="tab"
                                                    data-bs-toggle="tab" data-bs-target="#navs-pills-google"
                                                    aria-controls="navs-pills-google"
                                                    aria-selected="true">Google</button>
                                            </li>
                                            <li class="nav-item">
                                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                                    data-bs-target="#navs-pills-events"
                                                    aria-controls="navs-pills-events"
                                                    aria-selected="false">Events</button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content pt-0 pb-4">
                                        <div class="tab-pane fade show active" id="navs-pills-google" role="tabpanel">
                                            <div class="table-responsive text-start text-nowrap">
                                                <div class="card h-100 hig-stat-card">
                                                    <div
                                                        class="card-header d-flex align-items-center justify-content-between">
                                                        <div class="card-title mb-0">
                                                            <h5 class="mb-1">Google Statistics</h5>
                                                            <p class="card-subtitle">Total number of Visits 23.8k</p>
                                                        </div>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="btn btn-label-primary">January</button>
                                                            <button type="button"
                                                                class="btn btn-label-primary dropdown-toggle dropdown-toggle-split"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <span class="visually-hidden">Toggle Dropdown</span>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item"
                                                                        href="javascript:void(0);">January</a></li>
                                                                <li><a class="dropdown-item"
                                                                        href="javascript:void(0);">February</a></li>
                                                                <li><a class="dropdown-item"
                                                                        href="javascript:void(0);">March</a></li>
                                                                <li><a class="dropdown-item"
                                                                        href="javascript:void(0);">April</a></li>
                                                                <li><a class="dropdown-item"
                                                                        href="javascript:void(0);">May</a></li>
                                                                <li><a class="dropdown-item"
                                                                        href="javascript:void(0);">June</a></li>
                                                                <li><a class="dropdown-item"
                                                                        href="javascript:void(0);">July</a></li>
                                                                <li><a class="dropdown-item"
                                                                        href="javascript:void(0);">August</a></li>
                                                                <li><a class="dropdown-item"
                                                                        href="javascript:void(0);">September</a></li>
                                                                <li><a class="dropdown-item"
                                                                        href="javascript:void(0);">October</a></li>
                                                                <li><a class="dropdown-item"
                                                                        href="javascript:void(0);">November</a></li>
                                                                <li><a class="dropdown-item"
                                                                        href="javascript:void(0);">December</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div id="googleStatisticsChart"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="navs-pills-events" role="tabpanel">
                                            <div class="table-responsive text-start text-nowrap">
                                                <div class="card">
                                                    <div class="card-header header-elements">
                                                        <h5 class="card-title mb-0">Event Statistics</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <canvas id="eventsChart" class="chartjs"
                                                            data-height="400"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!--/ Google and Events Timeline -->
                            <!-- Browser and OS table -->
                            <!-- <div class="col-md-6 order-3 order-lg-4 mb-6 mb-lg-0">
                                <div class="card text-center h-100">
                                    <div class="card-header nav-align-top">
                                        <ul class="nav nav-pills" role="tablist">
                                            <li class="nav-item">
                                                <button type="button" class="nav-link active" role="tab"
                                                    data-bs-toggle="tab" data-bs-target="#navs-pills-browser"
                                                    aria-controls="navs-pills-browser"
                                                    aria-selected="true">Browser</button>
                                            </li>
                                            <li class="nav-item">
                                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                                    data-bs-target="#navs-pills-os" aria-controls="navs-pills-os"
                                                    aria-selected="false">Operating
                                                    System</button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content pt-0 pb-4">
                                        <div class="tab-pane fade show active" id="navs-pills-browser" role="tabpanel">
                                            <div class="table-responsive text-start text-nowrap">
                                                <table class="table table-borderless">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Browser</th>
                                                            <th>Visits</th>
                                                            <th class="w-50">Data In Percentage</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="admin/assets/img/icons/brands/chrome.png"
                                                                        alt="Chrome" height="24" class="me-3">
                                                                    <span class="text-heading">Chrome</span>
                                                                </div>
                                                            </td>
                                                            <td class="text-heading">8.92k</td>
                                                            <td>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-4">
                                                                    <div class="progress w-100" style="height:10px;">
                                                                        <div class="progress-bar bg-success"
                                                                            role="progressbar" style="width: 64.75%"
                                                                            aria-valuenow="64.75" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                    <small class="fw-medium">64.75%</small>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="admin/assets/img/icons/brands/safari.png"
                                                                        alt="Safari" height="24" class="me-3">
                                                                    <span class="text-heading">Safari</span>
                                                                </div>
                                                            </td>
                                                            <td class="text-heading">1.29k</td>
                                                            <td>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-4">
                                                                    <div class="progress w-100" style="height:10px;">
                                                                        <div class="progress-bar bg-primary"
                                                                            role="progressbar" style="width: 18.43%"
                                                                            aria-valuenow="18.43" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                    <small class="fw-medium">18.43%</small>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="admin/assets/img/icons/brands/firefox.png"
                                                                        alt="Firefox" height="24" class="me-3">
                                                                    <span class="text-heading">Firefox</span>
                                                                </div>
                                                            </td>
                                                            <td class="text-heading">328</td>
                                                            <td>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-4">
                                                                    <div class="progress w-100" style="height:10px;">
                                                                        <div class="progress-bar bg-info"
                                                                            role="progressbar" style="width: 8.37%"
                                                                            aria-valuenow="8.37" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                    <small class="fw-medium">8.37%</small>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>4</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="admin/assets/img/icons/brands/edge.png"
                                                                        alt="Edge" height="24" class="me-3">
                                                                    <span class="text-heading">Edge</span>
                                                                </div>
                                                            </td>
                                                            <td class="text-heading">142</td>
                                                            <td>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-4">
                                                                    <div class="progress w-100" style="height:10px;">
                                                                        <div class="progress-bar bg-warning"
                                                                            role="progressbar" style="width: 6.12%"
                                                                            aria-valuenow="6.12" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                    <small class="fw-medium">6.12%</small>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>5</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="admin/assets/img/icons/brands/opera.png"
                                                                        alt="Opera" height="24" class="me-3">
                                                                    <span class="text-heading">Opera</span>
                                                                </div>
                                                            </td>
                                                            <td class="text-heading">82</td>
                                                            <td>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-4">
                                                                    <div class="progress w-100" style="height:10px;">
                                                                        <div class="progress-bar bg-danger"
                                                                            role="progressbar" style="width: 2.12%"
                                                                            aria-valuenow="1.94" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                    <small class="fw-medium">2.12%</small>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>6</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="admin/assets/img/icons/brands/uc.png"
                                                                        alt="uc" height="24" class="me-3">
                                                                    <span class="text-heading">UC Browser</span>
                                                                </div>
                                                            </td>
                                                            <td class="text-heading">328</td>
                                                            <td>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-4">
                                                                    <div class="progress w-100" style="height:10px;">
                                                                        <div class="progress-bar bg-danger"
                                                                            role="progressbar" style="width: 20.14%"
                                                                            aria-valuenow="1.94" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                    <small class="fw-medium">20.14%</small>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="navs-pills-os" role="tabpanel">
                                            <div class="table-responsive text-start text-nowrap">
                                                <table class="table table-borderless">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>System</th>
                                                            <th>Visits</th>
                                                            <th class="w-50">Data In Percentage</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="admin/assets/img/icons/brands/windows.png"
                                                                        alt="Windows" height="24" class="me-3">
                                                                    <span class="text-heading">Windows</span>
                                                                </div>
                                                            </td>
                                                            <td class="text-heading">875.24k</td>
                                                            <td>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-4">
                                                                    <div class="progress w-100" style="height:10px;">
                                                                        <div class="progress-bar bg-success"
                                                                            role="progressbar" style="width: 61.50%"
                                                                            aria-valuenow="61.50" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                    <small class="fw-medium">61.50%</small>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="admin/assets/img/icons/brands/mac.png"
                                                                        alt="Mac" height="24" class="me-3">
                                                                    <span class="text-heading">Mac</span>
                                                                </div>
                                                            </td>
                                                            <td class="text-heading">89.68k</td>
                                                            <td>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-4">
                                                                    <div class="progress w-100" style="height:10px;">
                                                                        <div class="progress-bar bg-primary"
                                                                            role="progressbar" style="width: 16.67%"
                                                                            aria-valuenow="16.67" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                    <small class="fw-medium">16.67%</small>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="admin/assets/img/icons/brands/ubuntu.png"
                                                                        alt="Ubuntu" height="24" class="me-3">
                                                                    <span class="text-heading">Ubuntu</span>
                                                                </div>
                                                            </td>
                                                            <td class="text-heading">37.68k</td>
                                                            <td>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-4">
                                                                    <div class="progress w-100" style="height:10px;">
                                                                        <div class="progress-bar bg-info"
                                                                            role="progressbar" style="width: 12.82%"
                                                                            aria-valuenow="12.82" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                    <small class="fw-medium">12.82%</small>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>4</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="admin/assets/img/icons/brands/chrome.png"
                                                                        alt="Chrome" height="24" class="me-3">
                                                                    <span class="text-heading">Chrome</span>
                                                                </div>
                                                            </td>
                                                            <td class="text-heading">8.34k</td>
                                                            <td>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-4">
                                                                    <div class="progress w-100" style="height:10px;">
                                                                        <div class="progress-bar bg-warning"
                                                                            role="progressbar" style="width: 6.25%"
                                                                            aria-valuenow="6.25" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                    <small class="fw-medium">6.25%</small>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>5</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="admin/assets/img/icons/brands/cent.png"
                                                                        alt="Cent" height="24" class="me-3">
                                                                    <span class="text-heading">Cent</span>
                                                                </div>
                                                            </td>
                                                            <td class="text-heading">2.25k</td>
                                                            <td>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-4">
                                                                    <div class="progress w-100" style="height:10px;">
                                                                        <div class="progress-bar bg-danger"
                                                                            role="progressbar" style="width: 2.76%"
                                                                            aria-valuenow="2.76" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                    <small class="fw-medium">2.76%</small>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>6</td>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="admin/assets/img/icons/brands/linux.png"
                                                                        alt="linux" height="24" class="me-3">
                                                                    <span class="text-heading">Linux</span>
                                                                </div>
                                                            </td>
                                                            <td class="text-heading">328k</td>
                                                            <td>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-4">
                                                                    <div class="progress w-100" style="height:10px;">
                                                                        <div class="progress-bar bg-danger"
                                                                            role="progressbar" style="width: 20.14%"
                                                                            aria-valuenow="2.76" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                    <small class="fw-medium">20.14%</small>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!--/ Browser and OS table -->
                        </div>

                    </div>
                    <!-- / Content -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>



        <!-- Overlay (handled by iOS sheet overlay in aside.php) -->
        <!-- <div class="layout-overlay layout-menu-toggle"></div> -->


        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>

    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <!--                                   DATA SYSTEMMM (IMPORTANTT)                                            -->

    <script>
    function fetchCounts() {
        fetch('admin/data/getCounts.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                displayCounts(data);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                document.getElementById('totalUsers').innerText = 'Error loading data';
                document.getElementById('totalUsers2').innerText = 'Error loading data';
                document.getElementById('mfis').innerText = 'Error loading data';
                document.getElementById('entered_count').innerText = 'Error loading data';
                document.getElementById('not_entered_count').innerText = 'Error loading data';
                document.getElementById('used_dinner_count').innerText = 'Error loading data';
                document.getElementById('not_used_dinner_count').innerText = 'Error loading data';
                document.getElementById('used_breakfast_count').innerText = 'Error loading data';
                document.getElementById('not_used_breakfast_count').innerText = 'Error loading data';
                document.getElementById('used_snack_count').innerText = 'Error loading data';
                document.getElementById('not_used_snack_count').innerText = 'Error loading data';
            });
    }


    function displayCounts(data) {
        const totalUsers = (data.paid_count || 0) + (data.unpaid_count || 0) + (data.rejected_count || 0);
        const totalUsers2 = (data.paid_count || 0);
        document.getElementById('totalUsers').innerText = totalUsers;
        document.getElementById('totalUsers2').innerText = totalUsers2;
        document.getElementById('mfis').innerText = data.mfis_count || 0;
        document.getElementById('entered_count').innerText = data.entered_count || 0;
        document.getElementById('not_entered_count').innerText = data.not_entered_count || 0;
        document.getElementById('used_dinner_count').innerText = data.used_dinner_count || 0;
        document.getElementById('not_used_dinner_count').innerText = data.not_used_dinner_count || 0;
        document.getElementById('used_breakfast_count').innerText = data.used_breakfast_count || 0;
        document.getElementById('not_used_breakfast_count').innerText = data.not_used_breakfast_count || 0;
        document.getElementById('used_snack_count').innerText = data.used_snack_count || 0;
        document.getElementById('not_used_snack_count').innerText = data.not_used_snack_count || 0;
    }


    window.onload = fetchCounts;
    </script>

    <!--                                          END OF DATA SYSTEMMM (IMPORTANTT)                                            -->



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
    <!-- <script>
        document.querySelector('.layout-menu-toggle').addEventListener('click', function() {
    const aside = document.getElementById('layout-menu');
    const logo = document.getElementById('tedx_logo');
    const collapsedClass = 'menu-collapsed';

    // Toggle the collapsed state
    aside.classList.toggle(collapsedClass);

    // Change the image based on whether the menu is collapsed
    if (aside.classList.contains(collapsedClass)) {
        // Collapsed state: Change to a smaller or different image
        logo.src = 'admin/assets/img/logos/x-art.png';  // Update with your collapsed image path
        logo.style.height = '30px';  // Adjust the image size when collapsed
        logo.style.marginLeft = '-0.37em'
    } else {
        // Expanded state: Return to the original image
        logo.src = 'admin/assets/img/logos/TEDx_logo_place2_RGB_CS2_page-0001.jpg';  // Original image
        logo.style.height = '60px';  // Original size
    }
});

    </script> -->

</body>

</html>