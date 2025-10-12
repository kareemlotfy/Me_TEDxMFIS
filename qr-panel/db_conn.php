<?php 

$hname = 'localhost';   // e.g., 'localhost' or 'mysql.hostingprovider.com'
$uname = 'u654105294_tedxmfisun';
$pass = 'TEDxMFIS@DB@Password1';
$db = 'u654105294_tedxmfis';

$conn = mysqli_connect($hname, $uname, $pass, $db);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

?>
