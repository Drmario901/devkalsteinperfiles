<?php
session_start();
require_once __DIR__ . '/../db/conexion.php';
// $hostdb = "localhost";
// $userdb = "kalsteinplus";
// $passdb = "OqA;}vKA94PO";
// $namedb = "kalsteinplus_he270716_wp_es";

// $conexion = new mysqli($hostdb, $userdb, $passdb, $namedb);

if ($conexion->connect_error) {
    die("Error: " . $conexion->connect_error);
}

$response = array();

$php_session = session_id();

$sql = "SELECT php_model FROM wp_session_model WHERE php_session = '$php_session' ORDER BY `timestamp` DESC LIMIT 1";
$result = $conexion->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_model = $row['php_model'];
    
    $response['status'] = 'Modelo:';
    $response['last_model'] = $last_model;
} else {
    $response['status'] = 'No hay modelo con la sesion';
    $response['last_model'] = '';
}

echo json_encode($response);
?>
