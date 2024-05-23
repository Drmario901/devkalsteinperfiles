<?php
// Ruta del archivo que deseas monitorear
$filePath = __DIR__ . '/monetico_log_recurrent.txt';

// Archivo que almacena el último timestamp modificado
$lastModifiedFile = __DIR__ . '/last_modified.txt';

// Ruta del archivo de log para errores
$errorLogFile = __DIR__ . '/error_log.txt';

// Función para registrar errores
function logError($message)
{
  global $errorLogFile;
  file_put_contents($errorLogFile, date('Y-m-d H:i:s') . " - " . $message . "\n", FILE_APPEND);
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

  // Parsear el contenido del archivo para extraer la información necesaria
  // Esto dependerá del formato del archivo

  // Suponiendo que el archivo contiene JSON
  $dataArray = json_decode($data, true);

  // Verificar si la decodificación fue exitosa
  if (json_last_error() !== JSON_ERROR_NONE) {
    logError("Error al decodificar JSON: " . json_last_error_msg());
    exit;
  }

  // Procesar los datos
  foreach ($dataArray as $entry) {
    // Obtener los valores necesarios
    $userID = $entry['userID'] ?? null;
    $subscriptionType = $entry['subscriptionType'] ?? null;
    $paymentReference = $entry['paymentReference'] ?? null;

    // Validar que los valores necesarios no estén vacíos
    if (!$userID || !$subscriptionType || !$paymentReference) {
      logError("Datos faltantes en la entrada: " . json_encode($entry));
      continue;
    }

    // Conectar a la base de datos
    require __DIR__ . '/php/conexion.php';

    // Obtener account_aid desde wp_account
    $stmt = $conexion->prepare("SELECT account_aid FROM wp_account WHERE user_tag = ?");
    if (!$stmt) {
      logError("Error preparando la consulta: " . $conexion->error);
      continue;
    }

    $stmt->bind_param("s", $userID);
    $stmt->execute();
    $stmt->bind_result($accountAid);
    $stmt->fetch();
    $stmt->close();

    if ($accountAid) {
      // Calcular las fechas de inicio y finalización de la membresía (un mes)
      $fechaInicio = date('Y-m-d');
      $fechaFinal = date('Y-m-d', strtotime('+1 month'));

      // Determinar el tipo de membresía basado en la referencia
      $tipoMembresia = 0;
      if (strpos($paymentReference, 'SUB1') !== false) {
        $tipoMembresia = 1;
      } elseif (strpos($paymentReference, 'SUB2') !== false) {
        $tipoMembresia = 2;
      }

      // Actualizar la tabla wp_subscripcion
      $updateSubs = $conexion->prepare("UPDATE wp_subscripcion SET fecha_inicio = ?, fecha_final = ?, referencia_pago = ?, estado_membresia = 'activo', user_id = ? WHERE user_id = ?");
      if (!$updateSubs) {
        logError("Error preparando la actualización de wp_subscripcion: " . $conexion->error);
        continue;
      }

      $updateSubs->bind_param("sssii", $fechaInicio, $fechaFinal, $paymentReference, $accountAid, $accountAid);
      $updateSubs->execute();
      $updateSubs->close();

      // Actualizar el tipo de membresía en la tabla wp_account
      $updateAccount = $conexion->prepare("UPDATE wp_account SET tipo_membresia = ? WHERE account_aid = ?");
      if (!$updateAccount) {
        logError("Error preparando la actualización de wp_account: " . $conexion->error);
        continue;
      }

      $updateAccount->bind_param("ii", $tipoMembresia, $accountAid);
      $updateAccount->execute();
      $updateAccount->close();
    } else {
      logError("No se encontró account_aid para user_tag: $userID");
    }
  }
}
?>