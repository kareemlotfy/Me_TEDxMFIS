<?php
require_once('../Misc/security_middleware.php');
setCorsHeaders();
setSecurityHeaders();

// Connect to MySQL
$mysqli = new mysqli("localhost", "root", "", "tedx");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch job details
$id = $_GET['id'];
$sql = "SELECT id, title, description1, description2 FROM jobs WHERE id=$id";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Output job details
    $row = $result->fetch_assoc();
    echo "<h2>".$row["title"]."</h2>";
    echo "<p>".$row["description1"]."</p>";
    echo '<a href="apply_form.php?id=' . $row["id"] .'">Apply</a>';
    echo "<p>".$row["description2"]."</p>";
} else {
    header("Location: ../error/error.php");
}

// Close MySQL connection
$mysqli->close();
?>