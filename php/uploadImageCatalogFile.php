<?php

require_once '../db/conexion.php';

$pdf_folder_path = '/home/he290532/testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/catalogs/upload/';

$thumbnail_folder_path = '/home/he290532/testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/catalogs/thumbnails/';

$jpg_files = glob($thumbnail_folder_path . '*.jpg');

foreach ($jpg_files as $jpg_file) {
    $jpg_name = pathinfo($jpg_file, PATHINFO_FILENAME);

    $pdf_name = $pdf_folder_path . $jpg_name . '.pdf';

    
    if (file_exists($pdf_name)) {
        $sql = "UPDATE wp_catalogs SET catalog_image = '$jpg_name.jpg' WHERE catalog_name = '$jpg_name'";
        
        if ($conexion->query($sql) === TRUE) {
            echo "Updated image field in the database for $jpg_name.pdf <br>";
        } else {
            echo "Error updating the database: " . $conexion->error . "<br>";
        }
    } else {
        echo "No corresponding PDF found for $jpg_name.jpg <br>";
    }
}

$conexion->close();

echo "Process completed.";
?>