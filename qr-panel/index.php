

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <form  id="myForm" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Login</button>
        </form>
    </div>

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

