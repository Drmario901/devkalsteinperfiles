<?php 
	require_once __DIR__ . '/../../db/conexion.php';

	include 'translateText.php';
	translateText();

	$salida = "<option selected value='0' >Choose an option</option>";

	$consulta = "SELECT * FROM wp_paises ORDER BY en ASC";		
		
	$resultado = $conexion->query($consulta);
		
	if ($resultado->num_rows > 0) {
		while ($value = $resultado->fetch_assoc()) {
            $id = $value["id"];
            $iso = $value["iso"];
            $nombre = $value["en"]; 

            $salida.="
                <option value='$iso'>$nombre</option>
            ";
		}
	
		$salida.="</tbody></table>";
	} else {
		$salida.="<div class='nodatos'><h5 data-i17n='client:dataNotFound'>No se encontraron datos en su búsqueda</h5></div>";
	}
	
	echo $salida;
	$conexion->close();
 ?>
