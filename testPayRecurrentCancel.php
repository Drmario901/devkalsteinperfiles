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
    ksort($fields); // Ordenar los campos alfabéticamente
    $dataString = '';
    foreach ($fields as $key => $value) {
        $dataString .= $value . '*';
    }
    $dataString = rtrim($dataString, '*'); // Eliminar el último '*'
    return strtoupper(hash_hmac('sha1', $dataString, $securityKey));
}

// Fecha explícita en el formato correcto
$date = date('d/m/Y_a_H:i:s'); // Fecha y hora actuales
$date_commande = date('d/m/Y'); // Solo la fecha actual

// Resto de los parámetros
$securityKey = '255D023E7A0BDE9EEAC7516959CD93A9854F3991';
$tpe = '7593339';
$montant = '20.00USD'; // Asegurarse de que el monto esté en el formato correcto
$reference = 'Membresia-SUB2-1716406357'; // Evitar caracteres no permitidos
$version = '3.0';
$lgue = 'ES';
$societe = 'kalsteinfr';
$stoprecurrence = 'OUI';

// Crear arreglo de campos
$fields = [
    'version' => $version,
    'TPE' => $tpe,
    'date' => $date,
    'montant' => $montant,
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
