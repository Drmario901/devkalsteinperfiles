<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/db/conexion.php';

$archivoLog = "/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/monetico_log_recurrent.txt";
$membershipType = ['SUB1' => 1, 'SUB2' => 2];

function processLogFile($filePath, $membershipType, $conexion)
{
    $handle = fopen($filePath, "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $data = json_decode(substr($line, strpos($line, '{')), true);

            if ($data && $data['code-retour'] === 'payetest') {
                preg_match("/@(\w+)-/", $data['reference'], $userTagMatches);
                preg_match("/Membresia-(\w+)-/", $data['reference'], $membershipMatches);
                $reference = $data['reference'];
                $userTag = "@" . $userTagMatches[1] ?? null;
                $membershipId = $membershipMatches[1] ?? null;
                $membershipValue = $membershipType[$membershipId] ?? null;

                echo "userTag: $userTag, membershipValue: $membershipValue\n";

                if ($userTag && $membershipValue !== null) {
                    $stmt_ID = $conexion->prepare("SELECT account_aid FROM wp_account WHERE user_tag = ?");
                    if ($stmt_ID) {
                        $stmt_ID->bind_param("s", $userTag);
                        $stmt_ID->execute();
                        $result_ID = $stmt_ID->get_result();
                        if ($result_ID->num_rows > 0) {
                            $row_ID = $result_ID->fetch_assoc();
                            $accountId = $row_ID['account_aid'];
                            echo "account_aid: $accountId\n"; // Muestra el ID del usuario
                            //! Upsert en la tabla de wp_subscripcion
                            $stmt_subs = $conexion->prepare("INSERT INTO wp_subscripcion (fecha_inicio, fecha_final, referencia_pago, estado_membresia, user_id) VALUES (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE fecha_inicio = VALUES(fecha_inicio), fecha_final = VALUES(fecha_final), referencia_pago = VALUES(referencia_pago), estado_membresia = VALUES(estado_membresia)");
                            $fechaInicio = new DateTime(); // Fecha actual
                            $fechaFinal = new DateTime();
                            $fechaFinal->modify('+30 days'); // Sumamos 30 días

                            // Formateamos las fechas y preparamos otros datos
                            $fechaInicioStr = $fechaInicio->format('Y-m-d');
                            $fechaFinalStr = $fechaFinal->format('Y-m-d');
                            $estadoMembresia = $membershipValue;  // Asumiendo que es un integer que representa el estado

                            if ($stmt_subs) {
                                $stmt_subs->bind_param("sssii", $fechaInicioStr, $fechaFinalStr, $reference, $estadoMembresia, $accountId);
                                if ($stmt_subs->execute()) {
                                    echo "Suscripción actualizada/insertada correctamente.\n";
                                } else {
                                    echo "Error al insertar/actualizar suscripción: " . $stmt_subs->error . "\n";
                                }
                            } else {
                                echo "Error al preparar la consulta de inserción/actualización: " . $conexion->error . "\n";
                            }
                        }
                    }

                    //! Hacemos update del tipo de membresia;
                    $stmt = $conexion->prepare("UPDATE wp_account SET tipo_membresia = ? WHERE user_tag = ?");
                    if ($stmt) {
                        $stmt->bind_param("is", $membershipValue, $userTag);
                        if ($stmt->execute()) {
                            //echo "Membresía actualizada correctamente para el userTag: $userTag\n";
                        } else {
                            //echo "Error al actualizar la membresía para el userTag: $userTag. Error: " . $stmt->error . "\n";
                        }
                    } else {
                        //echo "Error al preparar la consulta SQL: " . $conexion->error . "\n";
                    }
                } else {
                    // echo "Datos inválidos o información faltante: userTag ($userTag), membershipValue ($membershipValue)\n";
                }
            }
        }

        fclose($handle);
    } else {
        echo "Unable to open file: $filePath\n";
    }
}

processLogFile($archivoLog, $membershipType, $conexion);
