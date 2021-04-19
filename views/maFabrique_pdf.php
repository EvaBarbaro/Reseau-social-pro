<?php
session_start();

require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

//$html0="<p><img src=".pathUrl()."'public/logoImages/'".$_SESSION['entreprise']['logo']." class='rounded-circle' width='70px'></p>";

$html1="<h1>Attestation de travail</h1>";

$html2="<p>Nous gérant de la société ".$_SESSION['entreprise']['designation']." attestons par la présente </p>";

$html3="<p>que Monsieur ou Madame  ".$_SESSION['compte']['prenom']." ".$_SESSION['compte']['nom']." est salarié au sein</p>";

$html4= "<p>de notre société du ".$_SESSION['compte'] ["date_embauche"]."  à ce jour."."</p>";



$html=$html1.$html1.$html2.$html3.$html4;


$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();



?>