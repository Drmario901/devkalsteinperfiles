<?php 

function updateCategoriesFromJson($jsonString, $conexion) {
    $data = json_decode($jsonString, true); // Decode the JSON string into an associative array

    foreach ($data as $id => $info) {
        foreach ($info['categories'] as $category) {
            // Prepare the SQL statement with placeholders
            $sql = "UPDATE wp_categories SET 
                        categorie_line_se = ?,
                        categorie_description_se = ?, 
                        categorie_sub_se = ?
                    WHERE categorie_id = ?";

            // Prepare the statement
            $stmt = $conexion->prepare($sql);

            if (!$stmt) {
                die('Prepare failed: ' . $conexion->error);
            }

            // Bind the values from your JSON to the placeholders
            $stmt->bind_param('sssi', 
                $info['categorie_line_se'],
                $category['categorie_description_se'],
                $category['categorie_sub_se'],
                $id);

            // Execute the statement
            if (!$stmt->execute()) {
                die('Execute failed: ' . $stmt->error);
            }

            // Close the statement
            $stmt->close();
            echo "Updated category with id: $id\n";
        }
    }
}

//Omitan
$jsonString = file_get_contents(__DIR__ . '/categorie_se.json');

if ($jsonString === false) {
    die('Error al leer el archivo JSON');
}

updateCategoriesFromJson($jsonString, $conexion);