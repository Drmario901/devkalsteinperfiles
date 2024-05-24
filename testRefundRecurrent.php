<?php
// ERROR DETECTION LINES.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/conexion.php';
session_start();

// EMAIL ACCOUNT SESSION.
if (isset($_SESSION["emailAccount"])) {
  $email = $_SESSION["emailAccount"];
} else {
  die('No email account in session.');
}

// LANGUAGE FOR THE TEXT OF LOADER.
$esText = '<h2>Redirigiendo a pasarela de pago</h2>';
// $enText = '<h2>Redirecting to Payment Gateway</h2>';

if (!isset($_GET["emailUser"])) {
  die('Error: emailUser not set');
}

$emailUser = $_GET["emailUser"];
echo 'aaaaa ' .  $emailUser;

// PAYMENT GATEWAY URL (MONETICO).
function encryptURL()
{
  $gateway = base64_encode('https://p.monetico-services.com/test/paiement.cgi');
  return $gateway;
}

// MAIN QUERIES
$consulta = "SELECT * FROM wp_account WHERE account_correo = '$emailUser'";

$response = $conexion->query($consulta);
if ($response) {
  if ($response->num_rows > 0) {
    $row = $response->fetch_assoc();
    $account_aid = $row['account_aid'];
  } else {
    die('No account found for this email.');
  }
} else {
  die('Query error: ' . $conexion->error);
}

echo 'el idddd ' . $account_aid;

$consulta2 = "SELECT referencia_pago FROM wp_subscripcion WHERE user_id = '$account_aid'";

$response2 = $conexion->query($consulta2);
if ($response2) {
  if ($response2->num_rows > 0) {
    $row2 = $response2->fetch_assoc();
    $referencia_pago = $row2['referencia_pago'];
  } else {
    die('No payment reference found for this account.');
  }
} else {
  die('Query error: ' . $conexion->error);
}

echo 'el idddd pero de ' . $referencia_pago;

// COMPOSER DEPENDENCIES.
require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/vendor/autoload.php';

use GuzzleHttp\Client;

// Datos proporcionados para la prueba
$securityKey = '255D023E7A0BDE9EEAC7516959CD93A9854F3991';
$tpe = '7593339';
$dateTime = new DateTime('now', new DateTimeZone('Europe/Paris'));
$date = $dateTime->format('d/m/Y:H:i:s');
$date_commande = $dateTime->format('d/m/Y');
$montant = '10.00USD';
$montant_recredit = '5.00USD';
$reference = 'SUB1-1716474386';
$version = '3.0';
$lgue = 'FR';
$societe = 'kalsteinfr';

$fields = [
  'version' => $version,
  'TPE' => $tpe,
  'date' => $date,
  'date_commande' => $date_commande,
  'montant' => $montant,
  'montant_recredit' => $montant_recredit,
  'reference' => $reference,
  'lgue' => $lgue,
  'societe' => $societe
];

// Calcular el MAC
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

$mac = calculateMAC($securityKey, $fields);
$fields['MAC'] = $mac;

$url = "https://p.monetico-services.com/test/recredit_paiement.cgi";

// Enviar la solicitud de recrédito
$client = new Client();
$response = $client->request('POST', $url, [
  'form_params' => $fields
]);

$responseBody = $response->getBody()->getContents();

if ($response->getStatusCode() == 200) {
  echo "Recrédito realizado exitosamente: " . $responseBody;
} else {
  echo "Error al realizar el recrédito: " . $responseBody;
}
