<?php
require('fpdf186/fpdf.php');
include("../Misc/db_conn.php");

// Suppress output buffering to prevent any initial output
ob_start();

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Exported Table', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    function Table($header, $data) {
        // Calculate maximum width needed for each column
        $maxWidths = [];
        foreach ($header as $key => $col) {
            $maxWidths[$key] = $this->GetStringWidth($col) + 6;
        }
        foreach ($data as $row) {
            foreach ($row as $key => $col) {
                $maxWidths[$key] = max($maxWidths[$key], $this->GetStringWidth($col) + 6);
            }
        }

        // Total available width (excluding margins)
        $pageWidth = $this->GetPageWidth() - $this->lMargin - $this->rMargin;
        $totalWidth = array_sum($maxWidths);

        // Adjust widths proportionally if they exceed the page width
        if ($totalWidth > $pageWidth) {
            $scaleFactor = $pageWidth / $totalWidth;
            foreach ($maxWidths as &$width) {
                $width *= $scaleFactor;
            }
        }

        // Set the header
        $this->SetFont('Arial', 'B', 12);
        foreach ($header as $key => $col) {
            $this->Cell($maxWidths[$key], 7, $col, 1);
        }
        $this->Ln();

        // Set the data
        $this->SetFont('Arial', '', 12);
        foreach ($data as $row) {
            foreach ($row as $key => $col) {
                $this->Cell($maxWidths[$key], 6, $col, 1);
            }
            $this->Ln();
        }
    }
}

// Fetch data from the database
$sql = "SELECT first_name, last_name, email, phone, isaccepted FROM user_cred WHERE isaccepted = 'yes'";
$result = $con->query($sql);

if (!$result) {
    die("Invalid query: " . $con->connect_error);
}

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [$row["first_name"], $row["last_name"], $row["email"], $row["phone"], $row["isaccepted"]];
}

$pdf = new PDF();
$pdf->AddPage();

$header = ['First Name', 'Last Name', 'Email', 'Phone', 'Status'];
$pdf->Table($header, $data);

// Clear the output buffer to prevent errors
ob_end_clean();
$pdf->Output('D', 'table.pdf');
?>
