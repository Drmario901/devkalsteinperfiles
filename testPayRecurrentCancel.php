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
use DansMaCulotte\Monetico\Requests\CancelRequest;
use DansMaCulotte\Monetico\Responses\CancelResponse;
use GuzzleHttp\Client;

function calculateMAC($securityKey, $fields) {
    ksort($fields);

    $dataString = '';
    foreach ($fields as $value) {
        $dataString .= $value . '*';
    }

    $dataString = rtrim($dataString, '*');

    return strtoupper(hash_hmac('sha1', $dataString, $securityKey));
}

// Datos proporcionados
$dateTime = new DateTime('now', new DateTimeZone('Europe/Paris'));
$date = $dateTime->format('d/m/Y:H:i:s'); // Formato correcto según documentación
$date_commande = $dateTime->format('d/m/Y');

// Verificar formatos de fecha
if (!preg_match('/^\d{2}\/\d{2}\/\d{4}:\d{2}:\d{2}:\d{2}$/', $date)) {
    die('Formato de fecha "date" incorrecto. Debe ser JJ/MM/AAAA:HH:MM:SS');
}
if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date_commande)) {
    die('Formato de fecha "date_commande" incorrecto. Debe ser JJ/MM/AAAA');
}

// Resto de los parámetros
$securityKey = '255D023E7A0BDE9EEAC7516959CD93A9854F3991';
$tpe = '7593339';
$montant = '10.00EUR'; // Formato correcto sin el símbolo de moneda y con dos decimales
$reference = 'SUB1-1716474386';
$version = '1.0';
$lgue = 'FR';
$societe = 'kalsteinfr';
$stoprecurrence = 'OUI';

$fields = [
    'version' => $version,
    'TPE' => $tpe,
    'date' => $date,
    'date_commande' => $date_commande,
    'montant' => $montant,
    'reference' => $reference,
    'lgue' => $lgue,
    'societe' => $societe,
    'stoprecurrence' => $stoprecurrence
];

$mac = calculateMAC($securityKey, $fields);

$fields['MAC'] = $mac;

$url = "https://p.monetico-services.com/test/capture_paiement.cgi";

// Enviar la solicitud de cancelación
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
