<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/vendor/autoload.php';
require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/conexion.php';

use DansMaCulotte\Monetico\Monetico;
use DansMaCulotte\Monetico\Responses\PurchaseResponse;

$data = $_POST;

if (empty($data)) {
    echo "ERROR: No se recibieron datos.";
    exit;
}

file_put_contents('monetico_log.txt', date('Y-m-d H:i:s') . " - Datos recibidos: " . json_encode($data) . "\n", FILE_APPEND);

$monetico = new Monetico('7593339', '530C185A56C2A9F904681A527780EBDB8C0E6C99', 'kalsteinfr');
$response = new PurchaseResponse($data);
$result = $monetico->validate($response);

if (!$result || $data['code-retour'] !== 'paiement') {
    echo "version=2\ncdr=1";
    exit;
}

preg_match("/@(\w+)-/", $data['reference'], $matches);
$userTag = $matches[1] ?? null;
preg_match("/Membresia-(\w+)-/", $data['reference'], $membershipMatches);
$membershipId = $membershipMatches[1] ?? null;

$membershipType = ['SUB1' => 1, 'SUB2' => 2];
$membershipValue = $membershipType[$membershipId] ?? null;

if ($userTag && $membershipValue !== null) {
    $stmt = $conexion->prepare("UPDATE wp_account SET tipo_membresia = ? WHERE user_tag = ?");
    $stmt->bind_param("is", $membershipValue, $userTag);
    $stmt->execute();
    echo "version=2\ncdr=0";
} else {
    echo "version=2\ncdr=1";
}
?>
