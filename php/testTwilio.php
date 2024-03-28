<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (isset($_SESSION["codeVerification"])) {
  $code = $_SESSION["codeVerification"];
}
/* if (isset($_SESSION["telefono"])) {
  $to = $_SESSION["telefono"];
} */

echo $code;

use Twilio\Rest\Client;

$sid = 'AC8c50999f3028ad776a0b422f3e85ce64';
$token = '55d74f432a32052137bd568946767750';
$twilioPhoneNumber = '+17608564734';
$client = new Client($sid, $token);
$to = '+' . $to;

try {
  $message = $client->messages->create(
    $to,
    array(
      'from' => $twilioPhoneNumber,
      'body' => "Your verification code to register in Kalstein is $code"
    )
  );

  echo 'The message has been sent';
} catch (Exception $e) {
  echo 'The message could not be sent, error: ' . $e->getMessage();
}