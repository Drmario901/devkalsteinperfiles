<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../../../db/conexion.php';

$acc_id = $_SESSION['emailAccount'];

echo $acc_id . 'la cuenta';

$consulta = "SELECT cotizacion_total FROM wp_cotizacion WHERE cotizacion_id_remitente = '" . $acc_id . "'";

echo 'hola';
$resultado = $conexion->query($consulta);

// Verificar si la consulta devolvió filas
if ($resultado->num_rows > 0) {
    // Iterar a través de los resultados
    while ($fila = $resultado->fetch_assoc()) {
        echo $fila['cotizacion_total'] . "<br>";
    }
} else {
    echo "No se encontraron resultados.";
}
?>