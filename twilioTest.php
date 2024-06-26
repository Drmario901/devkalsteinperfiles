<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

require 'vendor/autoload.php'; 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$language = $_COOKIE['language'];
$code = 'Ultima prueba librería Twilio';
/*if(isset($_SESSION["codeVerification"])){
    $code = $_SESSION["codeVerification"];
}*/

$phoneNumber = '+584128484468'; 

use Twilio\Rest\Client;

$sid = 'AC01d7c301de16deca4670d7d08a2ce74e'; 
$token = '109bdb26761ff762ac36a696335e2f73'; 
$twilioPhoneNumber = '+15107383214'; 
$client = new Client($sid, $token);

try {
    $message = $client->messages->create(
        $phoneNumber, 
        array(
            'from' => $twilioPhoneNumber, 
            'body' => $language
        )
    );

    echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
    echo 'El mensaje no se ha podido enviar, error: ' . $e->getMessage();
}
?>
