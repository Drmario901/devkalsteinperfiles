<?php 

require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/db/conexion.php';

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Parámetros para la paginación
$filasPorPagina = 10; // Cambiar según necesidad
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina - 1) * $filasPorPagina;

// Consulta para paginación
$sql = "SELECT id, id_cotizacion, monto_total, cotizacion_divisa, cotizacion_id_remitente, status_payment FROM wp_monetico LIMIT $offset, $filasPorPagina";
$resultado = $conexion->query($sql);

// Array para almacenar los datos
$datos = [];
if ($resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
        $datos[] = $fila;
    }
}

// Obtener el total de filas
$sqlTotal = "SELECT COUNT(id) AS total FROM wp_monetico";
$resultadoTotal = $conexion->query($sqlTotal);
$filaTotal = $resultadoTotal->fetch_assoc();
$totalFilas = $filaTotal['total'];

// Calcular el total de páginas
$totalPaginas = ceil($totalFilas / $filasPorPagina);

// Cerrar conexión
$conexion->close();

// A continuación, podrías pasar $datos, $pagina, $totalPaginas, etc., a tu frontend
?>

