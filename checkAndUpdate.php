<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

logMessage("Iniciando procesamiento del archivo de log: " . $filePath);

// Leer el contenido del archivo
$data = file_get_contents($filePath);
if ($data === false) {
    logMessage("Error al leer el archivo de log: " . $filePath);
    exit;
}

logMessage("Archivo de log leído exitosamente.");

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

logMessage("Última línea válida encontrada en el archivo de log: " . $lastLogLine);

// Extraer la parte JSON de la última línea del log
$jsonStr = trim(substr($lastLogLine, strpos($lastLogLine, 'Datos recibidos:') + 16));

// Parsear el JSON
$lastLogData = json_decode($jsonStr, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    logMessage("Error al decodificar JSON del último registro del log: " . json_last_error_msg());
    exit;
}

logMessage("Último registro del log decodificado exitosamente.");

// Conectar a la base de datos
require __DIR__ . '/php/conexion.php';
logMessage("Conexión a la base de datos establecida.");

// Obtener el último registro de la base de datos basado en la referencia
$lastReference = $lastLogData['reference'];
$result = $conexion->query("SELECT referencia_pago FROM wp_subscripcion ORDER BY ID DESC LIMIT 1");
if (!$result) {
    logMessage("Error al preparar la consulta a la base de datos: " . $conexion->error);
    exit;
}

logMessage("Consulta a la base de datos ejecutada exitosamente.");

$result->close();

logMessage("Última referencia en la base de datos: " . $result);

if ($result === $lastReference) {
    logMessage("No hay cambios en los registros.");
    exit;
}

logMessage("Procesando registros del archivo de log.");

// Procesar los registros del archivo de log
$lastRecords = [];
foreach ($lines as $line) {
    logMessage("Procesando línea: " . $line);
    if (strpos($line, 'Datos recibidos:') !== false) {
        // Extraer la parte JSON de la línea
        $jsonStr = trim(substr($line, strpos($line, 'Datos recibidos:') + 16));
        logMessage("JSON extraído: " . $jsonStr);

        // Parsear el JSON
        $dataArray = json_decode($jsonStr, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            logMessage("Error al decodificar JSON: " . json_last_error_msg());
            continue;
        }
        logMessage("Datos JSON decodificados: " . print_r($dataArray, true));

        // Extraer y formatear la fecha del JSON
        $jsonDate = DateTime::createFromFormat('d/m/Y', substr($dataArray['date'], 0, 10));
        if (!$jsonDate) {
            logMessage("Error al parsear la fecha del JSON: " . implode(", ", DateTime::getLastErrors()['errors']));
            continue;
        }
        logMessage("Fecha del JSON: " . $jsonDate->format('Y-m-d'));

        // Obtener los valores necesarios
        $userID = null;
        if (preg_match('/userID:@([\w.-]+)/', $dataArray['texte-libre'], $matches)) {
            $userID = '@' . $matches[1];
        }
        logMessage("userID extraído: " . $userID);

        $sql = "SELECT account_aid FROM wp_account WHERE user_tag = '$userID'";
        $result = $conexion->query($sql);
        if (!$result) {
            logMessage("Error al consultar la cuenta: " . $conexion->error);
            continue;
        }
        $row = $result->fetch_assoc();
        $accountID = $row['account_aid'];
        logMessage("ID de la cuenta: " . $accountID);

        // Obtener el monto de la transacción
        $montant = $dataArray['montant'] ?? null;
        logMessage("Monto de la transacción: " . $montant);

        // Suponiendo que la fecha original está en la variable $originalDate
        $originalDate = $dataArray['date'];
        logMessage("Fecha original: " . $originalDate);
        // Remover caracteres de escape y el texto '_a_'
        $originalDate = str_replace(['\\/', '_a_'], ['/', ' '], $originalDate);
        logMessage("Fecha original formateada: " . $originalDate);
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
        logMessage("Fecha y hora formateadas: " . $datetime);

        $subscriptionType = $dataArray['montant'] ?? null;
        $paymentReference = $dataArray['reference'] ?? null;
        $retour = $dataArray['code-retour'] ?? null;
        $montant = $dataArray['montant'] ?? null;

        logMessage("Datos obtenidos - subscriptionType: $subscriptionType, paymentReference: $paymentReference, retour: $retour, montant: $montant");

        if (!$userID || !$subscriptionType || !$paymentReference || !$retour || !$montant) {
            logMessage("Datos faltantes en la entrada: " . $jsonStr);
            continue;
        }

        // Depuración adicional para verificar las variables
        logMessage("Variables antes de la inserción - fechaInicio: $fechaInicio, fechaFinal: (calculando), paymentReference: $paymentReference, montant: $montant, datetime: $datetime, userID: $userID, retour: $retour");

        // Insertar el registro en la base de datos
        $insertSubs = $conexion->prepare("
            INSERT INTO wp_subscripcion (code_retour, fecha_inicio, fecha_final, referencia_pago, estado_membresia, monto, fechahora, user_id)
            VALUES (?, ?, ?, ?, '1', ?, ?, ?)
        ");
        if (!$insertSubs) {
            logMessage("Error preparando la inserción en wp_subscripcion: " . $conexion->error);
            continue;
        }
        logMessage("Preparación de inserción exitosa.");

        // Calcular la fecha final (un mes después de la fecha de inicio)
        $fechaFinal = (new DateTime($fechaInicio))->modify('+1 month')->format('Y-m-d');
        logMessage("Fecha final calculada: " . $fechaFinal);

        // Más depuración justo antes de la inserción
        logMessage("Ejecutando inserción con valores - fechaInicio: $fechaInicio, fechaFinal: $fechaFinal, paymentReference: $paymentReference, montant: $montant, datetime: $datetime, userID: $accountID");

        $insertSubs->bind_param("sssssss", $retour, $fechaInicio, $fechaFinal, $paymentReference, $montant, $datetime, $accountID);
        if (!$insertSubs->execute()) {
            if ($insertSubs->errno == 1062) {
                logMessage("Error de duplicado: La referencia de pago ya existe.");
            } else {
                logMessage("Error al insertar el registro en wp_subscripcion: " . $insertSubs->error);
            }
            continue;
        }
        $insertSubs->close();

        logMessage("Registro insertado para user_tag: $userID, referencia: $paymentReference");

        // Solo actualizar el tipo de membresía si el code-retour es 'payetest'
        if ($retour === 'payetest') {
            // Actualizar el tipo de membresía basado en el último registro
            $lastRecords[$accountID] = [
                'tipoMembresia' => (strpos($paymentReference, 'SUB1') !== false) ? 1 : ((strpos($paymentReference, 'SUB2') !== false) ? 2 : 0),
                'userID' => $accountID
            ];
        }
    }
}

logMessage("Actualización de tipos de membresía basadas en el último registro.");

// Procesar las actualizaciones de los usuarios basadas en el último registro
foreach ($lastRecords as $record) {
    $updateAccount = $conexion->prepare("UPDATE wp_account SET tipo_membresia = ? WHERE account_aid = ?");
    if (!$updateAccount) {
        logMessage("Error preparando la actualización de wp_account: " . $conexion->error);
        continue;
    }

    $updateAccount->bind_param("is", $record['tipoMembresia'], $record['userID']);
    if (!$updateAccount->execute()) {
        logMessage("Error al actualizar wp_account: " . $updateAccount->error);
        continue;
    }
    $updateAccount->close();

    logMessage("Actualización exitosa para user_tag: " . $record['userID']);
}

logMessage("Procesamiento completado.");
logMessage("--------------------------------------------");
?>