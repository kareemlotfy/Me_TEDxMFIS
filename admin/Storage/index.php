<?php 
include("../Misc/db_conn.php");
require("../Misc/functions.php");
require_once __DIR__ . '/../../config.php';

adminLogin();

$adminId = $_SESSION['adminId']; 
$pageId = 9; 
checkAdminPermission($con, $adminId, $pageId);

$sql = "SELECT * FROM storage ORDER BY created_at DESC";
$result = mysqli_query($con, $sql);

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

$currentPage = 'storage';
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Storage Items</title>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <base href="<?php echo BASE_URL; ?>">

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

    <style>
        .profile-circle{
            background-color: #fde0de;
            justify-content: center;
            display: flex;
            align-items: center;
            border-radius: 50%;
        }

    </style>

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
                <?php include('../Components/nav.php'); ?>
                <!-- / Navbar -->
                    <div class="container-xxl flex-grow-1 container-p-y">

<div class="card">
    <div class="card-datatable table-responsive">
<div class="table-responsive">
<div class="dt-buttons btn-group flex-wrap">
                                                    <div class="btn-group"></div>
<button class="btn btn-secondary add-new btn-primary" type="button"
                                                        data-bs-toggle="offcanvas"
                                                        data-bs-target="#offcanvasAddUser">
                                                        <span><i class="bx bx-plus bx-sm me-0 me-sm-2"></i>
                                                            <span class="d-none d-sm-inline-block">Add New Item</span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
<table class="datatables-users table border-top dataTable no-footer dtr-column collapsed">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Location</th>
            <th>Description</th>
            <th>Added By</th>
            <th>Created</th>
        </tr>
    </thead>

    <tbody>

        <?php while ($row = mysqli_fetch_assoc($result)):

        // Prepare
        $img = htmlspecialchars($row['image_path']);
        $name = htmlspecialchars($row['name']);
        $cat = htmlspecialchars($row['category']);
        $qty = htmlspecialchars($row['quantity']);
        $loc = htmlspecialchars($row['storage_location']);
        $desc = htmlspecialchars($row['description']);
        $added = htmlspecialchars($row['added_by']);
        $created = htmlspecialchars($row['created_at']);

        // Initial letter
        $initials = strtoupper($name[0]);

        // Quantity badge color
        if($qty == 0){
            $qtyBadge = "bg-label-danger";
        } elseif($qty <= 5){
            $qtyBadge = "bg-label-warning";
        } else {
            $qtyBadge = "bg-label-success";
        }

        ?>

        <tr>
            <!-- IMAGE -->
            <td>
                <?php if(!empty($img)): ?>
                    <img src="<?php echo "images/Storage/" . $img; ?>" style="width:60px; height:60px; object-fit:cover; border-radius:6px;">
                <?php else: ?>
                    <span class="text-muted">No image</span>
                <?php endif; ?>
            </td>
            <!-- NAME -->
            <td class="sorting_1">
                <div class="d-flex justify-content-start align-items-center user-name">
                    <span class="fw-medium"><?php echo $name; ?></span>
                </div>
            </td>

            <!-- CATEGORY -->
            <td><span class="badge bg-label-info"><?php echo $cat; ?></span></td>

            <!-- QUANTITY -->
            <td><span class="badge <?php echo $qtyBadge; ?>"><?php echo $qty; ?></span></td>

            <!-- LOCATION -->
            <td><span class="text-heading"><?php echo $loc; ?></span></td>


            <!-- DESCRIPTION -->
            <td>
                <span class="text-heading text-truncate" style="max-width:180px; display:inline-block;">
                    <?php echo $desc; ?>
                </span>
            </td>

            <!-- ADDED BY -->
            <td><span class="badge bg-label-secondary"><?php echo $added; ?></span></td>

            <!-- DATE -->
            <td><?php echo $created; ?></td>

        </tr>

        <?php endwhile; ?>

    </tbody>
</table>

 <!-- Offcanvas to add new user -->
                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser"
                                aria-labelledby="offcanvasAddUserLabel">
                                <div class="offcanvas-header border-bottom">
                                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add Item</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body mx-0 flex-grow-0 p-6 h-100">
                                    <form class="add-new-user pt-0" action="admin/Storage/add_item.php" method="POST" enctype="multipart/form-data">
    <div class="mb-6">
        <label class="form-label" for="item-name">Item Name</label>
        <input type="text" class="form-control" id="item-name" name="name" placeholder="Item Name" required>
    </div>

    <div class="mb-6">
        <label class="form-label" for="item-category">Category</label>
        <input type="text" class="form-control" id="item-category" name="category" placeholder="Category" required>
    </div>

    <div class="mb-6">
        <label class="form-label" for="item-quantity">Quantity</label>
        <input type="number" class="form-control" id="item-quantity" name="quantity" placeholder="Quantity" required>
    </div>

    <div class="mb-6">
        <label class="form-label" for="item-location">Location</label>
        <input type="text" class="form-control" id="item-location" name="location" placeholder="Location" required>
    </div>

    <div class="mb-6">
        <label class="form-label" for="item-description">Description</label>
        <textarea class="form-control" id="item-description" name="description" rows="3" placeholder="Description"></textarea>
    </div>

    <div class="mb-6">
        <label class="form-label" for="item-image">Image</label>
        <input type="file" class="form-control" id="item-image" name="image">
    </div>

    <button type="submit" class="btn btn-primary me-3">Submit</button>
    <button type="reset" class="btn btn-label-danger" data-bs-dismiss="offcanvas">Cancel</button>
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
</div>
</div>
</div>
</div>

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
    
</body>
</html>
