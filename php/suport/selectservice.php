<?php 
     
	require __DIR__ . '/../conexion.php';

	$salida = "<option value='0'>Selecciona el producto que deseas editar.</option>";

	$consulta = "SELECT * FROM WP_servicios";		
	$resultado = $conexion->query($consulta);

    while ($rows = $resultado->fetch_assoc()){
      $datos = $rows['SE_id'];
        $salida.= "<option value='$datos' style='color: #000 !important'>$datos</option>";
    } 


	echo $salida;
	$conexion->close();

?>