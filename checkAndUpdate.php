<?php
// Crear la carpeta 'monetico' si no existe
$logDir = __DIR__ . '/monetico';
if (!is_dir($logDir)) {
    mkdir($logDir, 0777, true);
}

// Ruta del archivo de log diario basado en la fecha actual
$filePath = $logDir . '/monetico_log_' . date('Y-m-d') . '.txt';

// Ruta del archivo de log para errores y confirmaciones
$logFile = __DIR__ . '/check_monetico_log.txt';

// Función para registrar mensajes en el log
function logMessage($message)
{
    global $logFile;
    echo $message . "\n";
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - " . $message . "\n", FILE_APPEND);
}

// Leer el contenido del archivo
$data = file_get_contents($filePath);

// Dividir el contenido en líneas individuales
$lines = explode("\n", $data);

// Obtener la última línea con datos válidos del archivo de log
$lastLogLine = '';
for ($i = count($lines) - 1; $i >= 0; $i--) {
    if (strpos($lines[$i], 'Datos recibidos:') !== false) {
        $lastLogLine = $lines[$i];
        break;
    }
}

if (empty($lastLogLine)) {
    logMessage("No hay registros válidos en el archivo de log.");
    exit;
}

// Extraer la parte JSON de la última línea del log
$jsonStr = trim(substr($lastLogLine, strpos($lastLogLine, 'Datos recibidos:') + 16));

// Parsear el JSON
$lastLogData = json_decode($jsonStr, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    logMessage("Error al decodificar JSON del último registro del log: " . json_last_error_msg());
    exit;
}

// Conectar a la base de datos
require __DIR__ . '/php/conexion.php';

// Obtener el último registro de la base de datos basado en la referencia
$lastReference = $lastLogData['reference'];
$result = $conexion->prepare("SELECT referencia_pago FROM wp_subscripcion WHERE referencia_pago = ? ORDER BY fechahora DESC LIMIT 1");
if (!$result) {
    logMessage("Error al consultar la base de datos: " . $conexion->error);
    exit;
}

$result->bind_param("s", $lastReference);
$result->execute();
$result->bind_result($dbReference);
$result->fetch();
$result->close();

if ($dbReference === $lastReference) {
    logMessage("No hay cambios en los registros.");
    exit;
}

// Procesar los registros del archivo de log
$lastRecords = [];
foreach ($lines as $line) {
    if (strpos($line, 'Datos recibidos:') !== false) {
        // Extraer la parte JSON de la línea
        $jsonStr = trim(substr($line, strpos($line, 'Datos recibidos:') + 16));

        // Parsear el JSON
        $dataArray = json_decode($jsonStr, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            logMessage("Error al decodificar JSON: " . json_last_error_msg());
            continue;
        }

        // Extraer y formatear la fecha del JSON
        $jsonDate = DateTime::createFromFormat('d/m/Y', substr($dataArray['date'], 0, 10));

        if (!$jsonDate) {
            logMessage("Error al parsear la fecha del JSON: " . implode(", ", DateTime::getLastErrors()['errors']));
            continue;
        }

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
            // Formatear la fecha a 'yyyy-mm-dd'
            $fechaInicio = $dateTime->format('Y-m-d');
            // Formatear la fecha y hora a 'yyyy-mm-dd hh:mm:ss'
            $datetime = $dateTime->format('Y-m-d H:i:s');
        } else {
            logMessage("Error al parsear la fecha y hora del JSON: " . implode(", ", DateTime::getLastErrors()['errors']));
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

        // Insertar el registro en la base de datos
        $insertSubs = $conexion->prepare("
            INSERT INTO wp_subscripcion (fecha_inicio, fecha_final, referencia_pago, estado_membresia, monto, fechahora, user_id, code_retour)
            VALUES (?, ?, ?, '1', ?, ?, ?, ?)
        ");
        if (!$insertSubs) {
            logMessage("Error preparando la inserción en wp_subscripcion: " . $conexion->error);
            continue;
        }

        // Calcular la fecha final (un mes después de la fecha de inicio)
        $fechaFinal = (new DateTime($fechaInicio))->modify('+1 month')->format('Y-m-d');

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
?>
