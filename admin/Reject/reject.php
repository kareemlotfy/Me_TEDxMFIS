<?php
include("../Misc/db_conn.php");
require("../Misc/functions.php");

adminLogin();

if (isset($_GET['id'])) {
    $rowId = intval($_GET['id']);

    $sql = "UPDATE user_cred SET isaccepted = 'reject' WHERE id = $rowId";

    if (mysqli_query($con, $sql)) {
        header("Location: ../Tickets/single.php?userFilter=all");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
} else {
    echo "Invalid request.";
}

mysqli_close($con);
?>