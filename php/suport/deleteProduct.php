<?php

    require __DIR__.'/../conexion.php';

    if (isset($_POST['delete_aid'])) {

        $deleteAid = $_POST['delete_aid'];
        $deleteQuery = "DELETE FROM wp_k_products_add WHERE p_aid = '$deleteAid'";
        $deleteResult = $conexion->query($deleteQuery);

        if ($deleteResult) {

            echo 'done';
        }      
    }
?>
