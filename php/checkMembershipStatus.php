<?php
session_start();
require_once 'conexion.php'; // Asegúrate de que este archivo contenga la lógica de conexión correcta

// Validación y desinfección de la entrada del usuario
$emailAccount = filter_var($_SESSION['emailAccount'], FILTER_SANITIZE_EMAIL);

// Conexión a la base de datos (con manejo de excepciones)
try {
  if ($conexion->connect_error) {
    throw new Exception("Error de conexión: " . $conexion->connect_error);
  }

  // Consulta preparada para obtener el tipo de membresía y contar productos (combinadas)
  $stmt = $conexion->prepare("SELECT tipo_membresia, 
                                      (SELECT COUNT(*) FROM wp_k_products WHERE product_maker = ?) AS total_productos
                               FROM wp_account 
                               WHERE account_correo = ?");
  $stmt->bind_param("ss", $emailAccount, $emailAccount);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $tipoDeMembresia = $row['tipo_membresia'];
    $totalProductos = $row['total_productos'];

    // Determinar el máximo de productos permitidos
    $maxProductos = 0;
    switch ($tipoDeMembresia) {
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

    // Actualizar la visibilidad de los productos
    if ($totalProductos > $maxProductos) {
      $excess = $totalProductos - $maxProductos;
      $updateStmt = $conexion->prepare("UPDATE wp_k_products SET visible = IF(product_create_at <= (
                SELECT product_create_at FROM wp_k_products WHERE product_maker = ? ORDER BY product_create_at DESC LIMIT 1 OFFSET ?
            ), 1, 0) WHERE product_maker = ?");
      $updateStmt->bind_param("iis", $emailAccount, $excess, $emailAccount);
      $updateStmt->execute();
    }

    echo json_encode(array('status' => 'success', 'message' => 'Estado de membresía verificado con éxito'));

  } else {
    echo json_encode(array('status' => 'error', 'message' => 'No se encontró ningún tipo de membresía para el usuario'));
  }

} catch (Exception $e) {
  // Manejo de errores (registra el error o muestra un mensaje amigable)
  error_log("Error en la base de datos: " . $e->getMessage());
  echo json_encode(array('status' => 'error', 'message' => 'Ocurrió un error. Por favor, inténtalo de nuevo más tarde.'));
} finally {
  $conexion->close();
}
?>