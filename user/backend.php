<?php
// Simulate form status (replace this with your actual logic)
$formStatus = file_get_contents('form_status.txt'); // Get form status from a text file

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-Type: application/json'); // Set the header to indicate JSON content
    echo json_encode(['formOpen' => $formStatus]); // Output JSON data
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    file_put_contents('form_status.txt', $data['isOpen']); // Update form status in the text file
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
}
?>
