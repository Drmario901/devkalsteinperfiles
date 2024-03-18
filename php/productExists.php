<?php
    $response = array();

    if (isset($_POST['model'])){
        require __DIR__ . '/conexion.php';

        $model = $_POST['model'];

        $model = str_replace(' (A)', '-A', $model);
        $model = str_replace(' (SS)', '-SS', $model);
        $model = str_replace(' (S)', '-S', $model);

        $query = "SELECT COUNT(*) FROM wp_k_products WHERE product_model = '$model'";
        $result = $conexion->query($query);
        
        $response['results'] = $result->fetch_array()[0];
        // $response['query'] = $query;
    }

    echo json_encode($response);
?>
