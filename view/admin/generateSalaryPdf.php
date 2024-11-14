<?php
require_once '../../fpdf186/fpdf.php';
include '../../database/db.php';

$month = $_POST['month'];
$year = $_POST['year'];

// Initialize FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 13);

$pdf->Cell(70, 20, "Salary Report for " . date("F", mktime(0, 0, 0, $month, 10)) . " $year", 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);

// Table headers
$pdf->Cell(35, 10, "Employee Name", 1);
$pdf->Cell(25, 10, "Position", 1);
$pdf->Cell(20, 10, "Month", 1);
$pdf->Cell(20, 10, "Year", 1);
$pdf->Cell(35, 10, "Rate (Per Day)", 1);
$pdf->Cell(35, 10, "Days Worked", 1);
$pdf->Cell(25, 10, "Salary", 1);
$pdf->Ln();

$sql = "SELECT e.name, e.position, s.rate, s.days_worked, s.salary 
        FROM employees e 
        JOIN salary_details s ON e.id = s.employee_id 
        WHERE s.month = '$month' AND s.year = '$year'";

$result = $conn->query($sql);

$pdf->SetFont('Arial', '', 9);

while ($row = $result->fetch_assoc()) {
    $pdf->Cell(35, 10, $row['name'], 1);
    $pdf->Cell(25, 10, $row['position'], 1);
    $pdf->Cell(20, 10, date("F", mktime(0, 0, 0, $month, 10)), 1);
    $pdf->Cell(20, 10, $year, 1);
    $pdf->Cell(35, 10, $row['rate'], 1);
    $pdf->Cell(35, 10, $row['days_worked'], 1);
    $pdf->Cell(25, 10, number_format($row['salary'], 2), 1);
    $pdf->Ln();
}

$pdf->Output();
