<?php
require_once('../Misc/security_middleware.php');
initSecurityMiddleware();

// Connect to MySQL
$mysqli = new mysqli("localhost", "root", "", "tedx");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch job listings
$sql = "SELECT id, title FROM jobs";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Output job listings
    while($row = $result->fetch_assoc()) {
        echo "<a href='jobs.php?id=".$row["id"]."'>".$row["title"]."</a><br>";
    }
} else {
    header("Location:../error/error.php");
}

// Close MySQL connection
$mysqli->close();
?>
