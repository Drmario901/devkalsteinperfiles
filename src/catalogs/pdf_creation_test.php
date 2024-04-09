<?php

require_once ('/home/he290532/testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/catalogs/mpdf/mpdf.php');
use Mpdf\Mpdf;

// Configuración de mPDF
$mpdf = new Mpdf([
    'mode' => 'utf-8', // Puedes configurar el modo según tus necesidades
    'format' => 'A4', // Tamaño del papel
]);

ob_start();
include '/home/he290532/testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/template.php';
$html = ob_get_clean();

$html = '
<html>
<head>
<link rel="stylesheet" href="https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/pdf.css">
</head>
<body>
' . $html . '
</body>
</html>
';

$mpdf->WriteHTML($html);

$savePath = '/home/he290532/testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/catalogs/LMAO.pdf';

$mpdf->Output($savePath, 'F'); // 'F' guarda el PDF en un archivo en el servidor

echo "PDF: <a href='$savePath' target='_blank'>Ver PDF</a>";
?>