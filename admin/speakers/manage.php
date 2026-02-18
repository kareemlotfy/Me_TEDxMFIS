<?php
session_start();
require_once("../../Misc/db_conn.php");
// require_once("../../Misc/functions.php");
// adminLogin();

// Prevent caching of this page
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

date_default_timezone_set('Africa/Cairo');

// Handle filters
$filterGen = isset($_GET['gen']) && $_GET['gen'] !== '' ? intval($_GET['gen']) : null;
$filterStatus = isset($_GET['status']) && $_GET['status'] !== '' ? $_GET['status'] : null;

// Build query with filters
$query = "SELECT * FROM speakers WHERE 1=1";
$params = [];
$types = "";

if ($filterGen !== null) {
    $query .= " AND generation = ?";
    $params[] = $filterGen;
    $types .= "i";
}

if ($filterStatus !== null) {
    $query .= " AND status = ?";
    $params[] = $filterStatus;
    $types .= "s";
}

$query .= " ORDER BY generation DESC, display_order ASC, created_at DESC";

// Prepare and execute with fresh data
if (!empty($params)) {
    $stmt = $con->prepare($query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $con->query($query);
}

// Get available generations for filter
$genQuery = "SELECT DISTINCT generation FROM speakers ORDER BY generation DESC";
$genResult = $con->query($genQuery);

$currentPage = 'speakers';
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Speakers</title>
    <link rel="icon" type="image/x-icon" href="admin/assets/img/logos/x-art.png" />
    <base href="http://localhost/TEDxManaratAlfaroukSchool/">

    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="admin/assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="admin/assets/vendor/css/core.css" />
    <link rel="stylesheet" href="admin/assets/vendor/css/theme-default.css" />

    <style>
    .filters-card {
        background: #fff;
        border-radius: .375rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px 0 rgba(34, 48, 62, .08);
    }

    .filter-row {
        display: flex;
        gap: 1rem;
        align-items: end;
        flex-wrap: wrap;
    }

    .filter-group {
        flex: 1;
        min-width: 200px;
    }

    .speaker-thumb {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: .375rem;
    }

    .action-group {
        display: flex;
        gap: .375rem;
        align-items: center;
    }

    .btn-icon-only {
        width: 32px;
        height: 32px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.125rem;
    }

    .status-badge {
        font-size: .75rem;
        padding: .25rem .75rem;
        border-radius: 1rem;
        font-weight: 600;
    }

    .gen-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: .375rem;
        font-weight: 600;
        font-size: .875rem;
    }

    .bio-cell {
        max-width: 350px;
    }

    .bio-text {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        color: #8592a3;
        font-size: .875rem;
        line-height: 1.4;
    }

    .alert {
        border: none;
        border-left: 3px solid;
        border-radius: .375rem;
    }

    .alert-success {
        background: #e3f8d7;
        border-color: #71dd37;
        color: #2d5816;
    }

    .alert-danger {
        background: #ffd8d2;
        border-color: #ff3e1d;
        color: #66190c;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .stats-row {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .stat-card {
        flex: 1;
        background: linear-gradient(135deg, #e62b1e 0%, #c00020 100%);
        color: white;
        padding: 1.25rem;
        border-radius: .375rem;
        box-shadow: 0 2px 6px 0 rgba(230, 43, 30, .2);
    }

    .stat-card h3 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0 0 .25rem 0;
    }

    .stat-card p {
        margin: 0;
        opacity: .9;
        font-size: .875rem;
    }

    table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: .75rem;
        letter-spacing: .5px;
        color: #384551;
    }

    .layout-page {
        padding-top: 61.9886360168457px !important;
    }
    </style>
</head>

<body>
    <!-- Add your nav/aside here -->
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
                    <div class="container-xxl flex-grow-1 container-p-y">



                        <!-- Stats -->
                        <div class="row g-6 mb-6">
                            <?php
                $totalQuery = "SELECT 
                    COUNT(*) as total,
                    SUM(CASE WHEN status='published' THEN 1 ELSE 0 END) as published,
                    SUM(CASE WHEN status='draft' THEN 1 ELSE 0 END) as draft,
                    SUM(CASE WHEN status='archived' THEN 1 ELSE 0 END) as archived
                FROM speakers";
                $statsResult = $con->query($totalQuery);
                $stats = $statsResult->fetch_assoc();
                ?>

                            <!-- Total Speakers-->
                            <div class="col-sm-6 col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="content-left">
                                                <span class="text-heading">Total Speakers</span>
                                                <div class="d-flex align-items-center my-1">
                                                    <h4 class="mb-0 me-2">
                                                        <div class="number-wrapper">
                                                            <?php echo $stats['total']; ?>
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


                            <!-- Published -->
                            <div class="col-sm-6 col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="content-left">
                                                <span class="text-heading">Published</span>
                                                <div class="d-flex align-items-center my-1">
                                                    <h4 class="mb-0 me-2">
                                                        <div class="number-wrapper">
                                                            <?php echo $stats['published']; ?>
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


                            <!-- Drafts -->
                            <div class="col-sm-6 col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="content-left">
                                                <span class="text-heading">Draft</span>
                                                <div class="d-flex align-items-center my-1">
                                                    <h4 class="mb-0 me-2">
                                                        <div class="number-wrapper">
                                                            <?php echo $stats['draft']; ?>
                                                        </div>
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="avatar">
                                                <span class="avatar-initial rounded bg-label-warning">
                                                    <i class="bx bx-edit bx-sm"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Archived -->
                            <div class="col-sm-6 col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between">
                                            <div class="content-left">
                                                <span class="text-heading">Archived</span>
                                                <div class="d-flex align-items-center my-1">
                                                    <h4 class="mb-0 me-2">
                                                        <div class="number-wrapper">
                                                            <?php echo $stats['archived']; ?>
                                                        </div>
                                                    </h4>
                                                </div>
                                            </div>
                                            <div class="avatar">
                                                <span class="avatar-initial rounded bg-label-secondary">
                                                    <i class="bx bx-archive bx-sm"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <!-- Page Header -->
                        <div class="page-header">
                            <div>
                                <h4 class="mb-1">Speaker Management</h4>
                                <p class="text-muted mb-0">Manage your TEDx speakers across all generations</p>
                            </div>
                            <a href="admin/speakers/add.php" class="btn btn-primary">
                                <i class='bx bx-plus me-1'></i> Add Speaker
                            </a>
                        </div>

                        <!-- Alerts -->
                        <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong>Success!</strong>
                            <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
                            <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
                        </div>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <strong>Error!</strong>
                            <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                            <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
                        </div>
                        <?php endif; ?>

                        <!-- Filters -->
                        <div class="filters-card">
                            <form method="GET" action="">
                                <div class="filter-row">
                                    <div class="filter-group">
                                        <label class="form-label">Generation</label>
                                        <select name="gen" class="form-select">
                                            <option value="">All Generations</option>
                                            <?php while($gen = $genResult->fetch_assoc()): ?>
                                            <option value="<?php echo $gen['generation']; ?>"
                                                <?php echo ($filterGen == $gen['generation']) ? 'selected' : ''; ?>>
                                                Generation <?php echo $gen['generation']; ?>
                                            </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>

                                    <div class="filter-group">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="">All Status</option>
                                            <option value="published"
                                                <?php echo ($filterStatus == 'published') ? 'selected' : ''; ?>>
                                                Published</option>
                                            <option value="draft"
                                                <?php echo ($filterStatus == 'draft') ? 'selected' : ''; ?>>Draft
                                            </option>
                                            <option value="archived"
                                                <?php echo ($filterStatus == 'archived') ? 'selected' : ''; ?>>Archived
                                            </option>
                                        </select>
                                    </div>

                                    <div style="display: flex; gap: .5rem;">
                                        <button type="submit" class="btn btn-primary">
                                            <i class='bx bx-filter-alt'></i> Filter
                                        </button>
                                        <a href="admin/speakers/manage.php" class="btn btn-label-secondary">
                                            <i class='bx bx-reset'></i> Clear
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Speakers Table -->
                        <div class="card">
                            <div class="table-responsive">
                                <?php if ($result && $result->num_rows > 0): ?>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Speaker</th>
                                            <th>Biography</th>
                                            <th>Gen</th>
                                            <th>Status</th>
                                            <th>Order</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($speaker = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td>
                                                <img src="<?php echo htmlspecialchars($speaker['image_path']); ?>"
                                                    alt="Speaker" class="speaker-thumb">
                                            </td>
                                            <td>
                                                <div>
                                                    <h6 class="mb-0">
                                                        <?php echo htmlspecialchars($speaker['full_name']); ?></h6>
                                                    <small
                                                        class="text-muted"><?php echo htmlspecialchars($speaker['job_title']); ?></small>
                                                </div>
                                            </td>
                                            <td class="bio-cell">
                                                <div class="bio-text"
                                                    title="<?php echo htmlspecialchars($speaker['bio_processed']); ?>">
                                                    <?php echo htmlspecialchars($speaker['bio_processed']); ?>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="gen-badge bg-label-primary">
                                                    <?php echo $speaker['generation']; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php 
                                            // Clean status value
                                            $currentStatus = trim($speaker['status']);
                                            $statusColors = [
                                                'published' => 'success',
                                                'draft' => 'warning', 
                                                'archived' => 'secondary'
                                            ];
                                            $color = $statusColors[$currentStatus] ?? 'secondary';
                                            ?>
                                                <span class="status-badge bg-label-<?php echo $color; ?>">
                                                    <?php echo ucfirst($currentStatus ?: 'Unknown'); ?>
                                                </span>
                                            </td>
                                            <td><?php echo $speaker['display_order']; ?></td>
                                            <td>
                                                <div class="action-group">
                                                    <a href="admin/speakers/edit.php?id=<?php echo $speaker['id']; ?>"
                                                        class="btn btn-sm btn-icon-only btn-primary" title="Edit">
                                                        <i class='bx bx-edit-alt'></i>
                                                    </a>

                                                    <?php if ($currentStatus !== 'published'): ?>
                                                    <a href="admin/speakers/process.php?action=publish&id=<?php echo $speaker['id']; ?>"
                                                        class="btn btn-sm btn-icon-only btn-success" title="Publish">
                                                        <i class='bx bx-check-circle'></i>
                                                    </a>
                                                    <?php endif; ?>

                                                    <?php if ($currentStatus !== 'draft'): ?>
                                                    <a href="admin/speakers/process.php?action=draft&id=<?php echo $speaker['id']; ?>"
                                                        class="btn btn-sm btn-icon-only btn-warning"
                                                        title="Move to Draft">
                                                        <i class='bx bx-edit'></i>
                                                    </a>
                                                    <?php endif; ?>

                                                    <?php if ($currentStatus !== 'archived'): ?>
                                                    <a href="admin/speakers/process.php?action=archive&id=<?php echo $speaker['id']; ?>"
                                                        class="btn btn-sm btn-icon-only btn-secondary" title="Archive">
                                                        <i class='bx bx-archive'></i>
                                                    </a>
                                                    <?php endif; ?>

                                                    <button
                                                        onclick="confirmDelete(<?php echo $speaker['id']; ?>, '<?php echo htmlspecialchars($speaker['full_name'], ENT_QUOTES); ?>')"
                                                        class="btn btn-sm btn-icon-only btn-danger" title="Delete">
                                                        <i class='bx bx-trash'></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                                <?php else: ?>
                                <div class="text-center py-5">
                                    <i class='bx bx-user-voice'
                                        style="font-size: 4rem; color: #8592a3; opacity: .5;"></i>
                                    <h5 class="mt-3 text-muted">No speakers found</h5>
                                    <p class="text-muted">Add your first speaker to get started</p>
                                    <a href="admin/speakers/add.php" class="btn btn-primary mt-3">
                                        <i class='bx bx-plus me-1'></i> Add Speaker
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-backdrop fade"></div>

                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>



        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>


        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>

    </div>


    <script src="admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="admin/assets/vendor/js/bootstrap.js"></script>

    <script>
    function confirmDelete(id, name) {
        if (confirm(`Delete "${name}"? This cannot be undone.`)) {
            window.location.href = `admin/speakers/process.php?action=delete&id=${id}`;
        }
    }

    // Auto-dismiss alerts after 5 seconds
    setTimeout(() => {
        document.querySelectorAll('.alert-dismissible').forEach(alert => {
            alert.style.transition = 'opacity 0.3s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        });
    }, 5000);
    </script>
</body>

</html>
<?php 
// Close connections properly
if (isset($stmt)) {
    $stmt->close();
}
if (isset($genResult)) {
    $genResult->close();
}
$con->close(); 
?>