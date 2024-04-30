<?php
session_start();
require_once 'conexion.php'; // Asegúrate de que este archivo contiene la lógica de conexión correcta

$emailAccount = $_SESSION['emailAccount']; // La dirección de correo del usuario actual

// Conexión a la base de datos
if ($conexion->connect_error) {
  die("Connection failed: " . $conexion->connect_error);
}

// Obtener el tipo de membresía del usuario
$sql = "SELECT tipo_membresia FROM wp_account WHERE account_correo = '$emailAccount'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $tipoMembresia = $row['tipo_membresia'];

  // Determinar el máximo de productos permitidos
  $maxProductos = 0;
  switch ($tipoMembresia) {
    case 0:
      $maxProductos = 5;
      break;
    case 1:
      $maxProductos = 10;
      break;
    case 2:
      $maxProductos = PHP_INT_MAX; // Sin límite
      break;
  }

  // Contar cuántos productos ha subido el usuario
  $sqlCount = "SELECT COUNT(*) AS total FROM wp_k_products WHERE product_maker = '$emailAccount'";
  $resultCount = $conexion->query($sqlCount);
  $countRow = $resultCount->fetch_assoc();
  $totalProductos = $countRow['total'];

  if ($totalProductos <= $maxProductos) {
    $sqlMakeVisible = "UPDATE wp_k_products SET visible = 0 WHERE product_maker = '$emailAccount' LIMIT $maxProductos";
  }

  // Si excede el máximo permitido, cambiar la visibilidad de los últimos productos subidos
  if ($totalProductos > $maxProductos) {
    $excess = $totalProductos - $maxProductos;
    $sqlUpdate = "UPDATE wp_k_products SET visible = 1 WHERE product_maker = '$emailAccount' ORDER BY product_create_at DESC LIMIT $excess";
    $conexion->query($sqlUpdate);
  }

}

$conexion->close();
?>