<?php
include("../Misc/db_conn.php");

date_default_timezone_set('Africa/Cairo');

$threshold = time() - 120;

$query = "SELECT id, last_activity FROM admin_cred";
$result = $con->query($query);

$admins = [];

while ($row = $result->fetch_assoc()) {
    $last = strtotime($row['last_activity']);
    $admins[] = [
        "id" => $row['id'],
        "online" => ($last >= $threshold)
    ];
}

echo json_encode($admins);
?>