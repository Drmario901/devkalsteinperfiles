<?php 


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../../../db/conexion.php';

$acc_id = $_SESSION['emailAccount'];

echo 'el iddd: ', $acc_id;

// Asegúrate de definir $tasaConversionEURUSD en algún lugar, o pasarla correctamente
$tasaConversionEURUSD = 1.1; // Ejemplo de tasa de conversión

function obtenerSumaTotalUSD($conexion, $acc_id, $estados, $tasaConversionEURUSD) {
    $sumaTotalUSD = 0;
    
    // La consulta se prepara asumiendo que $estados ya está correctamente formateada y sanitizada
    $consulta = "SELECT cotizacion_total, cotizacion_divisa FROM wp_cotizacion WHERE cotizacion_id_remitente = ? AND cotizacion_status IN ($estados)";
    
    if ($stmt = $conexion->prepare($consulta)) {
        $stmt->bind_param("s", $acc_id); // Vincular el 'acc_id' como parámetro
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $cotizacionTotal = $fila['cotizacion_total'];
                $cotizacionDivisa = $fila['cotizacion_divisa'];
                
                // Asumir USD si cotizacion_divisa está vacío o es USD, convertir si es EUR
                if (empty($cotizacionDivisa) || $cotizacionDivisa == 'USD') {
                    $cotizacionTotalUSD = $cotizacionTotal;
                } else if ($cotizacionDivisa == 'EUR') {
                    $cotizacionTotalUSD = $cotizacionTotal * $tasaConversionEURUSD;
                } else {
                    // Manejo de otras divisas no especificadas
                    $cotizacionTotalUSD = $cotizacionTotal; // Puede ajustarse según sea necesario
                }
                
                // Sumar al total
                $sumaTotalUSD += $cotizacionTotalUSD;
            }
        }
        $stmt->close(); // No olvidar cerrar el statement
    }

    return $sumaTotalUSD;
}

// Asegúrate de definir o actualizar la tasa de conversión EUR a USD
$tasaConversionEURUSD = 1.1; // Ejemplo, asegúrate de tener una tasa actualizada

// Ejemplo de cómo llamar a la función para cada conjunto de estados
$sumaTotalUSDPendiente = obtenerSumaTotalUSD($conexion, $acc_id, "'Pendiente', '0'", $tasaConversionEURUSD);
$sumaTotalUSDProcesar = obtenerSumaTotalUSD($conexion, $acc_id, "'Procesar', '1'", $tasaConversionEURUSD);
$sumaTotalUSDProcesado = obtenerSumaTotalUSD($conexion, $acc_id, "'Procesado', '3'", $tasaConversionEURUSD);

echo "Suma total USD Pendiente: $sumaTotalUSDPendiente<br>";
echo "Suma total USD Procesar: $sumaTotalUSDProcesar<br>";
echo "Suma total USD Procesado: $sumaTotalUSDProcesado<br>";




?> 