<?php

function checkMembership()
{
  // Asegúrate de que la sesión esté iniciada
  session_start();

  // Incluir el archivo de conexión a la base de datos
  require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/conexion.php';

  // Verificar si la sesión contiene la dirección de correo del usuario actual
  if (!isset($_SESSION['emailAccount'])) {
    echo json_encode(array('status' => 'error', 'message' => 'User email is not set in session'));
    return;
  }

  $emailAccount = $_SESSION['emailAccount'];

  // Verificar si la conexión a la base de datos se estableció correctamente
  if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
  }

  // Obtener el tipo de membresía del usuario desde la base de datos
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

    // Actualizar la visibilidad de los productos
    if ($totalProductos > $maxProductos) {
      $excess = $totalProductos - $maxProductos;
      $sqlUpdate = "UPDATE wp_k_products SET visible = 1 WHERE product_maker = '$emailAccount' ORDER BY product_create_at DESC LIMIT $excess";
      $conexion->query($sqlUpdate);
    } else {
      $sqlMakeVisible = "UPDATE wp_k_products SET visible = 0 WHERE product_maker = '$emailAccount' LIMIT $maxProductos";
      $conexion->query($sqlMakeVisible);
    }

    echo json_encode(array('status' => 'success', 'message' => 'Membership status checked successfully'));
  } else {
    echo json_encode(array('status' => 'error', 'message' => 'No membership type found for the user'));
  }

  // Cerrar la conexión a la base de datos
  $conexion->close();
}
