<?php 

require('../Misc/db_conn.php');
require('../Misc/functions.php');

session_start();
if ((isset($_SESSION["adminLogin"]) && $_SESSION["adminLogin"] == true)) {
    header("Location:dashboard.php");
    exit();
}

if(isset($_POST["submit"])) {
    $frm_data = filteration($_POST);

    $query = "SELECT * FROM `admin_cred` WHERE `admin_name`=?";
    $values = [$frm_data["admin_name"]];
    
    $res = select($query, $values, "s");
    if ($res -> num_rows == 1) {
        $row = mysqli_fetch_assoc($res);

        if (password_verify($frm_data["admin_pass"], $row["admin_pass"])) {
            session_regenerate_id(true); // Prevent session fixation
            $_SESSION["adminLogin"] = true;
            $_SESSION["adminId"] = $row["id"];
            $_SESSION["adminName"] = $row["admin_name"];
            header("Location:../Dashboard/dashboard.php");
            exit();
        } else {
            alert("error", "Login Failed", "Invalid username or password. Please try again.");
            addBodyClassAndStyle();
        }
    } else {
        alert("error", "Login Failed", "Invalid username or password. Please try again.");
        addBodyClassAndStyle();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/TEDxManaratAlfaroukSchool/">
    <link rel="stylesheet" href="admin/css/style.css">
    <link rel="shortcut icon" href="admin/images/x-art.png">
    <link rel="shortcut icon" href="admin/images/x-art.png" type="image/x-icon">
    <title>Login</title>
</head>
<body>
    <div class="container" id="login_container">
        <div class="box form-box">
            <header>Login</header>
            <form action="" method="POST">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="admin_name" id="email" autocomplete="off">
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="admin_pass" id="password" autocomplete="off">
                </div>

                <div class="field">
                    <input type="submit" class="btn1" name="submit" value="Login">
                </div>
            </form>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
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
</body>
</html>
