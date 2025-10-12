<?php 

$hname = 'localhost';   // e.g., 'localhost' or 'mysql.hostingprovider.com'
// $hname = 'srv1687.hstgr.io';   // e.g., 'localhost' or 'mysql.hostingprovider.com'
$uname = 'u654105294_tedxmfisun';//u654105294_tedxmfisun
$pass = 'TEDxMFIS@DB@Password1';//TEDxMFIS@DB@Password1
$db = 'u654105294_tedxmfis';//u654105294_tedxmfis

$con = mysqli_connect($hname, $uname, $pass, $db);

if (!$con) {
    die("Connection Failed: " . mysqli_connect_error());
}

?>
