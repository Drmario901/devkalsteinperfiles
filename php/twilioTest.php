<?php
require 'vendor/autoload.php'; 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$code = 'Feid';
/*if(isset($_SESSION["codeVerification"])){
    $code = $_SESSION["codeVerification"];
}*/

$phoneNumber = '+584128541945'; 

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
            'body' => $code
        )
    );

    echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
    echo 'El mensaje no se ha podido enviar, error: ' . $e->getMessage();
}
?>
