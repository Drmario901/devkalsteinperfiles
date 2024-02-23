<?php 
	require __DIR__ . '/../conexion.php';

	$salida = "<option selected value='0'>Choose an option</option>";

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
		$salida.="<div class='nodatos'><h5>No data found in your search</h5></div>";
	}
	
	echo $salida;
	$conexion->close();
 ?>