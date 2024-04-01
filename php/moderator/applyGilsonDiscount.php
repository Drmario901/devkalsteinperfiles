<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../conexion.php';

// Asegurar que recibimos los datos necesarios antes de proceder
if(isset($_POST['discount']) && isset($_POST['id'])) {
    $discount = $_POST['discount']; // El descuento viene como un porcentaje, por ejemplo, 20 para un 20% de descuento.
    $id = $_POST['id'];

    // OBTENER EL PRECIO DEL PRODUCTO
    $query = "SELECT product_priceUSD FROM wp_k_products WHERE id = '$id'";
    $result = $conexion->query($query);

    $finalPrice = 0; // Inicializar el precio final.

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $productPrice = $row['product_priceUSD'];
            // Calcular el precio después del descuento.
            $finalPrice = $productPrice - ($productPrice * ($discount / 100));
        }

        // Actualizar el precio con el descuento
        $queryUpdatePrice = "UPDATE wp_k_products SET product_price_gibson = '$finalPrice', descuento_gibson = '$discount' WHERE id = '$id'";

        if($conexion->query($queryUpdatePrice) === TRUE) {
            $response = ['status' => 'correcto', 'message' => 'Descuento aplicado y precio actualizado con éxito.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error al actualizar el precio.'];
        }
    } else {
        $response = ['status' => 'error', 'message' => 'Producto no encontrado.'];
    }
} else {
    $response = ['status' => 'error', 'message' => 'Faltan datos necesarios para el proceso.'];
}

header('Content-Type: application/json');
echo json_encode($response);
