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

            if ($data && $data['code-retour'] === 'paytest') {
                preg_match("/@(\w+)-/", $data['reference'], $userTagMatches);
                preg_match("/Membresia-(\w+)-/", $data['reference'], $membershipMatches);

                $userTag = $userTagMatches[1] ?? null;
                $membershipId = $membershipMatches[1] ?? null;
                $membershipValue = $membershipType[$membershipId] ?? null;

                if ($userTag && $membershipValue !== null) {
                    $stmt = $conexion->prepare("UPDATE wp_account SET tipo_membresia = ? WHERE user_tag = ?");
                    if ($stmt) {
                        $stmt->bind_param("is", $membershipValue, $userTag);
                        if ($stmt->execute()) {
                            // Membresía actualizada correctamente
                        } else {
                            // Error al actualizar la membresía
                            // echo "Failed to update membership for user tag: $userTag. Error: " . $stmt->error . "\n";
                        }
                    } else {
                        // Error al preparar la consulta SQL
                        // echo "Failed to prepare the statement: " . $conexion->error . "\n";
                    }
                } else {
                    // Datos inválidos o información faltante
                    // echo "Invalid data or missing information: userTag ($userTag), membershipValue ($membershipValue)\n";
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