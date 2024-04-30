<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

use DansMaCulotte\Monetico\Monetico;
use DansMaCulotte\Monetico\Responses\PurchaseResponse;

$data = $_POST;

if (!empty($data)) {
    file_put_contents('monetico_log_recurrent.txt', date('Y-m-d H:i:s') . " - Datos recibidos: " . json_encode($data) . "\n", FILE_APPEND);

    $monetico = new Monetico(
        '7590531', 
        '530C185A56C2A9F904681A527780EBDB8C0E6C99',
        'kalsteinfr' 
    );

    $response = new PurchaseResponse($data);
    $result = $monetico->validate($response);

    if ($result) {
        echo "version=2\n";
        echo "cdr=0\n";
    } else {
        echo "version=2\n";
        echo "cdr=1\n";
    }
} else {
    file_put_contents('monetico_log_recurrent.txt', date('Y-m-d H:i:s') . " - ERROR: No se recibieron datos.\n", FILE_APPEND);
    echo "ERROR: No se recibieron datos.";
}

?>
