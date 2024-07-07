<?php 
$hname = 'localhost';
$uname = 'root';
$pass = '';
$db = 'tedx';

$conn = mysqli_connect($hname, $uname, $pass, $db);

if (!$conn) {
    echo "Connection Failed!!!";
}
?>
