<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/../../../db/conexion.php';

$acc_id = $_SESSION['emailAccount'];

// echo 'el iddd: ', $acc_id;

$arrayCotizaciones = [];

$consulta = "SELECT cotizacion_id FROM wp_cotizacion WHERE cotizacion_id_remitente = ?";
    
if ($stmt = $conexion->prepare($consulta)) {
    $stmt->bind_param("s", $acc_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $arrayCotizaciones[] = 'QUO' . $fila['cotizacion_id'];
        }
    }
    $stmt->close();
}

$sumaTotalPendientes = 0;
$sumaTotalPagadas = 0;

// Tasa de conversión de EUR a USD
$tasaConversionEURUSD = 1.1;

if (!empty($arrayCotizaciones)) {
    $cotizacionesEnFormatoSQL = "'" . implode("', '", $arrayCotizaciones) . "'";
    $consultaMonetico = "SELECT id_cotizacion, monto_total, status_payment, cotizacion_divisa FROM wp_monetico WHERE id_cotizacion IN ($cotizacionesEnFormatoSQL)";
    
    if ($stmt = $conexion->prepare($consultaMonetico)) {
        $stmt->execute();
        $resultadoMonetico = $stmt->get_result();
        
        while ($filaMonetico = $resultadoMonetico->fetch_assoc()) {
            // Determinar la tasa de conversión basada en la divisa
            $tasaConversion = ($filaMonetico['cotizacion_divisa'] == 'EUR') ? $tasaConversionEURUSD : 1;
            $montoConvertido = $filaMonetico['monto_total'] * $tasaConversion;

            if ($filaMonetico['status_payment'] == 0) {
                $sumaTotalPendientes += $montoConvertido;
            } elseif ($filaMonetico['status_payment'] == 1) {
                $sumaTotalPagadas += $montoConvertido;
            }
        }
        $stmt->close();
    }
    
    // Exportar los totales a variables de sesión
    $_SESSION['sumaTotalPendientes'] = $sumaTotalPendientes;
    $_SESSION['sumaTotalPagadas'] = $sumaTotalPagadas;

    echo "Suma total pendiente: $sumaTotalPendientes <br/>";
    echo "Suma total pagada: $sumaTotalPagadas <br/>";
} 
else {
    echo 'No hay cotizaciones para buscar.';
}
?>