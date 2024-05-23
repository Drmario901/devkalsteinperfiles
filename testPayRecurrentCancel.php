<?php
// ERROR DETECTION LINES.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/conexion.php';
session_start();

// COMPOSER DEPENDENCIES.
require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/vendor/autoload.php';

use DansMaCulotte\Monetico\Monetico;

function calculateMAC($securityKey, $fields) {
    // Ordenar los campos alfabéticamente por clave
    ksort($fields);
    
    // Crear el string de datos concatenando los valores de los campos
    $dataString = '';
    foreach ($fields as $value) {
        $dataString .= $value . '*';
    }
    // Eliminar el último asterisco
    $dataString = rtrim($dataString, '*');
    
    // Calcular el HMAC-SHA1
    return strtoupper(hash_hmac('sha1', $dataString, $securityKey));
}

// Datos proporcionados
$date = '23%2F05%2F2024%5Fa%5F16%3A26%3A35'; // Fecha y hora de la transacción original codificada en URL
$date_commande = '23%2F05%2F2024'; // Solo la fecha de la transacción original codificada en URL

// Asegurarse de que las fechas están en el formato correcto
if (!preg_match('/^\d{2}%2F\d{2}%2F\d{4}%5Fa%5F\d{2}%3A\d{2}%3A\d{2}$/', $date)) {
    die('Formato de fecha "date" incorrecto. Debe ser dd%2Fmm%2Fyyyy%5Fa%5Fhh%3Amm%3Ass');
}
if (!preg_match('/^\d{2}%2F\d{2}%2F\d{4}$/', $date_commande)) {
    die('Formato de fecha "date_commande" incorrecto. Debe ser dd%2Fmm%2Fyyyy');
}

// Resto de los parámetros
$securityKey = '255D023E7A0BDE9EEAC7516959CD93A9854F3991';
$tpe = '7593339';
$montant = '10.00USD'; // Asegurarse de que el monto esté en el formato correcto
$montant_a_capturer = '0.00USD';
$montant_deja_capture = '0.00USD';
$montant_restant = '0.00USD';
$reference = 'SUB1-1716474386';
$version = '3.0';
$lgue = 'ES';
$societe = 'kalsteinfr';
$stoprecurrence = 'OUI';

// Crear arreglo de campos
$fields = [
    'version' => $version,
    'TPE' => $tpe,
    'date' => $date,
    'date_commande' => $date_commande,
    'montant' => $montant,
    'montant_a_capturer' => $montant_a_capturer,
    'montant_deja_capture' => $montant_deja_capture,
    'montant_restant' => $montant_restant,
    'reference' => $reference,
    'lgue' => $lgue,
    'societe' => $societe,
    'stoprecurrence' => $stoprecurrence
];

$mac = calculateMAC($securityKey, $fields);

$fields['MAC'] = $mac;

$url = "https://p.monetico-services.com/test/capture_paiement.cgi"; // URL de pruebas

?>
<html>
<body onload="document.forms['cancel_form'].submit();">
    <form name="cancel_form" action="<?php echo $url; ?>" method="post">
        <?php foreach ($fields as $key => $value): ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo htmlspecialchars($value); ?>">
        <?php endforeach; ?>
        <center><div class="custom-loader"></div></center>
    </form>
</body>
</html>
