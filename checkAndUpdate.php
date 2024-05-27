<?php
$filePath = __DIR__ . '/monetico_log_recurrent.txt';
$lastModifiedFile = sys_get_temp_dir() . '/last_modified.txt';
$logFile = __DIR__ . '/check_monetico_log.txt';

function logMessage($message)
{
  global $logFile;
  echo $message . "\n";
  file_put_contents($logFile, date('Y-m-d H:i:s') . " - " . $message . "\n", FILE_APPEND);
}

function getLastModifiedTime($lastModifiedFile)
{
  return file_exists($lastModifiedFile) ? file_get_contents($lastModifiedFile) : 0;
}

function updateLastModifiedTime($lastModifiedFile, $time)
{
  file_put_contents($lastModifiedFile, $time);
}

$lastModifiedTime = getLastModifiedTime($lastModifiedFile);
$currentModifiedTime = filemtime($filePath);

if ($currentModifiedTime > $lastModifiedTime) {
  updateLastModifiedTime($lastModifiedFile, $currentModifiedTime);
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

      $jsonDate = DateTime::createFromFormat('d/m/Y', substr($dataArray['date'], 0, 10));

      if ($jsonDate && $jsonDate->format('d/m/Y') == $currentDate) {
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
        ];
      }
    }
  }

  require __DIR__ . '/php/conexion.php';

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
        $fechaInicio = date('Y-m-d');
        $fechaFinal = date('Y-m-d', strtotime('+1 month', strtotime($fechaInicio)));

        $tipoMembresia = 0;
        if (strpos($record['paymentReference'], 'SUB1') !== false) {
          $tipoMembresia = 1;
        } elseif (strpos($record['paymentReference'], 'SUB2') !== false) {
          $tipoMembresia = 2;
        }

        $insertOrUpdateSubs = $conexion->prepare("
                    INSERT INTO wp_subscripcion (fecha_inicio, fecha_final, referencia_pago, estado_membresia, monto, user_id)
                    VALUES (?, ?, ?, '1', ?, ?)
                    ON DUPLICATE KEY UPDATE
                        fecha_inicio = VALUES(fecha_inicio),
                        fecha_final = VALUES(fecha_final),
                        referencia_pago = VALUES(referencia_pago),
                        estado_membresia = VALUES(estado_membresia),
                        monto = VALUES(monto)
                ");
        if (!$insertOrUpdateSubs) {
          logMessage("Error preparando la inserción/actualización de wp_subscripcion: " . $conexion->error);
          continue;
        }

        $insertOrUpdateSubs->bind_param("ssssi", $fechaInicio, $fechaFinal, $record['paymentReference'], $record['montant'], $accountAid);
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