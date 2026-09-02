<?php 

include("../Misc/db_conn.php");
require("../Misc/functions.php");
require_once __DIR__ . '/../../config.php';

adminLogin();

$adminId = $_SESSION['adminId']; // Assuming admin ID is stored in session after login
$pageId = 6; // Example: replace with the actual page ID you want to check

checkAdminPermission($con, $adminId, $pageId);
date_default_timezone_set('Africa/Cairo');

$now = date("Y-m-d H:i:s");

$update = $con->prepare("UPDATE admin_cred SET last_activity=? WHERE id=?");
$update->bind_param("si", $now, $adminId);
$update->execute();
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_account'])) {
    
    if ($adminId == 1) {
        echo "The super admin account cannot be deleted. You can refer to the IT to delete super admin account.";
    } else {
        // Check if admin ID exists in the database using prepared statement
        $check_stmt = $con->prepare("SELECT id FROM admin_cred WHERE id = ?");
        $check_stmt->bind_param("i", $adminId);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        
        if ($check_result->num_rows > 0) {
            // Begin transaction
            $con->begin_transaction();

            try {
                // Delete permissions associated with the admin
                $deletePermissionsQuery = "DELETE FROM permissions WHERE admin_id = ?";
                $stmt = $con->prepare($deletePermissionsQuery);
                $stmt->bind_param("i", $adminId);
                $stmt->execute();
                $stmt->close();

                // Delete the admin from admin_cred
                $delete_sql = "DELETE FROM admin_cred WHERE id = ?";
                $stmt = $con->prepare($delete_sql);
                $stmt->bind_param("i", $adminId);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    // Successfully deleted, destroy session and commit transaction
                    session_destroy();
                    $con->commit();
                    header("Location: ../Login/index.php");
                    exit();
                } else {
                    throw new Exception("Error deleting account or no rows affected.");
                }
            } catch (Exception $e) {
                // Rollback transaction on error
                $con->rollback();
                echo $e->getMessage();
            }

            $stmt->close();
        } else {
            echo "Admin ID not found in the database.";
        }
        
        $check_stmt->close();
    }
}
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

$con->close();

$currentPage = 'profile';
?>

<!DOCTYPE html>

<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-compact">


<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Profile</title>


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="admin/assets/img/logos/x-art.png" />

    <base href="<?php echo BASE_URL; ?>">

    <!-- System font via Apple HIG -->

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
    <link rel="stylesheet" href="admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css">
    <link rel="stylesheet" href="admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css">
    <link rel="stylesheet" href="admin/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css">
    <!-- <link rel="stylesheet" href="admin/css/style.css">
    <link rel="stylesheet" href="admin/css/style-profile.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Font Awesome CSS -->


    <!-- Page CSS -->
    <link rel="stylesheet" href="admin/assets/vendor/css/pages/page-profile.css" />

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

            <?php include('../components/aside.php'); ?>
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
                                            <img src="admin/Profile/images/<?php echo !empty($adminPic) ? $adminPic : 'default-pic.jpg'; ?>"
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
                                                <a href="admin/Profile/edit_account.php" class="btn btn-primary mb-1">
                                                    <i class='bx bx-edit bx-sm me-2'></i>Edit Account
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
                                        <li class="nav-item"><a class="nav-link active"
                                                href="admin/Profile/profile.php"><i class='bx bx-user bx-sm me-1_5'></i>
                                                Profile</a></li>
                                        <li class="nav-item"><a class="nav-link"
                                                href="admin/Permissions/permissions_page.php"><i
                                                    class='bx bx-group bx-sm me-1_5'></i> Admins and Permissions</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--/ Navbar pills -->

                        <!-- User Profile Content -->
                        <div class="row">
                            <div class="col-xl-4 col-lg-5 col-md-5">
                                <!-- About User -->
                                <div class="card mb-6">
                                    <div class="card-body">
                                        <small class="card-text text-uppercase text-muted small">About</small>
                                        <ul class="list-unstyled my-3 py-1">
                                            <li class="d-flex align-items-center mb-4"><i class="bx bx-user"></i><span
                                                    class="fw-medium mx-2">Full Name:</span>
                                                <span><?php echo htmlspecialchars($adminName); ?></span></li>
                                            <li class="d-flex align-items-center mb-4"><i class="bx bx-check"></i><span
                                                    class="fw-medium mx-2">Position:</span>
                                                <span><?php echo $adminPosition; ?></span></li>
                                            <li class="d-flex align-items-center mb-4"><i class="bx bx-crown"></i><span
                                                    class="fw-medium mx-2">Committee:</span>
                                                <span><?php echo $adminCommitee; ?></span></li>
                                            <li class="d-flex align-items-center mb-4"><i class="bx bx-flag"></i><span
                                                    class="fw-medium mx-2">Username:</span>
                                                <span><?php echo $adminUsername; ?></span></li>

                                        </ul>
                                        <small class="card-text text-uppercase text-muted small">Contacts</small>
                                        <ul class="list-unstyled my-3 py-1">
                                            <li class="d-flex align-items-center mb-4"><i class="bx bx-phone"></i><span
                                                    class="fw-medium mx-2">Contact:</span> <span><?php echo "EG (+20) " . htmlspecialchars($adminNumber); ?></span>
                                            </li>

                                            <li class="d-flex align-items-center mb-4"><i
                                                    class="bx bx-envelope"></i><span
                                                    class="fw-medium mx-2">Email:</span>
                                                <span><?php echo $adminEmail; ?></span></li>
                                        </ul>

                                    </div>
                                </div>
                                <!--/ About User -->
                            </div>

                        </div>
                        <!--/ User Profile Content -->

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
    <script src="admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

    <!-- Main JS -->
    <script src="admin/assets/js/main.js"></script>


    <!-- Page JS -->
    <script src="admin/assets/js/app-user-view-account.js"></script>

</body>

</html>
