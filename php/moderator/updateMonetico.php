<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/db/conexion.php';


$moneticoID = $_POST['id'];


if (isset($moneticoID)) {
    // La variable está definida y no es null
    echo json_encode(['success' => true, 'message' => 'Cotizacion confirmada con exito del id:  '. $moneticoID . '']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al confirmar la cotizacion.']);
}