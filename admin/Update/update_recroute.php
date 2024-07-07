<?php
require("../Misc/db_conn.php");
require("../Misc/functions.php");
adminLogin();

$admin_id = $_SESSION['adminId']; // Assuming admin ID is stored in session after login
$page_id = 5; // Example: Page X ID
$has_permission = mysqli_query($con, "SELECT * FROM permissions WHERE admin_id=$admin_id AND page_id=$page_id");

if (mysqli_num_rows($has_permission) == 0) {
    // Admin doesn't have permission to access this page
    header("Location: ../Misc/unauthorized.php");
    exit();
}

// Check user ID 
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // get user id from db
    $sql = "SELECT * FROM apply_form WHERE id = $userId";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $userDetails = $result->fetch_assoc();
    } else {
        echo "User not found";
        exit;
    }
} else {
    echo "User ID not provided";
    exit;
}

// Handle update user information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newFirstName = $_POST["newFirstName"];
    $newLastName = $_POST["newLastName"];
    $newEmail = $_POST["newEmail"];
    $newAge = $_POST["newAge"];
    $newPhone = $_POST["newPhone"];
    $newLocation = $_POST["newLocation"];
    $newSchool = $_POST["newSchool"];
    $isAccepted = $_POST["isaccepted"];
    $ipAddress = $_POST["ip_address"];
    $browser = $_POST["browser"];
    $operatingSystem = $_POST["operating_system"];
    $submitDate = $_POST["submit_date"];
    $title = $_POST["title"];
    
    

    // Update user information in the db
    $updateSql = "UPDATE apply_form SET
    first_name = '$newFirstName',
    last_name = '$newLastName',
    email = '$newEmail',
    age = $newAge,
    phone = '$newPhone',
    location = '$newLocation',
    school = '$newSchool',
    isaccepted = '$isAccepted',
    ip_address = '$ipAddress',
    browser = '$browser',
    operating_system = '$operatingSystem',
    submit_date = '$submitDate',
    title = '$title',

    WHERE id = $userId";

    if ($con->query($updateSql) === TRUE) {
        echo "User information updated successfully";
        
        // Redirect to users page
        // header("Location: users.php");
        exit;
    } else {
        echo "Error updating user information: " . $con->error;
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

        <header>Update Seekers Information</header>


            <div class="details users">
                <span class="title">Seeker Details</span>

    <div  class="fields">

    <div class="input-field">

    <label for="newFirstName">First Name:</label>
    <input type="text" name="newFirstName" value="<?php echo $userDetails['first_name']; ?>" required disabled>

    </div>


    <div class="input-field">

    <label for="newLastName">Last Name:</label>
    <input type="text" name="newLastName" value="<?php echo $userDetails['last_name']; ?>" required disabled>

    </div>

    <div class="input-field">

    <label for="newEmail">Email:</label>
    <input type="email" name="newEmail" value="<?php echo $userDetails['email']; ?>" required disabled>

    </div>

    <div class="input-field">


    <label for="newAge">Age:</label>
    <input type="number" name="newAge" value="<?php echo $userDetails['age']; ?>" required disabled>

    </div>


    <div class="input-field">

    <label for="newPhone">Phone:</label>
    <input type="text" name="newPhone" value="<?php echo $userDetails['phone']; ?>" required disabled>

    </div>

    <div class="input-field">


    <label for="newLocation">Location:</label>
    <input type="text" name="newLocation" value="<?php echo $userDetails['location']; ?>" required disabled>

    </div>

    <div class="input-field">

    <label for="newSchool">School:</label>
    <input type="text" name="newSchool" value="<?php echo $userDetails['school']; ?>" required disabled>

    </div>

    <div class="input-field">

    <label for="isaccepted">Is Accepted:</label>
    <input type="text" name="isaccepted" value="<?php echo $userDetails['isaccepted']; ?>" required disabled>

    </div>

    <div class="input-field">

    <label for="isaccepted">Title:</label>
    <input type="text" name="title" value="<?php echo $userDetails['title']; ?>" required disabled>

    </div>

    <div class="input-field">

    <label for="ip_address">IP Address:</label>
    <input type="text" name="ip_address" value="<?php echo $userDetails['ip_address']; ?>" required disabled>

    </div>

    <div class="input-field">

    <label for="browser">Browser:</label>
    <input type="text" name="browser" value="<?php echo $userDetails['browser']; ?>" required disabled>

    </div>

    <div class="input-field">

    <label for="operating_system">Operating System:</label>
    <input type="text" name="operating_system" value="<?php echo $userDetails['operating_system']; ?>" required disabled>

    </div>

    <div class="input-field">

    <label for="submit_date">Submit Date:</label>
    <input type="text" name="submit_date" value="<?php echo $userDetails['submit_date']; ?>" required disabled>

    </div>

    <button type="button" class="backbutton" onclick="goBack()">Back</button>
    <button type="submit" class="updatebutton" id="updateButton" style="display: none;">Update</button>
    <button type="button" class="editbutton" id="editButton" onclick="enableEditMode()">Edit</button>
    
    </div>
</form>

    </div>
    
    </main>

</body>
</html>
