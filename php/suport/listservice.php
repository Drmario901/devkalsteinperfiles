<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
error_reporting(E_ALL | E_STRICT);
session_start();
require __DIR__ . '/../conexion.php';

$resp = array();
$acc_id = isset($_SESSION['emailAccount']) ? $_SESSION['emailAccount'] : '';
$cate = isset($_POST['category']) ? $_POST['category'] : '0';
$a = isset($_POST['status']) ? $_POST['status'] : '0';
$page = isset($_POST['page']) ? intval($_POST['page']) : 1; // Asegúrate de que $page sea un entero

$perPage = 5;
$offset = ($page - 1) * $perPage;
$limit = $perPage;

$resp['html'] = '';

$queryAll = "SELECT COUNT(*) count FROM wp_servicios WHERE SE_correo = '$acc_id'";

if ($cate != '0') {
    $queryAll .= " AND SE_category LIKE '%$cate%'"; // Asegúrate de tener espacios antes de AND
}

if ($a != '0') {
    $queryAll .= " AND SE_estado = '$a'"; // Asegúrate de tener espacios antes de AND
}

$resultAll = $conexion->query($queryAll);
$All = $resultAll->fetch_assoc()['count'];

// Ajuste de la página si la solicitud excede el total de elementos
if ($All != null) {
    if ($All <= ($page - 1) * $perPage) {
        $page = intdiv($All, $perPage) + ($All % $perPage > 0 ? 1 : 0);
    }
    $page = max($page, 1);
}

$resp['total'] = $All;
$resp['pagina'] = $page;
$offset = ($page - 1) * $perPage; // Recalcula el offset por si la página fue ajustada

$consulta = "SELECT * FROM wp_servicios WHERE SE_correo = '$acc_id'";

if ($cate != '0') {
    $consulta .= " AND SE_category LIKE '%$cate%'";
}

if ($a != '0') {
    $consulta .= " AND SE_estado = '$a'";
}

$consulta .= " LIMIT $offset, $limit"; // Asegúrate de tener espacios antes de LIMIT

$resultado = $conexion->query($consulta);

if ($resultado && $resultado->num_rows > 0) {
    $i = $offset + 1;
    while ($value = $resultado->fetch_assoc()) {
        // Asegúrate de escapar correctamente los valores para evitar problemas de seguridad
        $id = htmlspecialchars($value['SE_id']);
        $service = htmlspecialchars($value['SE_servicio']);
        // Repite el proceso de escapado para todas las variables utilizadas en el HTML

        // Continúa con el procesamiento y generación de tu HTML
        $resp['html'] .= "<tr>...</tr>"; // Tu HTML aquí
    }
} else {
    $resp['html'] = "<div class='row contentNoDataQuote'...></div>";
}

echo json_encode($resp);
$conexion->close();
?>