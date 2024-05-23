<?php
//ERROR DETECTION LINES.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/conexion.php';
session_start();

//EMAIL ACCOUNT SESSION.
if (isset($_SESSION["emailAccount"])) {
  $email = $_SESSION["emailAccount"];
}
//$email = 'valfonsob12@yopmail.com';

//LANGUAGE FOR THE TEXT OF LOsADER.
$esText = '<h2>Redirigiendo a pasarela de pago</h2>';
//$enText = '<h2>Redirecting to Payment Gateway</h2>';

$emailUser = $_GET["emailUser"];

echo 'aaaaa ' .  $emailUser;

//PAYMENT GATEWAY URL (MONETICO).

function encryptURL()
{
  $gateway = base64_encode('https://p.monetico-services.com/test/paiement.cgi');
  return $gateway;
}

//GET VARIABLE.
if (!isset($_GET["emailUser"])) {
  die('Error');
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

use DansMaCulotte\Monetico\Monetico;
use DansMaCulotte\Monetico\Requests\RefundRequest;
use DansMaCulotte\Monetico\Responses\RefundResponse;
use GuzzleHttp\Client;

// JSON response from Monetico
$jsonResponse = '{"TPE":"7593339","date":"23\/05\/2024_a_19:48:35","montant":"20USD","reference":"SUB2-1716486501","texte-libre":"uniqid: 03ca08b782afed967aa1405e4ddd54d2664f7f0828e290.19661886  userID:@valfonsob13","code-retour":"payetest","cvx":"oui","vld":"1226","brand":"VI","motifrefus":"","usage":"inconnu","typecompte":"inconnu","ecard":"non","originecb":"FRA","bincb":"00000100","hpancb":"B552FD6DB65EC37C5B5C95F0E02A00841634AD86","ipclient":"185.28.22.84","originetr":"USA","cbmasquee":"00000100******21","modepaiement":"CB","authentification":"ewogICAiZGV0YWlscyIgOiB7CiAgICAgICJsaWFiaWxpdHlTaGlmdCIgOiAiTkEiLAogICAgICAibWVyY2hhbnRQcmVmZXJlbmNlIiA6ICJjaGFsbGVuZ2VfbWFuZGF0ZWQiCiAgIH0sCiAgICJwcm90b2NvbCIgOiAiM0RTZWN1cmUiLAogICAic3RhdHVzIiA6ICJub3RfZW5yb2xsZWQiLAogICAidmVyc2lvbiIgOiAiMi4yLjAiCn0K","MAC":"6B60B40BBE358A1D5665FE25D027C6215FF8063C"}';

// Decode the JSON response
$responseData = json_decode($jsonResponse, true);

// Initialize Monetico with credentials
$monetico = new Monetico(
  '7593339',
  '255D023E7A0BDE9EEAC7516959CD93A9854F3991',
  'kalsteinfr'
);

// Create a RefundRequest with the required fields
$refund = new RefundRequest([
  'dateTime' => new DateTime(),
  'orderDatetime' => DateTime::createFromFormat('d/m/Y_a_H:i:s', $responseData['date']),
  'recoveryDatetime' => new DateTime(),
  'authorizationNumber' => $responseData['vld'], // Assuming 'vld' is the authorization number
  'reference' => $responseData['reference'],
  'language' => 'FR',
  'currency' => 'USD',
  'amount' => 20 * 100, // Amount in cents
  'refundAmount' => 20 * 100, // Refund the full amount, in cents
  'maxRefundAmount' => 20 * 100, // Maximum refund amount, in cents
]);

// Get the fields for the refund request
$fields = $monetico->getFields($refund);

$client = new GuzzleHttp\Client();
$data = $client->request('POST', $url, $fields);

// $data = json_decode($data, true);

$response = new RefundResponse($data);
