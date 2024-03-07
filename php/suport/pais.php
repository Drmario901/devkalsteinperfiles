<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require __DIR__ . '/../conexion.php';

	include 'translateText.php';
	translateText();

	$salida = "<option selected value='0' data-i17n='client:elegirOpcion'>Choose an option</option>";

	$consulta = "SELECT * FROM wp_paises ORDER BY en ASC";		
		
	$resultado = $conexion->query($consulta);
		
	if ($resultado->num_rows > 0) {
		while ($value = $resultado->fetch_assoc()) {
            $id = $value["id"];
            $iso = $value["iso"];
            $nombre = $value["en"]; 

            $salida.="
                <option value='$iso' style='color: #000 !important;'>$nombre</option>
            ";
		}
	
		$salida.="</tbody></table>";
	} else {
		$salida.="<div class='nodatos'><h5 data-i17n='client:dataNotFound'>No data found in your search</h5></div>";
	}
	
	echo $salida;
	$conexion->close();
 ?>