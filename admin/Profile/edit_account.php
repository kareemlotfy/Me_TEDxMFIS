<?php 

include("../Misc/db_conn.php");
require("../Misc/functions.php");

adminLogin();

$adminId = $_SESSION['adminId']; // Assuming admin ID is stored in session after login
$pageId = 6; // Example: Page X ID

checkAdminPermission($con, $adminId, $pageId);

?>

<?php
header("Location:../Misc/error.html")
?>


<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['form_type'])) {
        $formType = $_POST['form_type'];
        
        // Password Change Form
        if ($formType === 'password_change') {
            $currentPassword = $_POST['currentPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

    // Prepare the SQL statement
    $stmt = $con->prepare("SELECT admin_pass FROM admin_cred WHERE id = ?");
    
    // Check if prepare() was successful
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($con->error));
    }
    
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    $stmt->close();

    // Verify the current password
    if (!password_verify($currentPassword, $hashedPassword)) {
        alert("error", "", "Error",'Current password is incorrect.', "close");
    }

    // Check if the new password matches the confirmation password
    if ($newPassword !== $confirmPassword) {
        alert("error","Error",'New password and confirmation password do not match.');
    }

    // Check if the new password meets the requirements
    if (strlen($newPassword) < 8 || !preg_match('/[a-z]/', $newPassword) || !preg_match('/[\d\s\W]/', $newPassword)) {
        alert("error","Error",'Password does not meet the requirements.');
    }

    // Hash the new password
    $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the password in the database
    $stmt = $con->prepare("UPDATE admin_cred SET admin_pass = ? WHERE id = ?");
    
    // Check if prepare() was successful
    if ($stmt === false) {
        alert("error","Error",'Prepare failed: ' . htmlspecialchars($con->error));
    }
    
    $stmt->bind_param("si", $newHashedPassword, $admin_id);
    if ($stmt->execute()) {
        alert("success","Success",'Password changed successfully!');
    } else {
        alert("error","Error",'Failed to update password.');
    }
        }
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

?>

<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['form_type'])) {
        $formType = $_POST['form_type'];
        
        // Password Change Form
        if ($formType === 'profile_update') {
    // Sanitize input
    $adminName = filter_input(INPUT_POST, 'admin_name', FILTER_SANITIZE_STRING);
    $adminUsername = filter_input(INPUT_POST, 'admin_username', FILTER_SANITIZE_STRING);
    $adminEmail = filter_input(INPUT_POST, 'admin_email', FILTER_SANITIZE_EMAIL);
    $adminCommitee = filter_input(INPUT_POST, 'admin_commitee', FILTER_SANITIZE_STRING);
    $adminPosition = filter_input(INPUT_POST, 'admin_position', FILTER_SANITIZE_STRING);
    $adminNumber = filter_input(INPUT_POST, 'admin_number', FILTER_SANITIZE_NUMBER_INT);

    // Validate required fields
    $errors = [];

    if (empty($adminName)) {
        $errors[] = "Admin name is required.";
    }

    if (empty($adminUsername)) {
        $errors[] = "Admin username is required.";
    }

    if (empty($adminEmail) || !filter_var($adminEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid admin email is required.";
    }

    if (empty($adminCommitee)) {
        $errors[] = "Admin committee is required.";
    }

    if (empty($adminPosition)) {
        $errors[] = "Admin position is required.";
    }

    if (empty($adminNumber)) {
        $errors[] = "Admin number is required.";
    }

    if (!empty($errors)) {
        // Display validation errors
        foreach ($errors as $error) {
            alert("error", "", "Validation Error", $error,"close");
        }
    } else {
        alert("sucsess", "", "Sucsess", "hi","close");
    }
    }
}
}

$currentPage = 'edit_account';
?>


<!DOCTYPE html>


<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact ">


<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Edit Account</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="admin/assets/img/logos/x-art.png" />

    <!-- Base -->
    <base href="https://tedxmanaratalfaroukschool.com/">
    <link rel="stylesheet" href="admin/css/style.css">
    <link rel="stylesheet" href="admin/css/style-profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Font Awesome CSS -->

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
    <link rel="stylesheet" href="admin/assets/vendor/css/core.css" />
    <link rel="stylesheet" href="admin/assets/vendor/css/theme-default.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="admin/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="admin/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="admin/assets/vendor/libs/@form-validation/form-validation.css" />
    <link rel="stylesheet" href="admin/assets/vendor/libs/animate-css/animate.css" />
    <link rel="stylesheet" href="admin/assets/vendor/libs/sweetalert2/sweetalert2.css" />

    <!-- Page CSS -->


    <!-- Helpers -->
    <script src="admin/assets/vendor/js/helpers.js"></script>
    <script src="admin/assets/js/config.js"></script>

</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">
        

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
                            <div class="col-md-12">

                                <div class="card mb-6">
                                    <!-- Account -->
                                    <form id="formAccountSettings" method="POST" enctype="multipart/form-data">
                                        <div class="card-body">
                                            <div
                                                class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
                                                <img src="admin/Profile/images/<?php echo !empty($adminPic) ? $adminPic : 'default-pic.jpg'; ?>"
                                                    alt="user-avatar" class="d-block w-px-100 h-px-100 rounded"
                                                    id="uploadedAvatar" />
                                                <div class="button-wrapper">
                                                    <button for="upload" class="btn btn-primary me-3 mb-4" tabindex="0"
                                                        disabled>
                                                        <span class="d-none d-sm-block">Upload new photo</span>
                                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                                        <input type="file" id="upload" name="admin_pic"
                                                            class="account-file-input" hidden
                                                            accept="image/png, image/jpeg, image/jpg" />
                                                    </button>
                                                    <div>Allowed JPG, JPEG or PNG. Max size of 1MB</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-4">
                                            <form id="formAccountSettings" method="POST">
                                                <input type="hidden" name="form_type" value="profile_update">
                                                <div class="row g-6">
                                                    <div class="col-md-6">
                                                        <label for="admin_name" class="form-label">Admin Name</label>
                                                        <input class="form-control" type="text" id="admin_name"
                                                            name="admin_name"
                                                            value="<?php echo htmlspecialchars($adminName); ?>"
                                                            autofocus required />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="admin_username" class="form-label">Username</label>
                                                        <input class="form-control" type="text" name="admin_username"
                                                            id="admin_username"
                                                            value="<?php echo htmlspecialchars($adminUsername); ?>"
                                                            required />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="admin_email" class="form-label">E-mail</label>
                                                        <input class="form-control" type="text" id="email"
                                                            name="admin_email"
                                                            value="<?php echo htmlspecialchars($adminEmail); ?>"
                                                            placeholder="john.doe@example.com" required />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="phoneNumber">Phone Number</label>
                                                        <div class="input-group input-group-merge">
                                                            <span class="input-group-text">EG (+20)</span>
                                                            <input type="text" id="phoneNumber" name="admin_number"
                                                                value="<?php echo htmlspecialchars($adminNumber); ?>"
                                                                class="form-control" placeholder="1234567890" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="admin_commitee">Commetie</label>
                                                        <div class="input-group input-group-merge">
                                                            <select name="admin_commitee" id="admin_committee"
                                                                class="form-control">
                                                                <option value="Coaching"
                                                                    <?php echo $adminCommitee == 'Coaching' ? 'selected' : ''; ?>>
                                                                    Coaching</option>
                                                                <option value="Designs"
                                                                    <?php echo $adminCommitee == 'Designs' ? 'selected' : ''; ?>>
                                                                    Designs</option>
                                                                <option value="Logistics"
                                                                    <?php echo $adminCommitee == 'Logistics' ? 'selected' : ''; ?>>
                                                                    Logistics</option>
                                                                <option value="Human Resources (HR)"
                                                                    <?php echo $adminCommitee == 'Human Resources (HR)' ? 'selected' : ''; ?>>
                                                                    Human Resources (HR)</option>
                                                                <option value="Marketing"
                                                                    <?php echo $adminCommitee == 'Marketing' ? 'selected' : ''; ?>>
                                                                    Marketing</option>
                                                                <option value="Information Technology (IT)"
                                                                    <?php echo $adminCommitee == 'Information Technology (IT)' ? 'selected' : ''; ?>>
                                                                    Information Technology (IT)</option>
                                                                <option value="Media"
                                                                    <?php echo $adminCommitee == 'Media' ? 'selected' : ''; ?>>
                                                                    Media</option>
                                                                <option value="Public Relations (PR)"
                                                                    <?php echo $adminCommitee == 'Public Relations (PR)' ? 'selected' : ''; ?>>
                                                                    Public Relations (PR)</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="admin_position">Position</label>
                                                        <div class="input-group input-group-merge">
                                                            <select name="admin_position" id="admin_position"
                                                                class="form-control">
                                                                <option value="Organizer"
                                                                    <?php echo $adminPosition == 'Organizer' ? 'selected' : ''; ?>>
                                                                    Organizer</option>
                                                                <option value="Operation"
                                                                    <?php echo $adminPosition == 'Operation' ? 'selected' : ''; ?>>
                                                                    Operation</option>
                                                                <option value="Head"
                                                                    <?php echo $adminPosition == 'Head' ? 'selected' : ''; ?>>
                                                                    Head</option>
                                                                <option value="Vice"
                                                                    <?php echo $adminPosition == 'Vice' ? 'selected' : ''; ?>>
                                                                    Vice</option>
                                                                <option value="Member"
                                                                    <?php echo $adminPosition == 'Member' ? 'selected' : ''; ?>>
                                                                    Member</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-6">
                                                    <button type="submit" class="btn btn-primary me-3">Save
                                                        changes</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /Account -->
                                </div>
                                <div class="card mb-6">
                                    <!-- Change Password -->
                                    <h5 class="card-header">Change Password</h5>
                                    <div class="card-body pt-1">
                                        <form id="formAccountSettings" method="POST"
                                            class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                                            <input type="hidden" name="form_type" value="password_change">
                                            <div class="row">
                                                <div
                                                    class="mb-6 col-md-6 form-password-toggle fv-plugins-icon-container">
                                                    <label class="form-label" for="currentPassword">Current
                                                        Password</label>
                                                    <div class="input-group input-group-merge has-validation">
                                                        <input class="form-control" type="password"
                                                            name="currentPassword" id="currentPassword"
                                                            placeholder="············">
                                                        <span class="input-group-text cursor-pointer"><i
                                                                class="bx bx-hide"></i></span>
                                                    </div>
                                                    <div
                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div
                                                    class="mb-6 col-md-6 form-password-toggle fv-plugins-icon-container">
                                                    <label class="form-label" for="newPassword">New Password</label>
                                                    <div class="input-group input-group-merge has-validation">
                                                        <input class="form-control" type="password" id="newPassword"
                                                            name="newPassword" placeholder="············">
                                                        <span class="input-group-text cursor-pointer"><i
                                                                class="bx bx-hide"></i></span>
                                                    </div>
                                                    <div
                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                    </div>
                                                </div>

                                                <div
                                                    class="mb-6 col-md-6 form-password-toggle fv-plugins-icon-container">
                                                    <label class="form-label" for="confirmPassword">Confirm New
                                                        Password</label>
                                                    <div class="input-group input-group-merge has-validation">
                                                        <input class="form-control" type="password"
                                                            name="confirmPassword" id="confirmPassword"
                                                            placeholder="············">
                                                        <span class="input-group-text cursor-pointer"><i
                                                                class="bx bx-hide"></i></span>
                                                    </div>
                                                    <div
                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 class="text-body">Password Requirements:</h6>
                                            <ul class="ps-4 mb-0">
                                                <li class="mb-4">Minimum 8 characters long - the more, the better</li>
                                                <li class="mb-4">At least one lowercase character</li>
                                                <li>At least one number, symbol, or whitespace character</li>
                                            </ul>
                                            <div class="mt-6">
                                                <button type="submit" class="btn btn-primary me-3">Save changes</button>
                                            </div>
                                            <input type="hidden">
                                        </form>
                                    </div>
                                    <!-- / Change Password -->
                                </div>
                                <div class="card">
                                    <h5 class="card-header">Delete Account</h5>
                                    <div class="card-body">
                                        <div class="mb-6 col-12 mb-0">
                                            <div class="alert alert-warning">
                                                <h5 class="alert-heading mb-1">Are you sure you want to delete your
                                                    account?</h5>
                                                <p class="mb-0">Once you delete your account, there is no going back.
                                                    Please be certain.</p>
                                            </div>
                                        </div>
                                        <form action="admin/Profile/DeleteAdminScript.php" id="formAccountDeactivation"
                                            method="POST">
                                            <div class="form-check my-8 ms-2">
                                                <input type="hidden" name="admin_id"
                                                    value=" <?php echo $adminId = $_SESSION['adminId']; ?> ">
                                                <input class="form-check-input" type="checkbox" name="accountActivation"
                                                    id="accountActivation" />
                                                <label class="form-check-label" for="accountActivation">I confirm my
                                                    account deactivation</label>
                                            </div>
                                            <button type="submit" class="btn btn-danger deactivate-account"
                                                id="deactivateButton" disabled>Deactivate Account</button>
                                        </form>
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
                <script src="admin/assets/vendor/libs/select2/select2.js"></script>
                <script src="admin/assets/vendor/libs/@form-validation/popular.js"></script>
                <script src="admin/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
                <script src="admin/assets/vendor/libs/@form-validation/auto-focus.js"></script>
                <script src="admin/assets/vendor/libs/cleavejs/cleave.js"></script>
                <script src="admin/assets/vendor/libs/cleavejs/cleave-phone.js"></script>
                <script src="admin/assets/vendor/libs/sweetalert2/sweetalert2.js"></script>

                <!-- Main JS -->
                <script src="admin/assets/js/main.js"></script>


                <!-- Page JS -->
                <script src="admin/assets/js/pages-account-settings-account.js"></script>

                <script>
                // Get the checkbox and the button
                const checkbox = document.getElementById('accountActivation');
                const deactivateButton = document.getElementById('deactivateButton');

                // Add an event listener to the checkbox
                checkbox.addEventListener('change', function() {
                    // Enable the button if the checkbox is checked, otherwise disable it
                    deactivateButton.disabled = !this.checked;
                });
                </script>

</body>

</html>