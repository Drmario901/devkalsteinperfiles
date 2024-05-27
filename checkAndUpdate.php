<?php
// Ruta del archivo que deseas monitorear
$filePath = __DIR__ . '/monetico_log_recurrent.txt';

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
  }

  // Conectar a la base de datos
  require __DIR__ . '/php/conexion.php';

  // Procesar los últimos registros únicos
  foreach ($lastRecords as $userID => $record) {
    if ($record['retour'] === 'payetest') {
      // Obtener account_aid desde wp_account
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
        // Calcular las fechas de inicio y finalización de la membresía (un mes)
        $fechaInicio = $record['date'];
        // Crear un objeto DateTime a partir de la fecha inicial
        $fecha = DateTime::createFromFormat('d/m/Y', $fechaInicio);

        // Añadir un mes
        $fecha->modify('+1 month');

        // Obtener la fecha final en el mismo formato
        $fechaFinal = $fecha->format('d/m/Y');

        // Determinar el tipo de membresía basado en la referencia
        $tipoMembresia = 0;
        if (strpos($record['paymentReference'], 'SUB1') !== false) {
          $tipoMembresia = 1;
        } elseif (strpos($record['paymentReference'], 'SUB2') !== false) {
          $tipoMembresia = 2;
        }

        // Actualizar o insertar en la tabla wp_subscripcion
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

        // Actualizar el tipo de membresía en la tabla wp_account
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