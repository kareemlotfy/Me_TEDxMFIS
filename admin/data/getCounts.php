<?php 
                                            //DASHBOARD Counting Data SYSTEM //
include("../Misc/db_conn.php");
require("../Misc/functions.php");

// JSON data (VERY IMPORTANT)
header("Content-Type: application/json");

// database queries
$queries = [
    'paid_count' => "SELECT COUNT(*) as paid_count FROM user_cred WHERE isaccepted = 'yes'",
    'unpaid_count' => "SELECT COUNT(*) as unpaid_count FROM user_cred WHERE isaccepted = 'no'",
    'male_count' => "SELECT COUNT(*) as male_count FROM user_cred WHERE gender = 'Male'",
    'female_count' => "SELECT COUNT(*) as female_count FROM user_cred WHERE gender = 'Female'",
    'above_18_count' => "SELECT COUNT(*) as above_18_count FROM user_cred WHERE age > 18",
    'under_18_count' => "SELECT COUNT(*) as under_18_count FROM user_cred WHERE age <= 18",
    'mfis_count' => "SELECT COUNT(*) as mfis_count FROM user_cred WHERE st_mfis = 'yes'",
    'not_mfis_count' => "SELECT COUNT(*) as not_mfis_count FROM user_cred WHERE st_mfis = 'no'",
    'student_in_school_count' => "SELECT COUNT(*) as student_in_school_count FROM user_cred WHERE login_type = 'Student In School'",
    'student_in_college_count' => "SELECT COUNT(*) as student_in_college_count FROM user_cred WHERE login_type = 'Student In College'",
    'parent_count' => "SELECT COUNT(*) as parent_count FROM user_cred WHERE login_type = 'Parent'",
    'entered_count' => "SELECT COUNT(*) as entered_count FROM user_cred WHERE enter_status = 'yes'",
    'not_entered_count' => "SELECT COUNT(*) as not_entered_count FROM user_cred WHERE enter_status = 'no'",
    'used_dinner_count' => "SELECT COUNT(*) as used_dinner_count FROM user_cred WHERE dinner_status = 'yes'",
    'not_used_dinner_count' => "SELECT COUNT(*) as not_used_dinner_count FROM user_cred WHERE dinner_status = 'no'",
];

$response = [];

foreach ($queries as $key => $query) {
    $result = $con->query($query);
    if ($result) {
        $row = $result->fetch_assoc();
        $response[$key] = $row[array_keys($row)[0]];
    } else {
        $response[$key] = 0;
    }
}

echo json_encode($response);

$con->close();
?>
