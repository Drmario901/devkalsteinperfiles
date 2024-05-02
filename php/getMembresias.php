<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/conexion.php';

// Asegúrate de que la sesión esté iniciada
session_start();

$acc = $_SESSION['emailAccount'];

// Preparar y ejecutar la primera consulta
$query_id_acc = $pdo->prepare("SELECT account_aid FROM accounts WHERE account_correo = ?");
$query_id_acc->execute([$acc]);
$account_id = $query_id_acc->fetchColumn();

echo 'ACC: ' . $acc;

// Preparar y ejecutar la segunda consulta, asumiendo que ya tienes el ID del usuario
if ($account_id) {
  $query = $pdo->prepare("SELECT fecha_inicio, fecha_final, referencia_pago, estado_membresia FROM wp_subscripcion WHERE user_id = ?");
  $query->execute([$account_id]);
  $membership = $query->fetch(PDO::FETCH_ASSOC);

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
