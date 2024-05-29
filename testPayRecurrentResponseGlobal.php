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
}

function log_to_host($host_config, $local_log_file) {
    $ftp_conn = ftp_connect($host_config['ftp_server']);
    if (!$ftp_conn) {
        echo "No se pudo conectar al servidor FTP: {$host_config['ftp_server']}\n";
        file_put_contents($local_log_file, date('Y-m-d H:i:s') . " - No se pudo conectar al servidor FTP: {$host_config['ftp_server']}\n", FILE_APPEND);
        return false;
    }

    $login = ftp_login($ftp_conn, $host_config['ftp_user'], $host_config['ftp_pass']);
    if (!$login) {
        echo "Falló el login FTP para {$host_config['ftp_server']}\n";
        file_put_contents($local_log_file, date('Y-m-d H:i:s') . " - Falló el login FTP para {$host_config['ftp_server']}\n", FILE_APPEND);
        ftp_close($ftp_conn);
        return false;
    }

    $remote_dir = dirname($host_config['remote_path']);
    if (!ftp_chdir($ftp_conn, $remote_dir)) {
        if (!ftp_mkdir($ftp_conn, $remote_dir)) {
            echo "Falló la creación del directorio: $remote_dir\n";
            file_put_contents($local_log_file, date('Y-m-d H:i:s') . " - Falló la creación del directorio: $remote_dir\n", FILE_APPEND);
            ftp_close($ftp_conn);
            return false;
        } else {
            echo "Directorio creado: $remote_dir\n";
        }
    } else {
        echo "Directorio existente: $remote_dir\n";
    }

    if (!ftp_put($ftp_conn, basename($host_config['remote_path']), $local_log_file, FTP_ASCII)) {
        echo "Falló la subida FTP para {$host_config['remote_path']}\n";
        file_put_contents($local_log_file, date('Y-m-d H:i:s') . " - Falló la subida FTP para {$host_config['remote_path']}\n", FILE_APPEND);
        ftp_close($ftp_conn);
        return false;
    }

    ftp_close($ftp_conn);
    return true;
}

$all_success = true;
foreach ($allowed_hosts as $host => $host_config) {
    if (!log_to_host($host_config, $local_log_file)) {
        $all_success = false;
        echo "ERROR: Falló la transferencia del archivo de log para $host.";
    }
}

if ($all_success) {
    echo "Archivo de log creado y transferido exitosamente.";
}
?>
