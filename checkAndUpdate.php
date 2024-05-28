<?php
// Crear la carpeta 'monetico' si no existe
$logDir = __DIR__ . '/monetico';
if (!is_dir($logDir)) {
    mkdir($logDir, 0777, true);
}

// Ruta del archivo de log diario basado en la fecha actual
$filePath = $logDir . '/monetico_log_' . date('Y-m-d') . '.txt';

// Archivo que almacena el último timestamp modificado
$lastModifiedFile = __DIR__ . '/last_modified.txt';

// Ruta del archivo de log para errores y confirmaciones
$logFile = __DIR__ . '/check_monetico_log.txt';

// Función para registrar mensajes en el log
function logMessage($message)
{
    global $logFile;
    echo $message . "\n";
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - " . $message . "\n", FILE_APPEND);
}

// Leer el último timestamp modificado registrado
if (file_exists($lastModifiedFile)) {
    $lastModifiedTime = file_get_contents($lastModifiedFile);
} else {
    $lastModifiedTime = 0;
}

// Obtener el timestamp modificado actual del archivo
$currentModifiedTime = filemtime($filePath);

// Verificar si el archivo ha sido modificado desde la última vez
if ($currentModifiedTime > $lastModifiedTime) {
    // Actualizar el timestamp en el archivo de registro
    file_put_contents($lastModifiedFile, $currentModifiedTime);

    // Leer el contenido del archivo
    $data = file_get_contents($filePath);

    // Dividir el contenido en líneas individuales
    $lines = explode("\n", $data);

    // Obtener la fecha actual del sistema
    $currentDate = date('d/m/Y');

    // Arreglo para rastrear el último registro por userID
    $lastRecords = [];

    // Procesar cada línea individualmente
    foreach ($lines as $line) {
        // Verificar si la línea contiene datos JSON
        if (strpos($line, 'Datos recibidos:') !== false) {
            // Extraer la parte JSON de la línea
            $jsonStr = trim(substr($line, strpos($line, 'Datos recibidos:') + 16));

            // Parsear el contenido del archivo para extraer la información necesaria
            $dataArray = json_decode($jsonStr, true);

            // Verificar si la decodificación fue exitosa
            if (json_last_error() !== JSON_ERROR_NONE) {
                logMessage("Error al decodificar JSON: " . json_last_error_msg());
                continue;
            }

            // Extraer y formatear la fecha del JSON
            $jsonDate = DateTime::createFromFormat('d/m/Y', substr($dataArray['date'], 0, 10));

            // Verificar si la fecha del JSON coincide con la fecha actual
            if ($jsonDate && $jsonDate->format('d/m/Y') == $currentDate) {
                // Obtener los valores necesarios
                $userID = null;
                if (preg_match('/userID:@([\w.-]+)/', $dataArray['texte-libre'], $matches)) {
                    $userID = '@' . $matches[1];
                }

                // Suponiendo que la fecha original está en la variable $originalDate
                $originalDate = $dataArray['date'];
                // Remover caracteres de escape y el texto '_a_'
                $originalDate = str_replace(['\\/', '_a_'], ['/', ' '], $originalDate);
                // Parsear la fecha y hora usando DateTime::createFromFormat
                $dateTime = DateTime::createFromFormat('d/m/Y H:i:s', $originalDate);

                if ($dateTime !== false) {
                    // Formatear la fecha a 'dd/mm/yyyy'
                    $date = $dateTime->format('d/m/Y');
                    // Formatear la fecha y hora a 'dd/mm/yyyy/hh:mm:ss'
                    $datetime = $dateTime->format('d/m/Y/H:i:s');
                } else {
                    $errors = DateTime::getLastErrors();
                    echo "Error al parsear la fecha: " . implode(", ", $errors['errors']) . "\n";
                    continue;
                }

                $subscriptionType = $dataArray['montant'] ?? null;
                $paymentReference = $dataArray['reference'] ?? null;
                $retour = $dataArray['code-retour'] ?? null;
                $montant = $dataArray['montant'] ?? null;

                if (!$userID || !$subscriptionType || !$paymentReference || !$retour || !$montant) {
                    logMessage("Datos faltantes en la entrada: " . $jsonStr);
                    continue;
                }

                // Insertar cada registro en la base de datos
                require __DIR__ . '/php/conexion.php';

                $insertSubs = $conexion->prepare("
                    INSERT INTO wp_subscripcion (fecha_inicio, fecha_final, referencia_pago, estado_membresia, monto, fechahora, user_id, code_retour)
                    VALUES (?, ?, ?, '1', ?, ?, ?, ?)
                ");
                if (!$insertSubs) {
                    logMessage("Error preparando la inserción en wp_subscripcion: " . $conexion->error);
                    continue;
                }

                // Calcular las fechas de inicio y finalización de la membresía (un mes)
                $fechaInicio = $date;
                // Crear un objeto DateTime a partir de la fecha inicial
                $fecha = DateTime::createFromFormat('d/m/Y', $fechaInicio);

                // Añadir un mes
                $fecha->modify('+1 month');

                // Obtener la fecha final en el mismo formato
                $fechaFinal = $fecha->format('Y-m-d');

                $fechaInicio = $dateTime->format('Y-m-d');

                $insertSubs->bind_param("sssssss", $fechaInicio, $fechaFinal, $paymentReference, $montant, $datetime, $userID, $retour);
                $insertSubs->execute();
                $insertSubs->close();

                // Solo actualizar el tipo de membresía si el code-retour es 'payetest'
                if ($retour === 'payetest') {
                    // Actualizar el tipo de membresía basado en el último registro
                    $lastRecords[$userID] = [
                        'tipoMembresia' => (strpos($paymentReference, 'SUB1') !== false) ? 1 : ((strpos($paymentReference, 'SUB2') !== false) ? 2 : 0),
                        'userID' => $userID
                    ];
                }

                logMessage("Registro insertado para user_tag: $userID");
            }
        }
    }

    // Conectar a la base de datos
    require __DIR__ . '/php/conexion.php';

    // Procesar las actualizaciones de los usuarios basadas en el último registro
    foreach ($lastRecords as $record) {
        $updateAccount = $conexion->prepare("UPDATE wp_account SET tipo_membresia = ? WHERE user_tag = ?");
        if (!$updateAccount) {
            logMessage("Error preparando la actualización de wp_account: " . $conexion->error);
            continue;
        }

        $updateAccount->bind_param("is", $record['tipoMembresia'], $record['userID']);
        $updateAccount->execute();
        $updateAccount->close();

        logMessage("Actualización exitosa para user_tag: " . $record['userID']);
    }

    logMessage("Procesamiento completado.");
} else {
    logMessage("No se encontraron modificaciones recientes en el archivo.");
}
?>
