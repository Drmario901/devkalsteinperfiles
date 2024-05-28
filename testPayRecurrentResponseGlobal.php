<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

use DansMaCulotte\Monetico\Monetico;
use DansMaCulotte\Monetico\Responses\PurchaseResponse;

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

$data = 'JORGITO HIZO ESTO.';
file_put_contents('monetico_log_recurrent.txt', date('Y-m-d H:i:s') . " - Datos recibidos: " . json_encode($data) . "\n", FILE_APPEND);

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

function log_to_host($host_config, $message) {
    $local_temp_file = tempnam(sys_get_temp_dir(), 'log');
    file_put_contents($local_temp_file, $message, FILE_APPEND);

    $ftp_conn = ftp_connect($host_config['ftp_server']);
    if (!$ftp_conn) {
        file_put_contents('monetico_log_recurrent.txt', date('Y-m-d H:i:s') . " - Could not connect to FTP server: {$host_config['ftp_server']}\n", FILE_APPEND);
        unlink($local_temp_file);
        return;
    }

    $login = ftp_login($ftp_conn, $host_config['ftp_user'], $host_config['ftp_pass']);
    if (!$login) {
        file_put_contents('monetico_log_recurrent.txt', date('Y-m-d H:i:s') . " - FTP login failed for {$host_config['ftp_server']}\n", FILE_APPEND);
        ftp_close($ftp_conn);
        unlink($local_temp_file);
        return;
    }

    $remote_dir = dirname($host_config['remote_path']);
    ftp_mkdir_recursive($ftp_conn, $remote_dir);

    if (!ftp_put($ftp_conn, $host_config['remote_path'], $local_temp_file, FTP_ASCII)) {
        file_put_contents('monetico_log_recurrent.txt', date('Y-m-d H:i:s') . " - FTP upload failed for {$host_config['remote_path']}\n", FILE_APPEND);
    } else {
        file_put_contents('monetico_log_recurrent.txt', date('Y-m-d H:i:s') . " - FTP upload succeeded for {$host_config['remote_path']}\n", FILE_APPEND);
    }

    ftp_close($ftp_conn);
    unlink($local_temp_file);
}

$log_message = date('Y-m-d H:i:s') . " - Log de prueba para verificación.\n";
foreach ($allowed_hosts as $host_config) {
    log_to_host($host_config, $log_message);
}

if (!empty($data)) {
    $monetico = new Monetico('7593339', '255D023E7A0BDE9EEAC7516959CD93A9854F3991', 'kalsteinfr');
    try {
        $response = new PurchaseResponse($data);
        $result = $monetico->validate($response);

        if ($result) {
            echo "version=2\ncdr=0";
            $log_message = date('Y-m-d H:i:s') . " - Transacción válida.\n";
        } else {
            echo "version=2\ncdr=1";
            $log_message = date('Y-m-d H:i:s') . " - Transacción inválida.\n";
        }
    } catch (Exception $e) {
        echo "version=2\ncdr=1";
        $log_message = date('Y-m-d H:i:s') . " - Error: " . $e->getMessage() . "\n";
    }

    foreach ($allowed_hosts as $host_config) {
        log_to_host($host_config, $log_message);
    }
} else {
    echo "ERROR: No se recibieron datos.";
    $log_message = date('Y-m-d H:i:s') . " - ERROR: No se recibieron datos.\n";

    foreach ($allowed_hosts as $host_config) {
        log_to_host($host_config, $log_message);
    }
}
?>
