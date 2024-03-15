<?php 

	require __DIR__ . '/../conexion.php';

	$salida = "<option selected value='0'>Choose an option</option>";

	$consulta = "SELECT * FROM `wp_k_products_add`";		
		
	$resultado = $conexion->query($consulta);
		
	if ($resultado->num_rows > 0) {
		while ($value = $resultado->fetch_assoc()) {
            $products = $value["product_name"];

            $salida.="
                <option style='color: #000 !important;'>$products</option>
            ";
		}
	} 
	
	echo $salida;
	$conexion->close();
 ?>
