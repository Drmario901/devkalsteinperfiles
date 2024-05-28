<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

use DansMaCulotte\Monetico\Monetico;
use DansMaCulotte\Monetico\Responses\PurchaseResponse;

$allowed_hosts = [
    'plataforma.kalstein.net' => '/home/he270716/public_html/plataforma.kalstein.net/monetico_log_recurrent.txt',
    'platform.kalstein.us' => '/path/to/log/host2_monetico_log_recurrent.txt',
    'plateforme.kalstein.fr' => '/path/to/log/host32_monetico_log_recurrent.txt'
];

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

if (array_key_exists(parse_url($origin, PHP_URL_HOST), $allowed_hosts)) {
    header('Access-Control-Allow-Origin: ' . $origin);
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type');
} else {
    echo "ERROR: Host no permitido.";
    exit;
}

$data = $_POST;
file_put_contents('monetico_log_recurrent.txt', date('Y-m-d H:i:s') . " - Datos recibidos: " . json_encode($data) . "\n", FILE_APPEND);

function log_to_host($host, $remote_path, $message) {
    $local_temp_file = tempnam(sys_get_temp_dir(), 'log');
    file_put_contents($local_temp_file, $message, FILE_APPEND);
    
    $scp_command = "scp $local_temp_file user@$host:$remote_path";
    $output = [];
    $return_var = 0;
    exec($scp_command, $output, $return_var);

    file_put_contents('monetico_log_recurrent.txt', date('Y-m-d H:i:s') . " - SCP Output: " . implode("\n", $output) . "\n", FILE_APPEND);
    file_put_contents('monetico_log_recurrent.txt', date('Y-m-d H:i:s') . " - SCP Return Var: " . $return_var . "\n", FILE_APPEND);

    unlink($local_temp_file);
}

if (!empty($data)) {
    $monetico = new Monetico('7593339', '255D023E7A0BDE9EEAC7516959CD93A9854F3991', 'kalsteinfr');
    $response = new PurchaseResponse($data);
    $result = $monetico->validate($response);

    if ($result) {
        echo "version=2\ncdr=0";
        $log_message = date('Y-m-d H:i:s') . " - Transacción válida.\n";
    } else {
        echo "version=2\ncdr=1";
        $log_message = date('Y-m-d H:i:s') . " - Transacción inválida.\n";
    }

    foreach ($allowed_hosts as $host => $remote_path) {
        log_to_host($host, $remote_path, $log_message);
    }
} else {
    echo "ERROR: No se recibieron datos.";
    $log_message = date('Y-m-d H:i:s') . " - ERROR: No se recibieron datos.\n";
    
    foreach ($allowed_hosts as $host => $remote_path) {
        log_to_host($host, $remote_path, $log_message);
    }
}
?>
