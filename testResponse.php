<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/vendor/autoload.php';
require_once '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/db/conexion.php';
require_once '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/txt/txt.php';

$archivoLog = "/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/monetico_log.txt"; 

use DansMaCulotte\Monetico\Monetico;
use DansMaCulotte\Monetico\Responses\PurchaseResponse;

$data = $_POST;

print_r($data);

file_put_contents('monetico_log.txt', date('Y-m-d H:i:s') . " - Datos recibidos: " . json_encode($data) . "\n", FILE_APPEND);

$dataFormat = json_encode($data);


if (!isset($_POST) || empty($_POST)) {
    file_put_contents('monetico_log.txt', date('Y-m-d H:i:s') . " - ERROR: No se recibieron datos por POST.\n", FILE_APPEND);
    echo "ERROR: No se recibieron datos por POST.";
    exit(); 
}

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

procesarArchivoMonetico($archivoLog, $conexion);

?>
