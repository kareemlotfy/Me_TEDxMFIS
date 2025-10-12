

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../admin/assets/img/logos/x-art.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../admin/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../admin/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../admin/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page -->
    <link rel="stylesheet" href="../admin/assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="../admin/assets/vendor/js/helpers.js"></script>
    <script src="../admin/assets/js/config.js"></script>
    <!-- <link rel="stylesheet" href="style.css"> -->
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
                            <a href="#" class="app-brand-link gap-2">
                                <img src="../admin/assets/img/logos/TEDx_logo_place2_RGB_CS2_page-0001.jpg" alt="tedx logo"
                                    id="tedx_logo" style="
    width: auto;
    height: 70px;">
                            </a>
                        </div>
                        <!-- /Logo -->

                        <form id="myForm" class="mb-3"  method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" 
                                    class="form-control">
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        
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

    <script>
            // Get the fragment identifier (the part after the # symbol)
            const fragment = window.location.hash;

            // Remove the '#' symbol from the fragment
            const id = fragment.substring(1); // Remove the # symbol

            console.log(id); // This will output 'id123'
            console.log('qrpanel.php/#'+id);

            var dynamicAction = 'login.php/#'+id; // Replace with your dynamic value

            // Set the form's action attribute using JavaScript
            document.getElementById('myForm').action = dynamicAction;

</script>
</body>
</html>

