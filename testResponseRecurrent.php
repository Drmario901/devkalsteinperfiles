<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

use DansMaCulotte\Monetico\Monetico;
use DansMaCulotte\Monetico\Responses\PurchaseResponse;

$data = $_POST;
file_put_contents('monetico_log_recurrent.txt', date('Y-m-d H:i:s') . " - Datos recibidos: " . json_encode($data) . "\n", FILE_APPEND);

if (!empty($data)) {
    $monetico = new Monetico('7593339', '255D023E7A0BDE9EEAC7516959CD93A9854F3991', 'kalsteinfr');
    $response = new PurchaseResponse($data);
    $result = $monetico->validate($response);

    if ($result) {
        echo "version=2\ncdr=0";
        // require 'processData.php';
    } else {
        echo "version=2\ncdr=1";
    }
} else {
    echo "ERROR: No se recibieron datos.";
    file_put_contents('monetico_log_recurrent.txt', date('Y-m-d H:i:s') . " - ERROR: No se recibieron datos.\n", FILE_APPEND);
}
?>