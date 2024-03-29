<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../../../db/conexion.php';

$acc_id = $_SESSION['emailAccount'];

echo $acc_id . ' la cuenta';
 
$consulta = "SELECT cotizacion_total, cotizacion_divisa FROM wp_cotizacion WHERE cotizacion_id_user = '" . $acc_id . "' AND cotizacion_id_remitente != 'KALSTEIN-INTERNAL'";

echo 'holaaaas';
$resultado = $conexion->query($consulta);

// Tasa de conversión de EUR a USD
$tasaConversionEURUSD = 1.1;

// Variable para acumular la suma total
$sumaTotalUSD = 0;

// Verificar si la consulta devolvió filas
if ($resultado->num_rows > 0) {
    // Iterar a través de los resultados
    while ($fila = $resultado->fetch_assoc()) {
        $cotizacionTotal = $fila['cotizacion_total'];
        $cotizacionDivisa = $fila['cotizacion_divisa'];
        
        // Convertir a USD si la divisa es EUR, de lo contrario asumir que ya está en USD
        if ($cotizacionDivisa == 'EUR') {
            $cotizacionTotalUSD = $cotizacionTotal * $tasaConversionEURUSD;
        } else {
            $cotizacionTotalUSD = $cotizacionTotal;
        }
        
        // Sumar al total
        $sumaTotalUSD += $cotizacionTotalUSD;
    }
    
    // echo "Suma total en USD: " . $sumaTotalUSD;
} else {
    echo "No se encontraron resultados.";
}
?>