<?php
//include connection file 
include('connect.php');
include('fpdf/fpdf.php');
 
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(70);
    // Title
    $this->Cell(50,20,'PHIEU DAT HANG',1,0,'C');
    // Line break
    $this->Ln(50);
}
 
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
 
$display_heading = array('ma_phieu_dat'=>'Ma Phieu dat', 'ma_kh'=> 'Khach hang', 'ngay_dat'=> 'Ngay dat','tien_coc'=> 'Tien coc','ghi_chu'=> 'Ghi chu');
 
$result = mysqli_query($abc, "SELECT * from phieu_dat_hang") or die("database error:". mysqli_error($conn));
$header = mysqli_query($abc, "SHOW columns FROM phieu_dat_hang");
 
$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',13);
foreach($header as $heading) {
$pdf->Cell(35,10,$display_heading[$heading['Field']],1);
}
foreach($result as $row) {
$pdf->SetFont('Arial','',10);
$pdf->Ln();
foreach($row as $column)
$pdf->Cell(35,10,$column,1);
}
$pdf->Output();
?>