<?php
    require __DIR__.'/../conexion.php';

    if (isset($_POST['quotes_id'])){


        $foreignId = $_POST['quotes_id'];

        $consulta = "SELECT * FROM wp_cotizacion_detalle WHERE cotizacion_detalle_id = $foreignId";
        $resultado = $conexion->query($consulta);

        if ($resultado->num_rows > 0) {

            $quotes = array();

            while ($row = $resultado->fetch_assoc()) {
                $name = $row['cotizacion_detalle_name'];
                $maker = $row['cotizacion_detalle_maker'];

                $quote = array(
                    "product_name" => $name,
                    "product_maker" => $maker
                );

                array_push($quotes, $quote);
            }
        }
    }
    
    echo json_encode($quotes);
?>
