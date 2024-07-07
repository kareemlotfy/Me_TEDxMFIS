<?php 

require("../Misc/functions.php");
session_start();
session_destroy();
header("Location:index.php");
exit();
?>