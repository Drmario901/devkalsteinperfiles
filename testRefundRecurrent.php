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

use DansMaCulotte\Monetico\Monetico;
use DansMaCulotte\Monetico\Requests\RefundRequest;
use DansMaCulotte\Monetico\Responses\RefundResponse;
use GuzzleHttp\Client;

// JSON response from Monetico
$jsonResponse = '{"TPE":"7593339","date":"23\/05\/2024_a_19:48:35","montant":"20USD","reference":"SUB2-1716486501","texte-libre":"uniqid: 03ca08b782afed967aa1405e4ddd54d2664f7f0828e290.19661886  userID:@valfonsob13","code-retour":"payetest","cvx":"oui","vld":"1226","brand":"VI","motifrefus":"","usage":"inconnu","typecompte":"inconnu","ecard":"non","originecb":"FRA","bincb":"00000100","hpancb":"B552FD6DB65EC37C5B5C95F0E02A00841634AD86","ipclient":"185.28.22.84","originetr":"USA","cbmasquee":"00000100******21","modepaiement":"CB","authentification":"ewogICAiZGV0YWlscyIgOiB7CiAgICAgICJsaWFiaWxpdHlTaGlmdCIgOiAiTkEiLAogICAgICAibWVyY2hhbnRQcmVmZXJlbmNlIiA6ICJjaGFsbGVuZ2VfbWFuZGF0ZWQiCiAgIH0sCiAgICJwcm90b2NvbCIgOiAiM0RTZWN1cmUiLAogICAic3RhdHVzIiA6ICJub3RfZW5yb2xsZWQiLAogICAidmVyc2lvbiIgOiAiMi4yLjAiCn0K","MAC":"6B60B40BBE358A1D5665FE25D027C6215FF8063C"}';

// Decode the JSON response
$responseData = json_decode($jsonResponse, true);

// Print the date value for debugging
echo 'Date from JSON: ' . $responseData['date'] . '<br>';

// Initialize Monetico with credentials
$monetico = new Monetico(
  '7593339',
  '255D023E7A0BDE9EEAC7516959CD93A9854F3991',
  'kalsteinfr'
);

// Clean the date string by removing '_a_' and replace it with a space
$dateString = str_replace('_a_', ' ', trim($responseData['date']));

// Print the cleaned date string for debugging
echo 'Cleaned date string: ' . $dateString . '<br>';

// Convert date string to DateTime object
$orderDate = DateTime::createFromFormat('d/m/Y H:i:s', $dateString);
if (!$orderDate) {
  echo 'DateTime::getLastErrors(): ';
  print_r(DateTime::getLastErrors());
  die('Invalid order date format.');
}

// Print the orderDate for debugging
echo 'Order Date: ';
var_dump($orderDate);

// Create the data array for RefundRequest
$data = [
  'dateTime' => new DateTime(),
  'orderDate' => $orderDate, // corrected key
  'recoveryDate' => new DateTime(), // corrected key
  'authorizationNumber' => $responseData['vld'], // Assuming 'vld' is the authorization number
  'reference' => $responseData['reference'],
  'language' => 'FR',
  'currency' => 'USD', // Assuming the currency is USD based on montant
  'amount' => 2000, // Amount in cents (20 USD * 100)
  'refundAmount' => 2000, // Refund the full amount, in cents
  'maxRefundAmount' => 2000, // Maximum refund amount, in cents
];

// Print the data array for debugging
echo 'Data array: ';
var_dump($data);

// Create a RefundRequest with the required fields
$refund = new RefundRequest($data);

// Print the RefundRequest for debugging
echo 'Refund Request: ';
var_dump($refund);

// Get the fields for the refund request
$fields = $monetico->getFields($refund);

// Print the fields for debugging
echo 'Fields: ';
var_dump($fields);

// Send the refund request using GuzzleHttp Client
$client = new Client();
$url = 'https://p.monetico-services.com/test/paiement.cgi'; // Monetico payment gateway URL
$response = $client->request('POST', $url, [
  'form_params' => $fields
]);

// Handle the response from Monetico
$refundResponse = new RefundResponse($response);
if ($refundResponse->isSuccess()) {
  echo 'Refund successful!';
} else {
  echo 'Refund failed: ' . $refundResponse->getMessage();
}
