<?php

    session_start();

    require __DIR__.'/../conexion.php';

    $acc_id = $_SESSION['emailAccount'];

    if (isset($_POST['delete_aid'])) {

        $deleteAid = $_POST['delete_aid'];

        $deleteQuery = "DELETE FROM wp_servicios WHERE SE_id = '$deleteAid'";
        $deleteResult = $conexion->query($deleteQuery);

        if ($deleteResult) {

            echo 'done';
        }
    }
?>
