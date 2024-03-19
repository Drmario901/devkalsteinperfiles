<?php
	require __DIR__ . '/data_productos.php';

	$salida = "<option selected value='0'>Choose an option</option>";

	$consulta = "SELECT * FROM wp_k_products ORDER BY wp_k_products.product_category ASC";		
		
	$resultado = $conexion->query($consulta);
	$categorys = array($value['product_category']);	
		
	if ($resultado->num_rows > 0) {
		while ($value = $resultado->fetch_assoc()) {
            //$products = $value["categorie_description"];
           if (in_array($value['product_category'], $categorys)){
			}else{
				array_push($categorys, $value['product_category']);
			}
		}
	} 
	
	foreach ($categorys as $value) {
		$salida.="                    
		<option style='color: #000 !important;'>".$value."</option>
			";
	}
	
	echo $salida;
	print_r($categorys);
	$conexion->close();
