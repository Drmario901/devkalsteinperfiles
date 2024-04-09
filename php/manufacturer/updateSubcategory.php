<?php

    require_once __DIR__ . '/../../db/conexion.php';

    if (isset($_POST['category'])) {
        $category = $_POST['category'];

        $query = "SELECT categorie_sub_es FROM wp_categories WHERE categorie_description_es = ? ORDER BY categorie_sub_es ASC";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            if ($row['categorie_sub_es'] === '') {
                echo '';
            }
        } else {
            $options = "<option value=''>Seleccione una subcategoría...</option>";
            while($row = $result->fetch_assoc()) {
                if ($row['categorie_sub_es'] !=='') {
                    $options .= "<option value='".$row['categorie_sub_es']."'>".$row['categorie_sub_es']."</option>";
                }
            }

            echo $options;
        }
    }

?>