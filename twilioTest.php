<?php
require 'vendor/autoload.php'; 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$code = 'Chávez vive la lucha sigue.';
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
    $call = $client->calls->create(
        $phoneNumber, 
        $twilioPhoneNumber, 
        [
            "twiml" => "<Response><Say voice='alice' language='es-MX'>Tu código de verificación es $code</Say></Response>"
        ]
    );

    echo 'La llamada ha sido iniciada';
} catch (Exception $e) {
    echo 'La llamada no se ha podido realizar, error: ' . $e->getMessage();
}
?>
