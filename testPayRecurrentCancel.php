<?php
// ERROR DETECTION LINES.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/conexion.php';
session_start();

// COMPOSER DEPENDENCIES.
require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/vendor/autoload.php';

use GuzzleHttp\Client;

function calculateMAC($securityKey, $fields) {
    ksort($fields, SORT_STRING);

    $dataString = '';
    foreach ($fields as $key => $value) {
        $dataString .= $key . '=' . $value . '*';
    }

    $dataString = rtrim($dataString, '*');

    return strtoupper(hash_hmac('sha1', $dataString, pack('H*', $securityKey)));
}

$dateTime = new DateTime('now', new DateTimeZone('Europe/Paris'));
$date = $dateTime->format('d/m/Y:H:i:s'); 
$date_commande = $dateTime->format('d/m/Y');

if (!preg_match('/^\d{2}\/\d{2}\/\d{4}:\d{2}:\d{2}:\d{2}$/', $date)) {
    die('Formato de fecha "date" incorrecto. Debe ser JJ/MM/AAAA:HH:MM:SS');
}
if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date_commande)) {
    die('Formato de fecha "date_commande" incorrecto. Debe ser JJ/MM/AAAA');
}

$securityKey = '255D023E7A0BDE9EEAC7516959CD93A9854F3991'; 
$tpe = '7593339';
$montant = '20.00USD'; 
$montant_a_capturer = '10.00USD';
$montant_deja_capture = '10.00USD';
$montant_restant = '0.00USD';
$reference = 'SUB2-1716577425';
$version = '3.0';
$lgue = 'ES'; 
$societe = 'kalsteinfr';
$stoprecurrence = 'OUI';

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

$url = "https://p.monetico-services.com/test/capture_paiement.cgi";

$client = new Client();
$response = $client->request('POST', $url, [
    'form_params' => $fields
]);

$responseBody = $response->getBody()->getContents();

if ($response->getStatusCode() == 200) {
    echo "Pago recurrente cancelado exitosamente.";
} else {
    echo "Error al cancelar el pago recurrente: " . $responseBody;
}
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
