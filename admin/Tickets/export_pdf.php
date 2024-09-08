<?php
require("../Misc/db_conn.php");

// Function to sanitize and validate user input
function sanitize_input($data, $con) {
    return mysqli_real_escape_string($con, htmlspecialchars($data, ENT_QUOTES, 'UTF-8'));
}

// Get filter and search criteria from POST request
$userFilter = isset($_POST['userFilter']) ? sanitize_input($_POST['userFilter'], $con) : 'all';
$searchPhone = isset($_POST['searchPhone']) ? sanitize_input($_POST['searchPhone'], $con) : '';

// Construct the filter condition based on the input
$filter = '';
if ($userFilter == 'paid') {
    $filter = "WHERE isaccepted = 'yes'";
} elseif ($userFilter == 'unpaid') {
    $filter = "WHERE isaccepted = 'no'";
}
elseif ($userFilter == 'reject') {
    $filter = "WHERE isaccepted = 'reject'";
}

if (!empty($searchPhone)) {
    $filter .= $filter ? " AND phone LIKE ?" : "WHERE phone LIKE ?";
}

// Fetch the filtered data using prepared statements
$sql = "SELECT * FROM user_cred $filter";
$stmt = $con->prepare($sql);

if (!empty($searchPhone)) {
    $searchTerm = "%$searchPhone%";
    $stmt->bind_param("s", $searchTerm);
}

$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Invalid query: " . htmlspecialchars($con->error, ENT_QUOTES, 'UTF-8'));
}

// Export to PDF logic
require('fpdf186/fpdf.php');

class PDF extends FPDF
{
    // Add a header
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'User Information', 0, 1, 'C');
        $this->Ln(10);
    }

    // Add a footer
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10); // Smaller font size

// Column headers
$header = ['Name', 'Email', 'Phone', 'Status'];
$widths = [70, 80, 23, 17]; // Adjusted widths to give more space to name and email columns

foreach ($header as $key => $col) {
    $pdf->Cell($widths[$key], 10, $col, 1);
}
$pdf->Ln();

$pdf->SetFont('Arial', '', 10); // Smaller font size

// Data rows
// Data rows
while ($row = $result->fetch_assoc()) {
    $name = htmlspecialchars($row["first_name"] . " " . $row["last_name"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($row["email"], ENT_QUOTES, 'UTF-8');
    $phone = htmlspecialchars($row["phone"], ENT_QUOTES, 'UTF-8');
    if ($row["isaccepted"] == 'no') {
        $status = 'Unpaid';
    } elseif ($row["isaccepted"] == 'yes') {
        $status = 'Paid';
    } else {
        $status = 'Rejected';
    }
    $pdf->Cell($widths[0], 10, $name, 1);
    $pdf->Cell($widths[1], 10, $email, 1);
    $pdf->Cell($widths[2], 10, $phone, 1);
    $pdf->Cell($widths[3], 10, $status, 1);
    $pdf->Ln();
}

$pdf->Output();
?>
