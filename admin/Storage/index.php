<?php 
include("../Misc/db_conn.php");
require("../Misc/functions.php");

adminLogin();

$adminId = $_SESSION['adminId']; 
$pageId = 9; 
checkAdminPermission($con, $adminId, $pageId);

$sql = "SELECT * FROM storage ORDER BY created_at DESC";
$result = mysqli_query($con, $sql);

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

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Storage Items</title>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <!-- Base -->
    <base href="http://localhost/TEDxManaratAlfaroukSchool/">
        <!-- <base href="https://tedxmanaratalfaroukschool.com/"> -->

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

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

                <div class="app-brand demo pb-4 pt-4 ">
                    <a href="admin/Dashboard/dashboard.php" class="app-brand-link">
                        <div class="logo-container">
                            <img src="admin/assets/img/logos/TEDx_logo_place2_RGB_CS2_page-0001.jpg" alt="tedx logo"
                                class="tedx-logo" id="tedx_logo" >
                            <img src="admin\assets\img\logos\x-art.png" class="x-logo" alt="x-logo" >
                        </div>
                        
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
                                <a href="javascript:void(0);" class="menu-link">
                                    <div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div class="text-truncate" data-i18n="Products">Products</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link">
                                            <div class="text-truncate" data-i18n="Product List">Product List</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link">
                                            <div class="text-truncate" data-i18n="Add Product">Add Product</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link">
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
                                        <a href="javascript:void(0);" class="menu-link">
                                            <div class="text-truncate" data-i18n="Order List">Order List</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link">
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
                                        <a href="javascript:void(0);" class="menu-link">
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
                                                <a href="javascript:void(0);"
                                                    class="menu-link">
                                                    <div class="text-truncate" data-i18n="Overview">Overview</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="javascript:void(0);"
                                                    class="menu-link">
                                                    <div class="text-truncate" data-i18n="Security">Security</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="javascript:void(0);" class="menu-link">
                                                    <div class="text-truncate" data-i18n="Address & Billing">Address &
                                                        Billing</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link">
                                    <div class="text-truncate" data-i18n="Manage Reviews">Manage Reviews</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link">
                                    <div class="text-truncate" data-i18n="Referrals">Referrals</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div class="text-truncate" data-i18n="Settings">Settings</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link">
                                            <div class="text-truncate" data-i18n="Store Details">Store Details</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link">
                                            <div class="text-truncate" data-i18n="Payments">Payments</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link">
                                            <div class="text-truncate" data-i18n="Checkout">Checkout</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link">
                                            <div class="text-truncate" data-i18n="Shipping & Delivery">Shipping &
                                                Delivery</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link">
                                            <div class="text-truncate" data-i18n="Locations">Locations</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link">
                                            <div class="text-truncate" data-i18n="Notifications">Notifications</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- e-commerce-app menu end -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class='menu-icon tf-icons bx bx-user'></i>
                            <div class="text-truncate" data-i18n="Users">Users</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="admin/Tickets/single.php?userFilter=all" class="menu-link">
                                    <div class="text-truncate" data-i18n="Single Tickets">Single Tickets</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="admin/Tickets/vip.php?userFilter=all" class="menu-link">
                                    <div class="text-truncate" data-i18n="VIP Tickets">VIP Tickets</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="admin/Tickets/family.php?userFilter=all" class="menu-link">
                                    <div class="text-truncate" data-i18n="Family Tickets">Family Tickets</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item active open">
                        <a href="admin/Storage/" class="menu-link ">
                            <i class="menu-icon tf-icons bx bx-box"></i>
                            <div class="text-truncate" data-i18n="Storage">Storage</div>
                        </a>
                    </li>                
                    <li class="menu-item ">
                        <a href="admin/Settings/settings.php" class="menu-link ">
                            <i class="menu-icon tf-icons bx bx-cog"></i>
                            <div class="text-truncate" data-i18n="Settings">Settings</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="admin\Misc\coming-soon.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-purchase-tag-alt"></i>
                            <div class="text-truncate" data-i18n="Coupons ">Coupons</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="admin\Misc\coming-soon.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-briefcase"></i>
                            <div class="text-truncate" data-i18n="Recruit">Recruit</div>
                        </a>
                    </li>
                </ul>
                <ul class="menu-inner" style="height:60px;">
                    <li class="menu-item" style="position: absolute; bottom: 10px; margin-top:10px;">
                        <a href="admin/Login/logout.php" class="menu-link">
                            <i class="bx bx-power-off bx-sm me-3"></i>
                            <div class="text-truncate" data-i18n="Log Out">Log Out</div>
                        </a>
                    </li>
                </ul>
                    
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
                            <li class="nav-item dropdown-language dropdown me-2 me-xl-0" style="visibility:hidden;">
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
                                        <img src="admin/Profile/images/<?php echo !empty($adminPic) ? $adminPic : 'default-pic.jpg'; ?>"
                                            alt class="w-px-40 h-auto rounded-circle">
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="admin/Profile/images/<?php echo !empty($adminPic) ? $adminPic : 'default-pic.jpg'; ?>"
                                                            alt class="w-px-40 h-auto rounded-circle">
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
                                            <i class="bx bx-edit bx-sm me-3"></i><span>Edit Account</span>
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
