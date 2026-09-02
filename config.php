<?php
// config.php

$host = $_SERVER['HTTP_HOST'] ?? '';
$isLocal = in_array($host, ['localhost',]);

if ($isLocal) {
    define('BASE_URL', 'http://localhost/TEDxManaratAlfaroukSchool/');
} else {
    define('BASE_URL', 'https://tedxmanaratalfaroukschool.com/');
}
?>
