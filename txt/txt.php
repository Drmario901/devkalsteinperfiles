<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../db/conexion.php"; // Asume que esta línea establece la conexión y guarda la instancia en $conexion

$archivo = __DIR__ . '/../monetico_log.txt';

if (!is_readable($archivo)) {
    die("El archivo no existe o no se puede leer.");
}

$lines = file($archivo);

foreach ($lines as $line) {
    if (strpos($line, 'Datos recibidos:') !== false) {
        $jsonString = substr($line, strpos($line, '{'));
        $jsonData = json_decode($jsonString);

        if ($jsonData !== null && json_last_error() === JSON_ERROR_NONE) {
            $reference = $jsonData->reference ?? 'No encontrado';
            $codeRetour = $jsonData->{'code-retour'} ?? 'No encontrado';

            if ($codeRetour == 'payetest' || $codeRetour == 'paiement') {
                // Verificar si ya existe
                insertDataToDatabase($conexion, $reference);
            }
        } else {
            echo "Error al decodificar JSON: " . json_last_error_msg() . "\n";
        }
    }
}

function insertDataToDatabase($conexion, $reference) {
    // Primero, verifica si el id_cotizacion ya existe
    $query = "SELECT id_cotizacion FROM wp_monetico WHERE id_cotizacion = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $reference);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) { // Si no existe, procede con la inserción
        $insertQuery = "INSERT INTO wp_monetico (id_cotizacion) VALUES (?)";
        $insertStmt = $conexion->prepare($insertQuery);
        $insertStmt->bind_param("s", $reference);
        if ($insertStmt->execute()) {
            echo "Inserción correcta, ID: " . $insertStmt->insert_id . "\n";
        } else {
            echo "Error en inserción: " . $insertStmt->error . "\n";
        }
        $insertStmt->close();
    } else {
        echo "El id_cotizacion '{$reference}' ya existe en la base de datos.\n";
    }
    $stmt->close();
}
?>