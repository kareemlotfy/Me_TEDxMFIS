<?php
// Include database connection and required functions
include("../Misc/db_conn.php");
require("../Misc/functions.php");

// Set the header for JSON response
header("Content-Type: application/json");

// Check the connection
if ($con->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $con->connect_error]));
}

// Combine related queries into a single query using conditional aggregation
$query = "
    SELECT 
        SUM(isaccepted = 'yes') AS paid_count,
        SUM(isaccepted = 'no') AS unpaid_count,
        SUM(isaccepted = 'reject') AS rejected_count,
        SUM(gender = 'Male') AS male_count,
        SUM(gender = 'Female') AS female_count,
        SUM(age >= 18) AS above_18_count,
        SUM(age < 18) AS under_18_count,
        SUM(st_mfis = 'yes') AS mfis_count,
        SUM(st_mfis = 'no') AS not_mfis_count,
        SUM(login_type = 'Student In School') AS student_in_school_count,
        SUM(login_type = 'Student In College') AS student_in_college_count,
        SUM(login_type = 'Parent') AS parent_count,
        SUM(enter_status = 'yes') AS entered_count,
        SUM(enter_status = 'no') AS not_entered_count,
        SUM(dinner_status = 'yes') AS used_dinner_count,
        SUM(dinner_status = 'no') AS not_used_dinner_count,
        SUM(breakfast_status = 'yes') AS used_breakfast_count,
        SUM(breakfast_status = 'no') AS not_used_breakfast_count,
        SUM(grade = 'Grade 7') AS grade_7_count,
        SUM(grade = 'Grade 8') AS grade_8_count,
        SUM(grade = 'Grade 9') AS grade_9_count,
        SUM(grade = 'Grade 10') AS grade_10_count,
        SUM(grade = 'Grade 11') AS grade_11_count,
        SUM(grade = 'Grade 12') AS grade_12_count
    FROM user_cred
";

$result = $con->query($query);

if ($result) {
    $response = $result->fetch_assoc();
    // Convert numeric values to integers
    $response = array_map('intval', $response);
} else {
    $response = ['error' => 'Failed to execute query: ' . $con->error];
}

// Return the response as JSON
echo json_encode($response);

// Close the database connection
$con->close();
?>
