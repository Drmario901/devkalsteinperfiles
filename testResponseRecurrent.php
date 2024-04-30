<?php

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
require 'conexion.php';  // Asegúrate de que este archivo contiene la lógica de conexión a tu base de datos.

use DansMaCulotte\Monetico\Monetico;
use DansMaCulotte\Monetico\Responses\PurchaseResponse;

$data = $_POST;

if (!empty($data)) {
    file_put_contents('monetico_log.txt', date('Y-m-d H:i:s') . " - Datos recibidos: " . json_encode($data) . "\n", FILE_APPEND);

    $monetico = new Monetico(
        '7590531',
        '530C185A56C2A9F904681A527780EBDB8C0E6C99',
        'kalsteinfr'
    );

    $response = new PurchaseResponse($data);
    $result = $monetico->validate($response);

    if ($result && $data['code-retour'] == 'payetest') {  
        echo "version=2\ncdr=0"; 
        $estado_membresia = 'Activa'; 
    } else {
        echo "version=2\ncdr=1"; 
        $estado_membresia = 'Pendiente'; // Estado deseado para pagos no exitosos
    }

    $email = $data['email']; 
    $updateQuery = "UPDATE wp_account SET estado_membresia = ? WHERE account_correo = ?";
    $stmt = $conexion->prepare($updateQuery);
    $stmt->bind_param("ss", $estado_membresia, $email);
    $stmt->execute();

    if ($stmt->error) {
        file_put_contents('monetico_log.txt', date('Y-m-d H:i:s') . " - ERROR al actualizar la base de datos: " . $stmt->error . "\n", FILE_APPEND);
    }

    $stmt->close();
} else {
    echo "ERROR: No se recibieron datos.";
    file_put_contents('monetico_log.txt', date('Y-m-d H:i:s') . " - ERROR: No se recibieron datos.\n", FILE_APPEND);
}

?>
