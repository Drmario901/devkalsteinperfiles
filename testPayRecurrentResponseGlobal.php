<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$allowed_hosts = [
    'plataforma.kalstein.net' => [
        'remote_path' => '/home/he270716/public_html/plataforma.kalstein.net/monetico_log_recurrent.txt',
        'ftp_server' => '185.28.22.128',
        'ftp_user' => 'he270716',
        'ftp_pass' => 'RP$c_myoUeMK'
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

$data = [
    'transaction_id' => '123',
    'TPE' => '1234567',
    'date' => '2024-05-27T12:34:56',
    'montant' => '100.00EUR',
    'reference' => 'REF123456',
    'MAC' => 'ABCDEF1234567890',
    'texte-libre' => 'Test transaction'
];

$local_log_file = 'monetico_log_recurrent.txt';
$log_message = date('Y-m-d H:i:s') . " - Datos recibidos: " . json_encode($data) . "\n";
file_put_contents($local_log_file, $log_message, FILE_APPEND);

if (!file_exists($local_log_file)) {
    echo "ERROR: El archivo de log local no se creó.";
    exit;
}

function ftp_mkdir_recursive($ftp_conn, $dir) {
    $parts = explode('/', $dir);
    $path = '';
    foreach ($parts as $part) {
        if (!empty($part)) {
            $path .= '/' . $part;
            if (!@ftp_chdir($ftp_conn, $path)) {
                if (!ftp_mkdir($ftp_conn, $path)) {
                    file_put_contents('monetico_log_recurrent.txt', date('Y-m-d H:i:s') . " - Failed to create directory: $path\n", FILE_APPEND);
                } else {
                    file_put_contents('monetico_log_recurrent.txt', date('Y-m-d H:i:s') . " - Created directory: $path\n", FILE_APPEND);
                }
            } else {
                ftp_chdir($ftp_conn, '/');  
            }
        }
    }
}

function log_to_host($host_config, $local_log_file) {
    $ftp_conn = ftp_connect($host_config['ftp_server']);
    if (!$ftp_conn) {
        file_put_contents($local_log_file, date('Y-m-d H:i:s') . " - Could not connect to FTP server: {$host_config['ftp_server']}\n", FILE_APPEND);
        return;
    }

    $login = ftp_login($ftp_conn, $host_config['ftp_user'], $host_config['ftp_pass']);
    if (!$login) {
        file_put_contents($local_log_file, date('Y-m-d H:i:s') . " - FTP login failed for {$host_config['ftp_server']}\n", FILE_APPEND);
        ftp_close($ftp_conn);
        return;
    }

    $remote_dir = dirname($host_config['remote_path']);
    ftp_mkdir_recursive($ftp_conn, $remote_dir);

    if (!ftp_put($ftp_conn, $host_config['remote_path'], $local_log_file, FTP_ASCII)) {
        file_put_contents($local_log_file, date('Y-m-d H:i:s') . " - FTP upload failed for {$host_config['remote_path']}\n", FILE_APPEND);
    } else {
        file_put_contents($local_log_file, date('Y-m-d H:i:s') . " - FTP upload succeeded for {$host_config['remote_path']}\n", FILE_APPEND);
    }

    ftp_close($ftp_conn);
}

$log_message = date('Y-m-d H:i:s') . " - Log de prueba para verificación.\n";
file_put_contents($local_log_file, $log_message, FILE_APPEND);

foreach ($allowed_hosts as $host => $host_config) {
    log_to_host($host_config, $local_log_file);
}

if (file_exists($local_log_file)) {
    echo "Archivo de log creado y transferido.";
} else {
    echo "ERROR: El archivo de log no se creó.";
}
?>
