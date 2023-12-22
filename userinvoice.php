<?php
session_start();
//include connection file 
include("dbinit.php");
$connection = new DatabaseConnection();
include_once('./fpdf184/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Order Invoice', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    function GenerateInvoice($data)
    {
        $this->SetFont('Arial', '', 12);
        $this->Ln(8);
        $this->Cell(40, 10, 'User ID:', 0);
        $this->Cell(0, 10, $data[0]['userID'], 0);
        $this->Ln(8);
        $this->Cell(40, 10, 'First Name:', 0);
        $this->Cell(0, 10, $data[0]['firstName'], 0);
        $this->Ln(8);
        $this->Cell(40, 10, 'Last Name:', 0);
        $this->Cell(0, 10, $data[0]['lastName'], 0);
        $this->Ln(8);
        $this->Cell(40, 10, 'Email:', 0);
        $this->Cell(0, 10, $data[0]['email'], 0,);
        $this->Ln(8);
        $this->Cell(40, 10, 'Phone:', 0);
        $this->Cell(0, 10, $data[0]['phone'], 0);
        $this->Ln(8);
        $this->Cell(40, 10, 'Address:', 0);
        $this->Cell(0, 10, $data[0]['address'], 0);
        $this->Ln(8);
        $this->Cell(40, 10, 'Province:', 0);
        $this->Cell(0, 10, $data[0]['province'], 0);
        $this->Ln(8);
        $this->Cell(40, 10, 'City:', 0);
        $this->Cell(0, 10, $data[0]['city'], 0);
        $this->Ln(8);
        $this->Cell(40, 10, 'PostalCode:', 0);
        $this->Cell(0, 10, $data[0]['postalCode'], 0);
        $this->Ln(15);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(25, 10, 'Order ID', 1, 0, 'C');
        $this->Cell(80, 10, 'Order Date', 1, 0, 'C');
        $this->Cell(30, 10, 'Brand', 1, 0, 'C');
        $this->Cell(25, 10, 'Price', 1, 0, 'C');
        $this->Cell(25, 10, 'Quantity', 1, 0, 'C');
        $this->Cell(35, 10, 'Total Amount', 1, 0, 'C');
        $this->Ln();

        $totalAmount = 0;
        foreach ($data as $row) {
            $this->SetFont('Arial', '', 12);
            $this->Cell(25, 10, $row['orderProductID'], 1, 0, 'C');
            $this->Cell(80, 10, $row['orderItemDate'], 1, 0, 'C');
            $this->Cell(30, 10, $row['brand'], 1, 0, 'C');
            $this->Cell(25, 10, $row['orderProductPrice'], 1, 0, 'C');
            $this->Cell(25, 10, $row['orderProductQuantity'], 1, 0, 'C');
            $this->Cell(35, 10, $row['orderProductPrice'] * $row['orderProductQuantity'], 1, 0, 'C');
            $this->Ln();

            $totalAmount += ($row['orderProductPrice'] * $row['orderProductQuantity']);
        }
        $tax = $totalAmount * 0.13;
        $grandTotal = $tax + $totalAmount;
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(185, 10, 'Tax:', 1, 0, 'R');
        $this->Cell(35, 10, $tax, 1, 0, 'C');
        $this->Ln();
        $this->Cell(185, 10, 'Total:', 1, 0, 'R');
        $this->Cell(35, 10, $grandTotal, 1, 0, 'C');
        $this->Ln(10);
        // Add a button
        $this->Cell(0, 10, 'Back to Home', 0, 1, 'C', false, 'index.php'); // Provide the URL of your home page here



    }
}

// Create a new PDF instance
$pdf = new PDF('P', 'mm', 'A3');
$pdf->AddPage();

// Call the stored procedure to fetch invoice data
$userID = $_SESSION['userid']; // Replace with the desired customer ID
$orderProductID = $_GET['orderProductID'];
$result = $connection->customer_invoice($userID, $orderProductID);

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Fetch data into an associative array
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $pdf->GenerateInvoice($data);
} else {
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'No invoice data found.', 0, 1, 'C');
}

// Output the PDF
$pdf->Output();
