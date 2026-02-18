<?php
/**
 * Speaker Management Processing Script v2.1
 * - Tracks published_date
 * - Prevents double-click issues
 * - No AI, No resizing
 */

session_start();
require_once("../../Misc/db_conn.php");
// require_once("../../Misc/functions.php");
// adminLogin();

date_default_timezone_set('Africa/Cairo');

define('MAX_FILE_SIZE', 5 * 1024 * 1024);
define('ALLOWED_TYPES', ['image/jpeg', 'image/png', 'image/jpg', 'image/webp']);
define('MAX_BIO_WORDS', 50);

/**
 * Process uploaded image (NO RESIZING)
 */
function processImage($file, $generation) {
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['error'] = "File upload error";
        return false;
    }
    
    if ($file['size'] > MAX_FILE_SIZE) {
        $_SESSION['error'] = "File exceeds 5MB limit";
        return false;
    }
    
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    
    if (!in_array($mimeType, ALLOWED_TYPES)) {
        $_SESSION['error'] = "Invalid file type";
        return false;
    }
    
    $uploadDir = "../../images/generation/" . $generation . "/";
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $uniqueName = uniqid('speaker_', true) . '.' . strtolower($extension);
    $targetPath = $uploadDir . $uniqueName;
    
    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        $_SESSION['error'] = "Failed to save image";
        return false;
    }
    
    return "images/generation/" . $generation . "/" . $uniqueName;
}

/**
 * Validate bio word count
 */
function validateBioWordCount($bio) {
    return str_word_count($bio) <= MAX_BIO_WORDS;
}

// ADD SPEAKER
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    
    if (empty($_POST['full_name']) || empty($_POST['job_title']) || empty($_POST['bio_raw']) || empty($_POST['generation'])) {
        $_SESSION['error'] = "All required fields must be filled";
        header("Location: add.php");
        exit;
    }
    
    if (!validateBioWordCount($_POST['bio_raw'])) {
        $_SESSION['error'] = "Biography must be 50 words or less";
        header("Location: add.php");
        exit;
    }
    
    if (!isset($_FILES['speaker_image']) || $_FILES['speaker_image']['error'] === UPLOAD_ERR_NO_FILE) {
        $_SESSION['error'] = "Speaker image is required";
        header("Location: add.php");
        exit;
    }
    
    $imagePath = processImage($_FILES['speaker_image'], intval($_POST['generation']));
    if (!$imagePath) {
        header("Location: add.php");
        exit;
    }
    
    $fullName = htmlspecialchars(trim($_POST['full_name']), ENT_QUOTES, 'UTF-8');
    $jobTitle = htmlspecialchars(trim($_POST['job_title']), ENT_QUOTES, 'UTF-8');
    $bioRaw = htmlspecialchars(trim($_POST['bio_raw']), ENT_QUOTES, 'UTF-8');
    $generation = intval($_POST['generation']);
    $displayOrder = intval($_POST['display_order'] ?? 0);
    $eventYear = intval($_POST['event_year'] ?? 2026);
    $status = in_array($_POST['status'], ['draft', 'published', 'archived']) ? $_POST['status'] : 'published';
    
    // Set published_date if status is published
    $publishedDate = ($status === 'published') ? date('Y-m-d H:i:s') : null;
    
    $facebook = !empty($_POST['facebook_url']) ? htmlspecialchars(trim($_POST['facebook_url']), ENT_QUOTES, 'UTF-8') : null;
    $linkedin = !empty($_POST['linkedin_url']) ? htmlspecialchars(trim($_POST['linkedin_url']), ENT_QUOTES, 'UTF-8') : null;
    $instagram = !empty($_POST['instagram_url']) ? htmlspecialchars(trim($_POST['instagram_url']), ENT_QUOTES, 'UTF-8') : null;
    $twitter = !empty($_POST['twitter_url']) ? htmlspecialchars(trim($_POST['twitter_url']), ENT_QUOTES, 'UTF-8') : null;
    
    $stmt = $con->prepare("INSERT INTO speakers (full_name, job_title, bio_raw, bio_processed, image_path, facebook_url, linkedin_url, instagram_url, twitter_url, event_year, generation, display_order, status, published_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssiisss", $fullName, $jobTitle, $bioRaw, $bioRaw, $imagePath, $facebook, $linkedin, $instagram, $twitter, $eventYear, $generation, $displayOrder, $status, $publishedDate);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Speaker added successfully!";
        header("Location: manage.php");
    } else {
        $_SESSION['error'] = "Database error";
        header("Location: add.php");
    }
    
    $stmt->close();
    exit;
}

// EDIT SPEAKER
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    
    $speakerId = intval($_POST['speaker_id']);
    
    if (empty($_POST['full_name']) || empty($_POST['job_title']) || empty($_POST['bio_raw'])) {
        $_SESSION['error'] = "All required fields must be filled";
        header("Location: edit.php?id=" . $speakerId);
        exit;
    }
    
    if (!validateBioWordCount($_POST['bio_raw'])) {
        $_SESSION['error'] = "Biography must be 50 words or less";
        header("Location: edit.php?id=" . $speakerId);
        exit;
    }
    
    // Get current speaker data
    $checkStmt = $con->prepare("SELECT status, published_date FROM speakers WHERE id = ?");
    $checkStmt->bind_param("i", $speakerId);
    $checkStmt->execute();
    $currentData = $checkStmt->get_result()->fetch_assoc();
    $checkStmt->close();
    
    $fullName = htmlspecialchars(trim($_POST['full_name']), ENT_QUOTES, 'UTF-8');
    $jobTitle = htmlspecialchars(trim($_POST['job_title']), ENT_QUOTES, 'UTF-8');
    $bioRaw = htmlspecialchars(trim($_POST['bio_raw']), ENT_QUOTES, 'UTF-8');
    $generation = intval($_POST['generation']);
    $displayOrder = intval($_POST['display_order'] ?? 0);
    $eventYear = intval($_POST['event_year'] ?? 2026);
    $status = in_array($_POST['status'], ['draft', 'published', 'archived']) ? $_POST['status'] : 'published';
    
    // Set published_date if transitioning to published for the first time
    $publishedDate = $currentData['published_date'];
    if ($status === 'published' && $currentData['status'] !== 'published' && $publishedDate === null) {
        $publishedDate = date('Y-m-d H:i:s');
    }
    
    $facebook = !empty($_POST['facebook_url']) ? htmlspecialchars(trim($_POST['facebook_url']), ENT_QUOTES, 'UTF-8') : null;
    $linkedin = !empty($_POST['linkedin_url']) ? htmlspecialchars(trim($_POST['linkedin_url']), ENT_QUOTES, 'UTF-8') : null;
    $instagram = !empty($_POST['instagram_url']) ? htmlspecialchars(trim($_POST['instagram_url']), ENT_QUOTES, 'UTF-8') : null;
    $twitter = !empty($_POST['twitter_url']) ? htmlspecialchars(trim($_POST['twitter_url']), ENT_QUOTES, 'UTF-8') : null;
    
    $imagePath = null;
    if (isset($_FILES['speaker_image']) && $_FILES['speaker_image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $imagePath = processImage($_FILES['speaker_image'], $generation);
        if (!$imagePath) {
            header("Location: edit.php?id=" . $speakerId);
            exit;
        }
        
        $stmt = $con->prepare("SELECT image_path FROM speakers WHERE id = ?");
        $stmt->bind_param("i", $speakerId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $oldImagePath = "../../" . $row['image_path'];
            if (file_exists($oldImagePath) && !str_contains($row['image_path'], 'mistryspeaker')) {
                unlink($oldImagePath);
            }
        }
        $stmt->close();
    }
    
    if ($imagePath) {
        $stmt = $con->prepare("UPDATE speakers SET full_name = ?, job_title = ?, bio_raw = ?, bio_processed = ?, image_path = ?, facebook_url = ?, linkedin_url = ?, instagram_url = ?, twitter_url = ?, event_year = ?, generation = ?, display_order = ?, status = ?, published_date = ? WHERE id = ?");
        $stmt->bind_param("sssssssssiiissi", $fullName, $jobTitle, $bioRaw, $bioRaw, $imagePath, $facebook, $linkedin, $instagram, $twitter, $eventYear, $generation, $displayOrder, $status, $publishedDate, $speakerId);
    } else {
        $stmt = $con->prepare("UPDATE speakers SET full_name = ?, job_title = ?, bio_raw = ?, bio_processed = ?, facebook_url = ?, linkedin_url = ?, instagram_url = ?, twitter_url = ?, event_year = ?, generation = ?, display_order = ?, status = ?, published_date = ? WHERE id = ?");
        $stmt->bind_param("ssssssssiisssi", $fullName, $jobTitle, $bioRaw, $bioRaw, $facebook, $linkedin, $instagram, $twitter, $eventYear, $generation, $displayOrder, $status, $publishedDate, $speakerId);
    }
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Speaker updated successfully!";
        header("Location: manage.php");
    } else {
        $_SESSION['error'] = "Database error";
        header("Location: edit.php?id=" . $speakerId);
    }
    
    $stmt->close();
    exit;
}

// DELETE SPEAKER
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $speakerId = intval($_GET['id']);
    
    $stmt = $con->prepare("SELECT image_path FROM speakers WHERE id = ?");
    $stmt->bind_param("i", $speakerId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $imagePath = "../../" . $row['image_path'];
        
        $deleteStmt = $con->prepare("DELETE FROM speakers WHERE id = ?");
        $deleteStmt->bind_param("i", $speakerId);
        
        if ($deleteStmt->execute()) {
            if (file_exists($imagePath) && !str_contains($row['image_path'], 'mistryspeaker')) {
                unlink($imagePath);
            }
            $_SESSION['success'] = "Speaker deleted successfully!";
        } else {
            $_SESSION['error'] = "Failed to delete speaker";
        }
        
        $deleteStmt->close();
    }
    
    $stmt->close();
    header("Location: manage.php");
    exit;
}

// STATUS UPDATE (with double-click prevention)
if (isset($_GET['action']) && in_array($_GET['action'], ['publish', 'draft', 'archive']) && isset($_GET['id'])) {
    $speakerId = intval($_GET['id']);
    $action = $_GET['action'];
    
    // Get current status
    $checkStmt = $con->prepare("SELECT status, published_date FROM speakers WHERE id = ?");
    $checkStmt->bind_param("i", $speakerId);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    
    if ($result->num_rows === 0) {
        $_SESSION['error'] = "Speaker not found";
        $checkStmt->close();
        header("Location: manage.php");
        exit;
    }
    
    $current = $result->fetch_assoc();
    $checkStmt->close();
    
    // Determine new status
    $newStatus = ($action === 'archive') ? 'archived' : ($action === 'publish' ? 'published' : 'draft');
    
    // Prevent double-click: if already in target status, just redirect
    if ($current['status'] === $newStatus) {
        $_SESSION['success'] = "Speaker is already " . $newStatus;
        header("Location: manage.php");
        exit;
    }
    
    // Set published_date if publishing for the first time
    $publishedDate = $current['published_date'];
    if ($newStatus === 'published' && $publishedDate === null) {
        $publishedDate = date('Y-m-d H:i:s');
    }
    
    $stmt = $con->prepare("UPDATE speakers SET status = ?, published_date = ? WHERE id = ?");
    $stmt->bind_param("ssi", $newStatus, $publishedDate, $speakerId);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Speaker status updated to " . $newStatus . "!";
    } else {
        $_SESSION['error'] = "Failed to update status: " . $stmt->error;
    }
    
    $stmt->close();
    $con->close();
    
    // Clear any output buffers and redirect
    while (ob_get_level()) {
        ob_end_clean();
    }
    header("Location: manage.php");
    exit;
}

$_SESSION['error'] = "Invalid request";
header("Location: manage.php");
exit;
