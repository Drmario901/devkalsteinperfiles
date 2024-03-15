<?php
require __DIR__.'/../conexion.php';

session_start();
if (isset($_SESSION['emailAccount'])){
    $email = $_SESSION['emailAccount'];
}

$fechaInicio = date('Y-m-d H:i:s', strtotime('-6 months'));

$consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_status = '3' AND cotizacion_create_at >= '$fechaInicio' AND cotizacion_id_remitente = '$email'";
$respuesta = $conexion->query($consulta);

if ($respuesta->num_rows > 0) {
    $suma = 0;
    while ($row = $respuesta->fetch_assoc()) {
        $suma += $row['cotizacion_id'];
    }

    $contador = mysqli_num_rows($respuesta);

    $salida = '<center><data class="card-data">' . $contador . '</data></center>';
} else {
    $salida = '<center><data class="card-data">No orders pending</data></center>';
}

echo $salida;
$conexion->close();
?>
