<?php
    require __DIR__.'/../../php/conexion.php';

    if(isset($_POST['data_product'])){
        $data_product = $_POST['data_product'];

        $recived = count($data_product);
        $finds = 0;
        $updated = 0;
        $not_found = [];
        $not_updated = [];

        foreach ($data_product as $key => $data) {
            $model       = $data['model'];
            $description = $data['description'];
            $table       = $data['table'];
            $batch       = $_POST['batch'];

            $query = "SELECT * FROM wp_k_products WHERE product_model = '$model'";
            $result = $conexion->query($query);

            if($result->num_rows > 0){
                $finds += 1;

                $queryUpdate = "UPDATE wp_k_products SET product_description = '$description', product_technical_description = '$table' WHERE product_model = '$model'";
                $resultUpdate = $conexion->query($queryUpdate);

                if ($resultUpdate){
                    $updated += 1;
                }
                else {
                    array_push($not_updated, $model);
                }
            }
            else {
                array_push($not_found, $model);
            }
        }

        $response = array(
            'batch' => $batch,
            'info_status' => 'succes',
            'finds' => $finds,
            'updated' => $updated,
            'not_found' => $not_found,
            'not_updated' => $not_updated
        );
    }
    else {
        $response = array(
            'info_status' => 'no_info'
        );
    }

    echo json_encode($response);
?>