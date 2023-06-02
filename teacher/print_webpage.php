<?php
// include autoloader
require_once "dompdf/src/autoloader.php";
// reference dompdf namespace
use Dompdf\Dompdf;
$dompdf=new Dompdf.php();
$dompdf->loadHtml ('<h1>This is my first HTML to PDF file.</h1>');
$dompdf->setPaper('A4','landscape');
$dompdf->render();


//output this generated pdf
$dompdf->stream('codexworld',array('Attatchment'=>0));
?>