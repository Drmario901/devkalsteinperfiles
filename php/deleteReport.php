<?php
  require __DIR__ . '/conexion.php';

  $id = $_POST['consulta'];

  $sql = "DELETE FROM wp_reportes WHERE R_id = '$id'";
  
  if ($conexion->query($sql) === TRUE) {
    $delete = 'correcto';
  } else {
    $delete = 'incorrecto';
  }

  $datos = array(
    'delete' => $delete
  );

  echo json_encode($datos, JSON_FORCE_OBJECT);