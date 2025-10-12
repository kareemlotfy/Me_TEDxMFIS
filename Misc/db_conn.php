<?php 

$hname = 'localhost';   // e.g., 'localhost' or 'mysql.hostingprovider.com'
$uname = 'root'; //u654105294_tedxmfisun
$pass = ''; //TEDxMFIS@DB@Password1
$db = 'tedx'; //u654105294_tedxmfis

$con = mysqli_connect($hname, $uname, $pass, $db);

if (!$con) {
    die("Connection Failed: " . mysqli_connect_error());
}

?>
