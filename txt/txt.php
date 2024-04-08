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
                // Extraer solo los 3 dígitos de la referencia

                $referenceRaw = $jsonData->reference ?? 'No encontrado';
                preg_match('/\d{3}/', $referenceRaw, $matches);
                $reference = intval($matches[0]);

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

// function insertDataToDatabase($conexion, $reference, $montoTotal, $divisa) {
//     $query = "SELECT id_cotizacion FROM wp_monetico WHERE id_cotizacion = ?";
//     $stmt = $conexion->prepare($query);
//     $stmt->bind_param("s", $reference);
//     $stmt->execute();
//     $result = $stmt->get_result();
    
//     if ($result->num_rows === 0) {

//         $queryCotizacion = "SELECT cotizacion_id_remitente FROM wp_cotizaciones WHERE cotizacion_id = ?";
//         $stmtCotizacion = $conexion->prepare($queryCotizacion);
//         $stmtCotizacion->bind_param("i", $reference);
//         $stmtCotizacion->execute();
//         $resultCotizacion = $stmtCotizacion->get_result();

//         // Modificar para incluir monto_total y cotizacion_divisa en la inserción
//         $insertQuery = "INSERT INTO wp_monetico (id_cotizacion, monto_total, cotizacion_divisa) VALUES (?, ?, ?)";
//         $insertStmt = $conexion->prepare($insertQuery);
//         // Asegúrate de que el tipo de dato corresponda con tu esquema de base de datos
//         $insertStmt->bind_param("sds", $reference, $montoTotal, $divisa);
//         if ($insertStmt->execute()) {
//             echo "Inserción correcta, ID: " . $insertStmt->insert_id . ", Monto: " . $montoTotal . " " . $divisa . "\n";
//         } else {
//             echo "Error en inserción: " . $insertStmt->error . "\n";
//         }
//         $insertStmt->close();
//     } else {
//         echo "El id_cotizacion '{$reference}' ya existe en la base de datos.\n";
//     }
//     $stmt->close();
// }

function insertDataToDatabase($conexion, $reference, $montoTotal, $divisa) {
    // Primero, verificar si el id_cotizacion ya existe en wp_monetico
    $query = "SELECT id_cotizacion FROM wp_monetico WHERE id_cotizacion = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $reference);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        // Ahora, buscar cotizacion_id_remitente en wp_cotizaciones
        $queryCotizacion = "SELECT cotizacion_id_remitente FROM wp_cotizaciones WHERE cotizacion_id = ?";
        $stmtCotizacion = $conexion->prepare($queryCotizacion);
        $stmtCotizacion->bind_param("i", $reference);
        $stmtCotizacion->execute();
        $resultCotizacion = $stmtCotizacion->get_result();
        
        if ($resultCotizacion->num_rows > 0) {
            // Si se encuentra, obtiene el cotizacion_id_remitente
            $row = $resultCotizacion->fetch_assoc();
            $cotizacionIdRemitente = $row['cotizacion_id_remitente'];
            
            // Continúa con la inserción usando $cotizacionIdRemitente según sea necesario
            $insertQuery = "INSERT INTO wp_monetico (id_cotizacion, monto_total, cotizacion_divisa, cotizacion_id_remitente) VALUES (?, ?, ?, ?)";
            $insertStmt = $conexion->prepare($insertQuery);
            // Asegúrate de que el tipo de dato corresponda con tu esquema de base de datos. Suponiendo que cotizacion_id_remitente es un entero
            $insertStmt->bind_param("idss", $reference, $montoTotal, $divisa, $cotizacionIdRemitente);
            
            if ($insertStmt->execute()) {
                echo "Inserción correcta, ID: " . $insertStmt->insert_id . ", Monto: " . $montoTotal . " " . $divisa . ", ID Remitente: " . $cotizacionIdRemitente . "\n";
            } else {
                echo "Error en inserción: " . $insertStmt->error . "\n";
            }
            $insertStmt->close();
        } else {
            echo "No se encontró cotizacion_id_remitente para '{$reference}'.\n";
            // Considera si necesitas manejar este caso específico de alguna manera
        }
        $stmtCotizacion->close();
    } else {
        echo "El id_cotizacion '{$reference}' ya existe en la base de datos.\n";
    }
    $stmt->close();
}


?>
