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

if (isset($data['reference']) && isset($data['code-retour'])) {
    $reference = $data['reference'];
    // Eliminación del prefijo "QUO" de la referencia, si está presente
    $referenceSinPrefijo = preg_replace("/^QUO/", "", $reference);
    $codeRetour = $data['code-retour'];
    
    // Preparar y ejecutar la actualización basada en el estado del pago
    if ($codeRetour == 'payetest' || $codeRetour == 'paiement') {
        $newStatus = 3; // Estado de éxito
    } else {
        $newStatus = 2; // Cualquier otro caso se considera no exitoso
    }
    // Consulta para actualizar el estado de la cotización
    $stmt = $conexion->prepare("UPDATE wp_cotizacion SET cotizacion_status = ? WHERE cotizacion_id = ?");
    if (!$stmt) {
        echo "Error al preparar la consulta: " . $conexion->error;
        exit();
    }

    $stmt->bind_param("is", $newStatus, $referenceSinPrefijo);
    if ($stmt->execute()) {
        echo "Cotización actualizada con éxito. Nuevo estado: $newStatus\n";
    } else {
        echo "Error al actualizar cotización: " . $stmt->error . "\n";
    }
    $stmt->close();
} else {
    echo "La clave 'reference' o 'code-retour' no está presente en los datos recibidos.";
}


print_r($data);

file_put_contents('monetico_log.txt', date('Y-m-d H:i:s') . " - Datos recibidos: " . json_encode($data) . "\n", FILE_APPEND);

$dataFormat = json_encode($data);

print_r($dataFormat);


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
