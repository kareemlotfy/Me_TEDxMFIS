<?php 
include("../Misc/db_conn.php");
require("../Misc/functions.php");

adminLogin();

$adminId = $_SESSION['adminId']; 
$pageId = 9; 
checkAdminPermission($con, $adminId, $pageId);

$sql = "SELECT * FROM storage ORDER BY created_at DESC";
$result = mysqli_query($con, $sql);

checkAdminPermission($con, $adminId, $pageId);
?>

<?php

$adminDetails = getAdminDetails($con, $adminId);

if ($adminDetails) {
    $adminName = $adminDetails['admin_name'];
    $adminCommitee = $adminDetails['admin_commitee'];
    $adminPic = $adminDetails['admin_pic'];
    $adminPosition = $adminDetails['admin_position'];
    $adminEmail = $adminDetails['admin_email'];
    $adminUsername = $adminDetails['admin_username'];
} else {
    echo "Admin details not found.";
}



// افترض إنك حددت البيانات من الـ POST
$name = $_POST['name'];
$category = $_POST['category'];
$quantity = $_POST['quantity'];
$location = $_POST['location'];
$description = $_POST['description'];
$added_by = $adminDetails['admin_name'];

$image_path = '';
if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
    $targetDir = "../../images/Storage/";

    $image_path = basename($_FILES["image"]["name"]);

    move_uploaded_file($_FILES["image"]["tmp_name"], $targetDir . $image_path);
}

// إضافة البيانات للـ database
$stmt = $con->prepare("INSERT INTO storage (name, category, quantity, storage_location, description, added_by, image_path, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
$stmt->bind_param("ssissss", $name, $category, $quantity, $location, $description, $added_by, $image_path);
$stmt->execute();
$stmt->close();

// إعادة توجيه للصفحة الرئيسية بعد الإضافة
header("Location: index.php");
exit;
?>
