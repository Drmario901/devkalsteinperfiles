<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../../../db/conexion.php';

$acc_id = $_SESSION['emailAccount'];

echo 'el id es este ' . $acc_id;

// Tasa de conversión de EUR a USD
$tasaConversionEURUSD = 1.1;

$sql = "SELECT R_id_cotizacion FROM wp_reportes WHERE R_estado = 'Procesado' AND R_usuario_agente = '". $acc_id ."'";
$result = $conexion->query($sql);

// Verificar si se encontraron filas
if ($result->num_rows > 0) {
    // Salida de datos de cada fila
    while($row = $result->fetch_assoc()) {
      echo "ID Cotización: " . $row["R_id_cotizacion"] . "<br>";
    }
  } else {
    echo "0 resultados";
  }

function obtenerSumaTotalUSD($conexion, $acc_id, $estado, $tasaConversionEURUSD) {
    $sumaTotalUSD = 0;
    $consulta = "SELECT cotizacion_total, cotizacion_divisa FROM wp_cotizacion WHERE cotizacion_id_user = '" . $acc_id . "' AND cotizacion_id_remitente != 'KALSTEIN-INTERNAL' AND cotizacion_status IN ($estado)";
    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows > 0) {
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
    }
    return $sumaTotalUSD;
}

// Llamadas a la función
$sumaTotalUSDPendiente = obtenerSumaTotalUSD($conexion, $acc_id, "'Pendiente', '0'", $tasaConversionEURUSD);
$sumaTotalUSDProcesar = obtenerSumaTotalUSD($conexion, $acc_id, "'Procesar', '1'", $tasaConversionEURUSD);
$sumaTotalUSDProcesado = obtenerSumaTotalUSD($conexion, $acc_id, "'Procesado', '3'", $tasaConversionEURUSD);

?>