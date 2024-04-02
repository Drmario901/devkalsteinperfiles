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

                if ($codeRetour == 'payetest' || $codeRetour == 'paiement') {
                    insertDataToDatabase($conexion, $reference);
                }
            } else {
                echo "Error al decodificar JSON: " . json_last_error_msg() . "\n";
            }
        }
    }
}

function insertDataToDatabase($conexion, $reference) {
    $query = "SELECT id_cotizacion FROM wp_monetico WHERE id_cotizacion = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $reference);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
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