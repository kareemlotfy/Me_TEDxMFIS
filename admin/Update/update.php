<?php 

include("../Misc/db_conn.php");
require("../Misc/functions.php");

adminLogin();

$adminId = $_SESSION['adminId']; // Assuming admin ID is stored in session after login
$pageId = 5; // Example: replace with the actual page ID you want to check

checkAdminPermission($con, $adminId, $pageId);
?>

<?php

// Check user ID 
if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);

    // Get user id from db using prepared statements
    $stmt = $con->prepare("SELECT * FROM user_cred WHERE id=?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $userDetails = $result->fetch_assoc();
    } else {
        echo "User not found";
        exit();
    }
} else {
    echo "User ID not provided";
    exit();
}

// Handle update user information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $newFirstName = htmlspecialchars($_POST["newFirstName"], ENT_QUOTES, 'UTF-8');
    $newLastName = htmlspecialchars($_POST["newLastName"], ENT_QUOTES, 'UTF-8');
    $newEmail = filter_var($_POST["newEmail"], FILTER_SANITIZE_EMAIL);
    $newAge = intval($_POST["newAge"]);
    $newPhone = htmlspecialchars($_POST["newPhone"], ENT_QUOTES, 'UTF-8');
    $newLocation = htmlspecialchars($_POST["newLocation"], ENT_QUOTES, 'UTF-8');
    $newSchool = htmlspecialchars($_POST["newSchool"], ENT_QUOTES, 'UTF-8');
    $isAccepted = htmlspecialchars($_POST["isaccepted"], ENT_QUOTES, 'UTF-8');
    $ipAddress = htmlspecialchars($_POST["ip_address"], ENT_QUOTES, 'UTF-8');
    $browser = htmlspecialchars($_POST["browser"], ENT_QUOTES, 'UTF-8');
    $operatingSystem = htmlspecialchars($_POST["operating_system"], ENT_QUOTES, 'UTF-8');
    $submitDate = htmlspecialchars($_POST["submit_date"], ENT_QUOTES, 'UTF-8');
    $ticketId = htmlspecialchars($_POST["ticket_id"], ENT_QUOTES, 'UTF-8');
    $enterStatus = htmlspecialchars($_POST["enter_status"], ENT_QUOTES, 'UTF-8');
    $dinnerStatus = htmlspecialchars($_POST["dinner_status"], ENT_QUOTES, 'UTF-8');

    // Update user information in the db using prepared statements
    $stmt = $con->prepare("UPDATE user_cred SET
        first_name=?, last_name=?, email=?, age=?, phone=?, location=?, school=?, 
        isaccepted=?, ip_address=?, browser=?, operating_system=?, submit_date=?, ticket_id=?, 
        enter_status=?, dinner_status=? WHERE id=?");

    $stmt->bind_param("sssissssssssissi", $newFirstName, $newLastName, $newEmail, $newAge, $newPhone, $newLocation, 
        $newSchool, $isAccepted, $ipAddress, $browser, $operatingSystem, $submitDate, $ticketId, $enterStatus, $dinnerStatus, $userId);

    if ($stmt->execute()) {
        echo "User information updated successfully";
        
        // Redirect to users page
        header("Location: ../Tickets/tickets.php?userFilter=all");
        exit();
    } else {
        echo "Error updating user information: " . htmlspecialchars($con->error, ENT_QUOTES, 'UTF-8');
    }
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
    <link rel="stylesheet" href="admin/css/style-update.css">
    <title>Admin Panel - TEDx Manarat AlFarouk School</title>
    <link rel="shortcut icon" href="admin/images/x-art.png" type="image/x-icon">
    <script>
        function goBack() {
            window.history.back();
        }
        function enableEditMode() {
            var formElements = document.querySelectorAll("form input");
            formElements.forEach(function (element) {
                element.disabled = !element.disabled;
            });
            document.getElementById("editButton").style.display = "none";
            document.getElementById("updateButton").style.display = "block";
        }
    </script>
</head>
<body>
    <main>
        <div class="container">
            <form method="post" action="">
                <header>Update User Information</header>
                <div class="details users">
                    <span class="title">User details</span>
                    <div class="fields">
                        <div class="input-field">
                            <label for="newFirstName">First Name:</label>
                            <input type="text" name="newFirstName" value="<?php echo htmlspecialchars($userDetails['first_name'], ENT_QUOTES, 'UTF-8'); ?>" required disabled>
                        </div>
                        <div class="input-field">
                            <label for="newLastName">Last Name:</label>
                            <input type="text" name="newLastName" value="<?php echo htmlspecialchars($userDetails['last_name'], ENT_QUOTES, 'UTF-8'); ?>" required disabled>
                        </div>
                        <div class="input-field">
                            <label for="newEmail">Email:</label>
                            <input type="email" name="newEmail" value="<?php echo htmlspecialchars($userDetails['email'], ENT_QUOTES, 'UTF-8'); ?>" required disabled>
                        </div>
                        <div class="input-field">
                            <label for="newAge">Age:</label>
                            <input type="number" name="newAge" value="<?php echo htmlspecialchars($userDetails['age'], ENT_QUOTES, 'UTF-8'); ?>" required disabled>
                        </div>
                        <div class="input-field">
                            <label for="newPhone">Phone:</label>
                            <input type="text" name="newPhone" value="<?php echo htmlspecialchars($userDetails['phone'], ENT_QUOTES, 'UTF-8'); ?>" required disabled>
                        </div>
                        <div class="input-field">
                            <label for="newLocation">Location:</label>
                            <input type="text" name="newLocation" value="<?php echo htmlspecialchars($userDetails['location'], ENT_QUOTES, 'UTF-8'); ?>" required disabled>
                        </div>
                        <div class="input-field">
                            <label for="newSchool">School:</label>
                            <input type="text" name="newSchool" value="<?php echo htmlspecialchars($userDetails['school'], ENT_QUOTES, 'UTF-8'); ?>" required disabled>
                        </div>
                        <div class="input-field">
                            <label for="isaccepted">Is Accepted:</label>
                            <input type="text" name="isaccepted" value="<?php echo htmlspecialchars($userDetails['isaccepted'], ENT_QUOTES, 'UTF-8'); ?>" required disabled>
                        </div>
                        <div class="input-field">
                            <label for="ip_address">IP Address:</label>
                            <input type="text" name="ip_address" value="<?php echo htmlspecialchars($userDetails['ip_address'], ENT_QUOTES, 'UTF-8'); ?>" required disabled>
                        </div>
                        <div class="input-field">
                            <label for="browser">Browser:</label>
                            <input type="text" name="browser" value="<?php echo htmlspecialchars($userDetails['browser'], ENT_QUOTES, 'UTF-8'); ?>" required disabled>
                        </div>
                        <div class="input-field">
                            <label for="operating_system">Operating System:</label>
                            <input type="text" name="operating_system" value="<?php echo htmlspecialchars($userDetails['operating_system'], ENT_QUOTES, 'UTF-8'); ?>" required disabled>
                        </div>
                        <div class="input-field">
                            <label for="submit_date">Submit Date:</label>
                            <input type="text" name="submit_date" value="<?php echo htmlspecialchars($userDetails['submit_date'], ENT_QUOTES, 'UTF-8'); ?>" required disabled>
                        </div>
                        <div class="input-field">
                            <label for="ticket_id">Ticket ID:</label>
                            <input type="text" name="ticket_id" value="<?php echo htmlspecialchars($userDetails['ticket_id'], ENT_QUOTES, 'UTF-8'); ?>" disabled>
                        </div>
                        <div class="input-field">
                            <label for="enter_status">Enter Event Status:</label>
                            <input type="text" name="enter_status" value="<?php echo htmlspecialchars($userDetails['enter_status'], ENT_QUOTES, 'UTF-8'); ?>" required disabled>
                        </div>
                        <div class="input-field">
                            <label for="dinner_status">Dinner Status:</label>
                            <input type="text" name="dinner_status" value="<?php echo htmlspecialchars($userDetails['dinner_status'], ENT_QUOTES, 'UTF-8'); ?>" required disabled>
                        </div>
                        <button type="button" class="backbutton" onclick="goBack()">Back</button>
                        <button type="submit" class="updatebutton" id="updateButton" style="display: none;">Update</button>
                        <button type="button" class="editbutton" id="editButton" onclick="enableEditMode()">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
