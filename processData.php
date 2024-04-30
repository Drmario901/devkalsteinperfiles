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

                $userTag = $userTagMatches[1] ?? null;
                $membershipId = $membershipMatches[1] ?? null;
                $membershipValue = $membershipType[$membershipId] ?? null;

                echo "userTag: $userTag, membershipValue: $membershipValue\n";

                if ($userTag && $membershipValue !== null) {
                    $stmt = $conexion->prepare("UPDATE wp_account SET tipo_membresia = ? WHERE user_tag = ?");
                    if ($stmt) {
                        $stmt->bind_param("is", $membershipValue, $userTag);
                        if ($stmt->execute()) {
                            echo "Membresía actualizada correctamente para el userTag: $userTag\n";
                        } else {
                            echo "Error al actualizar la membresía para el userTag: $userTag. Error: " . $stmt->error . "\n";
                        }
                    } else {
                        echo "Error al preparar la consulta SQL: " . $conexion->error . "\n";
                    }
                } else {
                    echo "Datos inválidos o información faltante: userTag ($userTag), membershipValue ($membershipValue)\n";
                }
            }
        }

        fclose($handle);
    } else {
        echo "Unable to open file: $filePath\n";
    }
}

processLogFile($archivoLog, $membershipType, $conexion);
?>