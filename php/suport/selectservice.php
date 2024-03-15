<?php 
     
	require __DIR__ . '../../db/conexion.php';

	include 'translateText.php';
	translateText();

	$salida = "<option value='0' data-i17n='client:seleccionarEditar' >Selecciona el producto que deseas editar.</option>";

	$consulta = "SELECT * FROM WP_servicios";		
	$resultado = $conexion->query($consulta);

    while ($rows = $resultado->fetch_assoc()){
      $datos = $rows['SE_id'];
        $salida.= "<option value='$datos' style='color: #000 !important'>$datos</option>";
    } 


	echo $salida;
	$conexion->close();

?>