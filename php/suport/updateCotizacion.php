<?php
    session_start();
    header("Content-Type: application/json");

    require_once __DIR__ . '/../../db/conexion.php';

    // Verificar si la sesión existe
    if (!isset($_SESSION["emailAccount"])) {
        echo json_encode(["status" => "Incorrecto", "mensaje" => "Usuario no autenticado."], JSON_FORCE_OBJECT);
        exit; // Finalizar ejecución si no hay sesión
    }

    // Asegurarse de que los datos POST necesarios estén disponibles
    if (!isset($_POST["cotizacion_status"], $_POST["cotizacion_status_nombre"])) {
        echo json_encode(["status" => "Incorrecto", "mensaje" => "Datos insuficientes para la operación."], JSON_FORCE_OBJECT);
        exit; // Finalizar ejecución si faltan datos
    }

    $user = $_SESSION["emailAccount"];
    $cotizacion_status = $_POST["cotizacion_status"];
    $cotizacion_status_nombre = $_POST["cotizacion_status_nombre"];

    // Preparar la consulta para prevenir inyecciones SQL
    $sql = "UPDATE wp_cotizacion SET cotizacion_status = ? WHERE cotizacion_id = ?";
    $stmt = $conexion->prepare($sql);

    if ($stmt === false) {
        echo json_encode(["status" => "Incorrecto", "mensaje" => "Error al preparar la consulta."], JSON_FORCE_OBJECT);
        exit;
    }

    // Vincular parámetros y ejecutar
    $stmt->bind_param("ss", $cotizacion_status, $cotizacion_status_nombre);
    $resultado = $stmt->execute();

    if ($resultado) {
        echo json_encode(["status" => "Correcto", "mensaje" => "Mise à jour réussie !!!"], JSON_FORCE_OBJECT);
    } else {
        echo json_encode(["status" => "Incorrecto", "mensaje" => "Rejet de la mise à niveau. Error: " . $stmt->error], JSON_FORCE_OBJECT);
    }

    // Cerrar el statement
    $stmt->close();
?>