<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../../../db/conexion.php';

$acc_id = $_SESSION['emailAccount'];

echo 'el iddd', $acc_id;

function obtenerSumaTotalUSD($conexion, $acc_id, $estado, $tasaConversionEURUSD) {
    $sumaTotalUSD = 0;
    $consulta = "SELECT cotizacion_total, cotizacion_divisa FROM wp_cotizacion WHERE cotizacion_id_remitente = '". $acc_id ."' AND cotizacion_status IN ($estado)";
    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo $cotizacionTotal = $fila['cotizacion_total'];
            echo $cotizacionDivisa = $fila['cotizacion_divisa'];
            
            // Convertir a USD si la divisa es EUR, de lo contrario asumir que ya está en USD
            if ($cotizacionDivisa == 'EUR') {
                $cotizacionTotalUSD = $cotizacionTotal * $tasaConversionEURUSD;
            } else {
                $cotizacionTotalUSD = $cotizacionTotal;
            }
            
            // Sumar al total
            $sumaTotalUSD += $cotizacionTotalUSD;
        }
    }
    return $sumaTotalUSD;
}

// Asegúrate de que $idsCotizacion no esté vacío antes de llamar a la función
if (!empty($idsCotizacion)) {
    $sumaTotalUSDPendiente = obtenerSumaTotalUSD($conexion, $acc_id, "'Pendiente', '0'", $tasaConversionEURUSD) ;
   $sumaTotalUSDProcesar = obtenerSumaTotalUSD($conexion, $acc_id, "'Procesar', '1'", $tasaConversionEURUSD);
    $sumaTotalUSDProcesado = obtenerSumaTotalUSD($conexion, $acc_id, "'Procesado', '3'", $tasaConversionEURUSD);
} else {
    echo "No hay cotizaciones para calcular.";
}




?> 