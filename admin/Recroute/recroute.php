<?php 
require("../Misc/db_conn.php");
require("../Misc/functions.php");
adminLogin();

$admin_id = $_SESSION['adminId']; // Assuming admin ID is stored in session after login
$page_id = 7; // Example: Page X ID
$has_permission = mysqli_query($con, "SELECT * FROM permissions WHERE admin_id=$admin_id AND page_id=$page_id");

if (mysqli_num_rows($has_permission) == 0) {
    // Admin doesn't have permission to access this page
    header("Location: ../Misc/unauthorized.php");
    exit();
}
      
// Query to get the count of users from the database
$sql = "SELECT COUNT(*) as user_count FROM apply_form";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userCount = $row["user_count"];
} else {
    $userCount = 0;
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/TEDxManaratAlfaroukSchool/">
    <link rel="stylesheet" href="admin/css/style.css">
    <link rel="stylesheet" href="admin/css/style-users.css">
    <title>Admin Panel - TEDx Manarat AlFarouk School</title>
    <link rel="shortcut icon" href="admin/images/x-art.png" type="image/x-icon">
</head>
<body>
    
    <nav class="navbar">
    <h1>Recroute</h1>
    <h3>Job seekers: <?php echo $userCount; ?></h3>
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
        <input type="text" id="searchInput" placeholder="Search by user Phone">

    <table class="table" id="userTable">
        <thead>
            <tr>
                <th>First Name &nbsp;<i class="fi fi-rr-angle-small-down"></i></th>
                <th>Last Name &nbsp;<i class="fi fi-rr-angle-small-down"></i></th>
                <th>Email &nbsp;<i class="fi fi-rr-angle-small-down"></i></th>
                <th>Phone &nbsp;<i class="fi fi-rr-angle-small-down"></i></th>
                <th>Status &nbsp;<i class="fi fi-rr-angle-small-down"></i></th>
                <th>Action &nbsp;<i class="fi fi-rr-angle-small-down"></i></th>
            </tr>
        </thead>

    <tbody>

        <?php
        include("../Misc/db_conn.php");

        // read data from table
        $sql = "SELECT * FROM apply_form";
        $result = $con->query($sql);

        if (! $result) {
            die("Invalid query: " . $con->connect_error);
        }

        //read data all
        while($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>" . $row["first_name"] . "</td>
            <td>" . $row["last_name"] . "</td>
            <td>" . $row["email"] . "</td>
            <td>" . $row["phone"] . "</td>
            <td>" . $row["isaccepted"] . "</td>
            <td>
                <a class='btn btn-primary btn-sm' href='admin/Update/update_recroute.php?id=$row[id]'>View Info</a>
                <button class='btn btn-success btn-sm' onclick='confirmAccept($row[id])'>Accept</button>
            </td>
        </tr>";

        }

        ?>
    </tbody>

    </table>

</div>

<script>

    //accept popout function
    
function confirmAccept(userId) {
        // Display a popout
        const isConfirmed = confirm("Are you sure you want to accept this user?");
        
        // if okay
        if (isConfirmed) {
            window.location.href = 'admin/Accept/accept_recroute.php?id=' + userId;
        }
    }

// Get the input field and table
const searchInput = document.getElementById('searchInput');
const userTable = document.getElementById('userTable');

// Add an event listener to the input field
searchInput.addEventListener('input', function() {
  const searchText = searchInput.value.toLowerCase(); // Get the input value and convert to lowercase for case-insensitive search
  const rows = userTable.getElementsByTagName('tr'); // Get all rows in the table

  // Loop through each row in the table
  for (let i = 1; i < rows.length; i++) { // Start from index 1 to skip the header row
    const userName = rows[i].getElementsByTagName('td')[3]; // Assuming the user's name is in the second column (index 1)

    if (userName) {
      const userNameText = userName.textContent.toLowerCase(); // Get the user's name value and convert to lowercase

      // Check if the search text is found in the user's name
      if (userNameText.includes(searchText)) {
        rows[i].style.display = ''; // Show the row if the search text is found in the user's name
      } else {
        rows[i].style.display = 'none'; // Hide the row if the search text is not found in the user's name
      }
    }
  }
});

</script>

</body>
</html>