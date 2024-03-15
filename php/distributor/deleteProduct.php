<?php

    session_start();

    require __DIR__.'../../db/conexion.php';

    $acc_id = $_SESSION['emailAccount'];

    if (isset($_POST['delete_aid'])) {

        $deleteAid = $_POST['delete_aid'];

        // recuperando manual
        $consulta = "SELECT product_manual FROM wp_k_products WHERE product_aid = '$deleteAid'";
        $result = $conexion->query($consulta)->fetch_array()[0];

        if($result != ''){
            unlink('https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/manuals/upload/'.$result);

            $deleteQuerypdf = "DELETE FROM wp_manuales WHERE M_pdf = '$result' AND M_maker = '$acc_id'";
            $deleteResultpdf = $conexion->query($deleteQuerypdf);
        }

        $deleteQuery = "DELETE FROM wp_k_products WHERE product_aid = '$deleteAid' AND product_maker = '$acc_id'";
        $deleteResult = $conexion->query($deleteQuery);

        if ($deleteResult) {

            echo 'done';
        }
    }
?>
