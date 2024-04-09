<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/db/conexion.php';

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// $filasPorPagina = 10;
// $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
// $offset = ($pagina - 1) * $filasPorPagina;

// $sql = "SELECT id, id_cotizacion, monto_total, cotizacion_divisa, cotizacion_id_remitente, status_payment FROM wp_monetico LIMIT $offset, $filasPorPagina";
$sql = "SELECT id, id_cotizacion, monto_total, cotizacion_divisa, cotizacion_id_remitente, status_payment FROM wp_monetico WHERE cotizacion_id_remitente <> 'KALSTEIN-INTERNAL';";

$resultado = $conexion->query($sql);

$datos = [];
if ($resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
    }
}

// $sqlTotal = "SELECT COUNT(id) AS total FROM wp_monetico";
// $resultadoTotal = $conexion->query($sqlTotal);
// $filaTotal = $resultadoTotal->fetch_assoc();
// $totalFilas = $filaTotal['total'];
// $totalPaginas = ceil($totalFilas / $filasPorPagina);

$conexion->close();

header('Content-Type: application/json');
echo json_encode($datos);

// echo json_encode([
//     'datos' => $datos,
//     'totalPaginas' => $totalPaginas,
//     'paginaActual' => $pagina
// ]);
?>


