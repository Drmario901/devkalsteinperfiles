<?php
// ERROR DETECTION LINES.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/conexion.php';
session_start();

// EMAIL ACCOUNT SESSION.
// if (isset($_SESSION["emailAccount"])) {
//   $email = $_SESSION["emailAccount"];
// } else {
//   die('No email account in session.');
// }

// // LANGUAGE FOR THE TEXT OF LOADER.
// $esText = '<h2>Redirigiendo a pasarela de pago</h2>';
// // $enText = '<h2>Redirecting to Payment Gateway</h2>';

$json_prueba = '{"TPE":"7593339","date":"24\/05\/2024_a_17:15:05","montant":"10USD","reference":"SUB1-1716563690","texte-libre":"uniqid: c15a3f97b46c7ce010e5a49ec3b6b3a2664f7f01063ea1.38026363  userID:@valfonsob12","code-retour":"payetest","cvx":"oui","vld":"1226","brand":"VI","motifrefus":"","usage":"inconnu","typecompte":"inconnu","ecard":"non","originecb":"FRA","bincb":"00000100","hpancb":"B552FD6DB65EC37C5B5C95F0E02A00841634AD86","ipclient":"185.28.22.84","originetr":"USA","cbmasquee":"00000100******21","modepaiement":"CB","authentification":"ewogICAiZGV0YWlscyIgOiB7CiAgICAgICJsaWFiaWxpdHlTaGlmdCIgOiAiTkEiLAogICAgICAibWVyY2hhbnRQcmVmZXJlbmNlIiA6ICJjaGFsbGVuZ2VfbWFuZGF0ZWQiCiAgIH0sCiAgICJwcm90b2NvbCIgOiAiM0RTZWN1cmUiLAogICAic3RhdHVzIiA6ICJub3RfZW5yb2xsZWQiLAogICAidmVyc2lvbiIgOiAiMi4yLjAiCn0K","MAC":"8A2ADD60FC8E74305E4E0E1A9A5ABBBDAB59D5BC"}';

// Decode the JSON response
$responseData = json_decode($json_prueba, true);

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
$tpe = $responseData['TPE'];
$date = str_replace('_a_', ' ', $responseData['date']);
$date_commande = $date; // Asumiendo que 'date_commande' es el mismo formato
$montant = $responseData['montant'];
$montant_recredit = '5.00USD'; // Este es un valor hardcodeado para la prueba
$reference = $responseData['reference'];
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
