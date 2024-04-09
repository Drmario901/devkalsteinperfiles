<?php

    require_once __DIR__ . '/../../db/conexion.php';

    if (isset($_POST['category'])) {
        $category = $_POST['category'];

        $query = "SELECT categorie_sub_es FROM wp_categories WHERE categorie_description_es = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result();

        $options = "<option value=''>Seleccione una subcategoría...</option>";
        while($row = $result->fetch_assoc()) {
            $options .= "<option value='".$row['categorie_sub_es']."'>".$row['categorie_sub_es']."</option>";
        }

        echo $options;
    }

?>