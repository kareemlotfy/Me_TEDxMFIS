<?php 
require("../Misc/db_conn.php");
require("../Misc/functions.php");
adminLogin();

$admin_id = $_SESSION['adminId']; // Assuming admin ID is stored in session after login
$page_id = 2; // Example: Page X ID
$has_permission = mysqli_query($con, "SELECT * FROM permissions WHERE admin_id=$admin_id AND page_id=$page_id");

if (mysqli_num_rows($has_permission) == 0) {
    // Admin doesn't have permission to access this page
    header("Location: ../Misc/unauthorized.php");
    exit();
}

$limit = 10; // Number of records per page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get current page number from query string, default to page 1
$offset = ($currentPage - 1) * $limit; // Calculate the offset

// filter condition
$filter = '';
if (isset($_GET['userFilter'])) {
    if ($_GET['userFilter'] == 'paid') {
        $filter = "WHERE isaccepted = 'yes'";
    } elseif ($_GET['userFilter'] == 'unpaid') {
        $filter = "WHERE isaccepted = 'no'";
    }
}

// search phone
$searchPhone = '';
if (isset($_GET['searchPhone']) && !empty($_GET['searchPhone'])) {
    $searchPhone = mysqli_real_escape_string($con, $_GET['searchPhone']);
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
$sql = "SELECT * FROM user_cred $filter LIMIT $limit OFFSET $offset";
$result = $con->query($sql);

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/TEDxManaratAlfaroukSchool/">
    <link rel="stylesheet" href="admin/css/style.css">
    <link rel="stylesheet" href="admin/css/style-tickets.css">
    <title>Admin Panel - TEDx Manarat AlFarouk School</title>
    <link rel="shortcut icon" href="admin/images/x-art.png" type="image/x-icon">

    <style>
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        padding-bottom: 20px;
    }

    .pagination a, .pagination-btn {
        color: #007bff;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color 0.3s;
        margin: 0 4px;
        border: 1px solid #ddd;
        border-radius: 4px;
        display: inline-block;
        cursor: pointer;
        background-color: white;
    }

    .pagination a:hover, .pagination-btn:hover {
        background-color: #f1f1f1;
    }

    .pagination a.active, .pagination-btn.active {
        background-color: #007bff;
        color: white;
        border: 1px solid #007bff;
    }

    .pagination a.disabled, .pagination-btn.disabled {
        color: #ddd;
        pointer-events: none;
    }

    .profile-circle {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #ffe0db;
        color: #ff3e1d;
        font-size: 14px;
    }

    .action-icons i {
        font-size: 20px;
        cursor: pointer;
        margin-right: 10px;
        color: #007bff;
        transition: color 0.3s;
    }

    .action-icons i:hover {
        color: #0056b3;
    }
    </style>
</head>
<body>

<nav class="navbar">
    <h1>Tickets</h1>
    <form class="centered">
        <a href="admin/Profile/profile.php"><?php echo $_SESSION["adminName"] ?></a>&nbsp;&nbsp;&nbsp;<a href="admin/Profile/profile.php"><i class="fi fi-tr-circle-user"></i></a>
    </form>
</nav>

<div class="aside">
    <br><br>
    <img src="user/images/TEDx_logo_place2_RGB_CS2_page-0001.jpg" alt="" class="logo">
    <br><br><br>
    <ul>
        <a href="admin/Dashboard/dashboard.php"><li><i class="fi fi-rr-house-chimney"></i> &nbsp;&nbsp;Dashboard</li></a>
        <a href="admin/Tickets/tickets.php?userFilter=all"><li><i class="fi fi-rr-ticket"></i> &nbsp;&nbsp;Tickets</li></a>
        <a href="admin/Misc/coming-soon.php"><li><i class="fi fi-rr-briefcase-blank"></i> &nbsp;&nbsp;Recroute</li></a>
        <a href="admin/Misc/coming-soon.php"><li><i class="fi fi-rr-shopping-cart"></i> &nbsp;&nbsp;Shop</li></a>
        <a href="admin/Settings/settings.php"><li><i class="fi fi-rr-settings"></i> &nbsp;&nbsp;Settings</li></a>
        <br><br><br><br><br>
    </ul>
    <br>
    <a href="admin/Login/logout.php" class="logout"><i class="fi fi-rr-exit"></i>&nbsp;&nbsp;&nbsp;&nbsp;Logout</a>
</div>

<div class="main">
    <h3>Total Users: <?php echo $totalUsers; ?></h3>
    <h4>Paid: <?php echo $paidCount; ?> | Unpaid: <?php echo $unpaidCount; ?></h4>
    <br>
    <form action="admin/Tickets/tickets.php" method="get">
        <label for="userFilter">Filter by status:</label>
        <select name="userFilter" id="userFilter" onchange="this.form.submit()">
            <option value="all" <?php if (!isset($_GET['userFilter']) || $_GET['userFilter'] == 'all') echo 'selected'; ?>>All</option>
            <option value="paid" <?php if (isset($_GET['userFilter']) && $_GET['userFilter'] == 'paid') echo 'selected'; ?>>Paid</option>
            <option value="unpaid" <?php if (isset($_GET['userFilter']) && $_GET['userFilter'] == 'unpaid') echo 'selected'; ?>>Unpaid</option>
        </select>
    </form>
    <br>
    <?php
    if ($_GET['userFilter'] == 'paid') {
        $y = "export_pdf_paid.php";
    } elseif ($_GET['userFilter'] == 'unpaid') {
        $y = "export_pdf_unpaid.php";
    } else {
        $y = "export_pdf_all.php";
    }
    ?>
    <form action="admin/Tickets/<?php echo $y ?>" method="post">
        <button type="submit" class="pagination-btn">Export to PDF</button>
    </form>
    <br>

    <form action="admin/Tickets/tickets.php" method="get" id="searchForm">
        <input type="hidden" name="userFilter" value="<?php echo isset($_GET['userFilter']) ? $_GET['userFilter'] : 'all'; ?>">
        <input type="text" id="searchPhone" name="searchPhone" placeholder="Search by Phone Number" value="<?php echo $searchPhone; ?>">
    </form>
    
    <table>
        <thead>
            <tr>
                <th>Profile</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="userTable">
            <?php
            while ($row = $result->fetch_assoc()) {
                $name = $row["first_name"] . " " . $row["last_name"];
                $initials = strtoupper($row["first_name"][0] . $row["last_name"][0]);
                $status = $row["isaccepted"] == 'yes' ? "Paid" : "Unpaid";
                echo "<tr>
                        <td><div class='profile-circle'>$initials</div></td>
                        <td>" . $name . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["phone"] . "</td>
                        <td>" . $status . "</td>
                        <td class='action-icons'>";
                if ($row["isaccepted"] == 'no') {
                    echo "<a href='admin/Update/update.php?id=" . $row["id"] . "'><i class='fi fi-rr-pencil'></i></a>
                          <a href='admin/Accept/accept.php?id=" . $row["id"] . "'><i class='fi fi-rr-check'></i></a>
                        </td>
                      </tr>";
                } else {
                    echo "<a href='admin/Update/update.php?id=" . $row["id"] . "'><i class='fi fi-rr-pencil'></i></a>
                          </td>
                      </tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        <?php 
        $totalPages = ceil($totalFilteredUsers / $limit);
        $queryString = http_build_query(array_merge($_GET, ['page' => 1]));

        // Previous button
        if ($currentPage > 1) {
            $prevPage = $currentPage - 1;
            $queryString = http_build_query(array_merge($_GET, ['page' => $prevPage]));
            echo "<a href='admin/Tickets/tickets.php?$queryString'>&laquo; Previous</a>";
        } else {
            echo "<a class='disabled'>&laquo; Previous</a>";
        }

        // Page numbers
        for ($i = 1; $i <= $totalPages; $i++) {
            $queryString = http_build_query(array_merge($_GET, ['page' => $i]));
            if ($i == $currentPage) {
                echo "<a class='active' href='admin/Tickets/tickets.php?$queryString'>$i</a>";
            } else {
                echo "<a href='admin/Tickets/tickets.php?$queryString'>$i</a>";
            }
        }

        // Next button
        if ($currentPage < $totalPages) {
            $nextPage = $currentPage + 1;
            $queryString = http_build_query(array_merge($_GET, ['page' => $nextPage]));
            echo "<a href='admin/Tickets/tickets.php?$queryString'>Next &raquo;</a>";
        } else {
            echo "<a class='disabled'>Next &raquo;</a>";
        }
        ?>
    </div>
</div>

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
