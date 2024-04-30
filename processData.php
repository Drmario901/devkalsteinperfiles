<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/db/conexion.php';

$archivoLog = "/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/monetico_log_recurrent.txt";

$membershipType = [
    'SUB1' => 1,
    'SUB2' => 2
];

function processLogFile($filePath, $membershipType, $conexion) {
    $handle = fopen($filePath, "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $data = json_decode(substr($line, strpos($line, '{')), true);

            if ($data && $data['code-retour'] === 'paiement') {
                $texteLibre = $data['texte-libre'];
                preg_match("/Membresia-(SUB\d+)-@(\w+)-/", $texteLibre, $matches);

                $membershipId = $matches[1] ?? null;
                $userTag = $matches[2] ?? null;

                if ($membershipId && $userTag && isset($membershipType[$membershipId])) {
                    $membershipId = $membershipType[$membershipId]; 
                    $userTag = $conexion->real_escape_string($userTag); 

                    $result = $conexion->query("SELECT account_sub_id FROM wp_account WHERE account_sub_id = '$membershipId'");

                    if ($result && $result->num_rows > 0) {
                        $conexion->query("UPDATE wp_account SET tipo_membresia = $membershipId WHERE account_sub_id = '$userTag'");
                        echo "Successfully updated membership for user tag: $userTag\n";
                    } else {
                        echo "No matching account_sub_id found for membership ID: $membershipId\n";
                    }
                } else {
                    echo "Invalid data or missing information: membershipId ($membershipId), userTag ($userTag)\n";
                }
            }
        }
        fclose($handle);
    } else {
        echo "Unable to open file: $filePath\n";
    }
}

?>
