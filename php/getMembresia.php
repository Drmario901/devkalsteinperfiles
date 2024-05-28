<?php

require_once 'conexion.php';

$acc_id = $_SESSION['emailAccount'];

$sql = "SELECT tipo_membresia, account_aid FROM wp_account WHERE account_correo = '$acc_id'";

$result = $conexion->query($sql);

// guardar en la session el tipo de membresia
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $_SESSION['tipo_membresia'] = $row['tipo_membresia'];
    $accountId = ['account_aid'];
    $membresia = $row['tipo_membresia'];
  }
  // echo json_encode($membresia);
} else {
  echo "0 results";
}

$sqlSubscripcion = "SELECT * FROM wp_subscripcion WHERE user_id = '$accountId'";
$resultSubscripcion = $conexion->query($sqlSubscripcion);
// guardar en la session las fechas de la membresia
if ($resultSubscripcion->num_rows > 0) {
  while ($row2 = $resultSubscripcion->fetch_assoc()) {
    $_SESSION['fecha_inicio'] = $row2['fecha_inicio'];
    $_SESSION['fecha_final'] = $row2['fecha_final'];
  }
} else {
  echo '0 results';
}
