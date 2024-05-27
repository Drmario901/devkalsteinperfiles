<?php
$filePath = __DIR__ . '/monetico_log_recurrent.txt';
$logFile = __DIR__ . '/check_monetico_log.txt';

// Función para registrar mensajes en el log
function logMessage($message)
{
  global $logFile;
  echo $message . "\n";
  file_put_contents($logFile, date('Y-m-d H:i:s') . " - " . $message . "\n", FILE_APPEND);
}

// Conectar a la base de datos
require __DIR__ . '/php/conexion.php';

// Leer el último timestamp modificado registrado desde la base de datos
$query = "SELECT last_modified_time FROM last_check WHERE file_path = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("s", $filePath);
$stmt->execute();
$stmt->bind_result($lastModifiedTime);
$stmt->fetch();
$stmt->close();

if (!$lastModifiedTime) {
  $lastModifiedTime = 0;
}

// Obtener el timestamp modificado actual del archivo
$currentModifiedTime = filemtime($filePath);

if ($currentModifiedTime > $lastModifiedTime) {
  // Actualizar el timestamp en la base de datos
  $query = "INSERT INTO last_check (file_path, last_modified_time) VALUES (?, ?)
              ON DUPLICATE KEY UPDATE last_modified_time = ?";
  $stmt = $conexion->prepare($query);
  $stmt->bind_param("sii", $filePath, $currentModifiedTime, $currentModifiedTime);
  $stmt->execute();
  $stmt->close();

  $data = file_get_contents($filePath);
  $lines = explode("\n", $data);
  $currentDate = date('d/m/Y');
  $lastRecords = [];

  foreach ($lines as $line) {
    if (strpos($line, 'Datos recibidos:') !== false) {
      $jsonStr = trim(substr($line, strpos($line, 'Datos recibidos:') + 16));
      $dataArray = json_decode($jsonStr, true);

      if (json_last_error() !== JSON_ERROR_NONE) {
        logMessage("Error al decodificar JSON: " . json_last_error_msg());
        continue;
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

      $userID = null;
      if (preg_match('/userID:@([\w.-]+)/', $dataArray['texte-libre'], $matches)) {
        $userID = '@' . $matches[1];
      }

      $subscriptionType = $dataArray['montant'] ?? null;
      $paymentReference = $dataArray['reference'] ?? null;
      $retour = $dataArray['code-retour'] ?? null;
      $montant = $dataArray['montant'] ?? null;

      if (!$userID || !$subscriptionType || !$paymentReference || !$retour || !$montant) {
        logMessage("Datos faltantes en la entrada: " . $jsonStr);
        continue;
      }

      $lastRecords[$userID] = [
        'subscriptionType' => $subscriptionType,
        'paymentReference' => $paymentReference,
        'retour' => $retour,
        'montant' => $montant,
        'date' => $date,
        'datetime' => $datetime
      ];
    }
  }

  foreach ($lastRecords as $userID => $record) {
    if ($record['retour'] === 'payetest') {
      $stmt = $conexion->prepare("SELECT account_aid FROM wp_account WHERE user_tag = ?");
      if (!$stmt) {
        logMessage("Error preparando la consulta: " . $conexion->error);
        continue;
      }

      $stmt->bind_param("s", $userID);
      $stmt->execute();
      $stmt->bind_result($accountAid);
      $stmt->fetch();
      $stmt->close();

      if ($accountAid) {

        $fechaInicio = $record['date'];
        $fechaFinal = date('m-d-Y', strtotime('+1 month', $fechaInicio));

        $tipoMembresia = 0;
        if (strpos($record['paymentReference'], 'SUB1') !== false) {
          $tipoMembresia = 1;
        } elseif (strpos($record['paymentReference'], 'SUB2') !== false) {
          $tipoMembresia = 2;
        }

        $insertOrUpdateSubs = $conexion->prepare("
                    INSERT INTO wp_subscripcion (fecha_inicio, fecha_final, referencia_pago, estado_membresia, monto, fecha, fechahora, user_id)
                    VALUES (?, ?, ?, '1', ?, ?, ?, ?)
                    ON DUPLICATE KEY UPDATE
                        fecha_inicio = VALUES(fecha_inicio),
                        fecha_final = VALUES(fecha_final),
                        referencia_pago = VALUES(referencia_pago),
                        estado_membresia = VALUES(estado_membresia),
                        monto = VALUES(monto),
                        fecha = VALUES(fecha),
                        fechahora = VALUES(fechahora)
                ");
        if (!$insertOrUpdateSubs) {
          logMessage("Error preparando la inserción/actualización de wp_subscripcion: " . $conexion->error);
          continue;
        }

        $insertOrUpdateSubs->bind_param("ssssssi", $fechaInicio, $fechaFinal, $record['paymentReference'], $record['montant'], $record['date'], $record['datetime'], $accountAid);
        $insertOrUpdateSubs->execute();
        $insertOrUpdateSubs->close();

        $updateAccount = $conexion->prepare("UPDATE wp_account SET tipo_membresia = ? WHERE account_aid = ?");
        if (!$updateAccount) {
          logMessage("Error preparando la actualización de wp_account: " . $conexion->error);
          continue;
        }

        $updateAccount->bind_param("ii", $tipoMembresia, $accountAid);
        $updateAccount->execute();
        $updateAccount->close();

        logMessage("Actualización exitosa para user_tag: $userID");
      } else {
        logMessage("No se encontró account_aid para user_tag: $userID");
      }
    } else {
      logMessage("El pago no se procesó correctamente.");
    }
  }
} else {
  logMessage("No se encontraron modificaciones recientes en el archivo.");
}
?>