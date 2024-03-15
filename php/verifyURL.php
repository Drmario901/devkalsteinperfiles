<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
session_start();
header('Content-Type: application/json');

require __DIR__. '../db/conexion.php';

$fullUrl = isset($_POST['fullUrl']) ? $_POST['fullUrl'] : '';

$fullUrl = $conexion->real_escape_string($fullUrl);

$sql = "SELECT ID_user FROM tienda_virtual WHERE ID_slug = '$fullUrl'";
$result = $conexion->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    $_SESSION['emailAccount'] = $row['ID_user']; 
    
    echo json_encode(['success' => true]);
} else {  
    echo json_encode(['success' => false]);
}

$conexion->close();
?>
