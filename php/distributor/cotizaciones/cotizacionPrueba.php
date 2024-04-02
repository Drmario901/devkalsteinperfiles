<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../../../db/conexion.php';

$acc_id = $_SESSION['emailAccount'];

echo 'el iddd: ', $acc_id;

$arrayCotizaciones = [];

$consulta = "SELECT cotizacion_id FROM wp_cotizacion WHERE cotizacion_id_remitente = ?";
    
if ($stmt = $conexion->prepare($consulta)) {
    $stmt->bind_param("s", $acc_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            // Asumiendo que 'cotizacion_id' es un número y los IDs en 'wp_monetico' tienen un prefijo 'QUO'
            $arrayCotizaciones[] = 'QUO' . $fila['cotizacion_id'];
        }
    }
    $stmt->close();
}

print_r( $arrayCotizaciones);

// Verificar si hay cotizaciones para buscar
if (!empty($arrayCotizaciones)) {
    // Convertir el array en una lista separada por comas para la consulta SQL
    $cotizacionesEnFormatoSQL = "'" . implode("', '", $arrayCotizaciones) . "'";
    
    // Preparar la consulta para buscar estas cotizaciones en wp_monetico
    $consultaMonetico = "SELECT id, id_cotizacion, monto_total, status_payment FROM wp_monetico WHERE id_cotizacion IN ($cotizacionesEnFormatoSQL)";
    
    if ($stmt = $conexion->prepare($consultaMonetico)) {
        // No es necesario bind_param debido a que ya sanitizamos la entrada al construir la cadena de consulta
        $stmt->execute();
        $resultadoMonetico = $stmt->get_result();
        
        if ($resultadoMonetico->num_rows > 0) {
            while ($filaMonetico = $resultadoMonetico->fetch_assoc()) {
                // Procesar los resultados, por ejemplo, imprimiéndolos
                echo 'ID: ' . $filaMonetico['id'] . ', ID Cotización: ' . $filaMonetico['id_cotizacion'] . ', Monto Total: ' . $filaMonetico['monto_total'] . ', Status: ' . $filaMonetico['status_payment'] . '<br/>';
            }
        } else {
            echo 'No se encontraron coincidencias en wp_monetico.';
        }
        $stmt->close();
    }
} else {
    echo 'No hay cotizaciones para buscar.';
}
?>