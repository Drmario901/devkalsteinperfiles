<?php
require __DIR__.'/../conexion.php';

session_start(); 
if (isset($_SESSION['emailAccount'])){
    $email = $_SESSION['emailAccount'];

}

$fechaInicio = date('Y-m-d H:i:s', strtotime('-6 months'));

$consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_status = 'Process' AND cotizacion_create_at >= '$fechaInicio' AND cotizacion_id_remitente = '$email'";

$respuesta = $conexion->query($consulta);

if ($respuesta->num_rows > 0) {
  $contador = $respuesta->num_rows;
  $salida = '<center><data class="card-data">' . $contador . '</data></center>';
} else {
  $salida = '<center><data class="card-data">No pending orders</data></center>';
}

echo $salida;
$conexion->close();
?>
