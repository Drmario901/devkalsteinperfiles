<?php
    require __DIR__.'../../db/conexion.php';

    if (isset($_POST['quote_id'])){


        $foreignId = $_POST['quote_id'];

        $consulta = "SELECT * FROM wp_cotizacion_detalle WHERE cotizacion_detalle_id = $foreignId";

        $resultado = $conexion->query($consulta);

        if ($resultado->num_rows > 0) {

            $quotes = array();

            while ($row = $resultado->fetch_assoc()) {
                $name = $row['cotizacion_detalle_name'];
                $model = $row['cotizacion_detalle_model'];
                $cant = $row['cotizacion_detalle_cant'];
                $image = $row['cotizacion_detalle_image'];
                $parent = $row['cotizacion_detalle_parent'];

                $quote = array(
                    "product_name" => $name,
                    "product_model" => $model,
                    "product_quantity" => $cant,
                    "product_image" => 'https://dev.kalstein.plus/plataforma/wp-content/uploads/kalsteinQuote/'.$image
                );
                
                if($parent != ''){
                    $quote["product_image"] = '';
                    $quote["product_name"] = "<b>--Accesory--</b>";
                    $quote["product_quantity"] = 1;
                }
                array_push($quotes, $quote);
            }
        }
    }
    
    echo json_encode($quotes);
?>
