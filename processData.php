<?php
require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/db/conexion.php';

function processLogFile($filePath) {
    $handle = fopen($filePath, "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $data = json_decode(substr($line, strpos($line, '{')), true);

            if ($data && $data['code-retour'] === 'paiement') {
                preg_match("/@(\w+)-/", $data['reference'], $userTagMatches);
                preg_match("/Membresia-(\w+)-/", $data['reference'], $membershipMatches);

                $userTag = $userTagMatches[1] ?? null;
                $membershipId = $membershipMatches[1] ?? null;
                $membershipType = ['SUB1' => 1, 'SUB2' => 2];
                $membershipValue = $membershipType[$membershipId] ?? null;

                if ($userTag && $membershipValue !== null) {
                    $stmt = $conexion->prepare("UPDATE wp_account SET tipo_membresia = ? WHERE user_tag = ?");
                    $stmt->bind_param("is", $membershipValue, $userTag);
                    if ($stmt->execute()) {
                        echo "Updated membership for user tag: $userTag\n";
                    } else {
                        echo "Failed to update membership for user tag: $userTag\n";
                    }
                }
            }
        }
        fclose($handle);
    } else {
        echo "Unable to open file.";
    }
}

$archivoLog = "/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/monetico_log_recurrent.txt";
processLogFile($archivoLog);
?>
