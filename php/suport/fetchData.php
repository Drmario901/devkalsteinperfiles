<?php 
     
	require __DIR__ . '/../conexion.php';

	$salida = "<option value='0'>Selecciona el producto que deseas editar.</option>";

	$consulta = "SELECT * FROM wp_k_products_add";		
	$resultado = $conexion->query($consulta);

    while ($rows = $resultado->fetch_array()){
      $datos = $rows['p_aid'];
        $salida.= "<option value='$datos' style='color: #000 !important'>$datos</option>";
    }


	echo $salida;
	$conexion->close();

?>