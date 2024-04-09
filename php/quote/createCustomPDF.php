<?php

require __DIR__ . '/../vendor/autoload.php';


use Spipu\Html2Pdf\Html2Pdf;

/* $emailAcc = $_GET['emailAcc']; */

ob_start();
/* require_once '/home/he270716/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/customTemplate.php'; */
require_once __DIR__ . '/customTemplate.php';
$html = ob_get_clean();

$html2pdf = new Html2Pdf('P', 'letter', 'es', true, 'UTF-8', 3);
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->writeHTML($html);
$html2pdf->output('cotizacion.pdf');

?>