<script>
            // Get the fragment identifier (the part after the # symbol)
            const fragment = window.location.hash;

            // Remove the '#' symbol from the fragment
            const id = fragment.substring(1); // Remove the # symbol

            console.log(id); // This will output 'id123'
            console.log('qrpanel.php/#'+id);

</script>

<?php


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate the username and password (you should use secure methods, like hashing)
    // For simplicity, let's assume valid credentials are "admin" for both username and password
    if ($username == "qrpanel@159" && $password == "openeasy@159") {
        session_start();
        $_SESSION["authenticated"] = true;
        echo "
        <script>window.location.href='../qrpanel.php/#'+id;</script>
        ";
        exit();
    } else {
        echo "Invalid username or password";
    }
    
}
