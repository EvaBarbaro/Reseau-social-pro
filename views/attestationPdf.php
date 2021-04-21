<?php
session_start();

require_once __DIR__ .'/dompdf/autoload.inc.php';
require_once __DIR__ .'/../pathUrl.php';



// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

// instantiate and use the dompdf class
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

$dompdf->loadHtml(
    "<!DOCTYPE html>
    <html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Document</title>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
    </head>
    <body>
        <img src=".pathUrl()."public/logoImages/".$_SESSION['logo']." alt='logo entreprise' width='100px' class='float-right'>
        <p>Le ".date("d/m/y")."</p>
        <h1 class='text-center'>Attestation de travail</h1>
        <p>Madame, monsieur</p>
        <p>Je soussigné, ".$_SESSION['bossPrenom']." ".$_SESSION['bossNom'].",</p>
        <p>Agissant en qualité de représentant de la société ".$_SESSION['designation'].", j'atteste et je certifie que ".$_POST['prenom']." ".$_POST['nom']
        ." est salarié de la socitété depuis le ".$_POST["date_embauche"]." en qualité de ".$_POST['grade']." au sein du département ".$_POST['departement']
        ." au poste de ".$_POST['poste'].".</p>
        <p>Cette attestation est délivré à la demande de l'intéressé pour faire valoir ce que de droit.</p>
        <h5>".$_SESSION['bossNom']." ".$_SESSION['bossPrenom']."</h5>
    </body>
    </html>"
);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('attestation-de-travail-'.$_POST['prenom'].'-'.$_POST['nom'].'.pdf');

?>