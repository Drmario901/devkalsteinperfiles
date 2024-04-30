<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/db/conexion.php';

$archivoLog = "/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/monetico_log_recurrent.txt";

function processLogFile($filePath) {
    $handle = fopen($filePath, "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            echo "Processing line: $line\n";  // Depuración
            $data = json_decode(substr($line, strpos($line, '{')), true);

            if ($data && ($data['code-retour'] === 'paiement' || $data['code-retour'] === 'payetest')) {
                preg_match("/@(\w+)-/", $data['reference'], $userTagMatches);
                preg_match("/Membresia-(\w+)-/", $data['reference'], $membershipMatches);

                $userTag = $userTagMatches[1] ?? 'no userTag found';
                $membershipId = $membershipMatches[1] ?? 'no membershipId found';
                echo "User Tag: $userTag, Membership ID: $membershipId\n";  // Depuración

                $membershipType = ['SUB1' => 1, 'SUB2' => 2];
                $membershipValue = $membershipType[$membershipId] ?? null;

                if ($userTag && $membershipValue) {
                    $stmt = $conexion->prepare("UPDATE wp_account SET tipo_membresia = ? WHERE user_tag = ?");
                    if (!$stmt) {
                        echo "Failed to prepare the statement: " . $conexion->error . "\n";
                        continue;
                    }

                    $stmt->bind_param("is", $membershipValue, $userTag);
                    if (!$stmt->execute()) {
                        echo "Failed to update membership for user tag: $userTag. Error: " . $stmt->error . "\n";
                    } else {
                        echo "Successfully updated membership for user tag: $userTag\n";
                    }
                } else {
                    echo "Invalid data or missing information: userTag ($userTag), membershipValue ($membershipValue)\n";
                }
            }
        }
        fclose($handle);
    } else {
        echo "Unable to open file: $filePath\n";
    }
}

processLogFile($archivoLog);
?>
