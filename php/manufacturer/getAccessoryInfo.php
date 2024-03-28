<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    require_once __DIR__.'/../../db/conexion.php';

    if (isset($_POST['quote_id'])){

        $foreignId = $_POST['quote_id'];

        $consulta = "SELECT * FROM wp_k_products WHERE product_aid = $foreignId";

        $resultado = $conexion->query($consulta);

        if ($resultado->num_rows > 0) {

            $quotes = array();

            while ($row = $resultado->fetch_assoc()) {
                $name = $row['product_name_es'];
                $model = $row['product_model'];
                $cant = $row['product_description_es'];
                $image = $row['product_image'];
                $price = $row['product_priceUSD'];

                $quote = array(
                    "product_name" => $name,
                    "product_model" => $model,
                    "product_description" => $cant,
                    "product_image" => $image,
                    "product_price" => $price
                );

                array_push($quotes, $quote);
            }
        }
    }
    
    echo json_encode($quotes);
?>
