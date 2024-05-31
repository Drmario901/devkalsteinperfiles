<?php

$idAccount = $_POST['idAccount'];
require __DIR__ . '/../conexion.php';

$sql = "SELECT * FROM wp_subscripcion WHERE user_id = '$idAccount' ORDER BY ID DESC";

$resultado = $conexion->query($sql);

if (!$resultado) {
  die("Error en la consulta SQL: " . $conexion->error);
}

$datos = [];

while ($row = $resultado->fetch_assoc()) {
  $datos[] = [
    'id' => $row['ID'],
    'code_retour' => $row['code_retour'],
    'fecha_inicio' => $row['fecha_inicio'],
    'fecha_final' => $row['fecha_final'],
    'referencia_pago' => $row['referencia_pago'],
    'estado_membresia' => $row['estado_membresia'],
    'monto' => $row['monto'],
    'fechahora' => $row['fechahora'],
    'dominio' => $row['dominio'],
  ];
}

echo json_encode($datos);
?>