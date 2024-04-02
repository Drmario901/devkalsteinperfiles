<?php
function procesarArchivoMonetico($archivo, $conexion) {
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
                $montoTotalConMoneda = $jsonData->montant ?? '0';

                // Extraer solo el monto numérico del string
                preg_match('/\d+(\.\d+)?/', $montoTotalConMoneda, $matches);
                $montoTotal = $matches[0] ?? 0;

                if ($codeRetour == 'payetest' || $codeRetour == 'paiement') {
                    insertDataToDatabase($conexion, $reference, $montoTotal);
                }
            } else {
                echo "Error al decodificar JSON: " . json_last_error_msg() . "\n";
            }
        }
    }
}

function insertDataToDatabase($conexion, $reference, $montoTotal) {
    $query = "SELECT id_cotizacion FROM wp_monetico WHERE id_cotizacion = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $reference);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        // Modificar para incluir monto_total en la inserción
        $insertQuery = "INSERT INTO wp_monetico (id_cotizacion, monto_total) VALUES (?, ?)";
        $insertStmt = $conexion->prepare($insertQuery);
        // Asegúrate de que el tipo de dato corresponda con tu esquema de base de datos
        $insertStmt->bind_param("sd", $reference, $montoTotal);
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