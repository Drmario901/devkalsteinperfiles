<?php 
	require __DIR__ . '/../conexion.php';

    $lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';
    $descriptionField = "product_category_" . $lang;

	// $salida = "<option selected value='0' style='color: #000 !important;'>Choisir une option</option>";

	// $consulta = "SELECT * FROM `wp_categories` ORDER BY `wp_categories`.`categorie_description` ASC";		
		
	// $resultado = $conexion->query($consulta);
	// $categorys = [];	


    // if cookie = en then remove _en from the fields
    if ($lang == 'en') {
        $lineField = "product_line";
        $descriptionField = "product_category";
        $subField = "product_subcategory";
    }


    $consulta = "SELECT $descriptionField FROM wp_k_products ORDER BY $descriptionField ASC";
    $resultado = $conexion->query($consulta);
    $categorys = [];

	$salida = "<option selected value='0' style='color: #000 !important;'>Choisir une option</option>";

	// if ($resultado->num_rows > 0) {
	// 	while ($value = $resultado->fetch_assoc()) {
    //         //$products = $value["categorie_description"];
    //        if (in_array($value['categorie_description_'.$lang], $categorys)){
	// 		}else{
	// 			array_push($categorys, $value['categorie_description_'.$lang]);
	// 		}
			
	// 	}
	// } 

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            if (in_array($fila[$descriptionField], $categorys)) {
            } else {
                array_push($categorys, $fila[$descriptionField]);
            }
        }
    } else {
        $salida .= "<div class='nodatos'><h5>No data found in your search</h5></div>";
    }
	
	foreach ($categorys as $value) {
		$salida.="                    
		<option style='color: #000 !important;' value='".$value."'>".$value."</option>";
	}
	
	echo $salida;
	print_r($categorys);
	$conexion->close();
 ?>
