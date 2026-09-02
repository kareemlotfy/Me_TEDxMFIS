<?php
include("../Misc/db_conn.php");
require("../Misc/functions.php");
require_once __DIR__ . '/../../config.php';

adminLogin();

$adminId = $_SESSION['adminId'] ?? 0;
$pageId  = 4;
checkAdminPermission($con, $adminId, $pageId);
date_default_timezone_set('Africa/Cairo');

$now = date("Y-m-d H:i:s");

$update = $con->prepare("UPDATE admin_cred SET last_activity=? WHERE id=?");
$update->bind_param("si", $now, $adminId);
$update->execute();

$adminDetails   = getAdminDetails($con, $adminId) ?: [];
$adminName      = $adminDetails['admin_name']     ?? '';
$adminCommitee  = $adminDetails['admin_commitee'] ?? '';
$adminPic       = $adminDetails['admin_pic']      ?? '';
$adminPosition  = $adminDetails['admin_position'] ?? '';
$adminEmail     = $adminDetails['admin_email']    ?? '';
$adminUsername  = $adminDetails['admin_username'] ?? '';

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ticket_price[ID], ticket_discount[ID], ticket_status[ID]
    $prices    = $_POST['ticket_price']    ?? [];
    $discounts = $_POST['ticket_discount'] ?? [];
    $statuses  = $_POST['ticket_status']   ?? [];

    $allowedStatuses = ['available', 'sold_out', 'hidden', 'coming_soon'];

    $con->begin_transaction();
    try {
        $stmt = $con->prepare("UPDATE settings SET ticket_price = ?, ticket_discount = ?, ticket_status = ? WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $con->error);
        }

        foreach ($prices as $id => $price) {
            $id       = (int)$id;
            $price    = is_numeric($price)    ? (float)$price    : 0.0;
            $discount = isset($discounts[$id]) && is_numeric($discounts[$id]) ? (float)$discounts[$id] : 0.0;
            $status   = isset($statuses[$id]) ? trim($statuses[$id]) : 'sold_out';
            if (!in_array($status, $allowedStatuses, true)) {
                $status = 'sold_out';
            }

            // ddsi => double, double, string, integer
            $stmt->bind_param("ddsi", $price, $discount, $status, $id);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed for ticket #$id: " . $stmt->error);
            }
        }

        $stmt->close();
        $con->commit();
        $msg = "Saved Successfully";
    } catch (Exception $e) {
        $con->rollback();
        $msg = "Error" . $e->getMessage();
    }
}

$tickets = [];
$sql = "SELECT id, ticket_name, ticket_status, ticket_price, ticket_discount FROM settings ORDER BY id ASC";
$result = $con->query($sql);

if ($result === false) {
    die("Database error while fetching tickets: " . $con->error);
}

while ($row = $result->fetch_assoc()) {
    $tickets[] = $row;
}
$result->free();

$currentPage = 'settings';
?>




<!DOCTYPE html>

<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-compact">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Settings</title>

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

    <!-- Page CSS -->
    <link rel="stylesheet" href="admin/css/style-settings.css">

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
                <?php include('../components/nav.php'); ?>
                <!-- / Navbar -->

             <!-- Content wrapper -->
             <div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
<!-- Form for updating ticket price, discount, and ticket status -->
<form method="POST" action="">
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-header border-bottom mb-3"><h5 class="card-title mb-0">Update Ticket Settings</h5></div>
        <div class="card-body">

          <!-- Ticket Loop -->
          <?php foreach ($tickets as $ticket): ?>
            <div class="card mb-3 p-3">
              <h6><?= htmlspecialchars($ticket['ticket_name']) ?></h6>

              <!-- Ticket Price & Discount -->
              <div class="row mb-3">
                <div class="col-md-6">
                  <label class="form-label">Ticket Price (L.E)</label>
                  <input type="number"
                         class="form-control"
                         name="ticket_price[<?= $ticket['id'] ?>]"
                         value="<?= htmlspecialchars($ticket['ticket_price']) ?>"
                         step="0.01" min="0" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Discount (L.E)</label>
                  <input type="number"
                         class="form-control"
                         name="ticket_discount[<?= $ticket['id'] ?>]"
                         value="<?= htmlspecialchars($ticket['ticket_discount']) ?>"
                         step="0.01" min="0" required>
                </div>
              </div>

              <!-- Ticket Status -->
              <div class="d-flex flex-wrap gap-3 mt-2">
                <label class="me-3 d-flex align-items-center gap-2">
                  <input type="radio" class="form-check-input mt-0"
                         name="ticket_status[<?= $ticket['id'] ?>]"
                         value="available"
                         <?= $ticket['ticket_status'] == 'available' ? 'checked' : '' ?>>
                  Available
                </label>
                <label class="me-3 d-flex align-items-center gap-2">
                  <input type="radio" class="form-check-input mt-0"
                         name="ticket_status[<?= $ticket['id'] ?>]"
                         value="coming_soon"
                         <?= $ticket['ticket_status'] == 'coming_soon' ? 'checked' : '' ?>>
                  Coming Soon
                </label>
                <label class="me-3 d-flex align-items-center gap-2">
                  <input type="radio" class="form-check-input mt-0"
                         name="ticket_status[<?= $ticket['id'] ?>]"
                         value="sold_out"
                         <?= $ticket['ticket_status'] == 'sold_out' ? 'checked' : '' ?>>
                  Sold Out
                </label>
                <label class="me-3 d-flex align-items-center gap-2">
                  <input type="radio" class="form-check-input mt-0"
                         name="ticket_status[<?= $ticket['id'] ?>]"
                         value="hidden"
                         <?= $ticket['ticket_status'] == 'hidden' ? 'checked' : '' ?>>
                  Hidden
                </label>
              </div>
            </div>
          <?php endforeach; ?>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-primary">Update All Settings</button>
        </div>
      </div>
    </div>
  </div>
</form>

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
<script src="admin/assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="admin/assets/vendor/libs/chartjs/chartjs.js"></script>

<!-- Main JS -->
<script src="admin/assets/js/main.js"></script>
<!-- Page JS -->
<script src="admin/assets/js/dashboards-analytics.js"></script>
