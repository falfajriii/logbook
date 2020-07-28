<?php
session_start();

include "koneksi.php";
require('fpdf/fpdf.php');

date_default_timezone_set('Asia/Jakarta');// change according timezone

$currentTime = date( 'd-m-Y h:i:s A', time () );


$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(0.5,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',14);
$pdf->Image('img/pupr.png',1,1,2,2);
$pdf->SetX(4);            
$pdf->MultiCell(22,0.5,'KEMENTERIAN PEKERJAAN UMUM DAN PERUMAHAN RAKYAT',0,'C');
$pdf->SetX(4);
$pdf->MultiCell(22,0.5,'SEKRETARIAT JENDRAL',0,'C');
$pdf->SetX(4);
$pdf->MultiCell(22,0.5,'PUSAT DATA DAN TEKNOLOGI INFORMASI (PUSDATIN)',0,'C');   
$pdf->SetFont('Arial','',8);
$pdf->SetX(4);
$pdf->MultiCell(22,0.5,'Jalan Pattimura 20, Kebayoran Baru, Jakarta 12110 - Telp: 021-7392262, Fax. 021-7220219, PU-net: 7227575 (hunting), http://www.pu.go.id',0,'C');
$pdf->SetX(4);
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(28.5,0.7,"DATA CENTER VISITOR LOG",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Printed On : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(1.5, 1, 'NO', 1, 0, 'C');
$pdf->Cell(4, 1, 'Nama Pengunjung', 1, 0, 'C');
$pdf->Cell(3, 1, 'Company', 1, 0, 'C');
$pdf->Cell(3, 1, 'Tanggal', 1, 0, 'C');
$pdf->Cell(10, 1, 'Keterangan', 1, 0, 'C');
$pdf->Cell(2, 1, 'Jam Masuk', 1, 0, 'C');
$pdf->Cell(2, 1, 'Jam Keluar', 1, 0, 'C');
$pdf->Cell(3, 1, 'pendamping', 1, 1, 'C');
$pdf->SetFont('Arial','',9);
$no=1;

$from=$_POST['from'];
$end=$_POST['end'];
$query=mysqli_query($koneksi,"SELECT * FROM kunjungan WHERE (tanggal BETWEEN '$from' AND '$end')");
while($lihat=mysqli_fetch_array($query)){

	$pdf->Cell(1.5, 1, $no, 1, 0, 'C');
	$pdf->Cell(4, 1, $lihat['nm_kunjungan'], 1, 0,'L');
	$pdf->Cell(3, 1, $lihat['company'], 1, 0,'C');
	$pdf->Cell(3, 1, $lihat['tanggal'],1, 0, 'C');
	$pdf->Cell(10, 1, $lihat['keterangan'],1, 0, 'L');
	$pdf->Cell(2, 1, $lihat['jam_msk'], 1, 0, 'C');
	$pdf->Cell(2, 1, $lihat['jam_klr'], 1, 0, 'C');
	$pdf->Cell(3, 1, $lihat['pendamping'], 1, 1, 'C');

	$no++;
}
$pdf->ln(1);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(47.5,0.7,"Kepala Sub Bidang",0,10,'C');

$pdf->ln(0.05);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(47.5,0.7,"Sistem Infrastruktur Teknologi Informasi",0,10,'C');

$pdf->ln(1.8);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(47.5,0.7,"(Jimmy Segers, ST)",0,10,'C');

$pdf->Output("Log_datacenter.pdf","I");

?>