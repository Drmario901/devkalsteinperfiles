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
$montant = '10.00USD'; // Asegúrate de que el formato es correcto y en USD
$montant_a_capturer = '0.00USD';
$montant_deja_capture = '0.00USD';
$montant_restant = '0.00USD';
$reference = 'SUB1-1716474386';
$version = '3.0';
$lgue = 'FR'; // Ajustado a FR según la documentación
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

// Enviar la solicitud de cancelación
$client = new Client();
$response = $client->request('POST', $url, [
    'form_params' => $fields
]);

$responseBody = $response->getBody()->getContents();
$responseStatusCode = $response->getStatusCode();

echo "Solicitud Enviada:<br>";
foreach ($fields as $key => $value) {
    echo $key . ': ' . htmlspecialchars($value) . '<br>';
}

echo "<br>MAC Calculada: " . $mac . "<br>";

echo "<br>Respuesta del Servidor:<br>";
echo "Código de Estado: " . $responseStatusCode . "<br>";
echo "Cuerpo de la Respuesta: " 
