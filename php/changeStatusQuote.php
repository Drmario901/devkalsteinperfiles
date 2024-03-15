<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

session_start();
if (isset($_SESSION["emailAccount"])) {
    $email = $_SESSION["emailAccount"];
} else {
    // Considera manejar el caso donde no existe la sesión o redirigir al usuario.
    // exit('No se ha iniciado sesión.'); // Por ejemplo.
}

<<<<<<< HEAD
require __DIR__ . '../db/conexion.php';
require __DIR__ . '/translations.php';
=======
require __DIR__ . '/conexion.php';
>>>>>>> d03330dc9257924955e26ceefec01c5da91e6e8d

// Debes asegurarte de que estás recibiendo los datos 'consulta' y 'consulta2' y validarlos.
if (!isset($_POST['consulta'], $_POST['consulta2'])) {
    exit('Los datos necesarios no están presentes.');
}

$consulta = $_POST['consulta'];
$id = $_POST['consulta2'];

// Es mejor usar sentencias preparadas para evitar inyecciones SQL.
if (!in_array($consulta, ['0', '3', '2'], true)) {
    exit('Valor de consulta no válido.'.$consulta);
}

$statusMap = ['Pending' => '0', 'Process' => '3', 'Cancel' => '2'];
$consulta = $statusMap[$consulta];

// Preparar la consulta para evitar inyecciones SQL
$query = $conexion->prepare("UPDATE wp_cotizacion SET cotizacion_status = ? WHERE cotizacion_id = ?");
$query->bind_param("si", $consulta, $id);
if ($query->execute()) {
    $registerUpdate = $conexion->prepare("INSERT INTO wp_register_updates(account_id, updates_date, update_description) VALUES (?, CURRENT_TIMESTAMP, ?)");
    $description = "The status of QUO$id was changed";
    $registerUpdate->bind_param("ss", $email, $description);
    $registerUpdate->execute();
    $update = 'correcto';
} else {
    $update = 'incorrecto'; // Esto debe ser 'incorrecto' si la actualización falla.
}

$datos = array(
    'update' => $update
);

echo json_encode($datos, JSON_FORCE_OBJECT);
$conexion->close();
?>
