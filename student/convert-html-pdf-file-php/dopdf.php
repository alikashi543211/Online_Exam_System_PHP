<?php
require('WriteHTML.php');

$pdf=new PDF_HTML();

$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 15);

$pdf->AddPage();
//$pdf->Image('companylogo.png',18,13,33);
$pdf->SetFont('Arial','B',14);
$pdf->WriteHTML('<para><h1>Tutorialswebsite Blog, Tutorials, jQuery, Ajax, PHP, MySQL </h1><br>
Website: <u>www.tutorialswebsite.com</u></para><br><br>How to Convert HTML to PDF with fpdf example');

$pdf->SetFont('Arial','B',7); 
$htmlTable='<TABLE>
<TR>
<TD>Name:</TD>
<TD>'.$_POST['name'].'</TD>
</TR>
<TR>
<TD>Email:</TD>
<TD>'.$_POST['email'].'</TD>
</TR>
<TR>
<TD>URl:</TD>
<TD>'.$_POST['url'].'</TD>
</TR>
<TR>
<TD>Comment:</TD>
<TD>'.$_POST['comment'].'</TD>
</TR>
</TABLE>';
$pdf->WriteHTML("<br><br><br>$htmlTable");
$pdf->SetFont('Arial','B',6);
$pdf->Output(); 
?>