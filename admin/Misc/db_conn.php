<?php 

$hname = 'localhost';
$uname = 'root';
$pass = '';
$db = 'tedx';

$con = mysqli_connect($hname, $uname, $pass, $db);

if (!$con) {
    echo "Connection Failed!!!";
}

?>