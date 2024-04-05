<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function procesarArchivoMonetico($archivo, $conexion) {
    if (!is_readable($archivo)) {
        die("El archivo no existe o no se puede leer.");
    }

    $lines = file($archivo);
    print_r($lines);



    foreach ($lines as $line) {
        if (strpos($line, 'Datos recibidos:') !== false) {
            $jsonString = substr($line, strpos($line, '{'));
            $jsonData = json_decode($jsonString);

            if ($jsonData !== null && json_last_error() === JSON_ERROR_NONE) {
                $reference = $jsonData->reference ?? 'No encontrado';
                $codeRetour = $jsonData->{'code-retour'} ?? 'No encontrado';
                $montoTotalConMoneda = $jsonData->montant ?? '0';

                // Extraer solo el monto numérico y la divisa del string
                preg_match('/(\d+(\.\d+)?)([A-Z]+)/', $montoTotalConMoneda, $matches);
                $montoTotal = $matches[1] ?? 0; // Monto numérico
                $divisa = $matches[3] ?? 'No encontrada'; // Divisa

                if ($codeRetour == 'payetest' || $codeRetour == 'paiement') {
                    insertDataToDatabase($conexion, $reference, $montoTotal, $divisa);
                }
            } else {
                echo "Error al decodificar JSON: " . json_last_error_msg() . "\n";
            }
        }
    }
}

function insertDataToDatabase($conexion, $reference, $montoTotal, $divisa) {
    $query = "SELECT id_cotizacion FROM wp_monetico WHERE id_cotizacion = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $reference);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        // Modificar para incluir monto_total y cotizacion_divisa en la inserción
        $insertQuery = "INSERT INTO wp_monetico (id_cotizacion, monto_total, cotizacion_divisa) VALUES (?, ?, ?)";
        $insertStmt = $conexion->prepare($insertQuery);
        // Asegúrate de que el tipo de dato corresponda con tu esquema de base de datos
        $insertStmt->bind_param("sds", $reference, $montoTotal, $divisa);
        if ($insertStmt->execute()) {
            echo "Inserción correcta, ID: " . $insertStmt->insert_id . ", Monto: " . $montoTotal . " " . $divisa . "\n";
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
