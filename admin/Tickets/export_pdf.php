<?php
require("../Misc/db_conn.php");

require("../Misc/functions.php");

adminLogin();

// Function to sanitize and validate user input
function sanitize_input($data, $con) {
    return mysqli_real_escape_string($con, htmlspecialchars($data, ENT_QUOTES, 'UTF-8'));
}

// Get filter and search criteria from POST request
$userFilter = isset($_POST['userFilter']) ? sanitize_input($_POST['userFilter'], $con) : 'all';
$searchPhone = isset($_POST['searchPhone']) ? sanitize_input($_POST['searchPhone'], $con) : '';
$searchName = isset($_POST['searchName']) ? sanitize_input($_POST['searchName'], $con) : '';

// Construct the filter condition based on the input
$filter = '';
$conditions = [];
$parameters = [];

// Handle user filter status
if ($userFilter == 'paid') {
    $conditions[] = "isaccepted = 'yes'";
} elseif ($userFilter == 'unpaid') {
    $conditions[] = "isaccepted = 'no'";
} elseif ($userFilter == 'reject') {
    $conditions[] = "isaccepted = 'reject'";
}

// Handle search by phone
if (!empty($searchPhone)) {
    $conditions[] = "phone LIKE ?";
    $parameters[] = "%$searchPhone%";
}

// Handle search by name
if (!empty($searchName)) {
    $conditions[] = "(name LIKE ?)";
    $parameters[] = "%$searchName%";
}

// Combine all conditions into a WHERE clause
if (!empty($conditions)) {
    $filter = "WHERE " . implode(" AND ", $conditions);
}

// Fetch the filtered data using prepared statements
$sql = "SELECT * FROM user_cred $filter";
$stmt = $con->prepare($sql);

// Bind parameters dynamically
if (!empty($parameters)) {
    $types = str_repeat('s', count($parameters)); // 's' for each string parameter
    $stmt->bind_param($types, ...$parameters);
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
while ($row = $result->fetch_assoc()) {
    $name = htmlspecialchars($row["first_name"] . " " . $row["last_name"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($row["email"], ENT_QUOTES, 'UTF-8');
    $phone = htmlspecialchars($row["phone"], ENT_QUOTES, 'UTF-8');
    
    // Determine status
    if ($row["isaccepted"] == 'no') {
        $status = 'Unpaid';
    } elseif ($row["isaccepted"] == 'yes') {
        $status = 'Paid';
    } else {
        $status = 'Rejected';
    }
    
    // Output each row
    $pdf->Cell($widths[0], 10, $name, 1);
    $pdf->Cell($widths[1], 10, $email, 1);
    $pdf->Cell($widths[2], 10, $phone, 1);
    $pdf->Cell($widths[3], 10, $status, 1);
    $pdf->Ln();
}

$pdf->Output();
?>
