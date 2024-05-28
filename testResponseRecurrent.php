<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

require 'vendor/autoload.php';

use DansMaCulotte\Monetico\Monetico;
use DansMaCulotte\Monetico\Responses\PurchaseResponse;

$data = $_POST;

// Crear la carpeta 'monetico' si no existe
$logDir = 'monetico';
if (!is_dir($logDir)) {
    mkdir($logDir, 0777, true);
}

$logFile = $logDir . '/monetico_log_' . date('Y-m-d') . '.txt';
file_put_contents($logFile, date('Y-m-d H:i:s') . " - Datos recibidos: " . json_encode($data) . "\n", FILE_APPEND);

if (!empty($data)) {
    $monetico = new Monetico('7593339', '255D023E7A0BDE9EEAC7516959CD93A9854F3991', 'kalsteinfr');
    $response = new PurchaseResponse($data);
    $result = $monetico->validate($response);

    if ($result) {
        echo "version=2\ncdr=0";
    } else {
        echo "version=2\ncdr=1";
    }
} else {
    echo "ERROR: No se recibieron datos.";
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - ERROR: No se recibieron datos.\n", FILE_APPEND);
}
?>