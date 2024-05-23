<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
require '/path/to/conexion.php'; // Asegúrate de ajustar la ruta a tu archivo de conexión

use DansMaCulotte\Monetico\Monetico;
use DansMaCulotte\Monetico\Responses\PurchaseResponse;

$data = $_POST;
file_put_contents('monetico_log_recurrent.txt', date('Y-m-d H:i:s') . " - Datos recibidos: " . json_encode($data) . "\n", FILE_APPEND);

if (!empty($data)) {
    $monetico = new Monetico('7593339', '255D023E7A0BDE9EEAC7516959CD93A9854F3991', 'kalsteinfr');
    $response = new PurchaseResponse($data);
    $result = $monetico->validate($response);

    if ($result) {
        echo "version=2\ncdr=0";

        // Procesar los datos recibidos
        $texteLibre = $data['texte-libre'];
        preg_match('/userID:@(\w+)/', $texteLibre, $matches);
        $userID = $matches[1];

        // Obtener account_aid desde wp_account
        $stmt = $conexion->prepare("SELECT account_aid FROM wp_account WHERE user_tag = ?");
        $stmt->bind_param("s", $userID);
        $stmt->execute();
        $stmt->bind_result($accountAid);
        $stmt->fetch();
        $stmt->close();

        if ($accountAid) {
            // Calcular las fechas de inicio y finalización de la membresía
            $fechaInicio = date('Y-m-d');
            $fechaFinal = date('Y-m-d', strtotime('+1 year'));

            // Determinar el tipo de membresía basado en la referencia
            $tipoMembresia = 0;
            if (strpos($data['reference'], 'SUB1') !== false) {
                $tipoMembresia = 1;
            } elseif (strpos($data['reference'], 'SUB2') !== false) {
                $tipoMembresia = 2;
            }

            // Actualizar la tabla wp_subscripcion
            $updateSubs = $conexion->prepare("UPDATE wp_subscripcion SET fecha_inicio = ?, fecha_final = ?, referencia_pago = ?, estado_membresia = 'activo', user_id = ? WHERE user_id = ?");
            $updateSubs->bind_param("sssii", $fechaInicio, $fechaFinal, $data['reference'], $accountAid, $accountAid);
            $updateSubs->execute();
            $updateSubs->close();

            // Actualizar el tipo de membresía en la tabla wp_account
            $updateAccount = $conexion->prepare("UPDATE wp_account SET tipo_membresia = ? WHERE account_aid = ?");
            $updateAccount->bind_param("ii", $tipoMembresia, $accountAid);
            $updateAccount->execute();
            $updateAccount->close();

            file_put_contents('monetico_log_recurrent.txt', date('Y-m-d H:i:s') . " - Actualización exitosa para userID: $userID\n", FILE_APPEND);
        } else {
            file_put_contents('monetico_log_recurrent.txt', date('Y-m-d H:i:s') . " - ERROR: userID no encontrado.\n", FILE_APPEND);
        }
    } else {
        echo "version=2\ncdr=1";
        file_put_contents('monetico_log_recurrent.txt', date('Y-m-d H:i:s') . " - Validación fallida.\n", FILE_APPEND);
    }
} else {
    echo "ERROR: No se recibieron datos.";
    file_put_contents('monetico_log_recurrent.txt', date('Y-m-d H:i:s') . " - ERROR: No se recibieron datos.\n", FILE_APPEND);
}
?>