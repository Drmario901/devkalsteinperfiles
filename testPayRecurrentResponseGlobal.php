<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$allowed_hosts = [
    'plataforma.kalstein.net' => [
        'remote_path' => '/home/he270716/public_html/plataforma.kalstein.net/monetico_log_recurrent.txt',
        'scp_server' => '185.28.22.128',
        'scp_user' => 'he270716',
        'scp_pass' => 'RP$c_myoUeMK'
    ]
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

$input_data = file_get_contents('php://input');
$data = json_decode($input_data, true);

if (!$data) {
    echo "ERROR: No se recibieron datos válidos.";
    exit;
}

$local_log_file = 'monetico_log_recurrent.txt';
$log_message = date('Y-m-d H:i:s') . " - Datos recibidos: " . json_encode($data) . "\n";
file_put_contents($local_log_file, $log_message, FILE_APPEND);

if (!file_exists($local_log_file)) {
    echo "ERROR: El archivo de log local no se creó.";
    exit;
} else {
    echo "Archivo de log local creado.\n";
}

function log_to_host($host_config, $local_log_file) {
    $scp_command = sprintf(
        "sshpass -p '%s' scp %s %s@%s:%s",
        escapeshellarg($host_config['scp_pass']),
        escapeshellarg($local_log_file),
        escapeshellarg($host_config['scp_user']),
        escapeshellarg($host_config['scp_server']),
        escapeshellarg($host_config['remote_path'])
    );

    $output = [];
    $return_var = 0;
    exec($scp_command, $output, $return_var);

    if ($return_var !== 0) {
        echo "Falló la subida SCP: " . implode("\n", $output) . "\n";
        file_put_contents($local_log_file, date('Y-m-d H:i:s') . " - Falló la subida SCP para {$host_config['remote_path']}\n", FILE_APPEND);
        return false;
    } else {
        echo "Archivo subido exitosamente a {$host_config['remote_path']}.\n";
        return true;
    }
}

$all_success = true;
foreach ($allowed_hosts as $host => $host_config) {
    if (!log_to_host($host_config, $local_log_file)) {
        $all_success = false;
        echo "ERROR: Falló la transferencia del archivo de log para $host.\n";
    }
}

if ($all_success) {
    echo "Archivo de log creado y transferido exitosamente.\n";
}
?>
