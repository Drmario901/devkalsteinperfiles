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

$sql = "SELECT * FROM wp_account WHERE account_correo = '$email'";
$result = $conexion->query($sql);
$row = $result->fetch_assoc();
$id = $row['account_aid'];

$sqlSubscripcion = "SELECT * FROM wp_subscripcion WHERE user_id = '$id' ORDER BY id DESC 
LIMIT 1";
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
    exit;
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

$dateTime = new DateTime('now', new DateTimeZone('Europe/Paris'));
$date = $dateTime->format('d/m/Y:H:i:s');
$date_commande = $dateTime->format('d/m/Y');

if (!preg_match('/^\d{2}\/\d{2}\/\d{4}:\d{2}:\d{2}:\d{2}$/', $date)) {
    die('Formato de fecha "date" incorrecto. Debe ser JJ/MM/AAAA:HH:MM:SS');
}
if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date_commande)) {
    die('Formato de fecha "date_commande" incorrecto. Debe ser JJ/MM/AAAA');
}

// $securityKey = '255D023E7A0BDE9EEAC7516959CD93A9854F3991';
$securityKey = '255D023E7A0BDE9EEAC7516959CD93A9854F3991';
$tpe = '7593339';
//$montant = $montoFinal;
$montant = '0.01USD';
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

$url = "https://p.monetico-services.com/capture_paiement.cgi";

$client = new Client();
$response = $client->request('POST', $url, [
    'form_params' => $fields
]);

$responseBody = $response->getBody()->getContents();
// parse_str(str_replace(" ", "&", $responseBody), $parsedResponse);

parse_str(str_replace(["\r", "\n"], '&', $responseBody), $parsedResponse);

// var_dump($parsedResponse);

if (isset($parsedResponse['cdr'])) {
    $cdr = $parsedResponse['cdr'];

    if ($cdr == 0) {
        // Lógica si cdr = 0
        // echo "cdr es igual a 0. La recurrencia ya está detenida.";
        header('Content-Type: application/json');
        echo json_encode(['status' => 200, 'response' => 'error', 'reference' => $reference, 'cdr' => $cdr]);
    } elseif ($cdr == 1) {
        // Lógica si cdr = 1
        // echo "cdr es igual a 1. Ejecutar lógica adicional.";
        // Aquí realizamos el update a la tabla wp_subscripcion
        $sqlUpdate = "
        UPDATE wp_subscripcion 
        SET estado_membresia = 2 
        WHERE id = (
          SELECT id 
          FROM (
            SELECT id 
            FROM wp_subscripcion 
            WHERE user_id = '$id' 
              AND estado_membresia <> 3 
            ORDER BY id DESC 
            LIMIT 1
          ) as subquery
        )";
        if ($conexion->query($sqlUpdate) === TRUE) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 200, 'response' => 'success', 'reference' => $reference, 'cdr' => $cdr]);
        } else {
            // echo "Error actualizando estado de membresía: " . $conexion->error;
            header('Content-Type: application/json');
            echo json_encode(['status' => 500, 'error' => $conexion->error]);
        }
    } else {
        echo "Valor de cdr desconocido: " . $cdr;
    }
} else {
    echo "No se pudo encontrar el valor de cdr en la respuesta.";
}
