<?php

require_once 'conexion.php';

$acc_id = $_SESSION['emailAccount'];

$sql = "SELECT tipo_membresia FROM wp_account WHERE account_correo = '$acc_id'";

$result = $conexion->query($sql);

// guardar en la session el tipo de membresia
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $_SESSION['tipo_membresia'] = $row['tipo_membresia'];
    $_SESSION['fecha_inicial'] = $row['fecha_inicial'];
    $_SESSION['fecha_final'] = $row['fecha_final'];
    $membresia = $row['tipo_membresia'];
  }
  // echo json_encode($membresia);
} else {
  echo "0 results";
}
