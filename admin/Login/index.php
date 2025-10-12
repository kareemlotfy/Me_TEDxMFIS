<?php
// Set secure session cookie parameters before starting the session
ini_set('session.cookie_secure', '1'); // Ensure cookies are sent over HTTPS
ini_set('session.cookie_httponly', '1'); // Prevent JavaScript access to session cookies
ini_set('session.cookie_samesite', 'Strict'); // Mitigate CSRF attacks

session_start();

require('../Misc/db_conn.php');
require('../Misc/functions.php');

// Redirect logged-in admin to the dashboard
if (isset($_SESSION["adminLogin"]) && $_SESSION["adminLogin"] === true) {
    header("Location: ../Dashboard/dashboard.php");
    exit();
}

// Generate CSRF token if not already set
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Handle form submission
if (isset($_POST["submit"])) {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        alert("error", "","Login Failed", "CSRF token validation failed", "close");
        exit();
    }

    $frm_data = filteration($_POST);

    // Prepare and execute query to fetch admin credentials
    $query = "SELECT * FROM `admin_cred` WHERE `admin_username` = ?";
    $values = [$frm_data["admin_username"]];
    $res = select($query, $values, "s");

    if ($res->num_rows === 1) {
        $row = mysqli_fetch_assoc($res);

        // Verify password
        if (password_verify($frm_data["admin_pass"], $row["admin_pass"])) {
            session_regenerate_id(true); // Prevent session fixation
            $_SESSION["adminLogin"] = true;
            $_SESSION["adminId"] = $row["id"];
            header("Location: ../Dashboard/dashboard.php");
            exit();
        } else {
            alert("error", "", "Login Failed", "Invalid username or password. Please try again.", "close");
        }
    } else {
        alert("error", "", "Login Failed", "Invalid username or password. Please try again.", "close");
    }

    // Log failed login attempt
    error_log('Failed login attempt for username: ' . $frm_data["admin_username"]);
}

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login</title>
    <!--Base -->
    <base href="https://tedxmanaratalfaroukschool.com/">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="admin/assets/img/logos/x-art.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="admin/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="admin/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="admin/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />


    <!-- Page -->
    <link rel="stylesheet" href="admin/assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="admin/assets/vendor/js/helpers.js"></script>
    <script src="admin/assets/js/config.js"></script>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <img src="admin/assets/img/logos/TEDx_logo_place2_RGB_CS2_page-0001.jpg" alt="tedx logo"
                                    id="tedx_logo" style="
    width: auto;
    height: 70px;">
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Welcome to TEDxManaratAlfaroukSchool! 👋</h4>
                        <p class="mb-4">Please sign-in to your account and start the adventure</p>

                        <form id="formAuthentication" class="mb-3" action="" method="POST">
                            <input type="hidden" name="csrf_token"
                                value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="admin_username" id="username" autocomplete="off"
                                    class="form-control">
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="admin_pass"
                                        autocomplete="off"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <input class="btn btn-primary d-grid w-100 btn1" type="submit" name="submit"
                                    value="Login"></input>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- / Content -->


    <!-- Core JS -->
    <script src="admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="admin/assets/vendor/js/bootstrap.js"></script>
    <script src="admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script>
        function closePopup() {
            let popup = document.getElementById("popup");
            let email = document.getElementById("email");
            let password = document.getElementById("password");
            popup.classList.add("close_popup");
            document.body.classList.remove("alertCalled");
            email.value = "";
            password.value = "";
        }
    </script>

    <script src="admin/assets/vendor/js/menu.js"></script>
    <!-- Main JS -->
    <script src="admin/assets/js/main.js"></script>

    <!-- Page JS -->
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>