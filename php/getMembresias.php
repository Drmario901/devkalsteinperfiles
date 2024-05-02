<?php
require __DIR__ . '/conexion.php';

session_start();
$acc = $_SESSION['emailAccount'];

// Utiliza la función de conexión que se ajusta a la base de datos
$conexion_usada = $conexion; // Aquí decides qué conexión utilizar basado en tu lógica

$query_id_acc = $conexion_usada->prepare("SELECT account_aid FROM wp_account WHERE account_correo = ?");
$query_id_acc->bind_param("s", $acc);
$query_id_acc->execute();
$result = $query_id_acc->get_result();
$account_id = $result->fetch_assoc()['account_aid'];

$response = array(); // Crear un array para la respuesta

if ($account_id) {
  $query = $conexion_usada->prepare("SELECT fecha_inicio, fecha_final, referencia_pago, estado_membresia FROM wp_subscripcion WHERE user_id = ?");
  $query->bind_param("s", $account_id);
  $query->execute();
  $result = $query->get_result();
  $membership = $result->fetch_assoc();

  if ($membership) {
    $response = [
      'status' => 'success',
      'data' => [
        'fecha_inicio' => $membership['fecha_inicio'],
        'fecha_final' => $membership['fecha_final'],
        'referencia_pago' => $membership['referencia_pago'],
        'estado_membresia' => $membership['estado_membresia']
      ]
    ];
  } else {
    $response = ['status' => 'error', 'message' => 'No se encontraron detalles de la membresía para el usuario.'];
  }
} else {
  $response = ['status' => 'error', 'message' => 'No se encontró la cuenta con ese correo.'];
}

header('Content-Type: application/json');
echo json_encode($response);
