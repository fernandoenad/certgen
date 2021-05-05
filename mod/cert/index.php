<?php
session_start();
require("../../dbconfig.php");
require("../../plugins/phptopdfapp/code128.php");
require("controller.php");

class PDF extends FPDF{
	function Header(){
		global $conn;
	}
}

$pdf = new PDF_Code128('L','mm','Letter');
$certContrlr  = new Controller();
$result = $certContrlr->printCertificate(array(array('printCertificate', $_GET['cer_code'])));

if($result['0']){
	$row = $result['2'];
	$participant = $row['cer_fullname'];
	$pronoun = ($row['cer_sex'] == "Female" ? "her" : "his");
	$webinar = $row['ses_title'];
	$session = $row['ses_session'];
	$template = $row['template'];
	$date = $row['ses_dates'];
	$venue = $row['ses_venue'];
	$date2 = date('jS', strtotime($row['cer_dateissue'])).' day of '.date('F, Y', strtotime($row['cer_dateissue']));
	$venue2 = $row['cer_placeissue'];
	$code = $row['cer_code'];
} else {
	$participant = "Certificate details not found.";
	$pronoun = "";
	$webinar = "";
	$session = "";
	$template = $row['template'];
	$date = "";
	$venue = "";
	$date2 = "";
	$venue2 = "";
	$code = "";	
}

$pdf->AddPage();

$pdf->Image('../../assets/images/' . $template,0,0,280);

if($template == "certtemp.jpg"){
	$pdf->Ln(98);
	$pdf->SetFont('Times','B',36);
	$pdf->Cell(260,4,mb_convert_encoding($participant,'ISO-8859-1', 'UTF-8'),0,1,'C');

	$pdf->Ln(8);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(260,4,mb_convert_encoding('for '.$pronoun.' participation during the ','ISO-8859-1', 'UTF-8'),0,1,'C');

	$pdf->Ln(8);
	$pdf->SetFont('Times','B',20);
	$pdf->Cell(260,4,mb_convert_encoding($webinar,'ISO-8859-1', 'UTF-8'),0,1,'C');

	$pdf->Ln(5);
	$pdf->SetFont('Times','B',18);
	$pdf->Cell(260,4,mb_convert_encoding('Session: '.$session,'ISO-8859-1', 'UTF-8'),0,1,'C');

	$pdf->Ln(5);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(260,4,mb_convert_encoding('held on '.$date.' '.$venue.'.','ISO-8859-1', 'UTF-8'),0,1,'C');

	$pdf->Ln(8);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(260,4,mb_convert_encoding('Given this '.$date2.' at the '.$venue2.'.','ISO-8859-1', 'UTF-8'),0,1,'C');
	$pdf->Ln(8);

	$pdf->Image('../../assets/images/qr_verify.png',15,170,20);
	$pdf->Ln(18);
	$pdf->SetFont('Courier','',10);
	$pdf->SetTextColor(255, 0, 0);
	$pdf->Cell(30,3,mb_convert_encoding($code,'ISO-8859-1', 'UTF-8'),0,1,'C');

} else if($template == "cert_0001.jpg"){
	$pdf->Ln(93);
	$pdf->SetFont('Times','B',33);
	$pdf->Cell(260,4,mb_convert_encoding($participant,'ISO-8859-1', 'UTF-8'),0,1,'C');

	$pdf->Ln(8);
	$pdf->SetFont('Times','',17);
	$pdf->Cell(260,4,mb_convert_encoding('for his/her participation during the ','ISO-8859-1', 'UTF-8'),0,1,'C');

	$pdf->Ln(3);
	

	$text = $webinar;
	$char_per_line = 82; 
	$text_arr = explode("\n", wordwrap($text, $char_per_line));
	$max_lines = 2;
	$line_count = 0;
	if(sizeof($text_arr) > $max_lines){
		$pdf->SetFont('Times','B',14);
		$char_per_line = 115; 
		$text_arr = explode("\n", wordwrap($text, $char_per_line));
		for($i=0; $i<sizeof($text_arr); $i++){
			$pdf->Cell(260, 5, mb_convert_encoding($text_arr[$i], 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
			$line_count++;
		} 
	} else {
		$pdf->SetFont('Times','B',19);
		for($i=0; $i<sizeof($text_arr); $i++){
			$pdf->Cell(260, 7, mb_convert_encoding($text_arr[$i], 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
			$line_count++;
		} 
	}

	

	/*
	for($i=$line_count; $i<$max_lines; $i++){
		$pdf->Cell(260, 7, '', 0, 1, 'C');
	}
	*/

	$pdf->Ln(1);
	$pdf->SetFont('Times','',17);
	$pdf->Cell(260,6,mb_convert_encoding('held at '.$venue,'ISO-8859-1', 'UTF-8'),0,1,'C');
	$pdf->Cell(260,6,mb_convert_encoding('from '.$date.'.','ISO-8859-1', 'UTF-8'),0,1,'C');

	$pdf->Ln(5);
	$pdf->SetFont('Times','',17);
	$text = "Given at " . $venue2;
	$char_per_line = 80; 
	$text_arr = explode("\n", wordwrap($text, $char_per_line));
	$max_lines = 2;
	$line_count = 0;

	for($i=0; $i<sizeof($text_arr); $i++){
		$pdf->Cell(260, 6, mb_convert_encoding($text_arr[$i], 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
		$line_count++;
	} 

	for($i=$line_count; $i<$max_lines; $i++){
		$pdf->Cell(260, 6, '', 0, 1, 'C');
	}
	$pdf->Ln(8);

	$pdf->Image('../../assets/images/qr_verify.png',15,170,20);
	$pdf->Ln(17);
	$pdf->SetFont('Courier','',10);
	$pdf->SetTextColor(255, 0, 0);
	$pdf->Cell(30,3,mb_convert_encoding($code,'ISO-8859-1', 'UTF-8'),0,1,'C');
}

//$filename="./certificate.pdf";
//$pdf->Output($filename,'F');
$pdf->Output();
?>