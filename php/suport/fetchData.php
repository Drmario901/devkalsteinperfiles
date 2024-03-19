<?php 
    require_once __DIR__ . '/../../db/conexion.php';

	include 'translateText.php';
	translateText();

	$salida = "<option value='0' data-i17n='client:seleccionarEditar'>Selecciona el producto que deseas editar.</option>";

	$consulta = "SELECT * FROM wp_k_products_add";		
	$resultado = $conexion->query($consulta);

    while ($rows = $resultado->fetch_array()){
      $datos = $rows['p_aid'];
        $salida.= "<option value='$datos' style='color: #000 !important'>$datos</option>";
    }


	echo $salida;
	$conexion->close();

?>