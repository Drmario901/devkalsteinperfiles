<?php
require __DIR__ . '/conexion.php';

session_start();
$acc = $_SESSION['emailAccount'];

// Utiliza la función de conexión que se ajusta a la base de datos
$conexion_usada = $conexion; // Aquí decides qué conexión utilizar basado en tu lógica

$query_id_acc = $conexion_usada->prepare("SELECT account_aid FROM accounts WHERE account_correo = ?");
$query_id_acc->bind_param("s", $acc);
$query_id_acc->execute();
$result = $query_id_acc->get_result();
$account_id = $result->fetch_assoc()['account_aid'];

echo 'ACC: ' . $acc;

if ($account_id) {
  $query = $conexion_usada->prepare("SELECT fecha_inicio, fecha_final, referencia_pago, estado_membresia FROM wp_subscripcion WHERE user_id = ?");
  $query->bind_param("s", $account_id);
  $query->execute();
  $result = $query->get_result();
  $membership = $result->fetch_assoc();

  if ($membership) {
    echo 'Fecha Inicio: ' . $membership['fecha_inicio'] . "<br>";
    echo 'Fecha Final: ' . $membership['fecha_final'] . "<br>";
    echo 'Referencia de Pago: ' . $membership['referencia_pago'] . "<br>";
    echo 'Estado de Membresía: ' . $membership['estado_membresia'];
  } else {
    echo "No se encontraron detalles de la membresía para el usuario.";
  }
} else {
  echo "No se encontró la cuenta con ese correo.";
}
