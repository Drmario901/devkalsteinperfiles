<?php
// ERROR DETECTION LINES.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/conexion.php';
session_start();

if (isset($_SESSION["emailAccount"])) {
    $email = $_SESSION["emailAccount"];
}

// COMPOSER DEPENDENCIES.
require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/vendor/autoload.php';

use GuzzleHttp\Client;


$sql = "SELECT * FROM wp_account WHERE account_email = '$email'";
$result = $conexion->query($sql);
$row = $result->fetch_assoc();
$id = $row['account_aid'];

$sqlSubscripcion = "SELECT * FROM wp_subscripcion WHERE user_id = '$id'";

$resultSubscripcion = $conexion->query($sqlSubscripcion);
if ($resultSubscripcion->num_rows > 0) {
    $rowSubscripcion = $resultSubscripcion->fetch_assoc();

    // Suponiendo que el monto se encuentra en una columna llamada 'monto'
    $monto = $rowSubscripcion['monto'];

    // Extraer la parte numérica del monto (asumiendo que el formato es siempre 'XXUSD')
    $montoNumerico = floatval($monto);

    // Formatear el monto para que tenga dos decimales
    $montoFormateado = number_format($montoNumerico, 2);

    // Concatenar con 'USD'
    $montoFinal = $montoFormateado . 'USD';
} else {
    echo "No se encontró la suscripción para el user_id: $id";
}

function calculateMAC($securityKey, $fields)
{
    ksort($fields, SORT_STRING);

    $dataString = '';
    foreach ($fields as $key => $value) {
        $dataString .= $key . '=' . $value . '*';
    }

    $dataString = rtrim($dataString, '*');

    return strtoupper(hash_hmac('sha1', $dataString, pack('H*', $securityKey)));
}

/* $dateTime = new DateTime('now', new DateTimeZone('Europe/Paris'));
$date = $dateTime->format('d/m/Y:H:i:s');
$date_commande = $dateTime->format('d/m/Y');

if (!preg_match('/^\d{2}\/\d{2}\/\d{4}:\d{2}:\d{2}:\d{2}$/', $date)) {
    die('Formato de fecha "date" incorrecto. Debe ser JJ/MM/AAAA:HH:MM:SS');
}
if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date_commande)) {
    die('Formato de fecha "date_commande" incorrecto. Debe ser JJ/MM/AAAA');
} */

$securityKey = '255D023E7A0BDE9EEAC7516959CD93A9854F3991';
$tpe = '7593339';
$montant = $montoFinal;
$montant_a_capturer = '0.00USD';
$montant_deja_capture = '0.00USD';
$montant_restant = '0.00USD';
$reference = $rowSubscripcion['referencia_pago'];
$version = '3.0';
$lgue = 'ES';
$societe = 'kalsteinfr';
$stoprecurrence = 'OUI';

$fields = [
    'version' => $version,
    'TPE' => $tpe,
    'date' => $rowSubscripcion['fecha'],
    'date_commande' => $rowSubscripcion['fechahora'],
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
        <center>
            <div class="custom-loader"></div>
        </center>
    </form>
</body>

</html>