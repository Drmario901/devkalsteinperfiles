<?php
    require_once __DIR__ . '/../../db/conexion.php';

    if (isset($_POST['delete_aid'])) {
        $deleteAid = $_POST['delete_aid'];
        $deleteQuery = "DELETE FROM wp_reports WHERE R_id = '$deleteAid'";
        $deleteResult = $conexion->query($deleteQuery);
        if ($deleteResult) {
            echo "Report deleted successfully";
        } else {
            echo "Error deleting report: " . $conexion->error;
        }

        $conexion->close();     
    }

   