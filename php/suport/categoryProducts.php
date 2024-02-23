<?php 
	require __DIR__ . '/../conexion.php';

	$salida = "<option selected value='0' style='color: #000 !important;'>Choose an option</option>";

	$consulta = "SELECT * FROM `wp_categories` ORDER BY `wp_categories`.`categorie_description` ASC";		
		
	$resultado = $conexion->query($consulta);
	$categorys = array($value['categorie_description']);	
		
	if ($resultado->num_rows > 0) {
		while ($value = $resultado->fetch_assoc()) {
            //$products = $value["categorie_description"];
           if (in_array($value['categorie_description'], $categorys)){
			}else{
				array_push($categorys, $value['categorie_description']);
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
 ?>
